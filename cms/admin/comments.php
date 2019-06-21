
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
            WELCOME TO POST PANEL
            <small>AUTHOR</small>
        </h1>
<?php

if(isset($_GET['source'])){

    $source = $_GET['source'];
} else{
    $source ='';
}

switch ($source){
    case  'add_post';
    include "includs/add_post.php";
    break;
    case  'edit_post';
    include "includs/edit_post.php";
    break;
    case  '2222';
    echo "echoaaa2222";
    break;
    default:
    include "includs/view_all_comments.php";
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