<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = isset($_POST['id']) ? $_POST['id'] : '';
  $username = isset($_POST['username']) ? $_POST['username'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
  $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
  $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
  $secret_question = isset($_POST['secret_question']) ? $_POST['secret_question'] : '';
  $secret_answer = isset($_POST['secret_answer']) ? $_POST['secret_answer'] : '';

  // TODO: Perform validation and database update
  // You can add your code here to validate the form inputs and update the data in the database

  // Update the record in the "users" table
  $sql = "UPDATE users SET username='$username', password='$password', email='$email', firstname='$firstname', lastname='$lastname', birthday='$birthday', secret_question='$secret_question', secret_answer='$secret_answer' WHERE id=$id";

  if ($connection->query($sql) === TRUE) {
    $_SESSION['success_message'] = "User updated successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $connection->error;
  }

  mysqli_close($connection);

  // Redirect back to the index page
  header("Location: index-admin.php");
  exit();
}

// Fetch the user record based on the provided ID
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($connection, $sql);

  if (!$result) {
    die("Error: " . $sql . "<br>" . mysqli_error($connection));
  }

  $user = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
  mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update User</title>
</head>
<body>
  <h1>Update User</h1>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
    
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required><br><br>
    
    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required><br><br>
    
    <label for="birthday">Birthday:</label>
    <input type="date" id="birthday" name="birthday" value="<?php echo $user['birthday']; ?>" required><br><br>
    
    <label for="secret_question">Secret Question:</label>
    <select id="secret_question" name="secret_question" required>
      <option value="">Select a secret question</option>
      <option value="mother_maiden_name" <?php if ($user['secret_question'] === 'mother_maiden_name') echo 'selected'; ?>>What is your mother's maiden name?</option>
      <option value="secret_name" <?php if ($user['secret_question'] === 'secret_name') echo 'selected'; ?>>What is your secret name?</option>
    </select><br><br>
    
    <label for="secret_answer">Secret Answer:</label>
    <input type="text" id="secret_answer" name="secret_answer" value="<?php echo $user['secret_answer']; ?>" required><br><br>
    <input type="submit" name="submit" value="Update">
  </form>
</body>
</html>
