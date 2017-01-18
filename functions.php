<!-- Functions page includes functions for some processes that are reused so code can be condensed -->
<?php

// Creates function that tests the connection between the site and databse.
function confirm($result){
    global $connection;
    if(!$result){
        die("FAILED QUERY ". mysqli_error($connection));
    }
}

// Creates function to insert the categories in databse
function insert_categories(){

    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field must be filled out.";
        }else{
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUE('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query){
                die('Query Failed' . mysqli_error($connection));
            }
            header("Location: categories.php");
        }
    }
}

// Creates function to retreive all the categories in the databsase
function findAllCategories(){
    
    global $connection;
    
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }   
}

// Creates function to delete a categorry from database.
function deleteCategory(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
?>