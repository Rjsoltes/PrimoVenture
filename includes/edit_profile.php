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
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
        // Brings in information about the user
        // depending on what their user id is.
        if(isset($_GET['u_id'])){
            $the_user_id = $_GET['u_id'];
        }

        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_user_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_user_query)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_content = $row['user_content'];
            $user_image = $row['user_image'];
            $user_password = $row['user_password'];
            
        }
    
        // Retrieves data entered into the edit user form.
        if(isset($_POST['edit_user'])){
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
            $user_image = $_FILES['image']['name'];
            $user_image_temp = $_FILES['image']['tmp_name'];
            $user_content = $_POST['user_content'];
            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

            move_uploaded_file($user_image_temp, "../admin/img/$user_image");

            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_role = '{$user_role}', ";
            $query .= "user_image = '{$user_image}', ";
            $query .= "user_content = '{$user_content}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$user_password}' ";
            $query .= "WHERE user_id = '{$the_user_id}' ";

            $update_user = mysqli_query($connection, $query);
            confirm($update_user);
            echo "<p class='bg-success text-center'>Profile Updated!</p>";
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Edit Profile header -->
                <img src="../img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:left">
                <img src="../img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:right">
                <h1 class=" page-header text-center">E D I T&nbsp;&nbsp;&nbsp;P R O F I L E</h1>
                <div style="clear:both"></div>
                <!-- Edit Profile form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="well">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="user_firstname">First Name</label>
                                <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
                            </div>
                            <div class="form-group">
                                <label for="user_lastname">Last Name</label>
                                <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
                            </div>
                            <div class="form-group">
                                <label for="user_role">User Role</label><br>
                                <select name="user_role" id="">
                                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                                    <?php 
                                        // gets current role and displays it first then the other role second.
                                        if($user_role == 'admin'){
                                            echo "<option value='standard'>standard</option>";
                                        }else{
                                            echo "<option value='admin'>admin</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                               <label for="post_image">Profile Picture</label>
                                <img src="../admin/img/<?php echo $user_image; ?>" width="75" alt="">
                                <input type="file" name="image" value="<?php echo $user_image; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_content">User Summary</label>
                                <textarea type="text" class="form-control" name="user_content" id="" cols="30" rows="10"><?php echo $user_content; ?></textarea>
                            </div>
                             <div class="form-group">
                                <label for="username">Username</label>
                                <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input value="<?php echo $user_password ?>" type="password" class="form-control" name="user_password" required>
                            </div>
                            <div class="form-group"> 
                                <input type="submit" class="btn btn-primary" name="edit_user" value="Edit">
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