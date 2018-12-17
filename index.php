<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require_once './user.php'; ?>
<?php require_once './config.php'; ?>

<html>
    <head>
        <title>Web Crawler</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
            <div class="bg-success text-white text-center col-md-12">
                <h1>HOME PAGE</h1>
            </div>
            <?php if(isset($_SESSION['msg'])){ ?>
            <div class="bg-danger text-white col-md-12">
                <?= $_SESSION['msg']; ?>
            </div>
            <?php }
            /*uset session*/
            $user->RemoveSessionErrorMsg();
            ?>
            </div>
            <div class="row">
                <!-- login section begins -->
                <div class="col-md-4 border shadow">
                    <h2 class="bg-primary text-white text-center">LOGIN</h2>

                    <div class="col-md-12 border">
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- login section ends -->
                <!-- registeration section begins -->
                <div class="col-md-4 border shadow">
                    <h2 class="bg-primary text-white text-center">REGISTER</h2>

                    <div class="col-md-12 border">
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="text" class="form-control" name="cpassword">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- registration section ends -->
                <!-- Account activation begins -->
                <div class="col-md-4 border shadow">
                    <h2 class="bg-primary text-white text-center">Account Activation</h2>

                    <div class="col-md-12 border">
                        <form action="account_activation.php" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Activation Code</label>
                                <input type="text" class="form-control" name="active_code">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Account activation ends -->
            </div>
        </div>
    </body>
</html>
