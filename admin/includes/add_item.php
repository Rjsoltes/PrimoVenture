<!-- add_user.php displays a form that allows a user to be added to the database. -->
<?php 
    // Retrieves data entered into the add user form.
    if(isset($_POST['create_item'])){
        $item_name = $_POST['item_name'];
        $item_description = $_POST['item_description'];
        $item_color = $_POST['item_color'];
        $item_price = $_POST['item_price'];
        $item_rating = $_POST['item_rating'];
        $item_image = $_FILES['image']['name'];
        $item_image_temp = $_FILES['image']['tmp_name'];
        
        move_uploaded_file($item_image_temp, "../shop/img/$item_image");
        
        $query = "INSERT INTO shopitems(item_name, item_description, item_color, item_image, item_price , item_rating) "; 
        $query .= "VALUES('{$item_name}','{$item_description}','{$item_color}','{$item_image}','{$item_price}','{$item_rating}')";
        
        $create_item_query = mysqli_query($connection, $query);
        
        confirm($create_item_query);
        
        echo "<p class='bg-success'>Item Created!</p>";
    }

?>
   
<!-- Creates form to add a user into the database. -->
<div class="col-xs-5">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" name="item_name">
        </div>
        <div class="form-group">
            <label for="item_color">Item Color</label>
            <input type="text" class="form-control" name="item_color">
        </div>
        <div class="form-group">
            <label for="item_description">Item Description</label>
            <textarea type="text" class="form-control" name="item_description" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="item_image">Item Picture</label>
            <input type="file" name="image">
        </div>
         <div class="form-group">
            <label for="item_price">Item Price</label>
            <input type="text" class="form-control" name="item_price">
        </div>
        <div class="form-group">
            <label for="item_rating">Item Rating</label>
            <input type="text" class="form-control" name="item_rating">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="create_item" value="Add Item">
        </div>
    </form>
</div>