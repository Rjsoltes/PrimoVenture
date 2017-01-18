<?php include "includes/header.php"; ?>
    <!-- Display Navigation -->
    <?php include "includes/shop_navigation.php"; ?>
    <?php 
        if(isset($_GET['i_id'])){
            $the_item_id = $_GET['i_id'];
        }

        // Bring in information about the items to display on shop home page
        $query = "SELECT * FROM shopitems WHERE item_id = $the_item_id";
        $select_all_items_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_all_items_query)){
            $item_id = $row['item_id'];
            $item_name = $row['item_name'];
            $item_description = $row['item_description'];
            $item_color = $row['item_color'];
            $item_price = $row['item_price'];
            $item_reviews = $row['item_reviews'];
            $item_rating = $row['item_rating'];
            $item_image = $row['item_image'];

        ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
          <br>
           <img src="../img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:left">
                    <img src="../img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:right">
                    <h1 class="page-header text-center">Shop </h1>
                    <div class="text-center"><h1><small><?php echo $item_name; ?></small></h1></div>
                    <div style="clear:both"></div>
            <div class="well col-center">
                <div class="row">
                <div class="col-md-5">
                    <div class="thumbnail">
                        <img src="img/<?php echo $item_image; ?>" alt="" width="600">
                        <br>
                    </div>
                    <div class="text-left">
                        <a class="btn btn-success">Leave a Review</a>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            Anonymous
                            <span class="pull-right">10 days ago</span>
                            <p>This product was great in terms of quality. I would definitely buy another!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <div class="row">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="caption">
                                <h3 class="pull-right">$<?php echo $item_price; ?></h3>
                                <h3 class=""><?php echo $item_name;?> <small><?php echo $item_color; ?></small></h3>
                                <div class="ratings">
                                <p class="pull-right"><?php echo $item_reviews; ?> reviews</p>
                                <p>
                                   <?php 

                                        $empty_stars = 5 - ($item_rating);

                                        for($i = 0; $i < $item_rating; $i++){
                                            echo "<span class='glyphicon glyphicon-star'></span>";
                                        }
                                        for($i = 0; $i < $empty_stars; $i++){
                                            echo "<span class='glyphicon glyphicon-star-empty'></span>";   
                                        }
                                    ?> 
                                </p>
                            </div>
                                <p><?php echo $item_description; ?></p>
                            </div>
                            
                        <br><br><hr>
                        <div class="form-group">
                            <label for="item_size">Size</label>
                            <select name="" id="">
                                <option value="" selected>&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                                <option value="xlarge">X-Large</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item_quantity">QTY</label>
                            <select name="" id="">
                                <option value="" selected>&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            &nbsp;&nbsp;&nbsp;
                            <input type="submit" class="btn btn-primary" name="create_item" value="Add to Cart">
                        </div>
                    </form>
                    <br>
                    <h4>Features</h4>
                    <div class="caption">
                            
                            
                       
                    </div>
                </div>
                </div>
                </div>
                <?php } ?>
            
        </div>
        
<?php include "includes/footer.php"; ?>
