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
if (!$user) {
    $router->get('/auth/login', 'UserController::login');

    return;
}
if ($user) {
    // assignment routes
    $router->get('/assignments', 'AssignmentController::index');
    $router->get('/assignments/detail', 'AssignmentController::show');
    $router->post('/auth/logout', 'UserController::logout');
}
if ($user['userType'] === 'Lecturer') {
    // assignment routes for only lectures
    $router->get('/assignments/create', 'AssignmentController::create');
    $router->get('/assignments/edit', 'AssignmentController::edit');
    $router->post('/assignments', 'AssignmentController::store');
    $router->post('/assignments/delete', 'AssignmentController::delete');

    // Submission Routes  lecturer 
    $router->post('/submissions/grade', 'SubmissionController::grade');
}

if ($user['userType'] === 'Lecturer' || 'Admin') {
    // Submission Routes both lecturer and admin
    $router->get('/submissions', 'SubmissionController::index');
    $router->get('/submissions/detail', 'SubmissionController::show');
}
if ($user['userType'] === 'Student') {
    $router->post('/assignments/submit', 'AssignmentController::submit');
}
