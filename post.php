<?php
include('includes/config.php');
if(isset($_GET['c']))
{
    $slug = mysqli_real_escape_string($con, $_GET['title']);

    $posts = "SELECT * FROM posts WHERE slug='$slug' LIMIT 1";
    $posts_run = mysqli_query($con, $posts);

    if(mysqli_num_rows($posts_run) > 0)
    {
        $categoryItem = mysqli_fetch_array($posts_run);

        $page_title = $categoryItem['meta_title'];
        $meta_description =$categoryItem['meta_description'];
        $meta_keywords = $categoryItem['meta_keyword'];
    }
    else
    {
        $page_title = "Post Page";
        $meta_description ="Post page description bloggin website";
        $meta_keywords = "php, html, css, laravel, codeigniter, react js";
    }
}
else
{
    $page_title = "Post Page";
    $meta_description ="Post page description bloggin website";
    $meta_keywords = "php, html, css, laravel, codeigniter, react js";
}

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
            <?php
                if(isset($_GET['title']))
                {
                    $slug = mysqli_real_escape_string($con, $_GET['title']);

                    $posts = "SELECT * FROM posts WHERE slug='$slug'";
                    $posts_query = mysqli_query($con, $posts);

                    if(mysqli_num_rows($posts_query) > 0)
                    {
                        foreach($posts_query as $postItem)
                        {
                            ?>
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header">
                                        <h5><?=$postItem['name'];?></h5>
                                    </div>
                                    <div class="card-body">
                                        <label class="text-dark me-2">Posted On: <?= date('d-M-Y', strtotime($postItem['created_at'])); ?></label>
                                        <hr/>
                                        <?php
                                        if($postItem['image']!=null)
                                        {
                                            ?>
                                            <img src="uploads/posts/<?=$postItem['image'];?>" alt="<?=$postItem['name'];?>" class="w-50 rounded"/>
                                            <?php
                                        }
                                        ?>
                                        <div>
                                            <?=$postItem['description'];?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <h4>No such Post found</h4>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <h4>No such URL found</h4>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Advertise Area</h4>
                    </div>
                    <div class="card-body">
                        Your Advertise
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>