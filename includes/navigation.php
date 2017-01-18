<!-- Navigation for all the web pages outside of the admin folder -->
    <?php 
        // Brings in information about user that is used in navigation
        if(isset($_SESSION['username'])){
        
        $username = $_SESSION['username'];
        
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_profile_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_user_profile_query)){
            $user_id = $row['user_id'];
            $username = $row['username'];   
        }
        }
    ?>
   <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">PrimoVenture</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="about.php"><i class="fa fa-fw fa-book"></i>About</a></li>
                    <li><a href="shop/index.php"><i class="fa fa-fw fa-shopping-cart"></i> Shop</a></li>
                </ul>
                 <ul class="nav navbar-nav navbar-right">
                    <li><a href="home.php"><i class='fa fa-fw fa-home'></i> Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-list-ul"></i> Categories<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                              <li><a href="home.php">All</a></li>
                           <?php 
                                $query = "SELECT * FROM categories";
                                $select_categories = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_categories)){
                                    $cat_title = $row['cat_title'];
                                    $cat_id = $row['cat_id'];

                                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                }
                            ?>
                        </ul>
                    </li>
                    <?php
                        // Determines the user tab on the navigation.
                        // If the user is an admin then they get a link to the admin page and their profile.
                        // If the user is a standard user they just get a link to their profile. 
                        // Also if a user is logged in then is shows a log out button.
                        // If no user is logged in then it shows a log in button.
                        // Always shows a register button.
                        if(isset($_SESSION['user_role'])){
                                $user_role = $_SESSION['user_role'];
                                if($user_role == 'admin'){
                                    echo "<li class='dropdown'>
                                            <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-fw fa-user'></i> {$username} <b class='caret'></b></a>
                                            <ul class='dropdown-menu'>
                                                
                                                <li>
                                                    <a href='admin/index.php'><i class='fa fa-fw fa-lock'></i> Admin</a>
                                                </li>
                                                <li class='divider'></li>
                                                <li>
                                                    <a href='profile.php?u_id={$user_id}'><i class='fa fa-fw fa-user'></i> Profile</a>
                                                </li>
                                            </ul>
                                          </li>";
                                }else{
                                    echo "<li><a href='profile.php?u_id={$user_id}'><i class='fa fa-fw fa-user'></i> {$username}</a></li>";
                                }
                                echo "<li><a href='registration.php'><i class='fa fa-fw fa-send'></i> Register</a></li>";
                                echo "<li><a href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a></li>";
                                
                            }else{
                                echo "<li><a href='registration.php'><i class='fa fa-fw fa-send'></i> Register</a></li>";
                                echo "<li><a href='login_page.php'><i class='fa fa-fw fa-sign-in'></i> Log In</a></li>";
                        }
                        
                    ?>
                  <form class="navbar-form navbar-right" action="search.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="search">
                    </div>
                    <button name="submit" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                  </form>
                </ul>
            </div>
        </div>
    </nav>