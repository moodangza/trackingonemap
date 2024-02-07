<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('showdata','Home::showdata');
$routes->add('showjob','Home::showjob');
$routes->get('showprocess','Home::showprocess');
// $routes->get('addprocess','Home::addprocess');
// $routes->add('job/get', 'Home::showjob');
$routes->add('home/get', 'Home::showprocess');
$routes->get('showjobselect', 'Home::showjobselect');
$routes->get('showjobselect/(:num)', 'Home::showjobselect/$1');
$routes->get('formaddprocess', 'Home::formaddprocess');
$routes->get('formaddprocess/(:num)', 'Home::formaddprocess/$1');
$routes->get('formupdateprocess/(:num)', 'Home::formupdateprocess/$1');
$routes->post('addjob', 'Home::addjob');
$routes->post('insertprocess', 'Home::insertprocess');
$routes->post('updatejob','Home::updatejob');