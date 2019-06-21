<?php include "includs/admin_header.php"?>
<?php
if(isset($_SESSION['username'])){

    $profile_username = ($_SESSION['username']);

    $query = "SELECT * FROM users WHERE username = '{$profile_username}' ";
    $select_user_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_query)){
        
        $user_firstname     = $row['user_firstname'];
        $user_lastname      = $row['user_lastname'];    
        $user_role          = $row['user_role'];
        $username           = $row['username'];   
        $user_email         = $row['user_email'];
        $user_password      = $row['user_password'];
           
    }
}
?>
<?php
//==============update user profile====================
if(isset($_POST['edit_user'])){
   
    $user_firstname      = $_POST['user_firstname'];
    $user_lastname       = $_POST['user_lastname'];
    
    $username            = $_POST['username'];
    $user_email          = $_POST['user_email'];
    $user_password       = $_POST['user_password'];
 
    $query = "UPDATE users SET ";
    $query .="user_firstname    = '{$user_firstname}', ";
    $query .="user_lastname     = '{$user_lastname}', ";
    
    $query .="username          = '{$username}', ";
    $query .="user_email        = '{$user_email}', ";
    $query .="user_password     = '{$user_password}' ";
    $query .="WHERE username     = '{$profile_username}' ";
      
        $edit_user_query = mysqli_query($connection,$query);
        
        confirmQuery($edit_user_query);
}
//==============update user profile====================
?>

<div id="wrapper">
<!-- Navigation -->
<?php include "includs/admin_navigation.php"?>

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            WELCOME TO POST PANEL
            <small><?php echo $_SESSION['username'];?></small>
        </h1>

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
    <label for="username">Username</label>
    <input value="<?php echo $username ?>" name="username" type="text" class="form-control">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input value="<?php echo $user_email ?>" name="user_email" type="email" class="form-control">
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input autocomplete="off" name="user_password" type="password" class="form-control">
</div>

<div class="form-group">
    <input type="submit" class="btn btn-success" name="edit_user" value="Update Profile">
</div>
</form>







     </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->


<?php include "includs/admin_footer.php"?>