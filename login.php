<?php

require_once './user.php';
require_once './config.php';

$email = trim(filter_input(INPUT_POST, "email",FILTER_SANITIZE_EMAIL));
$password = trim(filter_input(INPUT_POST,"password",FILTER_DEFAULT));

$user->login($email,$password);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

