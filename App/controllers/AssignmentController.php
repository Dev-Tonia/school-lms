<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class AssignmentController
{
    protected $db;
    private $assignment;

    public function __construct()
    {

        $config = require  basePath('config/db.php');
        $this->db = new Database($config);
    }
    public  function index()
    {

        $class = "";
        if (isset($_SESSION['user'])) {
            // getting the user details 
            $class =  $_SESSION['user']['level'];
        }

        $params = [
            'class' => $class
        ];

        // getting all the assignments for the lectures
        $assignments = $this->db->query('SELECT * FROM assignment')->fetchAll();
        // getting all assignment for each student level
        $assignmentsForEachLevel = $this->db->query('SELECT * FROM assignment WHERE class = :class', $params)->fetchAll();

        loadView('assignments/index', [
            'assignments' => $assignments,
            'assignmentsForEachLevel' => $assignmentsForEachLevel
        ]);
        // loadView('assignments/index');
    }
    public  function create()
    {
        loadView('assignments/create');
    }
    public  function show()
    {
        $assId = htmlspecialchars($_GET['id'] ?? '');
        $userId = "";
        if (isset($_SESSION['user'])) {
            // getting the user details 
            $userId =  $_SESSION['user']['id'];
        }

        $assParams = [
            'id' =>  $assId
        ];
        // getting all the assignments
        $this->assignment = $this->db->query('SELECT * FROM assignment WHERE id = :id', $assParams)->fetch();
        // Check if listing exists
        if (!$this->assignment) {
            ErrorController::notFound('assignment not found');
            return;
        }
        $isSubmitted = false;
        $subParams = [
            'assignment_id' => $assId,
            'user_id' => $userId
        ];

        $submission = $this->db->query('SELECT * FROM submissions WHERE assignment_id = :assignment_id AND user_id = :user_id', $subParams)->fetch();
        if ($submission) {
            $isSubmitted = true;
        }
        loadView('assignments/show', [
            'assignment' => $this->assignment,
            'isSubmitted' => $isSubmitted
        ]);
    }

    /**
     * Store data to the database
     *
     * @return void
     */
    public function store()
    {
        $class    = filter_input(INPUT_POST, 'class', FILTER_SANITIZE_SPECIAL_CHARS);
        $title    = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $question    = filter_input(INPUT_POST, 'question', FILTER_SANITIZE_SPECIAL_CHARS);
        $course    = filter_input(INPUT_POST, 'course', FILTER_SANITIZE_SPECIAL_CHARS);
        $markObtainable    = filter_input(INPUT_POST, 'mark-obtainable', FILTER_SANITIZE_SPECIAL_CHARS);
        $dueDate    = filter_input(INPUT_POST, 'dueDate');

        // check if the user is login
        if (!isset($_SESSION['user'])) {
            redirect('/');
        }
        $errors = [];
        // validate the user input
        if (!Validation::string($class)) {
            $errors['class'] = 'Class is required';
        }
        if (!Validation::string($title)) {
            $errors['title'] = 'Title is required';
        }
        if (!Validation::string($question)) {
            $errors['question'] = 'Question is required';
        }
        if (!Validation::string($course)) {
            $errors['course'] = 'Course is required';
        }
        if (!Validation::string($dueDate)) {
            $errors['dueDate'] = 'Input a due date';
        }
        if (!Validation::string($markObtainable)) {
            $errors['markObtainable'] = 'Obtainable mark is required';
        }
        // inspectAndDie($grade);

        // check to make sure there is no error.
        if (!empty($errors)) {
            loadView('/assignments/create', [
                'errors' => $errors,
                'assignment' => [
                    'class' => $class,
                    'title' => $title,
                    'question' => $question,
                    'course' => $course,
                    'dueDate' => $dueDate,
                    'markObtainable' => $markObtainable,

                ]
            ]);
            exit;
        }

        // Create user account
        $params = [
            'title' => $title,
            'question' => $question,
            'class' => $class,
            'course' => $course,
            'due_date' => $dueDate,
            'mark_obtainable' => $markObtainable,
            'user_id' => $_SESSION['user']['id']
        ];
        $this->db->query('INSERT INTO assignment (title, question, class, course, due_date, mark_obtainable ,user_id ) VALUES
                                                 (:title, :question, :class, :course, :due_date, :mark_obtainable, :user_id)', $params);


        redirect('/assignments');
    }
    public function submit()
    {
        $assignmentId = $_POST['id']; //this is coming from the hidden input in the submit form
        $file = $_FILES['file'];
        $path = basename($file["name"]);
        $target_file = 'upload/' . $path;
        $isUpload =   move_uploaded_file($file["tmp_name"], $target_file);

        if (!$isUpload) {
            redirect(
                '/assignments'
            );
            exit;
        }
        $params = [
            'file_path' => $path,
            'user_id' => $_SESSION['user']['id'],
            'assignment_id' => $assignmentId
        ];
        $this->db->query('INSERT INTO submissions (file_path, user_id, assignment_id ) VALUES (:file_path, :user_id, :assignment_id)', $params);

        // redirect users
        redirect(
            '/'
        );
    }
    public function edit()
    {
        $assId = htmlspecialchars($_GET['id'] ?? '');
        //         if (!$assId) {
        // redirect('/assignments')            exit;
        //         }
        inspectAndDie($assId);
    }
    public function delete()
    {
        $assignmentId = $_POST['id']; //this is coming from the hidden input in the submit form

        $params = ['id' => $assignmentId];

        $this->db->query('DELETE FROM assignment WHERE id = :id', $params);

        // redirect users
        redirect(
            '/assignments'
        );
    }
}
