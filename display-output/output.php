<?php
// output.php
$servername = "localhost"; // atau nama server Anda
$username = "username"; // username database Anda
$password = ""; // password database Anda
$dbname = "your_db"; // nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
