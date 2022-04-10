<?php
include('includes/config.php');
if(isset($_GET['c']))
{
    $slug = mysqli_real_escape_string($con, $_GET['c']);

    $category = "SELECT slug, meta_title, meta_description, meta_keyword FROM categories WHERE slug='$slug'";
    $category_run = mysqli_query($con, $category);

    if(mysqli_num_rows($category_run) > 0)
    {
        $categoryItem = mysqli_fetch_array($category_run);

        $page_title = $categoryItem['meta_title'];
        $meta_description =$categoryItem['meta_description'];
        $meta_keywords = $categoryItem['meta_keyword'];
    }
    else
    {
        $page_title = "Category Page";
        $meta_description ="Category page description bloggin website";
        $meta_keywords = "php, html, css, laravel, codeigniter, react js";
    }
}
else
{
    $page_title = "Category Page";
    $meta_description ="Category page description bloggin website";
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
                if(isset($_GET['c']))
                {
                    $slug = mysqli_real_escape_string($con, $_GET['c']);

                    $category = "SELECT id,slug FROM categories WHERE slug='$slug'";
                    $category_run = mysqli_query($con, $category);

                    if(mysqli_num_rows($category_run) > 0)
                    {
                        $categoryItem = mysqli_fetch_array($category_run);
                        $category_id = $categoryItem['id'];

                        $posts = "SELECT category_id,name, slug, created_at FROM posts WHERE category_id='$category_id' AND status='0'";
                        $posts_query = mysqli_query($con, $posts);

                        if(mysqli_num_rows($posts_query) > 0)
                        {
                            foreach($posts_query as $postItem)
                            {
                                ?>
                                <a href="post.php?title=<?=$postItem['slug'];?>" class="text-decoration-none">
                                    <div class="card card-body shadow-sm mb-4">
                                        <h5><?=$postItem['name'];?></h5>
                                        <div>
                                            <label class="text-dark me-2">Posted On: <?= date('d-M-Y', strtotime($postItem['created_at'])); ?></label>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <h4>No Posts Available</h4>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <h4>No such Category found</h4>
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