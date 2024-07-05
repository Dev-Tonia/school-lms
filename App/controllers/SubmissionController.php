<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class SubmissionController
{
    protected $db;

    public function __construct()
    {

        $config = require  basePath('config/db.php');
        $this->db = new Database($config);
    }
    public  function index()
    {
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        $lec_id =   $user['userType'] === 'Lecturer' ?  $user['id'] : '';

        $limit = 2;  // create a limit
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $submissionForCount = $this->db->query('SELECT  s.id , s.user_id  , s.assignment_id, s.file_path, s.grade, s.created_at, u.first_name, u.last_name, 
        a.title, a.question, a.user_id AS assignment_creator, a.course_id, a.class_id, a.mark_obtainable,  c.id AS class_id,   c.class_name,    co.id AS course_id,   co.course_code
         FROM  submissions s 
         JOIN users u ON s.user_id = u.id
         JOIN assignment a ON s.assignment_id = a.id 
         LEFT JOIN  classes c ON a.class_id = c.id
         LEFT JOIN  courses co ON a.course_id = co.id ORDER BY s.created_at DESC ')->fetchAll();
        $totalSubmissions = count($submissionForCount);

        // filtering all the assignment to get each level assignment
        $totalLectureSubmission = count(array_filter($submissionForCount, function ($submission) use ($lec_id) {
            return $submission->assignment_creator === $lec_id;
        }));

        $allSubmissions = $this->db->query("SELECT  s.id , s.user_id  , s.assignment_id, s.file_path, s.grade, s.created_at, u.first_name, u.last_name, 
        a.title, a.question, a.user_id AS assignment_creator, a.course_id, a.class_id, a.mark_obtainable,  c.id AS class_id,   c.class_name,    co.id AS course_id,   co.course_code
         FROM  submissions s 
         JOIN users u ON s.user_id = u.id
         JOIN assignment a ON s.assignment_id = a.id 
         LEFT JOIN  classes c ON a.class_id = c.id
         LEFT JOIN  courses co ON a.course_id = co.id 
         LIMIT $start , $limit ")->fetchAll();

        $lectureSubmission = array_filter($allSubmissions, function ($submission) use ($lec_id) {
            return $submission->assignment_creator === $lec_id;
        });



        $totalPage = 0;
        $submissions = '';
        if ($user['userType'] === 'Admin') {
            $totalPage = ceil($totalSubmissions / $limit);
            $submissions = $allSubmissions;
        } else if ($user['userType'] === 'Lecturer') {
            $totalPage = ceil($totalLectureSubmission / $limit);
            $submissions = $lectureSubmission;
        }

        $prev = max($page - 1, 1);
        $next = min($page + 1, $totalPage);


        loadView('submissions/index', [
            'submissions' => $submissions,
            'totalPage' => $totalPage,
            'prev' => $prev,
            'next' => $next,
            'page' => $page,
        ]);
    }

    public  function show()
    {
        $id = htmlspecialchars($_GET['id'] ?? '');
        $params = [
            'id' => $id
        ];
        // getting the submission
        $submission = $this->db->query('SELECT  s.id , s.user_id, s.assignment_id, s.file_path, s.grade, s.created_at, u.first_name, u.last_name, 
a.title, a.question, a.course_id, a.class_id, a.mark_obtainable,  c.id AS class_id,   c.class_name,    co.id AS course_id,   co.course_code
 FROM  submissions s 
 JOIN users u ON s.user_id = u.id
 JOIN assignment a ON s.assignment_id = a.id 
 LEFT JOIN  classes c ON a.class_id = c.id
 LEFT JOIN  courses co ON a.course_id = co.id  WHERE s.id = :id', $params)->fetch();


        $isScore = false;
        $score = $submission->grade;
        if ($score) {
            $isScore = true;
        }
        // Check if listing exists
        if (!$submission) {
            ErrorController::notFound('submission not found');
            return;
        }

        loadView('submissions/show', [
            'submission' => $submission,
            'isScore' => $isScore
        ]);
    }

    public function grade()
    {
        $id = htmlspecialchars($_POST['sub-id']);

        // getting the user input
        $score    = filter_input(INPUT_POST, 'score', FILTER_SANITIZE_SPECIAL_CHARS);
        $param = [
            'id' => $id
        ];
        // getting the submission to grade
        $submission = $this->db->query('SELECT * FROM submissions WHERE id = :id', $param)->fetch();

        // getting the assignment
        $assParams = [
            'id' => $submission->assignment_id,
        ];


        $assignment = $this->db->query('SELECT * FROM assignment WHERE id = :id', $assParams)->fetch();

        if ($score > $assignment->mark_obtainable) {
            $_SESSION['error'] = [
                'errorMessage' => 'Score is greater than the total mark obtainable'
            ];
            redirect('/submissions');
        }


        $subParams = [
            'grade' => $score,
            'id' => $id
        ];

        $this->db->query('UPDATE submissions SET grade = :grade WHERE id = :id', $subParams);
        redirect('/submissions');
    }
}
