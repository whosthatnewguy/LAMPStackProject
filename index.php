<?php
//connecting to config files
require('config/config.php');
require('config/db.php');

//create query using data table name
$query = 'SELECT * FROM accounts ORDER BY created_at DESC';

//get results
$result = mysqli_query($conn, $query);

//fetching data as associative array
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

//dumps data on html page to view
//var_dump($posts);

//free results from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);

?>

<?php include('include/header.php'); ?>
    <div class="container">
    <h1>Posts</h1>
    <!--looping thru sql fetch -->
    <?php foreach ($posts as $post) : ?>
        <div class="well">
            <h1><?php echo $post['title']; ?></h1>
            <small>Created on <?php echo $post['created_at']; ?>
            by<?php echo $post['author']; ?></small>
            <p><?php echo $post['body'];  ?></p>
            <a class="btn btn-default" href="<?php echo ROOT_URL;
            ?>post.php?id= <?php echo $post['id']; ?>">Read More</a>
        </div>
    <?php endforeach; ?>
    </div>
<?php include('include/footer.php'); ?>



