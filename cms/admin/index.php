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
                
                <small><?php echo $_SESSION['username'];?></small>
            </h1>
        </div>
    </div>
<!-- /.row -->
 <!-- /.row -->
 <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
     
<div class='huge'><?php echo $post_count = recordCount('posts')?></div>                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="post.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
  
  <div class='huge'><?php echo $comments_count = recordCount('comments')?></div> 
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

<div class='huge'><?php echo $users_count = recordCount('users')?></div> 
                   
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

<div class='huge'><?php echo $categories_count = recordCount('categories')?></div> 
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
 <!-- /.row -->
<?php

$published_post         = checkStatus('posts','post_status','published');

$draft_post             = checkStatus('posts','post_status','draft');

$unapproved_comments    = checkStatus('comments','comment_status','unapproved');

$user_role_subscriber   = checkUserRole('users','user_role','subscriber');

?>

 <div class="row">

 <div id="columnchart_material" style="width: auto; height: 500px;"></div>
  
 <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
<?php

$element_text = ['All Post','Active Post','Draft Posts','Comments','Pending Comments','Users','Subscriber','Categories'];
$element_count = [$post_count, $published_post,$draft_post, $comments_count,$unapproved_comments,$users_count,$user_role_subscriber,$categories_count];

for($i=0; $i < 8; $i++){

    echo "['{$element_text[$i]}'". "," ."{$element_count[$i]}],";

}
?>
         //['Posts', 1170],
          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>




 </div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->


<?php include "includs/admin_footer.php"?>