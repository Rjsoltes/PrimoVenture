<!-- Category Page is very similar to the home page except this page
     takes a parameter of category number so in order for this page to display, 
     there must be category.php?category=1. This instructs the web site to display
     posts that are of category 1. -->
<!-- Display Header -->
<?php include "includes/header.php"; ?>
    <!-- Display Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <br><br>
            <!-- Category Page Header -->
            <img src="img/primoventureLogoB&W.png" alt="" width="225" class="image-responsive" style="float:left">
            <img src="img/primoventureLogoB&W.png" alt="" width="225" class="image-responsive" style="float:right">
            <h1 class="page-header text-center">P R I M O V E N T U R E</h1>
            <div class="text-center"><h1><small> Adventure is out there.</small></h1></div>
            <div style="clear:both"></div>
            <div class="page-header"></div>
            <!-- Blog Entries Column -->
            <div class="col text-center">
               <?php 
                    // Gets the name of category clicked on.
                    if(isset($_GET['category'])){
                        $post_category_id = $_GET['category'];
                    }  
                
                    // Makes query and gets all posts that are in the category
                    // that is clicked on.
                    $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    
                    // Displays all posts under the clicked category.
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,430);
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
                   <?php } }?>
            </div>
        </div>
        <hr>
<!-- Displays Footer -->
<?php include "includes/footer.php"; ?>