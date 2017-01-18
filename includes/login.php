<!-- Login.php contains all the php in order to log a user in 
     when they click the login button on the login form at the login_page.php. -->
<!-- Includes db.php so the connection can be passed through mysql functions -->
<?php include "db.php"; ?>
<!-- Starts a session for the user that logs in -->
<?php session_start(); ?>
<?php
    // Creates a query to log a user in based on a username and password entered.
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_user_query)){
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
            $db_user_content = $row['user_content'];
        }

        // $password = crypt($password, $db_user_password);

        // If username and password are wrong, user is redirected to the same page.
        // If correct they are redirected to the admin home-page.
        if($username !== $db_username && $password !== $db_user_password){
            header("Location: ../login_page.php");

        }else if($username == $db_username && $password == $db_user_password){
            // sets the current session user information to the information of 
            // the user that is logged in. 
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['user_content'] = $db_user_content;
            
            // Redirects to the home page with user logged in.
            header("Location: ../home.php");

        }else{
            // Redirects to the home page with user not logged in.
            header("Location: ../login_page.php");
        }
    }
?>