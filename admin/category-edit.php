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
                        Edit Category
                        <a href="category-view.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_GET['id']))
                        {
                            $category_id = $_GET['id'];
                            $category_edit = "SELECT * FROM categories WHERE id = '$category_id' LIMIT 1";
                            $category_edit_run = mysqli_query($con, $category_edit);

                            if(mysqli_num_rows($category_edit_run) > 0)
                            {
                                $row = mysqli_fetch_array($category_edit_run);
                                ?>
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" value="<?= $row['id'] ?>" name="category_id">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Category Name</label>
                                                <input type="text" name="name" required class="form-control" value="<?=$row['name']?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Slug (URL)</label>
                                                <input type="text" name="slug" required class="form-control" value="<?=$row['slug']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label>Description</label>
                                                <textarea name="description" rows="5" required class="form-control"><?=$row['description']?></textarea>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Meta Title</label>
                                                <input type="text" name="meta_title" required class="form-control" value="<?=$row['meta_title']?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Image</label>
                                                <input type="hidden" name="old_image" value="<?=$row['image']?>" />
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Meta Keyword</label>
                                                <textarea name="meta_keyword" rows="3" class="form-control"><?=$row['meta_keyword']?></textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Meta Description</label>
                                                <textarea name="meta_description" rows="3" class="form-control"><?=$row['meta_description']?></textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Navbar Status</label><br>
                                                <input type="checkbox" name="navbar_status" <?=$row['navbar_status'] == '1' ? 'checked': ''?>>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Status</label><br>
                                                <input type="checkbox" name="status" <?=$row['status'] == '1' ? 'checked': ''?>>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <button type="submit" class="btn btn-primary float-end" name="category_update">
                                                    Update Category
                                                </button>
                                            </div>   
                                        </div> 
                                    </form>
                                <?php
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