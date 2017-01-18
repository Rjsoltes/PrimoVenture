<!-- users.php is a controller for the different tabs of the users element on the navigation -->
<!-- Display Header -->
<?php include "includes/header.php"; ?>
    <div id="wrapper">
        <!-- Display Navigation -->
        <?php include "includes/navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page">
                            Users 
                            <small> Admin: <?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <?php
                            // checks the source of the users.php
                            // uses switch statement to change between the
                            // different sub pages of users.
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }else{
                                $source = '';
                            }

                            switch($source){
                                case 'add_user';
                                    include "includes/add_user.php";
                                break;
                                case 'edit_user';
                                    include "includes/edit_user.php";
                                break;
                                default:
                                    include "includes/view_all_users.php";
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