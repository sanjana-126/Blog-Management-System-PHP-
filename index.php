<?php
include('includes/config.php');

$page_title = "Home Page";
$meta_description ="Home page description bloggin website";
$meta_keywords = "php, html, css, laravel, codeigniter, react js";

include('includes/header.php');
include('includes/navbar.php');
$navbarCategory = "SELECT * FROM categories WHERE navbar_status='0' AND status='0'";
$navbarCategory_run = mysqli_query($con, $navbarCategory);
?>
<div class="bg-background py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel category-carousel owl-theme">
                    <?php
                    if (mysqli_num_rows($navbarCategory_run) > 0) {
                        foreach ($navbarCategory_run as $navItem) {
                        ?>
                            <div class="item">
                                <a href="category.php?c=<?= $navItem['slug'] ?>" class="nav-link">
                                    <div class="card">
                                        <img src="uploads/categories/<?= $navItem['image'] ?>" alt="Image" height="200px">
                                        <div class="card-body text-center">
                                            <h5 class="text-dark"><?= $navItem['name'] ?></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="py-1 bg-gray">
    <div class="container">
        <div class="border text-center p-3">
            <h3>Advertise here</h3>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Blog Adda: Find everything about CSE</h4>
                <div class="underline"></div>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque aut nostrum adipisci nobis vero, magni maxime repellendus ipsum repudiandae error tenetur. Laudantium, inventore nemo! Excepturi nobis est quibusdam molestias ratione?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto natus, vel iste, consequuntur, doloribus maiores dolorum repudiandae optio sint facilis obcaecati veritatis officia saepe quaerat neque tempora iure labore. Doloribus.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="py-5 bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>All Categories List</h4>
                <div class="underline"></div>
            </div>
            <?php
            foreach ($navbarCategory_run as $navItem) {
                ?>
                <div class="col-md-3">
                    <div class="card card-body mb-3">
                        <a href="category.php?c=<?= $navItem['slug'] ?>" class="text-decoration-none">
                            <h5 class="text-dark mb-0">
                                <?=$navItem['name']?>
                            </h5>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Recent Posts</h4>
                <div class="underline"></div>
            </div>
            <div class="col-md-8">
                <?php
                $homePosts = "SELECT * FROM posts WHERE status='0' ORDER BY id DESC LIMIT 12";
                $homePosts_query = mysqli_query($con, $homePosts);
                if(mysqli_num_rows($homePosts_query) > 0)
                {
                    foreach($homePosts_query as $item)
                    {
                        ?>
                        <div class="card card-body shadow mb-3">
                            <a href="post.php?title=<?=$item['slug'];?>" class="text-decoration-none">
                                <h5 class="text-dark mb-0">
                                    <?=$item['name']?>
                                </h5>
                            </a>
                            <small class="ms-1 mt-2 text-primary">Posted On: <?= date('d-M-Y', strtotime($item['created_at'])); ?></small>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="col-md-4">
                <div class="border text-center p-3">
                    <h3>Advertise here</h3>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>