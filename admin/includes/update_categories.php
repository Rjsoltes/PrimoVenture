<!-- Creates form to edit a category -->
<form action="categories.php" method="post">
    <div class="form-group">
       <label for="cat-title">Edit Category</label>
       <?php 
            //Edit Category
            if(isset($_GET['edit'])){
                $the_cat_id = $_GET['edit'];
                
                // Creates query that gets the title of the category based on the id.
                $query = "SELECT * FROM categories WHERE cat_id = $the_cat_id ";
                $select_categories_id = mysqli_query($connection, $query);

                // Displays the category wanting to be edited
                while($row = mysqli_fetch_assoc($select_categories_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    ?>

                    <input value="<?php if(isset($cat_title)){ echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">

            <?php 
                }}
            ?>

        <?php 
            //Update Category by getting info entered and sending it to the database.
            if(isset($_POST['update_category'])){
                $the_cat_title = $_POST['cat_title'];
                $the_cat_id = $_POST['cat_id'];
                $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$the_cat_id}";
                $update_query = mysqli_query($connection, $query);
                header("Location: categories.php");
            }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update">
    </div>
</form>