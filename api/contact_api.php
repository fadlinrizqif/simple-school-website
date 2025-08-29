<?php
header("Content-Type: application/json");

// Koneksi ke database
$host = "localhost"; 
$user = "root";      // sesuaikan
$pass = "";          // sesuaikan
$db   = "school_contact";   // nama database kamu

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    echo json_encode([
        "status" => "error",
        "message" => "Koneksi gagal: " . $conn->connect_error
    ]);
    exit;
}

// Ambil data dari POST
$nama  = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$pesan = $_POST['pesan'] ?? '';

// Validasi sederhana
if (empty($nama) || empty($email) || empty($pesan)) {
    echo json_encode([
        "status" => "error",
        "message" => "Semua field wajib diisi!"
    ]);
    exit;
}

// Gunakan prepared statement agar lebih aman
$stmt = $conn->prepare("INSERT INTO kontak (nama, email, pesan) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama, $email, $pesan);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Data berhasil disimpan",
        "data" => [
            "nama" => $nama,
            "email" => $email,
            "pesan" => $pesan
        ]
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal menyimpan data: " . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
