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
        $user = '';
        if (isset($_SESSION['user'])) {
            // getting the user details 
            $user =  $_SESSION['user'];
            $id = $user['id'];
            $class =  $user['classId'];
        }
        if (!$user) {
            loadView('landing');
            exit;
        }
        // getting all the assignment 
        $assignments = $this->db->query(' SELECT 
        a.id ,
        a.user_id, 
        a.title, 
        a.question, 
        a.mark_obtainable, 
        a.due_date, 
        a.class_id, 
        c.class_name, 
        a.course_id, 
        co.course_code   FROM 
        assignment a
    LEFT JOIN 
        classes c ON a.class_id = c.id
    LEFT JOIN 
        courses co ON a.course_id = co.id
')->fetchAll();
        // filtering all the assignment to get each lecture assignment
        $assignmentsByLecturer = array_filter($assignments, function ($assignment) use ($id) {
            return $assignment->user_id === $id;
        });

        // filtering all the assignment to get each level assignment
        $assignmentsForEachLevel = array_filter($assignments, function ($assignment) use ($class) {
            return $assignment->class_id === $class;
        });

        // getting all scores for the student  
        $allSubmissions = $this->db->query("SELECT  s.id , s.user_id  , s.assignment_id, s.file_path, s.grade, s.created_at, u.first_name, u.last_name, 
        a.title, a.question, a.user_id AS assignment_creator, a.course_id, a.class_id, a.mark_obtainable,  c.id AS class_id,   c.class_name,    co.id AS course_id,   co.course_code
         FROM  submissions s 
         JOIN users u ON s.user_id = u.id
         JOIN assignment a ON s.assignment_id = a.id 
         LEFT JOIN  classes c ON a.class_id = c.id
         LEFT JOIN  courses co ON a.course_id = co.id 
         LIMIT 10")->fetchAll();

        $lectureSubmission = array_filter($allSubmissions, function ($submission) use ($id) {
            return $submission->assignment_creator === $id;
        });


        // filtering all the submission to get each student submission
        $studentSubmissions = array_filter($allSubmissions, function ($submission) use ($id) {
            return $submission->user_id === $id;
        });
        $paramForUserRole = [
            'user_type' => 'Student',
        ];
        // Select all student
        $students = $this->db->query('SELECT * FROM users WHERE user_type = :user_type', $paramForUserRole)->fetchAll();
        $submissions = '';
        if ($user['userType'] === 'Admin') {
            $submissions = $allSubmissions;
        } else if ($user['userType'] === 'Lecturer') {
            $submissions = $lectureSubmission;
        }


        loadView('home', [
            'assignmentsFormEachLectures' => $assignmentsByLecturer,
            'assignmentsForEachLevel' => $assignmentsForEachLevel,
            'submissions' => $submissions,
            'studentSubmissions' => $studentSubmissions,
            'allAssignment' => $assignments,
            'allStudent' => $students,
        ]);
    }
}
