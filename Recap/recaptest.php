<?php
#CREATE 06/25/23
include "config.php";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = isset($_POST['username']) ? $_POST['username']: '';

$sql = "INSERT INTO users (username) values ($username)";

    if($connection->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Created";
    }else{
        echo "Error :" . $sql . "<br>" . $connection->error;
    }
    exit();
}
?>
<?php
#UPDATE
include ("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id']: '';
    $username = isset($_POST['username']) ? $_POST['username']: '';

$sql = "UPDATE users SET username='$username' WHERE id=$id";

    if($connection->query($sql) === TRUE){
        $_SESSION['sucess_message'] = "Updated";
    }else{
        echo "Error :" . $sql . "<br>" . $connection->error;
    }
    exit();
}
?>
<?php
#DELETE
include "config.php";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id']: '';

$sql = "DELETE FROM users WHERE id=$id";

    if($connection->query($sql) === TRUE) {
        $_SESSION['sucess_message'] = "Deleted";
    }else{
        echo "Error: ". $sql . "<br>" . $connection->error;
    }
    exit();
}
?>