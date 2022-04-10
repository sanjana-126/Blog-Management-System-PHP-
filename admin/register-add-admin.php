<?php
include('config/dbcon.php');
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Admin/User
                        <a href="view-register.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="code.php" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Password</label>
                                <input type="text" class="form-control" name="password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Role as</label>
                                <select name="role_as" required class="form-control">
                                    <option value="">--Select Role--</option>
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br>
                                <input type="checkbox" name="status" width="70px" height="70px" class="ms-2">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end" name="add_user">Add Admin/User</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>