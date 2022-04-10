<?php
include('includes/config.php');

$page_title = "Register Page";
$meta_description ="Register page description bloggin website";
$meta_keywords = "php, html, css, laravel, codeigniter, react js";

include('includes/header.php');

if(isset($_SESSION['auth']))
{
    if(!isset($_SESSION['message'])){
        $_SESSION['message'] = "You are already Logged In";    
    }
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
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="registercode.php" method="post">
                            <div class="form-group mb-3">
                                <label class="mb-2">Name</label>
                                <input required type="text" placeholder="Name" class="form-control" name="name">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2">Email Id</label>
                                <input required type="email" placeholder="Email Address" class="form-control" name="email">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2">Password</label>
                                <input required type="password" placeholder="Password" class="form-control" name="password">    
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2">Confirm Password</label>
                                <input required type="password" placeholder="Confirm Password" class="form-control" name="cnfpassword">    
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="register_btn" class="btn btn-primary float-end">Register</button>
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