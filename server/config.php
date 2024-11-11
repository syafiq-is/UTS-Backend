<?php

/*

CREATE DATABASE uts_backend;
USE uts_backend;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    level VARCHAR(10) NOT NULL DEFAULT "mahasiswa" CHECK(level IN ("admin", "mahasiswa", "dosen")),
    nilai_t1 INT DEFAULT 0,
    nilai_t2 INT DEFAULT 0,
    nilai_t3 INT DEFAULT 0,
    nilai_t4 INT DEFAULT 0,
    nilai_t5 INT DEFAULT 0,
    nilai_t6 INT DEFAULT 0,
    nilai_t7 INT DEFAULT 0,
    nilai_t8 INT DEFAULT 0,
    nilai_t9 INT DEFAULT 0,
    nilai_t10 INT DEFAULT 0,
    nilai_uts INT DEFAULT 0,
    nilai_uas INT DEFAULT 0,
    ipk DECIMAL(3,1) AS (ROUND(((nilai_t1+nilai_t2+nilai_t3+nilai_t4+nilai_t5+nilai_t6+nilai_t7+nilai_t8+nilai_t9+nilai_t10)/500) + ((nilai_uts+nilai_uas)/100),1))
);

INSERT INTO users (username, email, password, level) VALUES ('ADMIN', 'admin@email.com', '123', 'admin');
INSERT INTO users (username, email, password, level) VALUES ('Pak Dosen', 'dosen@email.com', '123', 'dosen');
INSERT INTO users (username, email, password, level) VALUES ('Syafiq', 'syafiq@email.com', '123', 'mahasiswa');

INSERT INTO users (username, email, password, level, nilai_t1, nilai_t2, nilai_t3, nilai_t4, nilai_t5, nilai_t6, nilai_t7, nilai_t8, nilai_t9, nilai_t10, nilai_uts, nilai_uas)
VALUES
('Kim Dokja', 'kim.dj@email.com', '123', 'mahasiswa', 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100),
('mhs1', 'mhs1@example.com', 'password1', 'mahasiswa', 85, 90, 88, 75, 92, 83, 80, 95, 87, 90, 88, 90),
('mhs2', 'mhs2@example.com', 'password2', 'mahasiswa', 70, 75, 78, 65, 72, 73, 76, 70, 69, 71, 74, 75),
('mhs3', 'mhs3@example.com', 'password3', 'mahasiswa', 60, 65, 66, 55, 62, 63, 61, 60, 59, 68, 64, 67),
('mhs4', 'mhs4@example.com', 'password4', 'mahasiswa', 85, 90, 88, 75, 92, 83, 80, 95, 87, 90, 88, 90),
('mhs5', 'mhs5@example.com', 'password5', 'mahasiswa', 95, 96, 97, 95, 94, 93, 92, 90, 91, 89, 94, 95)

*/

// server yang digunakan
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "uts_backend";

$sambung = mysqli_connect($server, $user, $password, $nama_database);
if (!$sambung) {
  die("Ada masalah koneksi ke database: " . mysqli_connect_error());
}
