<?php include "includes/header.php"; ?>

    <?php include "includes/shop_navigation.php";?>
    
    <div class="container">
        <div class="row">
            <div class="col-center">
            <img src="../img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:left">
                    <img src="../img/primoventureLogoB&W.png" alt="" width="100" class="image-responsive" style="float:right">
                    <h1 class="page-header text-center">Shop</h1>
                    <div class="text-center"><h1><small> Adventure is out there.</small></h1></div>
                    <div style="clear:both"></div><br>
            </div>
        </div>
    </div>
    <header id="myCarousel" class="carousel slide">
       
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background: url(img/sunset.jpg) center;"></div>
                <div class="carousel-caption">
                    <h2> P R I M O V E N T U R E </h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background: url(img/forest.jpg) center;"></div>
                <div class="carousel-caption">
                    <h2> P R I M O V E N T U R E </h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background: url(img/cityscape.jpg) center;"></div>
                <div class="carousel-caption">
                    <h2> P R I M O V E N T U R E </h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
    <hr>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-center">
                <br>
                <div class="row">
                    
                    <?php 
                        // Bring in information about the items to display on shop home page
                        $query = "SELECT * FROM shopitems";
                        $select_all_items_query = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_all_items_query)){
                            $item_id = $row['item_id'];
                            $item_name = $row['item_name'];
                            $item_description = substr($row['item_description'],0,140);
                            $item_color = $row['item_color'];
                            $item_price = $row['item_price'];
                            $item_reviews = $row['item_reviews'];
                            $item_rating = $row['item_rating'];
                            $item_image = $row['item_image'];
                            
                            ?>
                                <!-- Item Post -->
                                <div class="col-sm-4 col-lg-4 col-md-4">
                                    <div class="thumbnail">
                                        <a href="item.php?i_id=<?php echo $item_id;?>"><img src="img/<?php echo $item_image; ?>" alt="" width="600"></a>
                                        <div class="caption">
                                            <h4 class="pull-right">$<?php echo $item_price; ?></h4>
                                            <h4><a href="item.php?i_id=<?php echo $item_id;?>"><?php echo $item_name;?> <small><?php echo $item_color; ?></small></a></h4>
                                            <p><?php echo $item_description; ?>... </p>
                                        </div>
                                        <div class="ratings">
                                           <a class="pull-right btn btn-sm btn-primary" href="#">Add to Cart</a>
                                            <p>
                                               <?php 
                                                    $empty_stars = 5 - ($item_rating);
                            
                                                    for($i = 0; $i < $item_rating; $i++){
                                                        echo "<span class='glyphicon glyphicon-star'> </span>";
                                                    }
                                                    for($i = 0; $i < $empty_stars; $i++){
                                                        echo "<span class='glyphicon glyphicon-star-empty'> </span>";   
                                                    }
                            
                                                    echo " " . $item_reviews . " reviews";
                                                ?> 
                                            </p><br>
                                        </div>
                                    </div>
                                </div>
                       <?php }  ?>
<!--
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <h4><a href="#">Like this template?</a>
                        </h4>
                        <p>If you like this template, then check out <a target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this tutorial</a> on how to build a working review system for your online store!</p>
                        <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">View Tutorial</a>
                    </div>
-->

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>
<?php include "includes/footer.php"; ?>