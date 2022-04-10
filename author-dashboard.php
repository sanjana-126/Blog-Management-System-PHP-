<?php
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
$user_id = $_SESSION['auth_user']['user_id'];
$name = $_SESSION['auth_user']['user_name'];
$email = $_SESSION['auth_user']['user_email'];
// echo $_SESSION['auth_user']['user_id'];
?>
<div class="container-fluid px-4" style="min-height: 100vh">
    <h1 class="mt-4">Dashboard</h1>
    <h4><?=$name?></h4>
    <h6><?=$email?></h6>
    <div class="col-md-12">
        <?php include('admin/message.php');?>
    </div>
    <div class="row mt-5">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Total Posts
                    <?php
                    $posts = "SELECT * FROM posts WHERE created_by='$user_id'";
                    $posts_run = mysqli_query($con, $posts);
                    $total_posts = mysqli_num_rows($posts_run);
                    ?>
                    <h2><?=$total_posts?></h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Pending Posts
                    <?php
                    $posts = "SELECT * FROM posts WHERE created_by='$user_id' AND status='1'";
                    $posts_run = mysqli_query($con, $posts);
                    $total_pending_posts = mysqli_num_rows($posts_run);
                    ?>
                    <h2><?=$total_pending_posts?></h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Rejected Posts
                    <?php
                    $posts = "SELECT * FROM posts WHERE created_by='$user_id' AND status='2'";
                    $posts_run = mysqli_query($con, $posts);
                    $total_rejected_posts = mysqli_num_rows($posts_run);
                    ?>
                    <h2><?=$total_rejected_posts?></h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="myDataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Post Name</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $posts = "SELECT p.*, c.name AS cname FROM posts p, categories c WHERE p.created_by=$user_id AND c.id=p.category_id";
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
                                    <td>
                                        <?php
                                        if($row['status'] == '0')
                                        {
                                            echo "Approved";
                                        }
                                        elseif($row['status'] == '1')
                                        {
                                            echo "Pending";
                                        }
                                        else
                                        {
                                            echo "Rejected";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                    <a href="post-edit-author.php?id=<?=$row['id']?>" class="btn btn-sm btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <form action="code.php" method="post">
                                            <button type="submit" value="<?=$row['id']?>" name="post_delete_btn" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    <td>
                                    <form action="post-view-author.php" method="post">
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

        <div class="card">
            <a href="post-add-author.php" class="btn btn-primary">Create New Post</a>
        </div>
    </div>
</div>
</div>
<?php
include('includes/footer.php');
?>