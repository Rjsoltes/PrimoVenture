<!-- categories.php displays all the categories in a table from database -->
<!-- Display Header -->
<?php include "includes/header.php"; ?>
    <div id="wrapper">
        <!-- Display Navigation -->
        <?php include "includes/navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                            <small> Admin: <?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <!--Add Category Form-->
                        <div class="col-xs-6">
                           <?php 
                                // Gets text from the form to add a new category.
                                // Checks if there is anything in the field and presents error
                                // if something goes wrong with a connection to database.
                                // Reloads page after something is submitted
                                insert_categories();
                            ?>
                            <form action="categories.php" method="post">
                                <div class="form-group">
                                   <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Cateogry">
                                </div>
                            </form>
                            <?php 
                                // Update and include edited category.
                                if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];
                                    include "includes/update_categories.php";
                                }
                            ?>
                        </div>
                        <div class="col-xs-6">
                           <!-- Creates a table of categories currently in the database. -->
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        //Display Category titles in table
                                       findAllCategories();
                                    ?>
                                    <?php 
                                        //Delete Category
                                        deleteCategory();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Display Footer -->
<?php include "includes/footer.php"; ?>