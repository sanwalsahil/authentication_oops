<?php
session_start();
define('conString','mysql:host=localhost;dbname=authentication');
define('dbUser','root');
define('dbPass','');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user = new User();
$user->dbConnection(conString, dbUser, dbPass);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

