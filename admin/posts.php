<!-- posts.php is a controller for the different tabs of the posts element on the navigation -->
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
                        <h1 class="page">
                            Posts 
                            <small> Admin: <?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <?php
                            // checks the source of the tab clicked
                            // uses switch statement to change between the three
                            // different sub pages of posts.
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }else{
                                $source = '';
                            }

                            switch($source){
                                case 'add_post';
                                    include "includes/add_post.php";
                                break;
                                case 'edit_post';
                                    include "includes/edit_post.php";
                                break;
                                default:
                                    include "includes/view_all_posts.php";
                                break;
                            }
    
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Display Footer -->
<?php include "includes/footer.php"; ?>