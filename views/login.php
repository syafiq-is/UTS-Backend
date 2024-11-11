<?php
session_start();

if (isset($_SESSION["status"]) && $_SESSION["status"] === "login") {
  if ($_SESSION["level"] === "admin") {
    header("location:./home_admin.php");
  } else if ($_SESSION["level"] === "dosen") {
    header("location:./home_dosen.php");
  } else if ($_SESSION["level"] === "mahasiswa") {
    header("location:./home.php");
  } else {
    header("location:./home.php");
  }
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link rel="shortcut icon" href="img/Tab_icon.svg" type="image/x-icon">
  <!-- Bootstrap Script -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      background-image: url(./img/image.jpg);
      background-position: center;
      background-size: cover;
    }

    #card {
      margin: 60px;
      padding: 30px 40px;
      background-color: white;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      min-width: 600px;
    }
  </style>
</head>

<body>
  <div id="card">
    <h2 class="my-4 mb-5 fw-bold text-center">Login to Your Account</h2>
    <form action="../server/login_controller.php" method="POST">
      <div class="mb-3">
        <label for="InputEmail">Email:</label>
        <input type="email" class="form-control" id="InputEmail" name="email" required>
      </div>
      <div class="mb-3">
        <label for="InputPassword">Password:</label>
        <input type="password" class="form-control" id="InputPassword" name="password" required>
      </div>
      <button type="submit" class="my-3 btn btn-danger form-control">Login</button>
    </form>
    <?php
    if (isset($_SESSION['error'])) {
      $errorMessage = $_SESSION['error'];
      echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    }
    ?>
  </div>
</body>

</html>