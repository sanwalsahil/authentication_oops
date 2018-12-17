<?php
require_once './user.php';
require_once './config.php';

$email = trim(filter_input(INPUT_POST, "email" ,FILTER_SANITIZE_EMAIL));
$active_code = trim(filter_input(INPUT_POST, "active_code" ,FILTER_DEFAULT));
//echo "<pre>";print_r($_POST);die;
$user->emailActivation($email,$active_code);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

