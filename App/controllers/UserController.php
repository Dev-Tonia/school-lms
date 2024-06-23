<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class UserController
{
    protected  $db;
    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show the login page
     *
     * @return void
     */
    public function login()
    {
        loadView('users/login');
    }
    /**
     * Show the student register page
     *
     * @return void
     */
    public function studentCreate()
    {
        $classes = $this->db->query('SELECT * FROM classes')->fetchAll();

        loadView('users/register/student-create', [
            'classes' => $classes
        ]);
    }

    /**
     * Show the lecture register page
     *
     * @return void
     */
    public function lectureCreate()
    {
        loadView('users/register/lecture-create');
    }

    public function studentStore()
    {
        // the classes from the db
        // $classes = $this->db->query('SELECT * FROM classes')->fetchAll();

        $first_name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
        $password    = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPassword    = filter_input(INPUT_POST, 'confirm-password', FILTER_SANITIZE_SPECIAL_CHARS);
        $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $reg_no    = filter_input(INPUT_POST, 'reg-no', FILTER_SANITIZE_SPECIAL_CHARS);
        $level    = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_SPECIAL_CHARS);
        $user_type    = 'Student';

        // Validations
        $errors = [];

        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }
        if (!Validation::string($first_name, 3, 50)) {
            $errors['firstName'] = 'Name must be between 3 and 50';
        }
        if (!Validation::string($last_name, 3, 50)) {
            $errors['lastName'] = 'Name must be between 3 and 50';
        }
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6';
        }
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }
        if (!Validation::match($password, $confirmPassword)) {
            $errors['password-confirmation'] = 'Password does not match';
        }
        if (empty(trim($level))) {
            $errors['level'] = 'Select your current level';
        }
        if (!Validation::string($reg_no)) {
            $errors['reg-no'] = 'Reg-no is required';
        }

        //checking if error exist
        if (!empty($errors)) {
            loadView('users/register/student-create', [
                'errors' => $errors,
                'user' => [
                    'firstName' => $first_name,
                    'lastName' => $last_name,
                    'email' => $email,
                    'reg-no' => $reg_no,
                    'level' => $level,

                ]
            ]);
            exit;
        }
        $flashMessage = [];
        // check if email already exist
        $params = ['email' => $email];
        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();
        if ($user) {
            $flashMessage['email'] = 'Email already exists';
            loadView('users/register/student-create', [
                'flashMessage' => $flashMessage,
            ]);
            exit;
        }
        // Create user account
        $params = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'reg_no' => $reg_no,
            'class_id' => $level,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'user_type' => $user_type
        ];
        $this->db->query('INSERT INTO users (first_name, last_name, email,  reg_no, class_id, user_type, password) VALUES (:first_name, :last_name, 
            :email,  :reg_no, :class_id, :user_type,  :password)', $params);

        redirect('/auth/login');
    }

    /**
     * register staff
     *
     * @return void
     */
    public function staffStore()
    {

        $first_name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
        $password    = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPassword    = filter_input(INPUT_POST, 'confirm-password', FILTER_SANITIZE_SPECIAL_CHARS);
        $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $employee_no    = filter_input(INPUT_POST, 'reg-no', FILTER_SANITIZE_SPECIAL_CHARS);
        $user_type    = 'Lecturer';

        // Validations
        $errors = [];

        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }
        if (!Validation::string($first_name, 3, 50)) {
            $errors['firstName'] = 'Name must be between 3 and 50';
        }
        if (!Validation::string($last_name, 3, 50)) {
            $errors['lastName'] = 'Name must be between 3 and 50';
        }
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6';
        }
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }
        if (!Validation::match($password, $confirmPassword)) {
            $errors['password-confirmation'] = 'Password does not match';
        }
        if (!Validation::string($employee_no)) {
            $errors['reg-no'] = 'Reg-no is required';
        }

        //checking if error exist
        if (!empty($errors)) {
            loadView('users/register/lecture-create', [
                'errors' => $errors,
                'user' => [
                    'firstName' => $first_name,
                    'lastName' => $last_name,
                    'email' => $email,
                    'reg-no' => $employee_no,
                ]
            ]);
            exit;
        }
        $flashMessage = [];
        // check if email already exist
        $params = ['email' => $email];
        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();
        if ($user) {
            $flashMessage['email'] = 'Email already exists';
            loadView('users/register/lecture-create', [
                'flashMessage' => $flashMessage,
            ]);
            exit;
        }
        // Create user account
        $params = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'employee_no' => $employee_no,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'user_type' => $user_type
        ];
        $this->db->query('INSERT INTO users (first_name, last_name, email,  employee_no, user_type, password) VALUES (:first_name, :last_name, 
            :email,  :employee_no, :user_type,  :password)', $params);

        redirect('/auth/login');
    }

    public function auth()
    {
        // getting the input value from the form
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $password    = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        $errors = [];

        // validations
        if (!Validation::email($email)) {
            $errors['email'] = "Please enter valid email";
        }
        if (!Validation::string($password, 6)) {
            $errors['password'] = "Password must be upto 6 characters";
        }
        // Check if errors is not empty
        if (!empty($errors)) {
            loadView('/auth/login', [
                'errors' => $errors
            ]);
            exit;
        }


        // check to make sure that the email exist in the database
        $params = ['email' => $email];
        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();
        if (!$user) {
            $errors['email'] = "Incorrect credentials";
            loadView('/users/login', [
                'errors' => $errors
            ]);
            exit;
        }
        // inspectAndDie($user);
        // check if password is correct
        if (!password_verify($password, $user->password)) {
            $errors['email'] = "Incorrect credentials";
            loadView('/users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // set user session 
        $_SESSION["user"] = [
            'id' => $user->id,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'email' => $user->email,
            'userType' => $user->user_type,
            'classId' => $user->class_id,
            'reg-no' => $user->reg_no,
            'employee-no' => $user->employee_no,

        ];

        redirect('/');
    }
    public function logout()
    {
        // destroying the sessions
        session_unset();
        session_destroy();
        // on setting the cookies
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }
}
