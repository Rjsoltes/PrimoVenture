<!-- Creates table to display all comments -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th colspan="3" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
           <?php
                // Creates query to retrieve all the info about comments and displays
                // all the info into rows on the table. 
                $query = "SELECT * FROM comments";
                $select_comments = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_comments)){

                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date'];
                    
                    echo "<tr>";
                    echo "<td>{$comment_id}</td>";
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>"; 
                    echo "<td>{$comment_status}</td>";
                    
                    // Creates query that gets id of the post the comment is
                    // related to. Displays link to the post that the comment is on.
                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    $select_post_id_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_post_id_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        
                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                    }
                    
                    echo "<td>{$comment_date}</td>";
                    echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                    echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                    echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                    echo "</tr>";

                }
           ?>
        </tr>
    </tbody>
</table>

<?php
    
    // Changes the comment status to approved by clicking the approved button above.
    // when button is clicked, page redirects to the same page for auto refresh.
    if(isset($_GET['approve'])){
        $the_comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";
        $approve_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");

    }

    // Changes the comment status to unapproved by clicking the unapproved button above.
    // when button is clicked, page redirects to the same page for auto refresh.
    if(isset($_GET['unapprove'])){
        $the_comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";
        $unapprove_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");

    }

    // Deletes the comment by clicking the delete button created above.
    // when button is clicked, page redirects to the same page for auto refresh.
    if(isset($_GET['delete'])){
        $the_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: comments.php");

    }
?>