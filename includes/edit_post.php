<!-- Edit profile page allows the user to edit the information attached to their account -->
<!-- Display Header -->
<?php include "db.php" ?>
<?php include "../functions.php" ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>P R I M O V E N T U R E</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/blog-home.css">
    <link rel="stylesheet" href="../admin/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../admin/font-awesome/css/font-awesome-animation.min.css">
    <link rel="stylesheet" href="../admin/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../css/loading.css">
    <link rel="stylesheet" href="../css/fade.css">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Display Navigation -->
    <?php 
        // Brings in information about user that is used in navigation
        if(isset($_SESSION['username'])){
        
        $username = $_SESSION['username'];
        
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_profile_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_user_profile_query)){
            $user_id = $row['user_id'];
            $username = $row['username'];
        }
        }
    ?>
   <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">PrimoVenture</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="../about.php"><i class='fa fa-fw fa-book'></i>About</a></li>
                </ul>
                 <ul class="nav navbar-nav navbar-right">
                    <li><a href="../home.php"><i class='fa fa-fw fa-home'></i> Home</a></li>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-list-ul"></i> Categories<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                  <li><a href="../home.php">All</a></li>
                               <?php 
                                    $query = "SELECT * FROM categories";
                                    $select_categories = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_assoc($select_categories)){
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];

                                        echo "<li><a href='../category.php?category=$cat_id'>{$cat_title}</a></li>";
                                    }

                                ?>
                            </ul>
                        </li>
                    </ul>
                    <?php
                        // Determines the user tab on the navigation.
                        // If the user is an admin then they get a link to the admin page and their profile.
                        // If the user is a standard user they just get a link to their profile. 
                        // Also if a user is logged in then is shows a log out button.
                        // If no user is logged in then it shows a log in button.
                        // Always shows a register button.
                        if(isset($_SESSION['user_role'])){
                                $user_role = $_SESSION['user_role'];
                                if($user_role == 'admin'){
                                    echo "<li class='dropdown'>
                                            <a href='../profile.php?u_id={$user_id}' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-fw fa-user'></i> Admin {$username} <b class='caret'></b></a>
                                            <ul class='dropdown-menu'>
                                                
                                                <li>
                                                    <a href='../admin/index.php'><i class='fa fa-fw fa-lock'></i> Admin</a>
                                                </li>
                                                <li class='divider'></li>
                                                <li>
                                                    <a href='../profile.php?u_id={$user_id}'><i class='fa fa-fw fa-user'></i> Profile</a>
                                                </li>
                                            </ul>
                                          </li>";
                                }else{
                                    echo "<li><a href='../profile.php?u_id={$user_id}'><i class='fa fa-fw fa-user'></i> {$username}</a></li>";
                                }
                                echo "<li><a href='../registration.php'><i class='fa fa-fw fa-send'></i> Register</a></li>";
                                echo "<li><a href='../includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a></li>";
                                
                            }else{
                                echo "<li><a href='../registration.php'><i class='fa fa-fw fa-send'></i> Register</a></li>";
                                echo "<li><a href='../login_page.php'><i class='fa fa-fw fa-sign-in'></i> Log In</a></li>";
                        }
                        
                    ?>
                  <form class="navbar-form navbar-right" action="search.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="search">
                    </div>
                    <button name="submit" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                  </form>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <?php
        // Gets the post id from the post where the edit button was clicked
        if(isset($_GET['p_id'])){
            $the_post_id = $_GET['p_id'];
        }

        // Creates query to retrtieve information about post to display in the edit post
        // fields of the form, so users can see what information they're editing.
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_posts_by_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_posts_by_id)){

            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];

        }

        // Checks all information put into the fields of the form
        // Creates query with all the new information and sends it to the database.
        if(isset($_POST['update_post'])){
            $post_title = $_POST['post_title'];
            $post_author = $_POST['post_author'];
            $post_category_id = $_POST['post_category'];
            $post_status = $_POST['post_status'];
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];

            move_uploaded_file($post_image_temp, "../img/$post_image");

            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_category_id = '{$post_category_id}', ";
            $query .= "post_date = now(), ";
            $query .= "post_author = '{$post_author}', ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_tags = '{$post_tags}', ";
            $query .= "post_content = '{$post_content}', ";
            $query .= "post_image = '{$post_image}' ";
            $query .= "WHERE post_id = {$the_post_id} ";

            $update_post = mysqli_query($connection, $query);
            confirm($update_post);
            echo "<p class='bg-success'>Post Updated!</p>";
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Edit Profile header -->
                <img src="../img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:left">
                <img src="../img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:right">
                <h1 class=" page-header text-center">E D I T&nbsp;&nbsp;&nbsp;P O S T</h1>
                <div style="clear:both"></div>
                <!-- Edit Profile form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="well">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="post_title">Post Title</label>
                                <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
                            </div>
                            <div class="form-group">
                                <label for="post_category_id">Post Category</label><br>
                                <select name="post_category" id="">
                                    <?php
                                        // Creates query to retrieve catagroy options for select element in form.
                                        $query = "SELECT * FROM categories";
                                        $select_categories = mysqli_query($connection, $query);
                                        confirm($select_categories);
                                        while($row = mysqli_fetch_assoc($select_categories)){
                                            $cat_title = $row['cat_title'];
                                            $cat_id = $row['cat_id'];

                                            echo "<option value='{$cat_id}'>{$cat_title}</option>";
                                        }

                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="post_author">Post Author</label>
                                <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
                            </div>
                            <div class="form-group">
                                <label for="post_status">Post Status</label>
                                <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
                            </div>
                            <div class="form-group">
                                <img src="../img/<?php echo $post_image; ?>" width="75" alt="">
                                <label for="post_image">Post Image</label>
                                <input type="file" name="image" value="<?php echo $post_image; ?>">
                            </div>
                             <div class="form-group">
                                <label for="post_tags">Post Tags</label>
                                <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
                            </div>
                            <div class="form-group">
                                <label for="post_content">Post Content</label>
                                <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10" ><?php echo $post_content; ?></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="update_post" value="Update">
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <hr>
<!-- Display Footer -->
<?php include "footer.php"; ?>