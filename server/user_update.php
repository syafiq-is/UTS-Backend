<?php
include 'config.php';
session_start();

if (isset($_POST['user_id'], $_POST['username'], $_POST['email'], $_POST['password'])) {
  $user_id = intval($_POST['user_id']); // Convert to integer for safety
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare and execute the update query
  $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
  $stmt = $sambung->prepare($sql);
  $stmt->bind_param("sssi", $username, $email, $password, $user_id);

  if ($stmt->execute()) {
    // $_SESSION["username"] = $username;
    header("location:../views/home.php");
    exit;
  } else {
    echo "Error updating user: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "User ID, username, or email not provided.";
}

$sambung->close();
