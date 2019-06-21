<?php

if(isset($_POST['create_user'])){

    $user_role           = $_POST['user_role'];
    $user_firstname      = $_POST['user_firstname'];
    $user_lastname       = $_POST['user_lastname'];
    $username            = $_POST['username'];
    $user_email          = $_POST['user_email'];
    $user_password       = $_POST['user_password'];

    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10) );  

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role,
    username, user_email, user_password) ";

    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";

    $create_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);


    echo "User Created: " . " " . "<a href='users.php'>View users</a>";

}
?>


<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="firstname">First Name</label>
        <input name="user_firstname" type="text" class="form-control">
    </div>

    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input name="user_lastname" type="text" class="form-control">
    </div>
    <div class="form-group">
       <select name="user_role" id=""> 
            <option value="subscriber">Select Option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
       </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input name="username" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input name="user_email" type="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input name="user_password" type="password" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="create_user" value="Add user">
    </div>

</form>