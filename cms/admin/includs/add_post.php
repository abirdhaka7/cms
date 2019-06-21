<?php

if(isset($_POST['create_post'])){

    $post_title         = $_POST['title'];
    $post_category_id   = $_POST['post_category'];
    $post_user          = $_POST['post_user'];
    $post_status        = $_POST['post_status'];
    $post_image         = $_FILES['image']['name'];
    $post_image_temp    = $_FILES['image']['tmp_name'];
    $post_tags          = $_POST['post_tags'];
    $post_content       = $_POST['post_content'];
    $post_date          = date('d-m-y');
 
    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_title, post_category_id, post_date,
    post_user, post_image, post_content, post_status, post_tags) ";

    $query .= "VALUES('{$post_title}', {$post_category_id}, now(),'{$post_user}','{$post_image}','{$post_content}','{$post_status}','{$post_tags}') ";


    $create_post_query = mysqli_query($connection, $query);
    confirmQuery($create_post_query);
    
    
    $the_post_id = mysqli_insert_id($connection);
    
    echo "<p class='bg-info'>Post Created: <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='post.php'>Edit More Post</a></p>";

}
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title :</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">

    <div class="form-group">
    <label for="Users">Users :</label>
       <select name="post_user" id=""> 
          
            <?php
                        
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection,$query);


            while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row['user_id'];
            $username = $row['username'];

            echo "<option value='$username'>{$username}</option>";
            }
            ?>
       </select>
    </div>

    <div class="form-group">
    <label for="Category">Category :</label>
       <select name="post_category" id=""> 
            <?php                    
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<option value='$cat_id'>{$cat_title}</option>";
            }
            ?>
       </select>
    </div>

    <div class="form-group">
        <label for="status">Post Status :</label>
        <select name="post_status" id="">
           <option value="draft">Post Status</option>
           <option value="published">Publish</option>
           <option value="draft">draft</option>        
        </select>
 </div>

    <div class="form-group">
        <label for="post_image">Post Image :</label>
        <input type="file"  name="image">    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags :</label>
        <input type="text" class="form-control" name="post_tags">
    </div>


    <div class="form-group">
        <label for="post_content">Post Content :</label>
        <textarea class="form-control" name="post_content" id="body" col="30" row="10">
        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="create_post" value="Create Post">
    </div>

</form>