<?php 
#CREATE 
// recap  create.php 
include "config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //retrieve data 
    $username = isset($_POST['username']) ? $_POST['username'] : '';

// insert to DB
$sql = "INSERT INTO users (username) values ($username)";

    if($connection->($sql) === TRUE) {
        $_SESSION['success_message'] = "User created succesfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
// Show username from DB (READ)
    echo "<h1> Username: " . $username . "</h1>";

header("Location: index-admin.php");
exit();
}
?>
<?php
#UPDATE
// recap update.php 
include "config.php";
session_start();
//validation starts here 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
// Update query
$sql = "UPDATE users SET username='$username' WHERE id=$id";

    if($connection->query($sql) === TRUE) {
        $_SESSION['success_message'] = "User updated";
    }else {
        echo "Error :" . $sql . "<br>" .$connection->error;
    }
    mysqli_close($connection)

    header("Location: index-admin.php")
    exit();
} 
?>
<?php
#DELETE
//recap delete.php
include "config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //retrieve data
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    //Delete query
$sql = "DELETE FROM users WHERE id=$id";

if ($connection->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Deleted";
}else {
    echo "Error :". $sql . "<br>" . $connection->error;
}
}
?>