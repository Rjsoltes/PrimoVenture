<!-- Home Page of Web Site -->
<!-- Displays Header -->
<?php include "includes/header.php"; ?>
    <!-- Displays Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
           <br><br>
           <!-- Home page PrimoVenture Heading  -->
            <img src="img/primoventureLogoB&W.png" alt="" width="225" class="image-responsive" style="float:left">
            <img src="img/primoventureLogoB&W.png" alt="" width="225" class="image-responsive" style="float:right">
            <h1 class="page-header text-center">P R I M O V E N T U R E</h1>
            <div class="text-center"><h1><small> Adventure is out there.</small></h1></div>
            
            <div style="clear:both"></div>
            <div class="page-header"></div>
            <!-- Blog Posts -->
            <div class="col text-center">  
               <?php 
                    // Bring in information about the blog posts to display on home page
                    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                    $query .= "ORDER BY post_date DESC ";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,430); //only shows first 430 characters
                        $post_status = $row['post_status'];
                        
                        // If the post is published then it will display on home-page
                        if($post_status == 'published'){
                        
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
                   <?php } 
                    } ?>
            </div>
        </div>
        <hr>
<!-- Display Footer -->
<?php include "includes/footer.php"; ?>