<!-- for header -->
<?php include "includs/admin_header.php"?>


<div id="wrapper">
<!-- Navigation -->
<?php include "includs/admin_navigation.php"?>

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            WELCOME TO ADMIN PANEL
            <small>AUTHOR</small>
        </h1>
        
        <div class="col-xs-6"><!---/.for catagories table-->

<?php   insertCategories();?>

<form action="" method="post">
    <div class="form-group">
        <label for="add-categories">Add Categories</label>
        <input class="form-control" type="text" name="cat_title">
    </div>
    <div class="form-group">
        <input class="btn btn-info" class="form-control"  type="submit" name="submit">
    </div>            
</form>

<?php 
    
    if(isset($_GET['edit'])){

    $cat_id = $_GET['edit'];

    include "includs/update_categories.php";
}

?>
         

</div><!--/.col-->

<div class="col-xs-6">


<table class="table table-border table-hover">
    <thead>
        <th>Id</th>
        <th>Categories</th>
        <th>Delete</th>
    </thead>
    <tbody>
<?php findAllCategoriesQuery();?>           
<?php deleteCategories();?>

            </tbody>
        </table>


        </div><!--/.col-->
    
    
    
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->


<?php include "includs/admin_footer.php"?>