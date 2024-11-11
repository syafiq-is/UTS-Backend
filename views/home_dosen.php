<?php
include "../server/config.php";
session_start();

if ($_SESSION["level"] === "admin") {
  header("location: home_admin.php");
} else if ($_SESSION["level"] === "mahasiswa") {
  header("location: home.php");
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
  <title>Dashboard Dosen</title>
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
    <div class="h3 fw-bold">Dashboard Dosen</div>
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

    <h3 class="mb-4">Detail Dosen</h3>
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

    <h3 class="mb-4">Daftar Mahasiswa</h3>
    <!-- TABLE -->
    <div class="overflow-x-auto w-100">
      <table class="mb-5">
        <tr>
          <th rowspan="2">Nama</th>
          <th colspan="10">Nilai Tugas</th>
          <th rowspan="2">Nilai UTS</th>
          <th rowspan="2">Nilai UAS</th>
          <th rowspan="2">IPK</th>
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
        $query = mysqli_query($sambung, "SELECT * FROM users WHERE level = 'mahasiswa'");

        while ($user = mysqli_fetch_assoc($query)) {
          echo '
          <tr>
            <td>' . htmlspecialchars($user['username']) . '</td>
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
            <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateNilai' . htmlspecialchars($user['id']) . '">
              Update Nilai
            </button>
            </td>
          </tr>
          

          <!-- Modal -->
          
            <form action="../server/user_update_nilai.php" method="POST" id="form_hapus_nilai' . htmlspecialchars($user['id']) . '">
              <input type="hidden" name="user_id" value="' . htmlspecialchars($user['id']) . '" >
              <input type="hidden" name="nilai_t1" value="0" >
              <input type="hidden" name="nilai_t2" value="0" >
              <input type="hidden" name="nilai_t3" value="0" >
              <input type="hidden" name="nilai_t4" value="0" >
              <input type="hidden" name="nilai_t5" value="0" >
              <input type="hidden" name="nilai_t6" value="0" >
              <input type="hidden" name="nilai_t7" value="0" >
              <input type="hidden" name="nilai_t8" value="0" >
              <input type="hidden" name="nilai_t9" value="0" >
              <input type="hidden" name="nilai_t10" value="0" >
              <input type="hidden" name="nilai_uts" value="0" >
              <input type="hidden" name="nilai_uas" value="0" >
            </form>
            <div class="modal fade" id="updateNilai' . htmlspecialchars($user['id']) . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateNilai' . htmlspecialchars($user['id']) . 'Label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateNilai' . htmlspecialchars($user['id']) . 'Label">Update Nilai: ' . htmlspecialchars($user['username'])  . '</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="../server/user_update_nilai.php" method="POST" id="form_update_nilai' . htmlspecialchars($user['id']) . '">
                      <input type="hidden" name="user_id" value="' . htmlspecialchars($user['id']) . '" >
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 1</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t1" value="' . htmlspecialchars($user['nilai_t1']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 2</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t2" value="' . htmlspecialchars($user['nilai_t2']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 3</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t3" value="' . htmlspecialchars($user['nilai_t3']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 4</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t4" value="' . htmlspecialchars($user['nilai_t4']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 5</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t5" value="' . htmlspecialchars($user['nilai_t5']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 6</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t6" value="' . htmlspecialchars($user['nilai_t6']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 7</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t7" value="' . htmlspecialchars($user['nilai_t7']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 8</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t8" value="' . htmlspecialchars($user['nilai_t8']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 9</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t9" value="' . htmlspecialchars($user['nilai_t9']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">Tugas 10</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_t10" value="' . htmlspecialchars($user['nilai_t10']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">UTS</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_uts" value="' . htmlspecialchars($user['nilai_uts']) . '" >
                      </div>
                      <div class="d-flex align-items-center mb-2">
                        <span style="width: 150px;">UAS</span>
                        <input type="number" min="0" max="100" class="form-control w-100" name="nilai_uas" value="' . htmlspecialchars($user['nilai_uas']) . '" >
                      </div>
                    </form>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" onclick="submitForm(\'form_update_nilai' . htmlspecialchars($user['id']) . '\')" class="btn btn-primary">Update</button>
                    <button type="button" onclick="submitForm(\'form_hapus_nilai' . htmlspecialchars($user['id']) . '\')" class="btn btn-danger">Hapus Semua Nilai</button>
                  </div>
                </div>
              </div>
            </div>
          ';
        }
        ?>
      </table>
      <!-- END TABLE -->

      <script>
        function submitForm(formID) {
          const form = document.getElementById(formID);
          form.submit();
        }
      </script>
    </div>
  </div>
</body>

</html>