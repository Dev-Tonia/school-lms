<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use  DateTime;

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
        $student_id = '';
        $lec_id = '';
        if (isset($_SESSION['user'])) {
            // getting the user details 
            $class =   $_SESSION['user']['level'];
            $student_id =   $_SESSION['user']['userType'] === 'Student' ?  $_SESSION['user']['id'] : '';
            $lec_id =   $_SESSION['user']['userType'] === 'Lecturer' ?  $_SESSION['user']['id'] : '';
        }
        $paramForId = [
            'id' => $student_id,
        ];
        // getting all the assignments for the lectures
        $assignments = $this->db->query('SELECT * FROM assignment')->fetchAll();

        // filtering all the assignment to get each level assignment
        $filterAssignmentForStudent = array_filter($assignments, function ($assignment) use ($class) {
            return $assignment->class === $class;
        });
        // filtering all the assignment to get each level assignment
        $filterAssignmentForEachLecture = array_filter($assignments, function ($assignment) use ($lec_id) {
            return $assignment->id === $lec_id;
        });

        // getting all submission
        $submissions = $this->db->query('SELECT s.id AS submission_id, s.id, s.user_id, s.assignment_id, s.file_path, s.grade, s.created_at, u.first_name, u.last_name, 
      a.title, a.question, a.course, a.class, a.mark_obtainable
      FROM submissions s
      JOIN users u ON s.user_id = u.id
      JOIN assignment a ON s.assignment_id = a.id 
      WHERE s.user_id = :id', $paramForId)->fetchAll();
        // inspectAndDie($submissions);
        $assignmentsForEachStudent = getGradesForAssignments(assignments: $filterAssignmentForStudent, submissions: $submissions);

        loadView('assignments/index', [
            'allAssignments' => $assignments,
            'assignmentsForEachStudent' => $assignmentsForEachStudent,
            'assignmentsForEachLecture' => $filterAssignmentForEachLecture,
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
        // Check to make sure that the date is not a paste date 
        $now = new DateTime();
        $now->setTime(0, 0, 0);
        $inputDate = new DateTime($dueDate);
        if ($inputDate < $now) {
            $errors['dueDate'] = 'Select a Future due date';
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
        $assParams = [
            'id' =>  $assId
        ];
        // getting all the assignments
        $assignment = $this->db->query('SELECT * FROM assignment WHERE id = :id', $assParams)->fetch();
        loadView('assignments/edit', [
            'assignment' => $assignment
        ]);
    }

    public function update()
    {
        $isPutRequest = isset($_POST['_method']) && $_POST['_method'] === 'put';
        $id = '';
        if ($isPutRequest) {
            $id = $_POST['id'];
        }
        if (!$id) {
            redirect('/assignments');
        }
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
        // getting all the assignments
        $assignment = $this->db->query('SELECT * FROM assignment WHERE id = :id', ['id' => $id])->fetch();
        // check to make sure there is no error.
        if (!empty($errors)) {
            loadView('/assignments/create', [
                'errors' => $errors,
                'assignment' => $assignment
            ]);
            exit;
        }

        // Create user account
        $params = [
            'id' => $id,
            'title' => $title,
            'question' => $question,
            'class' => $class,
            'course' => $course,
            'due_date' => $dueDate,
            'mark_obtainable' => $markObtainable,
            'user_id' => $_SESSION['user']['id']
        ];
        $this->db->query('UPDATE  assignment SET title = :title, question = :question, class =:class, course= :course, 
        due_date = :due_date, mark_obtainable = :mark_obtainable ,user_id = :user_id WHERE id = :id', $params);


        redirect('/assignments');

        /* 
        $isPutRequest = $_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'put';

         $sql = 'UPDATE books SET title = :title, author = :author,genre = :genre, date = :date WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $params = ["title" => $title, "author" => $author, 'genre' => $genre, 'date' => $date, 'id' => $id];
        $stmt->execute($params);*/
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
