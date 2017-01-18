<!-- edit_user.php displays a form that
     allows a user's information to be changed. -->
<?php 
    // Creates query to get the information for a specific user.
    if(isset($_GET['u_id'])){
        $the_user_id = $_GET['u_id'];
        
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_users_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_users_query)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
            $user_content = $row['user_content'];
            
    }

    }

// Retrieves data entered into the edit user form.
    if(isset($_POST['edit_user'])){
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        $user_content = $_POST['user_content'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        
        move_uploaded_file($user_image_temp, "./img/$user_image");
        
        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_image = '{$user_image}', ";
        $query .= "user_content = '{$user_content}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE user_id = '{$the_user_id}' ";
    
        $update_user = mysqli_query($connection, $query);
        confirm($update_user);
        echo "<p class='bg-success'>User Updated!</p>";
    }

?>
   
<div class="col-xs-5">
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label><br>
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php 
                // gets current role and displays it first then the other role second.
                if($user_role == 'admin'){
                    echo "<option value='standard'>standard</option>";
                }else{
                    echo "<option value='admin'>admin</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
       <label for="post_image">Profile Picture</label>
        <img src="img/<?php echo $user_image; ?>" width="75" alt="">
        <input type="file" name="image" value="<?php echo $user_image; ?>">
    </div>
    <div class="form-group">
        <label for="user_content">User Summary</label>
        <textarea type="text" class="form-control" name="user_content" id="" cols="30" rows="10"><?php echo $user_content; ?></textarea>
    </div>
     <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input value="<?php echo $user_password ?>" type="password" class="form-control" name="user_password" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit">
    </div>
</form>
</div>