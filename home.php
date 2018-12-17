<?php
require_once './user.php';
require_once './config.php';
if(empty($_SESSION['user'])){
    header('Location:index.php');
}
//echo "<pre>";print_r($_SESSION);die;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>Home Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>
    <body>
<div class="container">
    <div class="row">
        <div class="col-md-10 bg-primary text-white text-center">
            <h2>WELCOME <?= $_SESSION['user']['fname'].' '.$_SESSION['user']['lname'].'( '.$_SESSION['user']['email'].' )' ?></h2>
        </div>
        <div class="col-md-2 bg-danger text-white text-center">
            <a href="logout.php" class="btn btn-danger text-white"><h2>LOGOUT</h2></a>
        </div>
    </div>
</div>
    </body>
</html>
