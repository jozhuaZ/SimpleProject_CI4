<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'HomeController::index');

// Registration
$routes->get('/u/registration', 'RegistrationController::index');
$routes->post('/u/register', 'RegistrationController::registerUser');

// Login
$routes->get('/login', 'LoginController::index');
$routes->post('/u/login', 'LoginController::loginUser');
// Logout
$routes->get('/u/logout', 'LoginController::logout');


// Admin
$routes->get('/a/user-record', 'AdminController::userRecord');