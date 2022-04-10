<?php
include('config/dbcon.php');
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">PHP admin panel for Admin</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="col-md-12">
        <?php include('message.php')?>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Total Categories
                    <?php
                    $dash_category = "SELECT * FROM categories";
                    $dash_category_run = mysqli_query($con, $dash_category);
                    $total_categories = mysqli_num_rows($dash_category_run);
                    echo '<h4 class="mb-0">'.$total_categories.'</h4>'
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="category-view.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Total Posts
                    <?php
                    $dash_posts = "SELECT * FROM posts WHERE status='0'";
                    $dash_posts_run = mysqli_query($con, $dash_posts);
                    $total_posts = mysqli_num_rows($dash_posts_run);
                    echo '<h4 class="mb-0">'.$total_posts.'</h4>'
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Total Users
                    <?php
                    $users = "SELECT * FROM users WHERE role_as='0'";
                    $users_run = mysqli_query($con, $users);
                    $total_users = mysqli_num_rows($users_run);
                    echo '<h4 class="mb-0">'.$total_users.'</h4>'
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Total Admins
                    <?php
                    $admins = "SELECT * FROM users WHERE role_as='1'";
                    $admins_run = mysqli_query($con, $admins);
                    $total_admins = mysqli_num_rows($admins_run);
                    echo '<h4 class="mb-0">'.$total_admins.'</h4>'
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="card-header">
            <h4>
                Requests
            </h4>
        </div>
        <div class="card-body">
        <?php include('message.php');?>
            <div class="table-responsive">
                <table class="table table-bordered" id="myDataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Post Name</th>
                            <th>Status</th>
                            <th>Approve</th>
                            <th>Reject</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php
                        $posts = "SELECT p.*, c.name AS cname FROM posts p, categories c WHERE p.status='1' AND c.id=p.category_id";
                                    $posts_run = mysqli_query($con, $posts);
                        // $posts = "SELECT * FROM posts WHERE created_by='$user_id'";
                        $posts_run = mysqli_query($con, $posts);
                        if(mysqli_num_rows($posts_run) > 0)
                        {
                            foreach($posts_run as $row)
                            {
                                ?>
                                <tr>
                                    <td><?=$row['id']?></td>
                                    <td><?=$row['cname']?></td>
                                    <td><?=$row['name']?></td>
                                    <td>Pending</td>
                                    <td>
                                        <form action="code.php" method="post">
                                            <button type="submit" value="<?=$row['id']?>" name="post_approve_btn" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="code.php" method="post">
                                            <button type="submit" value="<?=$row['id']?>" name="post_reject_btn" class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    </td>
                                    <td>
                                    <form action="../post-view-author.php" method="post">
                                        <button type="submit" value="<?=$row['id']?>" name="post_view_btn" class="btn btn-sm btn-primary">View</button>
                                    </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="7">No Data Available</td>
                            </tr>
                            <?php
                        }
                        ?>

                        
                        
                    </tbody>
                </table>
            </div>
    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>