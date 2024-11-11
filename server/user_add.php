<?php
include 'config.php';
session_start();

// Tampung isi dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$level = ($_POST['level'] == "dosen") ? "dosen" : "mahasiswa";

// Check kesamaan password dengan confirm password
if ($password !== $confirm) {
  header('location: ../views/home_admin.php');
  exit;
}

// Encrypt password
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
  $sql = "INSERT INTO users (username, email, password, level) VALUES ('$username', '$email', '$password', '$level')";
  $query = mysqli_query($sambung, $sql);

  // Jika variable tidak kosong
  if ($query) {
    header('location: ../views/login.php');
    exit;
  } else {
    $_SESSION["error"] = "Buat akun gagal";
    header('location: ../views/login.php');
    exit;
  }
} catch (mysqli_sql_exception $e) {
  // Handle error duplicate email entry
  if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
    $_SESSION["error"] = "Email sudah terpakai";
    header('location: ../views/home_admin.php');
    exit;
  } else {
    echo $e;
    exit;
  }
}
