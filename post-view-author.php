<?php
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<?php 
if(isset($_POST['post_view_btn']))
{
    $post_id = $_POST['post_view_btn'];
    
    $post = "SELECT * FROM posts WHERE id='$post_id' LIMIT 1";
    $post_run = mysqli_query($con, $post);

    if(mysqli_num_rows($post_run) > 0)
    {
        $row = mysqli_fetch_array($post_run);
        ?>
        
        <div class="py-4">
            <div class="container">
                <div class="row">
                        <div class="category-heading">
                            <h4 class="mb-0"><?=$row['name']?></h4>
                        </div>

                        <div class="card card-shadow mt-4">
                            <div class="card-body post-description">
                            <?=$row['description']?>
                            </div>
                        </div>
                </div>
                <?php
                if($_SESSION['auth_role'] == '1')
                {
                    ?>
                    <div class="row">
                        <button type="button" class="btn btn-success mt-3 float-end">Approve</button>
                        <button type="button" class="btn btn-danger mt-3 float-end">Reject</button>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php
    }
}
?>

<?php
include('includes/footer.php');
include('admin/includes/scripts.php');
?>