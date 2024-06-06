<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class AssignmentController
{
    protected $db;
    private $assignments;
    private $assignment;

    public function __construct()
    {

        $config = require  basePath('config/db.php');
        $this->db = new Database($config);
    }
    public  function index()
    {
        $this->assignments = $this->db->query('SELECT * FROM assignment')->fetchAll();
        loadView('assignments/index', [
            'assignments' => $this->assignments,
        ]);
        // loadView('assignments/index');
    }
    public  function create()
    {
        loadView('assignments/create');
    }
    public  function show()
    {
        $id = $_GET['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $this->assignment = $this->db->query('SELECT * FROM assignment WHERE id = :id', $params)->fetch();

        // Check if listing exists
        if (!$this->assignment) {
            ErrorController::notFound('assignment not found');
            return;
        }
        loadView('assignments/show', [
            'assignment' => $this->assignment
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
        $grade    = filter_input(INPUT_POST, 'grade', FILTER_SANITIZE_SPECIAL_CHARS);
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
        if (!Validation::string($grade)) {
            $errors['dueDate'] = 'Input a due date';
        }

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
                    'grade' => $grade,

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
            'grade' => $grade,
            'user_id' => $_SESSION['user']['id']
        ];
        $this->db->query('INSERT INTO assignment (title, question, class, course, due_date, grade ,user_id ) VALUES
                                                 (:title, :question, :class, :course, :due_date, :grade, :user_id)', $params);


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
            $error = ["The file can't be uploaded. Try again"];
            // inspectAndDie($this->assignments);
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

        // loadView('/');
        // inspectAndDie(basename($file["name"]));
    }
}
