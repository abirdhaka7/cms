<?php

if(isset($_GET['edit_user'])){

    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_users_query = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_users_query)){
    $user_id             = $row['user_id'];
    $username            = $row['username'];
    $user_password       = $row['user_password'];
    $user_firstname      = $row['user_firstname'];
    $user_lastname       = $row['user_lastname'];    
    $user_email          = $row['user_email'];
    $user_role           = $row['user_role'];

}
?>


<?php

if(isset($_POST['edit_user'])){

    $user_role           = $_POST['user_role'];
    $user_firstname      = $_POST['user_firstname'];
    $user_lastname       = $_POST['user_lastname'];
    $username            = $_POST['username'];
    $user_email          = $_POST['user_email'];
    $user_password       = $_POST['user_password'];

    if(!empty($user_password)){
                
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
        $get_user_query = mysqli_query($connection, $query_password);
        $row = mysqli_fetch_array($get_user_query);

        $db_user_password = $row['user_password'];

        if($db_user_password != $user_password ){
  
         $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12)); 
     }


    $query = "UPDATE users SET ";
    $query .="user_firstname    = '{$user_firstname}', ";
    $query .="user_lastname     = '{$user_lastname}', ";
    $query .="user_role         = '{$user_role }', ";
    $query .="username          = '{$username}', ";
    $query .="user_email        = '{$user_email}', ";
    $query .="user_password     = '{$hashed_password}' ";
    $query .="WHERE user_id     = {$the_user_id} ";
      
    $edit_user_query = mysqli_query($connection,$query);
    
    confirmQuery($edit_user_query);

    
    echo "<p class='bg-info'>User Updated: <a href='users.php'>View Users</a></p>";
    
    }

}

}else{
    header("Location: index.php");
}

?>
<form action="" method="post" enctype="multipart/form-data">
   
<div class="form-group">
        <label for="FirstName">First Name</label>
        <input value="<?php echo $user_firstname?>" type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="LastName">Last Name</label>
        <input value="<?php echo $user_lastname?>"  type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
       <select name="user_role" id=""> 

       <option value="<?php echo $user_role?>"><?php echo $user_role?></option>
        <?php
            if($user_role == 'admin'){
                echo "<option value='subscriber'>Subscriber</option>";
            }else{
                echo "<option value='admin'>Admin</option>";
            }
            
        ?>    
            
       </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username ?>" name="username" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input value="<?php echo $user_email ?>" name="user_email" type="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input  autocomplete="off" name="user_password" type="password" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="edit_user" value="Update user">
    </div>

</form>