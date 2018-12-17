<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User {
    /*     * ***** COPY OF DB CONNECTION ***** */

    private $pdo;

    /*     * *** variable for setting message ***** */
    private $msg;
    
    /***** variable for setting user details *****/
    private $user;
    
    /**** variable for login attempts ****/
    private $permitedAttemps = 5;
    
    public function dbConnection($conString, $user, $pass) {
        if (session_status() === PHP_SESSION_ACTIVE) {
            try {
                $pdo = new PDO($conString, $user, $pass);
                $this->pdo = $pdo;
                return true;
            } catch (PDOException $e) {
                $this->msg = "Could Not Be Connected";
                echo 12;
                die;
                $this->error_found();
                return false;
            }
        } else {
            $this->msg = "Session Not Set";
            return false;
        }
    }

    public function error_found() {
        // session_start();
        $_SESSION['msg'] = $this->msg;
        header('Location:index.php');
    }
    
    public function success_redirect() {
        // session_start();
        $_SESSION['msg'] = $this->msg;
        header('Location:index.php');
    }

    public function registration($fname, $lname, $email, $password, $cpassword) {
        $pdo = $this->pdo;
        if (($fname == null || $lname == null || $email == null || $password == null || $cpassword == null)) {
            $this->msg = 'Please fill all fields to register';
            $this->error_found();
        }
        if ($password != $cpassword) {
            $this->msg = 'Password and Confirm Password do not match';
            $this->error_found();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->msg = 'Please enter a valid email';
            $this->error_found();
        }

        $password = $this->hashPass($password);
        $confCode = $this->hashPass(date("Y-m-d H:i:s") . $password);

        $statement = $pdo->prepare('INSERT INTO users (fname,lname,email,password,confirm_code) VALUES (?,?,?,?,?)');

        if ($statement->execute([$fname, $lname, $email, $password, $confCode])) {
            if ($this->sendConfirmationMail($email)) {
                $this->msg = 'User Details entered and activation mail sent';
                $this->success_redirect();
            } else {
                $this->msg = 'User Details entered but activation mail could not be sent';
                $this->error_found();
            }
        } else {
            $this->msg = 'User Details Could Not Be Saved';
            $this->error_found();
        }

        if ($fname == null) {
            echo $fname;
            echo 222;
            die;
        }
    }

    public function RemoveSessionErrorMsg() {
        unset($_SESSION['msg']);
    }

    public function hashPass($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function sendConfirmationMail($email){
        $pdo = $this->pdo;
        $statement = $pdo->prepare('SELECT confirm_code FROM users WHERE email = ? limit 1');
        $statement->execute([$email]);
        $code = $statement->fetch();
        
        $subject = 'Confirm Your Registration';
        $message = 'Please confirm your registration by pasting this code in confirmation box'.$code['confirm_code'];
        $headers = 'X-Mailer: PHP/' . phpversion();
        if(mail($email,$subject,$message,$headers)){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function emailActivation($email,$active_code){
        $pdo = $this->pdo;
        $statement = $pdo->prepare('UPDATE users SET confirmed = 1 WHERE email = ? AND confirm_code = ?');
        if(!$statement->execute([$email,$active_code])){
            print_r($statement->errorInfo());
        }
//        echo $active_code;
//        echo $statement->rowCount();
        if($statement->rowCount() > 0){
          //  echo 12;die;
            $statement = $pdo->prepare('SELECT id,fname,lname,email,wrong_logins FROM users WHERE email = ? AND confirmed = 1');
            $statement->execute([$email]);
            $user = $statement->fetch();
            
            $this->user = $user;
            
            session_regenerate_id();
            if(!empty($user['email'])){
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['fname'] = $user['fname'];
                $_SESSION['user']['lname'] = $user['lname'];
                $_SESSION['user']['email'] = $user['email'];
                $_SESSION['user']['user_role'] = $user['user_role'];
                $this->UserHomepage();
            }else{
                //echo 2233;die;
                $this->msg = 'Account Activation Failed';
                $this->error_found();
            }
            
        }else{
           // echo 21;die;
                $this->msg = 'Account Activation Failed';
                $this->error_found();
        }
    }
    
    public function UserHomepage(){
        header('Location:home.php');
    }
    
    public function logout(){
        $_SESSION['user'] = NULL;
        session_regenerate_id();
        header('Location:index.php');
    }
    
    public function login($email,$password){
        if(is_null($this->pdo)){
            $this->msg = 'Connection did not work out!';
            $this->error_found();
        }else{
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id, fname, lname, email, wrong_logins, password, user_role FROM users WHERE email = ? and confirmed = 1 limit 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();
//            echo $password;
//            echo "<br>";
//            echo $user['password'];die;
            if(password_verify($password,$user['password'])){
                if($user['wrong_logins'] <= $this->permitedAttemps){
                    $this->user = $user;
                    session_regenerate_id();
                    $_SESSION['user']['id'] = $user['id'];
                    $_SESSION['user']['fname'] = $user['fname'];
                    $_SESSION['user']['lname'] = $user['lname'];
                    $_SESSION['user']['email'] = $user['email'];
                    $_SESSION['user']['user_role'] = $user['user_role'];
                    $this->UserHomepage();
                }else{
                    $this->msg = 'This user account is blocked, please contact our support department.';
                    $this->error_found();
                }
            }else{
                $this->registerWrongLoginAttemp($email);
                $this->msg = 'Invalid login information or the account is not activated.';
                $this->error_found();
            } 
        }
    }
    private function registerWrongLoginAttemp($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE users SET wrong_logins = wrong_logins + 1 WHERE email = ?');
        $stmt->execute([$email]);
    }

}
