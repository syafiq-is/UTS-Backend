<?php
include "../server/config.php";
session_start();

if ($_SESSION["level"] === "mahasiswa") {
  header("location: home.php");
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
  <title>Dashboard Admin</title>
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
  <div class="d-flex justify-content-between align-items-center shadow w-100 px-5 bg-white position-sticky top-0 position-sticky top-0">
    <div class="h3 fw-bold">Dashboard Admin</div>
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

    <h3 class="my-4">Tambah User</h3>
    <!-- FORM TAMBAH DOSEN -->
    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#modalTambahDosen">
      Tambah Dosen
    </button>
    <!-- Modal -->
    <form action="../server/user_add.php" method="POST" class="" style="max-width: 400px;">
      <div class="modal fade" id="modalTambahDosen" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalTambahDosenLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalTambahDosenLabel">Tambah Dosen</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="level" value='dosen'>
              <input type="text" placeholder="Nama" class="form-control mb-2" name="username" value=''>
              <input type="email" placeholder="Email" class="form-control mb-2" name="email" value=''>
              <input type="text" placeholder="Password" class="form-control mb-2" name="password" value=''>
              <input type="text" placeholder="Confirm Password" class="form-control mb-2" name="confirm" value=''>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </div>
        </div>
      </div>
      <div>
      </div>
    </form>
    <!-- END FORM TAMBAH DOSEN -->

    <!-- FORM TAMBAH MAHASISWA -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMahasiswa">
      Tambah Mahasiswa
    </button>
    <!-- Modal -->
    <form action="../server/user_add.php" method="POST" class="" style="max-width: 400px;">
      <div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalTambahMahasiswaLabel">Tambah Mahasiswa</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text" placeholder="Nama" class="form-control mb-2" name="username" value=''>
              <input type="email" placeholder="Email" class="form-control mb-2" name="email" value=''>
              <input type="text" placeholder="Password" class="form-control mb-2" name="password" value=''>
              <input type="text" placeholder="Confirm Password" class="form-control mb-2" name="confirm" value=''>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </div>
        </div>
      </div>
      <div>
      </div>
    </form>
    <!-- END FORM TAMBAH MAHASISWA -->


    <h3 class="my-4">Daftar Semua Akun</h3>
    <!-- TABLE -->
    <div class="overflow-x-auto w-100">
      <table class="mb-5 over">
        <tr>
          <th rowspan="2">ID</th>
          <th rowspan="2">Nama</th>
          <th rowspan="2">Email</th>
          <th rowspan="2">Password</th>
          <th rowspan="2">Level</th>
          <th colspan="10">Nilai Tugas</th>
          <th rowspan="2">Nilai UTS</th>
          <th rowspan="2">Nilai UAS</th>
          <th rowspan="2">Action</th>
        </tr>
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

        // Get all users in database
        $query = mysqli_query($sambung, "SELECT * FROM users");

        while ($user = mysqli_fetch_assoc($query)) {
          echo '
          <tr>
            <td>' . htmlspecialchars($user['id']) . '</td>
            <td>' . htmlspecialchars($user['username']) . '</td>
            <td>' . htmlspecialchars($user['email']) . '</td>
            <td>' . htmlspecialchars($user['password']) . '</td>
            <td>' . htmlspecialchars($user['level']) . '</td>
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

            <td>
          ';

          if ($user["level"] !== "admin") {
            echo '
              <form action="../server/user_delete.php" method="POST">
                <input type="hidden" name="user_id" value="' . htmlspecialchars($user['id']) . '">
                <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
            ';
          }

          echo '</td></tr>';
        }
        ?>
      </table>
    </div>
    <!-- END TABLE -->
  </div>
</body>

</html>