<?php
include('config/dbcon.php');
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-5">
        <div class="col-md-12">
            <?php include('message.php');?>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Posts Available
                        <a href="post-add.php" class="btn btn-primary float-end">Add Post</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table stripe">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Image</th>                                    
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $posts = "SELECT p.*, c.name AS cname FROM posts p, categories c WHERE c.id=p.category_id";
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
                                                    <img src="../uploads/posts/<?=$row['image']?>" width="60px" height="60px" />
                                                </td>
                                                <td><?=$row['status'] == '1' ? 'Hidden' : 'Visible'?></td>
                                                <td>
                                                    <a href="post-edit.php?id=<?=$row['id']?>" class="btn btn-sm btn-info">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="post">
                                                    <button type="submit" value="<?=$row['id']?>" name="post_delete_btn" class="btn btn-sm btn-danger">Delete</button>
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
                                            <td colspan="6">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>