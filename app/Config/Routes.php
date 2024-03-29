<?php

use App\Controllers\Approvecontroller;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('login','Home::login');
$routes->get('/', 'Home::index');
$routes->get('showdata','Home::showdata');
$routes->add('showjob','Home::showjob');
$routes->add('showjob/(:num)','Home::showjob/$1');
$routes->get('showprocess','Home::showprocess');
// $routes->get('addprocess','Home::addprocess');
// $routes->add('job/get', 'Home::showjob');
$routes->add('home/get', 'Home::showprocess');
$routes->get('showjobselect', 'Home::showjobselect');
$routes->get('showdvselect', 'Home::showdvselect');
$routes->get('showafterdiv','Home::showafterdiv');
$routes->get('showdvselect/(:num)', 'Home::showdvselect/$1');
$routes->get('showjobselect/(:num)', 'Home::showjobselect/$1');

$routes->get('formprocess', 'Home::formprocess');
$routes->get('formprocess/(:num)', 'Home::formprocess/$1');
$routes->get('formupdateprocess/(:num)', 'Home::formupdateprocess/$1');
$routes->post('addjob', 'Home::addjob');
$routes->post('insertprocess', 'Managecontroller::insertprocess');
$routes->post('updatejobform','Home::updatejobform');
$routes->post('deleteprocess/(:num)','Managecontroller::deleteprocess/$1');
$routes->post('confirmprocess/(:num)','Managecontroller::confirmprocess/$1');
$routes->post('editjob','Home::editjob');
$routes->post('deletejob','Home::deletejob');
$routes->get('showsubprocess','Home::showsubprocess');
$routes->post('addsubprocess','Home::addsubprocess');
$routes->post('deletesubprocess','Managecontroller::deletesubprocess');
$routes->get('editsubprocess','Home::editsubprocess');
$routes->post('confirmsubprocess','Managecontroller::confirmsubprocess');
$routes->post('updatesubprocess','Managecontroller::updatesubprocess');
// ส่วน approve
$routes->get('approvefirstpage','Approvecontroller::approvefirstpage');
$routes->get('listjobapprove/(:num)','Approvecontroller::listjobapprove/$1');
$routes->post('detailapprove','Approvecontroller::detailapprove');
$routes->post('confirmapprove/(:num)','Approvecontroller::confirmapprove/$1');
$routes->post('rejectapprove/(:num)','Approvecontroller::rejectapprove/$1');
// ต้อง login ถึงจะทำงานได้
// $routes->group('', ['filter' => 'auth'], function($routes){
// });