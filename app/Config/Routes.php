<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('showdata','Home::showdata');
$routes->add('showjob','Home::showjob');
$routes->get('showprocess','Home::showprocess');
$routes->get('addprocess','Home::addprocess');
// $routes->add('job/get', 'Home::showjob');
$routes->add('home/get', 'Home::showprocess');

