<?php
include('config/dbcon.php');
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Users</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Users</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User</h4>
                </div>
                <div class="card-body">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $user_id = $_GET['id'];
                            $user = "SELECT * FROM users WHERE id = '$user_id' ";
                            $user_run = mysqli_query($con, $user);

                            if(mysqli_num_rows($user_run) > 0)
                            {
                                foreach($user_run as $item)
                                {
                                    ?>
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="user_id" value="<?= $item['id'];?>">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="">Name</label>
                                                    <input type="text" class="form-control" name="name" value="<?= $item['name']?>">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Email</label>
                                                    <input type="text" class="form-control" name="email" value="<?= $item['email']?>">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Password</label>
                                                    <input type="text" class="form-control" name="password">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Role as</label> 
                                                    <select name="role_as" required class="form-control">
                                                        <option value="">--Select Role--</option>
                                                        <option value="1" <?= $item['role_as'] == '1' ? 'selected':''; ?> >Admin</option>
                                                        <option value="0" <?= $item['role_as'] == '0' ? 'selected':''; ?> >User</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Status</label>
                                                    <input type="checkbox" name="status" width="70px" height="70px" class="ms-2" <?= $item['status'] == '1' ? 'checked':''; ?>>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <button type="submit" class="btn btn-primary float-end" name="update_user">Update User</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                    <h4>No Record Found</h4>
                                <?php
                            }
                        }
                    ?>

                </div>
            </div>
        </div>

    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>