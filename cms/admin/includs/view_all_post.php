<?php

include "delete_modal.php";

if(isset($_POST['checkBoxArray'])){

    foreach($_POST['checkBoxArray'] as $postValueId){

        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options){
            case 'published':

            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '$postValueId' ";

            $update_to_published_status = mysqli_query($connection,$query);

            break;
            case 'draft':

            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '$postValueId' ";

            $update_to_draft_status = mysqli_query($connection,$query);

            break;
            case 'delete':

            $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";

            $update_to_delete_status = mysqli_query($connection,$query);

            break;
            case 'clone':

            $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
            $select_post_query = mysqli_query($connection,$query);                    
                    
            while($row = mysqli_fetch_assoc($select_post_query)){
                $post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];    
                $post_status = $row['post_status'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
                $post_comment_count = $row['post_comment_count'];

            $query = "INSERT INTO posts(post_title, post_category_id, post_date,
            post_author,post_user, post_image, post_content, post_status, post_comment_count, post_tags) ";
        
            $query .= "VALUES('{$post_title}', {$post_category_id}, now(),'{$post_author}','{$post_user}','{$post_image}','{$post_content}','{$post_status}','{$post_comment_count}','{$post_tags}') ";

            $clone_query = mysqli_query($connection,$query);
            if(!$clone_query){
                die("Faield". mysqli_error($connection));
            }

            break;
      }
    }
  }
}
?>

<form action="" method='post'>
    <div class='col-xs-4 form-group' id="select_bulk_option">
        <select class='form-control' name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>
    <div class="col-xs-4">

        <input class='btn btn-info' value='Apply' name='submit' type="submit">
        <a class='btn btn-success' href="post.php?source=add_post">Add New</a>

    </div>

<table class="table table-bordered">
        <thead>
            <tr>
                <th> <input id='selectAllBoxes' type="checkbox"> </th>
                <th>ID</th>
                <th>USER</th>
                <th>CATEGORY</th>  
                <th>TITLE</th>
                <th>STATUS</th>
                <th>DATE</th>
                <th>IMAGES</th>
                <th>TAGS</th>
                <th>COMMENTS</th>                
                <th>DELETE</th>
                <th>EDIT</th>
                <th>VIEW POST</th>
                <th>POST VIEWS</th>
            </tr>
        </thead>
        <tbody>
<?php
//--------Show All Post from DataBase

$query = "SELECT posts.post_id, posts.post_author, posts.post_user,
posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";

$query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id,
categories.cat_title  ";

$query .="FROM posts ";

$query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC ";



$select_posts = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_posts)){
    $post_id              = $row['post_id'];
    $post_category_id     = $row['post_category_id'];
    $post_author          = $row['post_author'];
    $post_user            = $row['post_user'];
    $post_title           = $row['post_title'];    
    $post_status          = $row['post_status'];
    $post_date            = $row['post_date'];
    $post_image           = $row['post_image'];
    $post_tags            = $row['post_tags'];
    $post_comment_count   = $row['post_comment_count'];
    $post_views_count     = $row['post_views_count'];
    $category_title       = $row['cat_title'];
    $category_id          = $row['cat_id'];
  
    echo "<tr>";
  ?>
  
    <td><input class='checkBoxes' name='checkBoxArray[]' type='checkbox' value='<?php echo $post_id?>'> </td>
  <?php
      
    echo "<td>{$post_id}</td>";  
    
    
    if(!empty($post_author)){
        
        echo "<td>{$post_author}</td>"; 
    
    } elseif (!empty($post_user)){

        echo "<td>{$post_user}</td>"; 
    }

    echo "<td>{$category_title}</td>";
    echo "<td>{$post_title}</td>";    
    echo "<td>{$post_status}</td>";
    echo "<td>{$post_date}</td>";
    echo "<td><img width='85' src='../images/{$post_image}'></td>";
    echo "<td>{$post_tags}</td>";


    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
    $send_comment_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($send_comment_query);
    $comment_id = $row['comment_id'];
    $count_comments = mysqli_num_rows($send_comment_query);

    echo "<td><a href='post_comments.php?id={$post_id}'>{$count_comments}</a></td>";


    echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link btn btn-danger' >DELETE</a></td>";
    
    echo "<td><a class='btn btn-primary' href='post.php?source=edit_post&p_id={$post_id}'>EDIT</a></td>";

    echo "<td><a class='btn btn-info' href='../post/{$post_id}'>VIEW POST</a></td>";

    echo "<td><a  href='post.php?reset={$post_id}'>{$post_views_count}</a></td>";
   
    echo "</tr>";
}

?>
            
        </tbody>
    </table>
</form>



<?php

if(isset($_GET['delete'])){

        $the_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: post.php");

}

if(isset($_GET['reset'])){

    $the_post_id = escape($_GET['reset']);

$query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection,$_GET['reset']). " ";
$reset_query = mysqli_query($connection, $query);
header("Location: post.php");

}



?>




<script>



$(document).ready(function(){


$(".delete_link").on('click', function(){


    var id = $(this).attr("rel");

    var delete_url = "post.php?delete="+ id +" ";


    $(".modal_delete_link").attr("href", delete_url);


    $("#myModal").modal('show');
        
    });



});

</script>