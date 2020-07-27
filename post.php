<?php
//connecting to config files
require('config/config.php');
require('config/db.php');

//deleting from db and getting post info
if(isset($_POST['delete'])){
    // Get form data
    //$_POST is post array
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "DELETE FROM accounts WHERE id = {$delete_id}";


    if(mysqli_query($conn, $query)){
        // returns to home page after succesful submit
        header('Location: '.ROOT_URL.'');
    } else {
        echo 'ERROR: '. mysqli_error($conn);
    }
}





//get id || real_escape string gets rid of harmful characters
$id = mysqli_real_escape_string($conn, $_GET['id']);

//create query using data table name
$query = 'SELECT * FROM accounts WHERE id = '.$id;

//get results
$result = mysqli_query($conn, $query);

//fetching data as associative array
$post = mysqli_fetch_assoc($result);

//dumps data on html page to view
//var_dump($posts);

//free results from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);

?>

<?php include('include/header.php'); ?>
        <div class="container">
            <a href="<?php echo ROOT_URL; ?>" class="btn btn-default">Back</a>
            <h1><?php echo $post['title']; ?></h1>
            <small>Created on <?php echo $post['created_at']; ?>by<?php echo $post['author']; ?></small>
            <p><?php echo $post['body'];  ?></p>
            <hr>

            <!--delete button-->
            <form class="pull-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="delete_id" value="<?php  echo $post['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>


            <!--edit button -->
            <a href="<?php echo ROOT_URL;?>editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-default">Edit</a>
<?php include('include/footer.php'); ?>


