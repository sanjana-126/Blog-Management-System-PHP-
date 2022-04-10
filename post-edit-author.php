<?php
include('includes/config.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-5">
        <div class="col-md-12">
            <?php include('message.php');?>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Edit Post
                        <a href="author-dashboard.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $post_id = $_GET['id'];
                            $post_query = "SELECT * FROM posts WHERE id='$post_id' LIMIT 1";

                            $post_query_run = mysqli_query($con, $post_query);

                            if(mysqli_num_rows($post_query_run) > 0)
                            {
                                $row = mysqli_fetch_array($post_query_run);
                            }
                            else
                            {
                                ?>
                                    <h4>No Record Found</h4>
                                <?php
                            }

                        }
                    ?>
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$row['id']?>" name="post_id">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label>Category List</label>
                                <?php
                                    $category = "SELECT * FROM categories WHERE status='0'";
                                    $category_run = mysqli_query($con,$category);

                                    if(mysqli_num_rows($category_run) > 0)
                                    {
                                        ?>
                                            <select name="category_id" required class="form-control">
                                                <option value="">-- Select Category --</option>
                                                <?php
                                                    foreach($category_run as $item)
                                                    {
                                                        ?>
                                                        <option value="<?=$item['id']?>" <?= $item['id'] == $row['category_id'] ? 'selected':'' ?> >
                                                            <?=$item['name']?>
                                                        </option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <h5>No Categories Available</h5>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" name="name" value="<?=$row['name']?>" required class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Slug (URL)</label>
                                <input type="text" name="slug" value="<?=$row['slug']?>" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" rows="5" id="your_summernote" required class="form-control"><?= htmlentities($row['description']);?></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" value="<?=$row['meta_title']?>" required class="form-control" max="191">
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
                                <label>Image</label>
                                <input type="hidden" name="old_image" value="<?=$row['image']?>" />
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end" name="post_update">
                                    Update Post
                                </button>
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
include('admin/includes/scripts.php');
?>