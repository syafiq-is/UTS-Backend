<?php
include 'config.php';
session_start();

if (isset($_POST['user_id'])) {
  $user_id = intval($_POST['user_id']);
  $nilai_t1 = intval($_POST['nilai_t1']);
  $nilai_t2 = intval($_POST['nilai_t2']);
  $nilai_t3 = intval($_POST['nilai_t3']);
  $nilai_t4 = intval($_POST['nilai_t4']);
  $nilai_t5 = intval($_POST['nilai_t5']);
  $nilai_t6 = intval($_POST['nilai_t6']);
  $nilai_t7 = intval($_POST['nilai_t7']);
  $nilai_t8 = intval($_POST['nilai_t8']);
  $nilai_t9 = intval($_POST['nilai_t9']);
  $nilai_t10 = intval($_POST['nilai_t10']);
  $nilai_uts = intval($_POST['nilai_uts']);
  $nilai_uas = intval($_POST['nilai_uas']);

  // Prepare and execute the update query
  // Prepare and execute the update query
  $sql = "UPDATE users SET 
            nilai_t1 = ?, nilai_t2 = ?, nilai_t3 = ?, nilai_t4 = ?, nilai_t5 = ?, 
            nilai_t6 = ?, nilai_t7 = ?, nilai_t8 = ?, nilai_t9 = ?, nilai_t10 = ?, 
            nilai_uts = ?, nilai_uas = ? 
        WHERE id = ?";
  $stmt = $sambung->prepare($sql);
  $stmt->bind_param(
    "iiiiiiiiiiiii",
    $nilai_t1,
    $nilai_t2,
    $nilai_t3,
    $nilai_t4,
    $nilai_t5,
    $nilai_t6,
    $nilai_t7,
    $nilai_t8,
    $nilai_t9,
    $nilai_t10,
    $nilai_uts,
    $nilai_uas,
    $user_id
  );


  if ($stmt->execute()) {
    header("location: ../views/home.php");
    exit;
  } else {
    echo "Error updating user: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Some value are not provided." .
    $nilai_t1 .
    $nilai_t2 .
    $nilai_t3 .
    $nilai_t4 .
    $nilai_t5 .
    $nilai_t6 .
    $nilai_t7 .
    $nilai_t8 .
    $nilai_t9 .
    $nilai_t10 .
    $nilai_uts .
    $nilai_uas .
    $user_id;
}

$sambung->close();
