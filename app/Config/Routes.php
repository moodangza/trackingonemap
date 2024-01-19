<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('showdata','Home::showdata');
$routes->get('showjob','Home::showjob');
$routes->get('showprocess','Home::showprocess');
$routes->add('home/get', 'Home::showprocess');

