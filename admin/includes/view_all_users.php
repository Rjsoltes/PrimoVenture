<!-- Creates table to display information about users -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th colspan="4" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
           <?php
                // Creates query to retreive infromation about users from database.
                // Displays information into rows on the table.
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_users)){

                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];
                    $user_role = $row['user_role'];
                    
                    echo "<tr>";
                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$user_firstname</td>";
                    echo "<td>$user_lastname</td>";
                    echo "<td>$user_email</td>";
                    echo "<td>$user_role</td>";
                    echo "<td><a href='users.php?make_admin={$user_id}'>Make Admin</a></td>";
                    echo "<td><a href='users.php?make_standard={$user_id}'>Make Standard</a></td>";
                    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                    echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                    echo "</tr>";

                }
           ?>
        </tr>
    </tbody>
</table>

<?php
    
    // Changes the user role to admin by clicking the make admin button above.
    // when button is clicked, page redirects to the same page for auto refresh.
    if(isset($_GET['make_admin'])){
        $the_user_id = $_GET['make_admin'];
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id}";
        $make_admin_query = mysqli_query($connection, $query);
        header("Location: users.php");

    }

    // Changes the user role to standard by clicking the make standard button above.
    // when button is clicked, page redirects to the same page for auto refresh.
    if(isset($_GET['make_standard'])){
        $the_user_id = $_GET['make_standard'];
        $query = "UPDATE users SET user_role = 'standard' WHERE user_id = {$the_user_id}";
        $make_standard_query = mysqli_query($connection, $query);
        header("Location: users.php");

    }

    // Deletes the user when clicking the delete button created above.
    // when button is clicked, page redirects to the same page for auto refresh.
    if(isset($_GET['delete'])){
        $the_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");

    }
?>