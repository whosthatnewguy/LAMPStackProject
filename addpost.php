<?php
//connecting to config files
require('config/config.php');
require('config/db.php');

// Check for submit form
if(isset($_POST['submit'])){
    // Get form data
    //$_POST is post array
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);

    $query = "INSERT INTO accounts(title,author,body) VALUES('$title','$author','$body')";

    if(mysqli_query($conn, $query)){
        // returns to home page after succesful submit
        header('Location: '.ROOT_URL.'');
    } else {
        echo 'ERROR: '. mysqli_error($conn);
    }
}




?>

<?php include('include/header.php'); ?>
    <div class="container">
    <h1>Add Posts</h1>
    <!--action="" refers to this page - will submit form to this page-->
    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control">
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea name="body" class="form-control"></textarea>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    </form>

    </div>
<?php include('include/footer.php'); ?>



