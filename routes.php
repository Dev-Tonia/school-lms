<?php

// Defining the routes from the router class
$router->get('/', 'HomeController::index');
// users routes
$router->get('/auth/login', 'UserController::login');
$router->get('/auth/student/register', 'UserController::studentCreate');
$router->get('/auth/lecture/register', 'UserController::lectureCreate');
$router->post('/auth/student/register', 'UserController::studentStore');
$router->post('/auth/lecture/register', 'UserController::staffStore');
$router->post('/auth/login', 'UserController::auth');

$user = '';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'] ?? null;
}
// inspectAndDie($user);
// inspectAndDie($user['userType'] === 'Lecturer' || $user['userType'] ===  'Admin');


if (!$user) {
    $router->get('/auth/login', 'UserController::login');
    return;
}
if ($user) {
    // assignment routes
    $router->get('/assignments', 'AssignmentController::index');
    $router->get('/assignments/detail', 'AssignmentController::show');
    $router->post('/auth/logout', 'UserController::logout');
    $router->get('/assignment/search', 'AssignmentController::search');
}
if ($user['userType'] === 'Lecturer' || $user['userType'] ===  'Admin') {
    // Submission Routes both lecturer and admin
    $router->get('/submissions', 'SubmissionController::index');
    $router->get('/submissions/detail', 'SubmissionController::show');
}
if ($user['userType'] === 'Student') {
    $router->post('/assignments/submit', 'AssignmentController::submit');
}

if ($user['userType'] === 'Lecturer') {
    // assignment routes for only lectures
    $router->get('/assignments/create', 'AssignmentController::create');
    $router->get('/assignments/edit', 'AssignmentController::edit');
    $router->post('/assignments', 'AssignmentController::store');
    $router->post('/assignments/delete', 'AssignmentController::delete');
    $router->post('/assignments/update', 'AssignmentController::update');


    // Submission Routes  lecturer 
    $router->post('/submissions/grade', 'SubmissionController::grade');
}
if ($user['userType'] === 'Admin') {
    $router->get('/admin/classes', 'AdminController::classes');
    $router->get('/admin/courses', 'AdminController::courses');
    $router->get('/admin/students', 'AdminController::student');

    $router->post('/admin/classes', 'AdminController::addClass');
    $router->post('/admin/courses', 'AdminController::addCourse');
    $router->post('/admin/delete-class', 'AdminCOntroller::deleteClass');
    $router->post('/admin/delete-course', 'AdminCOntroller::deleteCourse');
}
