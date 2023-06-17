<?php
include "config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $id = isset($_POST['id']) ? $_POST['id'] : '';

  // Delete the record from the "users" table
  $sql = "DELETE FROM users WHERE id = '$id'";

  if ($connection->query($sql) === TRUE) {
    $_SESSION['success_message'] = "Record deleted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $connection->error;
  }

  // Redirect to the update.php page or display a success message
  header("Location: index-admin.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Form</title>
</head>
<body>
  <h1>Delete Information</h1>
  <form method="POST" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this user?')">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="submit" name="submit" value="DELETE">
  </form>
</body>
</html>
