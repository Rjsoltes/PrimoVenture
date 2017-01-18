<!-- Comments.php acts as a controller to view all the comments in a table -->
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
                            Comments 
                            <small> Admin: <?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <?php
                            // checks the source of the comments.php
                            // uses switch statement to include the view_all_comments.php.
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }else{
                                $source = '';
                            }

                            switch($source){
                                default:
                                    // includes the table of all comments in database.
                                    include "includes/view_all_comments.php";
                                break;
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Displays Footer -->
<?php include "includes/footer.php"; ?>