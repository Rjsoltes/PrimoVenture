<!-- add_user.php displays a form that allows a user to be added to the database. -->
<?php 
    // Retrieves data entered into the add user form.
    if(isset($_POST['create_user'])){
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_content = $_POST['user_content'];
        
        move_uploaded_file($user_image_temp, "./img/$user_image");
        
        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_image , user_content ,username, user_email, user_password) "; 
        $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}', '{$user_image}','{$user_content}','{$username}','{$user_email}','{$user_password}')";
        
        $create_user_query = mysqli_query($connection, $query);
        
        confirm($create_user_query);
        
        echo "<p class='bg-success'>User Created!</p>";
    }

?>
   
<!-- Creates form to add a user into the database. -->
<div class="col-xs-5">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="user_firstname">First Name</label>
            <input type="text" class="form-control" name="user_firstname">
        </div>
        <div class="form-group">
            <label for="user_lastname">Last Name</label>
            <input type="text" class="form-control" name="user_lastname">
        </div>
        <div class="form-group">
            <label for="user_role">User Role</label><br>
            <select name="user_role" id="">
                <option value="standard">Select options</option>
                <option value="admin">Admin</option>
                <option value="standard">Standard</option>
            </select>
        </div>
        <div class="form-group">
            <label for="user_image">Profile Picture</label>
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <label for="user_content">User Summary</label>
            <textarea type="text" class="form-control" name="user_content" id="" cols="30" rows="10"></textarea>
        </div>
         <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" class="form-control" name="user_email">
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" class="form-control" name="user_password">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
        </div>
    </form>
</div>