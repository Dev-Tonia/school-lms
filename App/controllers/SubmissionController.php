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
        $submissions = $this->db->query('SELECT s.id AS submission_id, s.id, s.user_id, s.assignment_id, s.file_path, s.created_at, u.first_name, u.last_name, 
        a.title, a.question, a.course, a.class, a.grade
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
        $id = $_GET['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $submission = $this->db->query('SELECT s.id AS submission_id, s.id, s.user_id,  s.assignment_id, s.file_path, s.created_at, u.id, 
        u.last_name, a.title, a.question, a.course, a.class, a.grade
        FROM submissions s
        JOIN users u ON s.user_id = u.id
        JOIN assignment a ON s.assignment_id = a.id 
        WHERE s.id = :id', $params)->fetch();

        // Check if listing exists
        if (!$submission) {
            ErrorController::notFound('submission not found');
            return;
        }
        loadView('submissions/show', [
            'submission' => $submission
        ]);
    }

    public function grade()
    {

        // getting the user input
        $score    = filter_input(INPUT_POST, 'score', FILTER_SANITIZE_SPECIAL_CHARS);


        $id = $_POST['id'];
        $param = [
            'id' => $id
        ];
        $submission = $this->db->query('SELECT * FROM submissions WHERE id = :id', $param)->fetch();

        $params = [
            'student_id' => $submission->user_id,
            'assignment_id' => $submission->assignment_id,
            'submission_id' => $submission->id,
            'score' => $score
        ];

        $this->db->query('INSERT INTO scores (student_id, assignment_id, submission_id, score ) VALUES
                                             (:student_id, :assignment_id, :submission_id, :score)', $params);
        redirect('/submissions');
    }
}