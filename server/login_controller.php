<?php
// Bangun koneksi ke database
include 'config.php';
session_start();

// Tampung isi dari form
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) && !empty($password)) {
  // Bandingkan email di database
  $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $query = mysqli_query($sambung, $sql);

  // Cek pada baris database
  $result = mysqli_num_rows($query);

  // Cek apakah email ada di database
  if ($result > 0) {
    $user = mysqli_fetch_assoc($query);

    // Cek password
    if ($password === $user["password"]) {
      $_SESSION["id"] = $user["id"];
      $_SESSION["username"] = $user["username"];
      $_SESSION["level"] = $user["level"];
      $_SESSION["status"] = "login";
      var_dump($user);

      if ($_SESSION["level"] === "admin") {
        header("location:../views/home_admin.php");
      } else if ($_SESSION["level"] === "dosen") {
        header("location:../views/home_dosen.php");
      } else {
        header("location: ../views/home.php");
      }
      exit;
    } else {
      $_SESSION["error"] = "Incorrect password";
      header("location:../views/login.php");
    }
  } else {
    $_SESSION["error"] = "Account doesn't exist";
    header("location:../views/login.php");
  }
}
