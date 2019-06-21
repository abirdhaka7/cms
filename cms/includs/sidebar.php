<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>

    <form action="search.php" method="post">
    
    <div class="input-group">
        <input type="text" name="search" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Login Form -->
<div class="well">

<?php if(isset($_SESSION['user_role'])):?>

    <h4>Logged in as <?php echo $_SESSION['username']?></h4>

    <a href="includs/logout.php" class="btn btn-primary">Log Out</a>
<?php else:?>
<h4>Log In</h4>

    <form action="includs/login.php" method="post">
    
    <div class="form-group">
        <input name="username" placeholder="Enter username" type="text" name="search" class="form-control">         
        </span>
    </div>
    <div class="input-group">
         <input name="password" placeholder="Enter Password" type="password" name="user_password" class="form-control">
      
        <span class="input-group-btn">
            <button class="btn btn-success" type="submit" name="login">
            Submit
            </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
<?php endif; ?>
     
</div>




<!-- Blog Categories Well -->
<div class="well">

<?php

$query = "SELECT * FROM categories";
$select_categories_sidebar = mysqli_query($connection,$query);

?>  
<h4>BLOG CATEGORIES</h4>
<div class="row">
    <div class="col-lg-12">
        <ul class="list-unstyled">
<?php

while($row = mysqli_fetch_assoc($select_categories_sidebar)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<li><a href='category.php?category=$cat_id'>$cat_title<a></li>";

}    

?>
        </ul>
    </div>
       
  </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "includs/widget.php";?>

</div>