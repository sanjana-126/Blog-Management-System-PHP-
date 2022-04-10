<?php
include('authentication.php');
include('config/dbcon.php');
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
        if(file_exists('../uploads/posts/'.$image))
        {
            unlink("../uploads/posts/".$image);
        }
        $_SESSION['message'] = "Post Deleted Successfully";
        header("Location: post-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: post-view.php");
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
    $status = $_POST['status'] == true ? '1':'0';

    $query = "UPDATE posts SET category_id='$category_id', name='$name',slug='$slug',description='$description',image='$update_filename',
                meta_title='$meta_title',meta_description='$meta_description',meta_keyword='$meta_keyword',status='$status' WHERE id='$post_id'";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        if($image != NULL)
        {
            if(file_exists('../uploads/posts/'.$old_filename))
            {
                unlink("../uploads/posts/".$old_filename);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$update_filename);
        }
        $_SESSION['message'] = "Post Updated Successfully";
        header("Location: post-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: post-view.php");
        exit(0);
    }
}

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
    $status = $_POST['status'] == true ? '1':'0';

    $query = "INSERT INTO posts (category_id, name, slug, description, image, meta_title, meta_description, meta_keyword, status, created_by) VALUES
                    ('$category_id','$name', '$slug', '$description', '$filename', '$meta_title', '$meta_description', '$meta_keyword', '$status','$created_by')";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$filename);
        $_SESSION['message'] = "Post Created Successfully";
        header("Location: post-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: post-view.php");
        exit(0);
    }
}

if(isset($_POST['category_delete']))
{
    $category_id = $_POST['category_delete'];

    $check_img_query = "SELECT * FROM categories WHERE id='$post_id' LIMIT 1";
    $img_res = mysqli_query($con, $check_img_query);
    $res_data = mysqli_fetch_array($img_res);
    $image = $res_data['image'];

    $query = "DELETE FROM categories WHERE id='$category_id' LIMIT 1";
    $query_run =mysqli_query($con, $query);

    if($query_run)
    {
        if(file_exists('../uploads/categories/'.$image))
        {
            unlink("../uploads/categories/".$image);
        }
        $_SESSION['message'] = "Category Deleted Successfully";
        header("Location: category-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: category-view.php");
        exit(0);
    }
}


if(isset($_POST['category_update']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $meta_title = $_POST['meta_title'];


    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];

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

    $navbar_status = $_POST['navbar_status'] == true ? '1':'0';
    $status = $_POST['status'] == true ? '1':'0';

    $query = "UPDATE categories SET name='$name', slug='$slug', image='$update_filename', description='$description', meta_title='$meta_title', meta_description='$meta_description',
                    meta_keyword='$meta_keyword', navbar_status='$navbar_status', status='$status' WHERE id='$category_id'";  

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        if($image != NULL)
        {
            if(file_exists('../uploads/categories/'.$old_filename))
            {
                unlink("../uploads/categories/".$old_filename);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/categories/'.$update_filename);
        }
        $_SESSION['message'] = "Category Updated Successfully";
        header("Location: category-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: category-view.php");
        exit(0);
    } 
}



if(isset($_POST['category_add']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $meta_title = $_POST['meta_title'];

    $image = $_FILES['image']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_extension;


    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];

    $navbar_status = $_POST['navbar_status'] == true ? '1':'0';
    $status = $_POST['status'] == true ? '1':'0';

    $query = "INSERT INTO categories (name, slug, image, description, meta_title, meta_description, meta_keyword, navbar_status, status) VALUES 
                        ('$name','$slug','$filename','$description','$meta_title','$meta_description', '$meta_keyword','$navbar_status','$status')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/categories/'.$filename);
        $_SESSION['message'] = "Category Added Successfully";
        header("Location: category-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: category-view.php");
        exit(0);
    } 
    
}





if(isset($_POST['user_delete']))
{
    $user_id = $_POST['user_delete'];

    $query = "DELETE FROM users WHERE id = '$user_id'";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "User Deleted Successfully";
        header("Location: view-register.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: view-register.php");
        exit(0);
    }    
}

if(isset($_POST['add_user']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';

    $query = "INSERT INTO users (name, email, password, role_as, status) VALUES ('$name','$email','$password','$role_as','$status')";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Admin/User Added Successfully";
        header("Location: view-register.php");
        exit(0);
    }
    else 
    {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location: view-register.php");
        exit(0);
    }
}

if(isset($_POST['update_user']))
{
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';

    $query = "UPDATE users SET name='$name', email='$email', password='$password', role_as='$role_as', status='$status'
                WHERE id='$user_id'";

    $query_run = mysqli_query($con ,$query);

    if($query_run)
    {
        $_SESSION['message'] = "Updated Successfully";
        header("Location: view-register.php");
        exit(0);
    }
}

if(isset($_POST['post_approve_btn']))
{
    $post_id = $_POST['post_approve_btn'];
    $query = "UPDATE posts SET status='0' WHERE id='$post_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Post is Approved";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['post_reject_btn']))
{
    $post_id = $_POST['post_reject_btn'];
    $query = "UPDATE posts SET status='2' WHERE id='$post_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Post is Rejected";
        header("Location: index.php");
        exit(0);
    }
}
?>