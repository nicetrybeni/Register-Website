<?php
include "config.php";

// Check if a success message exists in the session
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
  }

// Fetch all records from the "users" table
$sql = "SELECT * FROM users";
$result = mysqli_query($connection, $sql);

if (!$result) {
  die("Error: " . $sql . "<br>" . mysqli_error($connection));
}

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="style-admin.css"> 
</head>
<body>
  <h1>Admin Panel</h1>
  <?php if (isset($success_message)): ?>
    <p style="color: green;"><?php echo $success_message; ?></p>
  <?php endif; ?>
  <a href="create.php">Create User</a>
  <table>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Birthday</th>
      <th>Secret Question</th>
      <th>Secret Answer</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
      <td><?php echo $user['id']; ?></td>
      <td><?php echo $user['username']; ?></td>
      <td><?php echo $user['email']; ?></td>
      <td><?php echo $user['firstname']; ?></td>
      <td><?php echo $user['lastname']; ?></td>
      <td><?php echo $user['birthday']; ?></td>
      <td><?php echo $user['secret_question']; ?></td>
      <td><?php echo $user['secret_answer']; ?></td>
      <td>
        <a href="update.php?id=<?php echo $user['id']; ?>">Update</a>
        <form style="display: inline-block;" method="POST" action="delete.php">
          <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
          <button type="submit" name="delete" value="<?php echo $user['id']; ?>">DELETE</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
