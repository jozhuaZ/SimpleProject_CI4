<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/user/registration', 'RegistrationController::index');
$routes->post('/user/register', 'RegistrationController::registerUser');
