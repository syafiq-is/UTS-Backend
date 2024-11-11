<?php
include "config.php";

if (isset($_POST['user_id'])) {
  $user_id = intval($_POST['user_id']);

  // Prepare and execute the delete query with error handling
  $sql = "DELETE FROM users WHERE id = ?";
  $stmt = $sambung->prepare($sql);
  $stmt->bind_param("i", $user_id);

  if ($stmt->execute()) {
    // Success, proceed to redirect
    header("Location: ../views/home.php");
    exit;
  } else {
    // Display error message
    echo "Error deleting user: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "User ID not provided.";
}

$sambung->close();
