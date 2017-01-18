<!-- admin/index.php displays easy to read information about different stats of the web site -->
<!-- Displays Header -->
<?php include "includes/header.php"; ?>
    <div id="wrapper">
        <!-- Displays Navigation -->
        <?php include "includes/navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <!--Displays Userame based on session -->
                            <small><?php echo $_SESSION['username']; ?></small> 
                        </h1>
                        <div class="row">
                           <!-- Creates Box that shows how many posts are active on the site -->
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-file-text fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php
                                                // Creates query and retrieves all posts and counts them.
                                                $query = "SELECT * FROM posts";
                                                $select_all_posts = mysqli_query($connection, $query);
                                                $post_count = mysqli_num_rows($select_all_posts);
                                                echo "<div class='huge'>{$post_count}</div>";
                                            ?>    
                                            <div>Posts</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="posts.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- Creates Box that shows how many total comments are on the site -->
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comment fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php
                                                // Creates query and retrieves all comments and counts them.
                                                $query = "SELECT * FROM comments";
                                                $select_all_comments = mysqli_query($connection, $query);
                                                $comment_count = mysqli_num_rows($select_all_comments);
                                                echo "<div class='huge'>{$comment_count}</div>";
                                            ?>
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
                            <!-- Creates Box that shows how many users that have been created on the site -->
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php
                                                // Creates query and retrieves all users and counts them.
                                                $query = "SELECT * FROM users";
                                                $select_all_users = mysqli_query($connection, $query);
                                                $user_count = mysqli_num_rows($select_all_users);
                                                echo "<div class='huge'>{$user_count}</div>";
                                            ?>
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
                            <!-- Creates Box that shows how many categories that are on the site -->
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                            <?php
                                                // Creates query and retrieves all categories and counts them.
                                                $query = "SELECT * FROM categories";
                                                $select_all_categories = mysqli_query($connection, $query);
                                                $category_count = mysqli_num_rows($select_all_categories);
                                                echo "<div class='huge'>{$category_count}</div>";
                                            ?>
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
                    </div>
                </div>
                <?php 
                    // Creates a query for published posts, draft posts, 
                    // unapproved comments, admin users, and standard users.
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $select_all_published_posts = mysqli_query($connection, $query);
                    $published_post_count = mysqli_num_rows($select_all_published_posts);
                
                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_all_draft_posts = mysqli_query($connection, $query);
                    $draft_post_count = mysqli_num_rows($select_all_draft_posts);
                
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                    $unapproved_comments = mysqli_query($connection, $query);
                    $unapproved_comment_count = mysqli_num_rows($unapproved_comments);
                
                    $query = "SELECT * FROM users WHERE user_role = 'standard'";
                    $standard_users = mysqli_query($connection, $query);
                    $standard_user_count = mysqli_num_rows($standard_users);
                
                    $query = "SELECT * FROM users WHERE user_role = 'admin'";
                    $admin_users = mysqli_query($connection, $query);
                    $admin_user_count = mysqli_num_rows($admin_users);
                ?>
                <!-- Displays a google chart that shows all the data gathered from above -->
                <div class="row">
                    <script type="text/javascript">
                          google.charts.load('current', {'packages':['bar']});
                          google.charts.setOnLoadCallback(drawChart);
                          function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                              ['Data', 'Count'],
                                <?php 
                                    $element_text = ['Total Posts','Published Posts','Draft Posts' , 'Comments' , 'Unapproved Comments','Admin Users','Standard Users','Categories'];
                                    $element_count = [$post_count ,$published_post_count, $draft_post_count, $comment_count, $unapproved_comment_count, $admin_user_count, $standard_user_count, $category_count];
                                    for($i = 0; $i < 8 ;$i++){
                                        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                    }
                        
                                ?>
                        
                            ]);

                            var options = {
                              chart: {
                                title: '',
                                subtitle: '',
                              }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, options);
                          }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
<!-- Displays Footer -->
<?php include "includes/footer.php"; ?>