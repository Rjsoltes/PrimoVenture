<!-- The search page allows a user to search for posts based on the post tags attatched to each post. 
     This page is similar to the home page except it only shows posts based on similar post tags to
      what the user entered in the search box. -->
<!-- Display Header -->
<?php include "includes/header.php"; ?>
    <!-- Display Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
           <br><br>
            <img src="img/primoventureLogoB&W.png" alt="" width="225" class="image-responsive" style="float:left">
            <img src="img/primoventureLogoB&W.png" alt="" width="225" class="image-responsive" style="float:right">
            <h1 class="page-header text-center">P R I M O V E N T U R E</h1>
            <div class="text-center"><h1><small> Adventure is out there.</small></h1></div>
            <div style="clear:both"></div>
            <div class="page-header"></div>
            <!-- Blog Entries Column -->
            <div class="col text-center">
                <?php 
                    // Gets strings from the search form and displays posts
                    // based on the post_tags in the database
                    if(isset($_POST['submit'])){

                        $search = $_POST['search'];
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                        $search_query = mysqli_query($connection, $query);

                        // Tests connection to database with query
                        if(!$search_query){
                            die("Query failed" . mysqli_error($connection));
                        }

                        // Counts amount of posts, if post count
                        // is equal to 0 then it displays a message
                        // saying there are no posts.
                        $count = mysqli_num_rows($search_query);
                        if($count == 0){
                            echo "<h1> Oops! No posts! </h1>";
                        }
                        else{
                            
                            // If post count is > 0 then it displays all 
                            // posts with the post_tags that were entered in the search bar.
                            while($row = mysqli_fetch_assoc($search_query)){
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = substr($row['post_content'],0,430);
                                $post_id = $row['post_id'];
                                $post_status = $row['post_status'];

                                
                                // If the post is published then it will display on home-page
                                if($post_status == 'published'){
                                ?>
                                    <!-- Blog Post -->
                                    <h2>
                                        <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                                    </h2>
                                    <p class="lead">
                                        by <?php echo $post_author; ?>
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span> Posted <?php echo $post_date; ?></p>
                                    <hr>
                                    <a href="post.php?p_id=<?php echo $post_id;?>">
                                        <img class="img-responsive center-block" src="img/<?php echo $post_image;?>" alt="" width="70%">
                                    </a>
                                    <hr>
                                    <div class="col-md-10 col-md-offset-1">
                                        <span class="text-justify"><p><?php echo $post_content; ?>...</p></span>
                                        <a href="post.php?p_id=<?php echo $post_id;?>" class="btn btn-primary" >Read More<span class="glyphicon"></span></a>
                                    </div>
                                    <br><br><br><br><br>
                                    <hr> 
                           <?php }} 
                        }
                    } ?>
            </div>
        </div>
        <hr>
<!-- Display Footer -->
<?php include "includes/footer.php"; ?>