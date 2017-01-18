<!-- Logout.php is called upon when the user clicks logout. -->
<!-- Starts a new session so the previous session is canceled -->
<?php session_start(); ?>
<?php
    // sets the current session's user value's to null. 
    // effectively making an empty sesssion.
    $_SESSION['username'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['user_role'] = null;

    // redirects to the home page.
    header("Location: ../home.php");
?>