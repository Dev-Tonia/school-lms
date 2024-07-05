<?php

namespace App\Controllers;

use Framework\Database;

class AdminController
{
    protected $db;

    public function __construct()
    {

        $config = require  basePath('config/db.php');
        $this->db = new Database($config);
    }
    public function classes()
    {
        // loadView('assignments/index');
        $classes = $this->db->query('SELECT * FROM classes')->fetchAll();

        loadView('admin/classes', [
            'classes' => $classes
        ]);
    }
    public function courses()
    {
        // loadView('assignments/index');
        $courses = $this->db->query('SELECT * FROM courses')->fetchAll();

        loadView('admin/courses', [
            'courses' => $courses
        ]);
    }
    public function student()
    {
        $paramForUserRole = [
            'user_type' => 'Student',
        ];
        // Select all student
        $students = $this->db->query(' SELECT  u.id AS user_id,  u.first_name,  u.last_name,  u.email,  u.reg_no,  u.employee_no,  u.user_type,  u.created_at  ,
            c.class_name
        FROM 
            users u
        LEFT JOIN 
            classes c ON u.class_id = c.id WHERE user_type = :user_type', $paramForUserRole)->fetchAll();




        loadView('admin/students', [
            'students' => $students
        ]);
    }
    public function addClass()
    {

        // getting the user input
        $class   = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_SPECIAL_CHARS);



        $params = [
            'class_name' => $class,
        ];

        $this->db->query('INSERT INTO classes (class_name ) VALUES ( :class_name)', $params);

        redirect('/admin/classes');
    }
    public function addCourse()
    {

        // getting the user input
        $courseName   = filter_input(INPUT_POST, 'course', FILTER_SANITIZE_SPECIAL_CHARS);

        $courseCode   = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_SPECIAL_CHARS);

        $params = [
            'course_name' => $courseName,
            'course_code' => $courseCode

        ];
        $this->db->query('INSERT INTO courses (course_name , course_code) VALUES ( :course_name, :course_code)', $params);

        redirect('/admin/courses');
    }
    public function deleteClass()
    {
        $classId = $_POST['id']; //this is coming from the hidden input in the submit form
        // inspectAndDie($classId);
        if (!$classId) {
            // redirect users
            redirect(
                '/admin/classes'
            );
            exit;
        }
        $params = ['id' => $classId];

        $this->db->query('DELETE FROM classes WHERE id = :id', $params);

        // redirect users
        redirect(
            '/admin/classes'
        );
    }
    public function deleteCourse()
    {
        $courseId = $_POST['id']; //this is coming from the hidden input in the submit form
        if (!$courseId) {
            // redirect users
            redirect(
                '/admin/courses'
            );
            exit;
        }
        $params = ['id' => $courseId];

        $this->db->query('DELETE FROM courses WHERE id = :id', $params);

        // redirect users
        redirect(
            '/admin/courses'
        );
    }
}
