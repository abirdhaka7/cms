
<!-- for header -->
<?php include "includs/admin_header.php"?>
<?php

    if(!is_admin($_SESSION['username'])){

        header("Location: index.php");

    }


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
            WELCOME TO USER PANEL
            <small><?php echo $_SESSION['username'];?></small>
        </h1>
<?php

if(isset($_GET['source'])){

    $source = $_GET['source'];
} else{
    $source ='';
}

switch ($source){
    case  'add_user';
    include "includs/add_user.php";
    break;
    case  'edit_user';
    include "includs/edit_user.php";
    break;
    case  '2222';
    echo "2222";
    break;
    default:
    include "includs/view_all_users.php";
    break;
    
}



?>




     </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->


<?php include "includs/admin_footer.php"?>