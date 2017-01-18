<!-- Registration page allows user to register for an account on the web site -->
<!-- Displays Header -->
 <?php  include "includes/header.php"; ?>
   <?php
        // Gets data from registration form and cleans it of destructive things
        // using the mysqli_real_escape_string function.
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // If the fields of the form are not empty then 
            if(!empty($username) && !empty($email) && !empty($password)){
                $username = mysqli_real_escape_string($connection, $username);
                $email = mysqli_real_escape_string($connection, $email);
                $password = mysqli_real_escape_string($connection, $password);
                
                // Makes query to enter data from form into user table in database.
                $query = "INSERT INTO users(username, user_email, user_password, user_role) ";
                $query .= "VALUES('{$username}', '{$email}', '{$password}', 'standard' )";
                $register_user_query = mysqli_query($connection, $query);
                if(!$register_user_query){
                    die("Query Failed ". mysqli_error($connection));
                }
                // Displays message if registration was a success
                $message = "<h6 class='text-center bg-success'>Registration Submitted!</h6>";
            }else{
                // Displays message if a field is empty
                $message = "<h6 class='text-center bg-danger'>Fields cannot be empty!</h6>";
            }
        }else{
            // All other cases the message is not displayed.
            $message = "";
        } 
    ?>
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
            <h2 class="text-center">Register</h2>
            <div style="clear:both"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                               <?php echo $message; ?>
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                                </div>
                                 <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                                </div>
                                 <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                </div>

                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-info btn-lg btn-block" value="Register">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr>
<!-- Displays Footer -->
<?php include "includes/footer.php";?>