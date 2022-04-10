<?php

session_start();
include('admin/config/dbcon.php');

if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $logi_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($logi_query_run) > 0)
    {
       foreach($logi_query_run as $data)
       {
           $user_id = $data['id'];
           $user_name = $data['name'];
           $user_email = $data['email'];
           $role_as = $data['role_as'];
       }

       $_SESSION['auth'] = true;
       $_SESSION['auth_role'] = "$role_as";
       $_SESSION['auth_user'] = [
           'user_id'=>$user_id,
           'user_name'=>$user_name,
           'user_email'=>$user_email,
       ];

       if($_SESSION['auth_role'] == '1')
       {
            $_SESSION['message'] = "Welcome to dashboard";
            header("Location: admin/index.php");
            exit(0);
       }
       elseif($_SESSION['auth_role'] == '0')
       {
        $_SESSION['message'] = "You are Logged in";
        header("Location: index.php");
        exit(0);
       }

    }
    else
    {
        $_SESSION['message'] = "Credentials does not match";
        header("Location: login.php");
        exit(0);
    }
}
else
{
    $_SESSION['message'] = "You are not allowed to access this page";
    header("Location: login.php");
    exit(0);
}
