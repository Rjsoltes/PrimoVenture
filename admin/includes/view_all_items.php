<!-- Creates table to display information about users -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Color</th>
            <th>Image</th>
            <th>Price</th>
            <th># of Reviews</th>
            <th>Rating</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
           <?php
                // Creates query to retreive infromation about users from database.
                // Displays information into rows on the table.
                $query = "SELECT * FROM shopitems";
                $select_items = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_items)){

                    $item_id = $row['item_id'];
                    $item_name = $row['item_name'];
                    $item_description = $row['item_description'];
                    $item_color = $row['item_color'];
                    $item_price = $row['item_price'];
                    $item_reviews = $row['item_reviews'];
                    $item_rating = $row['item_rating'];
                    $item_image = $row['item_image'];
                    
                    echo "<tr>";
                    echo "<td>$item_id</td>";
                    echo "<td>$item_name</td>";
                    echo "<td>$item_description</td>";
                    echo "<td>$item_color</td>";
                    echo "<td><img width='75' src='../shop/img/$item_image'></td>";
                    echo "<td>$item_price</td>";
                    echo "<td>$item_reviews reviews</td>";
                    echo "<td>$item_rating stars</td>";
                    echo "<td><a href='shopitems.php?source=edit_item&i_id={$item_id}'>Edit</a></td>";
                    echo "<td><a href='shopitems.php?delete={$item_id}'>Delete</a></td>";
                    echo "</tr>";

                }
           ?>
        </tr>
    </tbody>
</table>

<?php
    // Deletes the user when clicking the delete button created above.
    // when button is clicked, page redirects to the same page for auto refresh.
    if(isset($_GET['delete'])){
        $the_item_id = $_GET['delete'];
        $query = "DELETE FROM shopitems WHERE item_id = {$the_item_id}";
        $delete_item_query = mysqli_query($connection, $query);
        header("Location: shopitems.php");

    }
?>