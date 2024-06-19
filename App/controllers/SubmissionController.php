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
        $submissions = $this->db->query('SELECT s.id AS submission_id, s.id, s.user_id, s.assignment_id, s.file_path,s.grade , s.created_at, u.first_name, u.last_name, 
        a.title, a.question, a.course, a.class, a.mark_obtainable
        FROM submissions s
        JOIN users u ON s.user_id = u.id
        JOIN assignment a ON s.assignment_id = a.id;
        ')->fetchAll();
        loadView('submissions/index', [
            'submissions' => $submissions,
        ]);
        // loadView('assignments/index');
    }

    public  function show()
    {
        $id = htmlspecialchars($_GET['id'] ?? '');
        $params = [
            'id' => $id
        ];
        // getting the submission
        $submission = $this->db->query('SELECT s.id AS submission_id, s.user_id,  s.assignment_id, s.file_path, s.grade, s.created_at, u.id, 
        u.last_name, a.title, a.question, a.course, a.class, a.mark_obtainable
        FROM submissions s
        JOIN users u ON s.user_id = u.id
        JOIN assignment a ON s.assignment_id = a.id 
        WHERE s.id = :id', $params)->fetch();


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


        $scoreParams = [
            'student_id' => $submission->user_id,
            'assignment_id' => $submission->assignment_id,
            'submission_id' => $submission->id,
            'score' => (float) $score
        ];

        $subParams = [
            'grade' => $score,
            'id' => $id
        ];
        $this->db->query('INSERT INTO scores (student_id, assignment_id, submission_id, score ) VALUES
                                             (:student_id, :assignment_id, :submission_id, :score)', $scoreParams);
        $this->db->query('UPDATE submissions SET grade = :grade WHERE id = :id', $subParams);
        redirect('/submissions');
    }
}
