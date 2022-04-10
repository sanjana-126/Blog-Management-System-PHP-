<?php
session_start();
include('admin/config/dbcon.php');

if(isset($_POST['register_btn']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cnfpassword = mysqli_real_escape_string($con, $_POST['cnfpassword']);

    if($password == $cnfpassword)
    {
       $checkemail = "SELECT email FROM users WHERE email = '$email'";
       $checkemail_run = mysqli_query($con, $checkemail);

       if(mysqli_num_rows($checkemail_run) > 0)
       {
           $_SESSION['message'] = "Email Already Exists";
           header("Location: register.php");
           exit(0);
       }
       else
       {
            $user_query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if($user_query_run)
            {
                $_SESSION['message'] = "Registered Successfully";
                header("Location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['message'] = "Something Went Wrong";
                header("Location: register.php");
                exit(0);
            }
       }
    } 
    else 
    {
        $_SESSION['message'] = 'Password and Confirm Password should be same';
        header("Location: register.php");
        exit(0);
    }
}
else
{
    header("Location: register.php");
    exit(0);
}
?>