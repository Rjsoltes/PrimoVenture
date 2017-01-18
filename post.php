<!-- The post page displays a page that includes an individual post with its full 
     post content. The home page only displays a preview of the post content. -->
<!-- Display Header -->
<?php include "includes/header.php"; ?>
    <!-- Display Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <br><br>
            <!-- Post page header -->
            <img src="img/primoventureLogoB&W.png" alt="" width="225" class="image-responsive" style="float:left">
            <img src="img/primoventureLogoB&W.png" alt="" width="225" class="image-responsive" style="float:right">
            <h1 class="page-header text-center">P R I M O V E N T U R E</h1>
            <div class="text-center"><h1><small> Adventure is out there.</small></h1></div>
            <div style="clear:both"></div>
            <div class="page-header"></div>
            <!-- Blog Posts -->
            <div class="col text-center">
               <?php 
                    // Brings in information about blog post depending on which 
                    // post was clicked on from the home-page
                    if(isset($_GET['p_id'])){
                        $the_post_id = $_GET['p_id'];
                    }
                
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_status = $row['post_status'];
                        
                        
                        ?>
                        
                            <!-- Blog Post -->
                            <h2><?php echo $post_title; ?></h2>
                            <p class="lead">
                                by <?php echo $post_author; ?>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted <?php echo $post_date; ?></p>
                            <hr>
                                <img class="img-responsive center-block" src="img/<?php echo $post_image;?>" alt="" width="70%">
                            <hr>
                            <div class="col-md-10 col-md-offset-1">
                                <span class="text-justify"><p><?php echo $post_content; ?></p></span>
                            </div><br>
                            <div style="clear:both"></div>
                            
                            
                   <?php } ?>
                   <?php
                        // If the user is an admin they will have the option of editing the post. 
                        if(isset($_SESSION['user_role'])){
                            $user_role = $_SESSION['user_role'];
                            $active_username = $_SESSION['username'];
                            if($user_role == 'admin' || $active_username == $post_author){
                                if(isset($_GET['p_id'])){
                                    $the_post_id = $_GET['p_id'];
                                    echo "<a href='includes/edit_post.php?p_id={$the_post_id}' class='btn btn-primary'>Edit Post <span class='glyphicon '></span></a>";
                                }
                            }
                        }
                    ?>
                <!-- Blog Comments -->
                <?php
                    // Creates query for a comment that is submitted from the form below
                    if(isset($_POST['create_comment'])){
                        
                        $the_post_id = $_GET['p_id'];
                        
                        $comment_author = $_POST['comment_author'];
                        $comment_content = $_POST['comment_content'];
                        
                        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_content, comment_status, comment_date)";
                        $query .= "VALUES($the_post_id, '{$comment_author}', '{$comment_content}', 'approved', now())";
                        
                        $create_comment_query = mysqli_query($connection, $query);
                        
                        $query = "UPDATE posts SET post_comment_count  = post_comment_count + 1 WHERE post_id = $the_post_id";
                        $update_comment_count = mysqli_query($connection, $query);
              
                    }
                ?>
                <?php 
                
                    if(isset($_SESSION['user_role'])){
                        
                ?>
                <!-- Submitting Comments Form -->
                <div style="clear:both"></div>
                <hr>
                <div class="col-md-6 col-md-offset-3">
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form action="" method="post" role="form">
                            <div class="form-group">
                               <label for="author">Author</label>
                                <input class="form-control" type="text" name="comment_author" value="<?php echo $username ?>">
                            </div>
                            <div class="form-group">
                               <label for="comment">Your comment</label>
                                <textarea class="form-control" rows="3" name="comment_content"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- Posted Comments -->
        <?php
            // Displays comments from database that are related to this specific post
            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_comment_query)){
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];

        ?> 
            <div class="media col">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>

        <?php } ?>
    <hr>
<!-- Displays Footer -->
<?php include "includes/footer.php"; ?>