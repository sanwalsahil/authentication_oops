<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './user.php';
require_once './config.php';

$email = trim(filter_input(INPUT_POST, "email",FILTER_SANITIZE_EMAIL));
$fname = trim(filter_input(INPUT_POST,"fname",FILTER_SANITIZE_STRING));
$lname = trim(filter_input(INPUT_POST,"lname",FILTER_SANITIZE_STRING));
$password = trim(filter_input(INPUT_POST,"password",FILTER_DEFAULT));
$cpassword = trim(filter_input(INPUT_POST,"cpassword",FILTER_DEFAULT));

$user->registration($fname,$lname,$email,$password,$cpassword);

