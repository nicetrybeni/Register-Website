<?php 
include "config.php";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username']: '';

    $sql = "INSERT INTO users (username) VALUES ($username)";

    if ($connection->query($sql) === TRUE) {
        $_SESSION['success_message'] = "User created successfully";
      } else {
      echo "Error: " . $sql . "<br>" . $connection->error;
      }
      echo "<h1>Submitted Data</h1>";
      echo "<p>Username: " . $username . "</p>";
      
      header("Location: index-admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Create </title>
</head>
<body>
    <h1> Account Information </h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="username">Username:</lable>
    <input type="text" id="username" name="username" required>

    <input type="submit" name="submit" value="CREATE ACCOUNT">
</body>
</html>