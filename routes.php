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

if (
    isset($_SESSION['user'])
) {

    // assignment routes
    $router->get('/assignments', 'AssignmentController::index');
    $router->get('/assignments/create', 'AssignmentController::create');
    $router->get('/assignments/detail', 'AssignmentController::show');
    $router->post('/assignments', 'AssignmentController::store');
    $router->post('/assignments/submit', 'AssignmentController::submit');
    $router->post('/assignments/delete', 'AssignmentController::delete');


    // Submission Routes
    $router->get('/submissions', 'SubmissionController::index');
    $router->get('/submissions/detail', 'SubmissionController::show');
    $router->post('/submissions/grade', 'SubmissionController::grade');

    // auth pages
    $router->post('/auth/logout', 'UserController::logout');
}
