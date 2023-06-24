<?php
include "config.php";
session_start();

if(isset($_SESSION['success_message'])) {
    $sucess_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

$sql = "SELECT * FROM users";
$result = mysqli_query($connection, $sql);

if(!$result) {
    die("Error : " . $slq . "<br>" . mysqli_error($connection));
}

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ADMIN</title>
        <link rel="stylesheet" href="style-admin.css">
    </head>
<body>
    <h1>Admin Panel</h1>
    <?php if(isset($sucess_message)) : ?>
        <p style="color: green;"><?php echo $sucess_message; ?></p>
    <?php endif; ?>
    <a href="recapcreate.php">Create Users</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
                <a href ="update.php?id=<?php echo $user['id']; ?>">Update</a>
                    <form style="display: inline-block;" method="POST" action="delete.php">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete" value="<?php echo $user['id']; ?>">Delete</button>
                    </form>
            </td>
        </tr>
            <?php endforeach; ?>
        </table>
</body>
</html>  
