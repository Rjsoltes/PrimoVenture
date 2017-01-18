<!-- Login Page, this page allows a user to login to their account -->
<!-- Displays Header  -->
 <?php  include "includes/header.php"; ?>
    <!-- Displays Navigation -->
    <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
        <section id="login">
            <h1 class="text-center">P R I M O V E N T U R E</h1>
            <div class="text-center"><h1><small> Adventure is out there.</small></h1></div>
            <div class="text-center">
                <img src="img/pvLogo.png" alt="" width="225" class="image-responsive text-center">
            </div>
            <h2 class="text-center">Login</h2>
            <div style="clear:both"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <form role="form" action="includes/login.php" method="post" id="login-form" autocomplete="off">

                               <h6 class="text-center"></h6>
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                                </div>
                                 <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                </div>

                                <input type="submit" name="login" id="btn-login" class="btn btn-custom btn-info btn-lg btn-block" value="Login">
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
    <hr>
<!-- Displays Footer -->
<?php include "includes/footer.php";?>