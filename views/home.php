<?php
include "../server/config.php";
session_start();

if ($_SESSION["level"] === "admin") {
  header("location: home_admin.php");
} else if ($_SESSION["level"] === "dosen") {
  header("location: home_dosen.php");
}

if (!isset($_SESSION["status"]) && $_SESSION["status"] !== "login") {
  header("Location: login.php");
  exit();
}

if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Mahasiswa</title>
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
      background-image: url(./img/image.jpg);
      background-position: center;
      background-size: cover;
    }

    table {
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: lightcoral;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center shadow w-100 px-5 bg-white position-sticky top-0">
    <div class="h3 fw-bold">Dashboard Mahasiswa</div>
    <form method="POST">
      <button type="submit" name="logout" class="my-3 btn btn-danger">Logout</button>
    </form>
  </div>
  <!-- END HEADER -->

  <div class="container py-4 px-5 mt-5 rounded bg-white">
    <h2 class="mt-4 mb-5 fw-bold">Selamat datang
      <?php
      if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        echo "$username";
      } else {
        echo "User";
      }
      ?>
    </h2>

    <h3 class="mb-4">Detail Mahasiswa</h3>
    <div class="d-flex mb-5">
      <div style="width: 150px; font-weight: bold;">
        <p>Nama</p>
        <p>Email</p>
        <p>Password</p>
      </div>
      <div>
        <?php
        $query = mysqli_query($sambung, "SELECT username, email, password FROM users WHERE id =" . $_SESSION['id']);
        $user = mysqli_fetch_assoc($query);
        echo '
            <p>: ' . htmlspecialchars($user['username']) . '</p>
            <p>: ' . htmlspecialchars($user['email']) . '</p>
            <p>: ' . htmlspecialchars($user['password']) . '</p>
        ';
        ?>
      </div>
    </div>

    <h3 class="mb-4">Nilai Anda</h3>
    <!-- TABLE -->
    <table class="mb-5">
      <th colspan="10">Nilai Tugas</th>
      <th rowspan="2">Nilai UTS</th>
      <th rowspan="2">Nilai UAS</th>
      <th rowspan="2">IPK</th>
      </th>
      <tr>
        <th>T1</th>
        <th>T2</th>
        <th>T3</th>
        <th>T4</th>
        <th>T5</th>
        <th>T6</th>
        <th>T7</th>
        <th>T8</th>
        <th>T9</th>
        <th>T10</th>
      </tr>
      <?php
      $query = mysqli_query($sambung, "SELECT * FROM users WHERE id =" . $_SESSION['id']);
      $user = mysqli_fetch_assoc($query);

      echo '
        <tr>
          <td>' . htmlspecialchars($user['nilai_t1']) . '</td>
          <td>' . htmlspecialchars($user['nilai_t2']) . '</td>
          <td>' . htmlspecialchars($user['nilai_t3']) . '</td>
          <td>' . htmlspecialchars($user['nilai_t4']) . '</td>
          <td>' . htmlspecialchars($user['nilai_t5']) . '</td>
          <td>' . htmlspecialchars($user['nilai_t6']) . '</td>
          <td>' . htmlspecialchars($user['nilai_t7']) . '</td>
          <td>' . htmlspecialchars($user['nilai_t8']) . '</td>
          <td>' . htmlspecialchars($user['nilai_t9']) . '</td>
          <td>' . htmlspecialchars($user['nilai_t10']) . '</td>
          <td>' . htmlspecialchars($user['nilai_uts']) . '</td>
          <td>' . htmlspecialchars($user['nilai_uas']) . '</td>
          <td>' . htmlspecialchars($user['ipk']) . '</td>
        </tr>';
      ?>
    </table>
    <!-- END TABLE -->
  </div>



  </div>
</body>

</html>