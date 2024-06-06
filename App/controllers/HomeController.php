<?php

namespace App\Controllers;

use Framework\Database;

class HomeController
{
    protected $db;

    public function __construct()
    {

        $config = require  basePath('config/db.php');
        $this->db = new Database($config);
    }
    public  function index()
    {
        $id = $_SESSION['user']['id'];

        // $user = $_SESSION['user']['']
        $params = [
            'id' => $id
        ];
        // getting all the assignments
        $assignments = $this->db->query('SELECT * FROM assignment LIMIT 10')->fetchAll();

        // getting all scores 
        $scores = $this->db->query('SELECT s.id AS score_id, s.id, s.student_id, s.assignment_id, s.score, u.first_name, 
        a.title, a.question, a.course, a.class
        FROM scores s
        JOIN users u ON s.student_id = u.id
        JOIN assignment a ON s.assignment_id = a.id;
        WHERE  s.student_id = :id', $params)->fetchAll();

        inspectAndDie($scores);        // getting all submission
        $submissions = $this->db->query('SELECT s.id AS submission_id, s.id, s.user_id, s.assignment_id, s.file_path, s.created_at, u.first_name, u.last_name, 
        a.title, a.question, a.course, a.class, a.grade
        FROM submissions s
        JOIN users u ON s.user_id = u.id
        JOIN assignment a ON s.assignment_id = a.id;
        ')->fetchAll();

        $isLogin = isset($_SESSION['user']);
        $isLogin ?
            loadView('home', [
                'assignments' => $assignments,
                'submissions' => $submissions
            ]) : loadView('landing');
    }
}
