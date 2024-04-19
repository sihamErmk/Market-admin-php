<?php
$conn = mysqli_connect('localhost', 'root', '', 'assoc');
$produit = $_GET['updateid'];
$sql = "SELECT * FROM users WHERE user_id=$user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_name = $row['user_name'];
$user_email = $row['user_email'];
$user_password = $row['user_password'];
$user_type = $row['user_type'];

if (isset($_POST['submit'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    // Hash the password using a secure hashing algorithm
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type'];
    $update = "UPDATE users SET user_name='$user_name', user_email='$user_email', user_type='$user_type', user_password='$pass' WHERE user_id=$user_id";
    $done = mysqli_query($conn, $update);
    if ($done) {
        echo "Updated successfully";
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update user</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="bc">
    <div class="form-container">
        <form action="" method="post">
            <h3>Update user</h3>
            <input type="text" name="user_name" required value="<?php echo $user_name ?>">
            <input type="email" name="user_email" value="<?php echo $user_email ?>" required>
            <input type="password" name="password" placeholder="New Password" required>
            <input type="password" name="cpassword" placeholder="Confirm New Password" required>
            <select name="user_type">
                <option value="User" <?php if ($user_type == 'User') echo 'selected'; ?>>User</option>
                <option value="Admin" <?php if ($user_type == 'Admin') echo 'selected'; ?>>Admin</option>
            </select>
            <input type="submit" name="submit" value="Update" class="form-btn">
        </form>
    </div>
</div>

</body>
</html>

