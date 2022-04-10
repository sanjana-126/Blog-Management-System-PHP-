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
                        Categories Available
                        <a href="category-add.php" class="btn btn-primary float-end">Add Category</a>
                    </h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-bordered table stripe">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $category = "SELECT * FROM categories WHERE status!='2'";
                                $category_run = mysqli_query($con, $category);
                                if(mysqli_num_rows($category_run) > 0)
                                {
                                    foreach($category_run as $row)
                                    {
                                        ?>
                                            <tr>
                                                <td><?=$row['id']?></td>
                                                <td><?=$row['name']?></td>
                                                <td>
                                                    <img src="../uploads/categories/<?=$row['image']?>" width="60px" height="60px" />
                                                </td>
                                                <td>
                                                    <?=$row['status'] == '1' ? 'Hidden' : 'Visible'?>
                                                </td>
                                                <td>
                                                    <a href="category-edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="post">
                                                        <button type="submit" name="category_delete" value="<?=$row['id']?>" class="btn btn-sm btn-danger">Delete</button>
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
                                            <td colspan="5">No Records Found</td>
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