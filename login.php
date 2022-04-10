<?php
include('includes/config.php');
$page_title = "Login Page";
$meta_description ="Login page description bloggin website";
$meta_keywords = "php, html, css, laravel, codeigniter, react js";

include('includes/header.php');



if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "You are already Logged In";
    header("Location: index.php");
    exit(0);
}

include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="post">
                            <div class="form-group mb-3">
                                <label class="mb-2">Email Id</label>
                                <input type="email" placeholder="Enter Email Address" class="form-control" name="email">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2">Password</label>
                                <input type="password" placeholder="Enter Password" class="form-control" name="password">    
                            </div> 
                            <div class="form-group mb-3">
                                <button type="submit" name="login_btn" class="btn btn-primary float-end">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>