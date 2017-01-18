<!-- Profile Page displays information about the current user logged in.  -->
<!-- Display Header -->
<?php include "includes/header.php"; ?>
    <!-- Display Navigation -->
    <?php include "includes/navigation.php"; ?>
    <?php 
        // Brings in information about the user
        // depending on what the u_id is of the current user
        if(isset($_GET['u_id'])){
            $the_user_id = $_GET['u_id'];
        }

        // Brings in information about the current user
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
            
        }
    ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Profile -->
                <img src="img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:left">
                <img src="img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:right">
                <h1 class=" page-header text-center">P R O F I L E</h1>
                <div style="clear:both"></div>
                <div>
                    <?php 
                        // Displays profile picture
                        if($user_image){
                            echo "<img src='admin/img/$user_image' alt='' width='400' class='center-block img-rounded image-responsive'>";
                            
                        }else{
                            echo "<img src='http://placehold.it/300x300' alt='' class='center-block img-thumbnail image-responsive'>";
                        }
                    ?>
                </div>
                <div style="clear:both"></div><br>
                <!-- Displays username --> 
                <h2 class="text-center"><?php echo $username; ?></h2>
                <div style="clear:both"></div><br>
                <!-- Displays user biography --> 
                <div class="col-md-8 col-md-offset-2">
                    <p class="lead text-justify">
                        <?php echo $user_content; ?>
                    </p>
                </div>
                <div style="clear:both"></div>
                <!-- Displays user first name, last name, email, account type --> 
                <div class="col-md-3 col-md-offset-3">
                    <ul class="list-group">
                        <li class="list-group-item">First Name: <?php echo $user_firstname; ?></li>
                        <li class="list-group-item">Last Name: <?php echo $user_lastname; ?></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item">E-mail: <?php echo $user_email; ?></li>
                        <li class="list-group-item">Account Type: <?php echo $user_role; ?></li>
                    </ul>
                </div>
                <div style="clear:both"></div>
                <!-- Displays button to edit the user information and add a post --> 
                <div class="col text-center">
                    <div class="col-md-10 col-md-offset-1">
                        <a href="includes/edit_profile.php?u_id=<?php echo $user_id;?>" class="btn btn-primary text-center">Edit Profile<span class="glyphicon"></span></a>
                    </div>
                </div><br><br><br><br>
            </div>
            <div class="col">
                <!-- Profile Posts -->
                <img src="img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:left">
                <img src="img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:right">
                <h1 class="page-header text-center">P O S T S</h1>
                <div class="col text-center">
                    <div class="col-md-10 col-md-offset-1">
                        <a href="includes/add_post.php" class="btn btn-primary text-center">Add Post <span class=" fa fa-plus"></span></a>
                    </div>
                </div>
                <div style="clear:both"></div>
                <br><br>
                <div class="col text-center">  
                    <?php 
                        // Bring in information about the blog posts to display on home page
                        $query = "SELECT * FROM posts WHERE post_author ='{$username}' ";
                        $query .= "ORDER BY post_date ASC ";
                        $select_profile_posts_query = mysqli_query($connection, $query);
                        
                        if(!$query){
                            echo 'failed';
                        }
                    
                        while($row = mysqli_fetch_assoc($select_profile_posts_query)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'],0,430); //only shows first 300 characters
                            $post_status = $row['post_status'];

                            ?>
                                <!-- Blog Post -->
                                <h2>
                                   <!-- Link to specific post using the $post_id -->
                                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                                </h2>
                                <p class="lead">
                                   <!-- Displays the author using $post_author -->
                                    by <?php echo $post_author; ?>
                                </p>
                                <!-- Shows date of post -->
                                <p><span class="glyphicon glyphicon-time"></span> Posted <?php echo $post_date; ?></p>
                                <br>
                                <!-- Link on the post image to take the user to that individual post -->
                                <a href="post.php?p_id=<?php echo $post_id;?>">
                                    <!-- Displays the image for the post -->
                                    <img class="img-responsive center-block" src="img/<?php echo $post_image;?>" alt="" width="70%">
                                </a>
                                <br>
                                <div class="col-md-10 col-md-offset-1">
                                    <!-- Displays content preview under the post image 
                                         Also a button that directs the user to the individual post page
                                         same link as clicking on the image. -->
                                    <span class="text-justify"><p><?php echo $post_content; ?>...</p></span>
                                    <a href="post.php?p_id=<?php echo $post_id;?>" class="btn btn-primary" >Read More<span class="glyphicon"></span></a>
                                </div>
                                <br><br><br><br><br>
                                <hr>
                                <br>
                       <?php } ?>
                </div>
            </div>
        </div>
        <hr>
<!-- Displays footer -->
<?php include "includes/footer.php"; ?>