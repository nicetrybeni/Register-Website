<?php
include "config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $username = isset($_POST['username']) ? $_POST['username'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
  $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
  $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
  $secret_question = isset($_POST['secret_question']) ? $_POST['secret_question'] : '';
  $secret_answer = isset($_POST['secret_answer']) ? $_POST['secret_answer'] : '';

// TODO: Perform validation and database insertion
// You can add your code here to validate the form inputs and insert the data into the database

// Create a new record in the "users" table
$sql = "INSERT INTO users (username, password, email, firstname, lastname, birthday, secret_question, secret_answer)
VALUES ('$username', '$password', '$email', '$firstname', '$lastname', '$birthday', '$secret_question', '$secret_answer')";

if ($connection->query($sql) === TRUE) {
  $_SESSION['success_message'] = "User created successfully";
} else {
echo "Error: " . $sql . "<br>" . $connection->error;
}

// Example: Display the submitted data
echo "<h1>Submitted Data</h1>";
echo "<p>Username: " . $username . "</p>";
echo "<p>Password: " . $password . "</p>";
echo "<p>Email: " . $email . "</p>";
echo "<p>First Name: " . $firstname . "</p>";
echo "<p>Last Name: " . $lastname . "</p>";
echo "<p>Birthday: " . $birthday . "</p>";
echo "<p>Secret Question: " . $secret_question . "</p>";
echo "<p>Secret Answer: " . $secret_answer . "</p>";

  // TODO: Perform validation and database insertion
  // You can add your code here to validate the form inputs and insert the data into the database
  
  // Example: Display the submitted data
  header("Location: index-admin.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
</head>
<body>
  <h1>Account Information</h1>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    
    <h1>Personal Information</h1>
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" required><br><br>
    
    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" required><br><br>
    
    <label for="birthday">Birthday:</label>
    <input type="date" id="birthday" name="birthday" required><br><br>
    
    <label for="secret_question">Secret Question:</label>
    <select id="secret_question" name="secret_question" required>
      <option value="">Select a secret question</option>
      <option value="mother_maiden_name">What is your mother's maiden name?</option>
      <option value="secret_name">What is your secret name?</option>
    </select><br><br>
    
    <label for="secret_answer">Secret Answer:</label>
    <input type="text" id="secret_answer" name="secret_answer" required><br><br>
    <input type="submit" name="submit" value="CREATE ACCOUNT">
  </form>
</body>
</html>
