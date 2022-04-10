<?php
include('includes/config.php');
if(isset($_POST['post_add']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];

    $created_by = $_SESSION['auth_user']['user_id'];

    $image = $_FILES['image']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_extension;
    $status = '1';

    $query = "INSERT INTO posts (category_id, name, slug, description, image, meta_title, meta_description, meta_keyword, status, created_by) VALUES
                    ('$category_id','$name', '$slug', '$description', '$filename', '$meta_title', '$meta_description', '$meta_keyword', '$status','$created_by')";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/posts/'.$filename);
        $_SESSION['message'] = "Post Created Successfully";
        header("Location: author-dashboard.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: author-dashboard.php");
        exit(0);
    }
}

if(isset($_POST['post_delete_btn']))
{
    $post_id = $_POST['post_delete_btn'];

    $check_img_query = "SELECT * FROM posts WHERE id='$post_id' LIMIT 1";
    $img_res = mysqli_query($con, $check_img_query);
    $res_data = mysqli_fetch_array($img_res);
    $image = $res_data['image'];

    $query = "DELETE FROM posts WHERE id='$post_id' LIMIT 1";
    $query_run =mysqli_query($con, $query);

    if($query_run)
    {
        if(file_exists('uploads/posts/'.$image))
        {
            unlink("uploads/posts/".$image);
        }
        $_SESSION['message'] = "Post Deleted Successfully";
        header("Location: author-dashboard.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: author-dashboard.php");
        exit(0);
    }
}

if(isset($_POST['post_update']))
{
    $post_id = $_POST['post_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];

    $created_by = $_SESSION['auth_user']['user_id'];

    $update_filename= ""; 
    $old_filename = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    if($image != NULL)
    {
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_extension;

        $update_filename = $filename;
    }
    else
    {
        $update_filename = $old_filename;
    }
    $status = '1';

    $query = "UPDATE posts SET category_id='$category_id', name='$name',slug='$slug',description='$description',image='$update_filename',
                meta_title='$meta_title',meta_description='$meta_description',meta_keyword='$meta_keyword',status='$status',created_by='$created_by' WHERE id='$post_id'";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        if($image != NULL)
        {
            if(file_exists('uploads/posts/'.$old_filename))
            {
                unlink("uploads/posts/".$old_filename);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/posts/'.$update_filename);
        }
        $_SESSION['message'] = "Post Updated Successfully";
        header("Location: author-dashboard.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: author-dashboard.php");
        exit(0);
    }
}
