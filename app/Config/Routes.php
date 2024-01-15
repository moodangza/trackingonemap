<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('showdata','Home::showdata');
$routes->get('popupjob','Home::popupjob');

