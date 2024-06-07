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
        $id = '';
        $class = "";
        if (isset($_SESSION['user'])) {
            // getting the user details 
            $id = $_SESSION['user']['id'];
            $class =  $_SESSION['user']['level'];
        }

        $paramForId = [
            'id' => $id,
        ]; // parameter to be pass to the query where id is need
        $paramForLevel = [
            'class' => $class
        ]; // to be passed where the need for to retrieve student level

        // getting all the assignments for each student level
        $assignmentsForEachLevel = $this->db->query('SELECT * FROM assignment WHERE class = :class', $paramForLevel)->fetchAll();

        // getting all the assignment for each lecture
        $assignmentsFormEachLectures = $this->db->query('SELECT * FROM assignment WHERE id = :id', $paramForId)->fetchAll();


        // getting all scores for the student  
        $scores = $this->db->query('SELECT s.id AS score_id, s.id, s.student_id, s.assignment_id, s.score, u.first_name, 
        a.title, a.question, a.course, a.class
        FROM scores s
        JOIN users u ON s.student_id = u.id
        JOIN assignment a ON s.assignment_id = a.id;
        WHERE  s.student_id = :id', $paramForId)->fetchAll();

        // getting all submission
        $submissions = $this->db->query('SELECT s.id AS submission_id, s.id, s.user_id, s.assignment_id, s.file_path, s.created_at, u.first_name, u.last_name, 
        a.title, a.question, a.course, a.class, a.grade
        FROM submissions s
        JOIN users u ON s.user_id = u.id
        JOIN assignment a ON s.assignment_id = a.id;
        ')->fetchAll();


        // getting all submission for each student
        $studentSubmissions = $this->db->query('SELECT s.id AS submission_id, s.id, s.user_id, s.assignment_id, s.file_path, s.created_at, u.first_name, u.last_name, 
        a.title, a.question, a.course, a.class, a.grade
        FROM submissions s
        JOIN users u ON s.user_id = u.id
        JOIN assignment a ON s.assignment_id = a.id;
        WHERE  s.student_id = :id', $paramForId)->fetchAll();

        $isLogin = isset($_SESSION['user']);
        $isLogin ?
            loadView('home', [
                'assignmentsFormEachLectures' => $assignmentsFormEachLectures,
                'assignmentsForEachLevel' => $assignmentsForEachLevel,
                'submissions' => $submissions,
                'studentSubmissions' => $studentSubmissions,
                'scores' => $scores,
            ]) : loadView('landing');
    }
}
