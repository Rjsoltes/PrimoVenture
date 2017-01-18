<!-- edit_user.php displays a form that
     allows a user's information to be changed. -->
<?php 
    // Creates query to get the information for a specific user.
    if(isset($_GET['i_id'])){
        $the_item_id = $_GET['i_id'];
        
        $query = "SELECT * FROM shopitems WHERE item_id = $the_item_id ";
        $select_items_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_items_query)){
            $item_id = $row['item_id'];
            $item_name = $row['item_name'];
            $item_description = $row['item_description'];
            $item_color = $row['item_color'];
            $item_price = $row['item_price'];
            $item_reviews = $row['item_reviews'];
            $item_rating = $row['item_rating'];
            $item_image = $row['item_image'];
            
    }

    }

// Retrieves data entered into the edit user form.
    if(isset($_POST['edit_item'])){
        $item_name = $_POST['item_name'];
        $item_description = $_POST['item_description'];
        $item_color = $_POST['item_color'];
        $item_price = $_POST['item_price'];
        $item_rating = $_POST['item_rating'];
        $item_reviews = $_POST['item_reviews'];
        $item_image = $_FILES['image']['name'];
        $item_image_temp = $_FILES['image']['tmp_name'];

        
        move_uploaded_file($item_image_temp, "../shop/img/$item_image");
        
        $query = "UPDATE shopitems SET ";
        $query .= "item_name = '{$item_name}', ";
        $query .= "item_description = '{$item_description}', ";
        $query .= "item_color = '{$item_color}', ";
        $query .= "item_price = '{$item_price}', ";
        $query .= "item_rating = '{$item_rating}', ";
        $query .= "item_reviews = '{$item_reviews}', ";
        $query .= "item_image = '{$item_image}' ";
        $query .= "WHERE item_id = '{$the_item_id}' ";
    
        $update_item = mysqli_query($connection, $query);
        confirm($update_item);
        echo "<p class='bg-success'>Item Updated!</p>";
    }

?>
   
<div class="col-xs-5">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input value="<?php echo $item_name; ?>" type="text" class="form-control" name="item_name">
        </div>
        <div class="form-group">
            <label for="item_color">Item Color</label>
            <input value="<?php echo $item_color; ?>" type="text" class="form-control" name="item_color">
        </div>
        <div class="form-group">
            <label for="item_description">Item Description</label>
            <textarea type="text" class="form-control" name="item_description" id="" cols="30" rows="10"><?php echo $item_description; ?></textarea>
        </div>
        <div class="form-group">
           <label for="item_image">Item Image</label>
            <img src="./shop/img/<?php echo $item_image; ?>" width="75" alt="">
            <input type="file" name="image" value="<?php echo $item_image; ?>">
        </div>
        <div class="form-group">
            <label for="item_price">Item Price</label>
            <input value="<?php echo $item_price; ?>" type="text" class="form-control" name="item_price">
        </div>
         <div class="form-group">
            <label for="item_rating">Item Rating</label>
            <input value="<?php echo $item_rating; ?>" type="text" class="form-control" name="item_rating">
        </div>
        <div class="form-group">
            <label for="item_reviews">Item Reviews</label>
            <input value="<?php echo $item_reviews; ?>" type="text" class="form-control" name="item_reviews">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="edit_item" value="Edit">
        </div>
    </form>
</div>