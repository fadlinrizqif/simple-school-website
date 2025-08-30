<?php
//header("Content-Type: application/json");

// Koneksi ke database
$host = "localhost"; 
$user = "root";      
$pass = "";          
$db   = "school_contact";   

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

// Validasi form apabila ada yang tidak diisi akan ada error
if (empty($nama) || empty($email) || empty($pesan)) {
   // echo json_encode([ 
     //   "status" => "error",
       // "message" => "Semua field wajib diisi!"
  //]);
  echo "<div style='
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
        background:#f0f0f0;
    '>
        <div style='
            padding:20px 30px;
            border-radius:10px;
            box-shadow:0 4px 10px rgba(0,0,0,0.2);
            background-color:#f44336;
            color:white;
            text-align:center;
            font-size:18px;
            max-width:400px;
        '>
            Semua field wajib diisi!<br><br>
            <a href='../pages/contact.html' style='color:white; text-decoration:underline;'>Kembali ke form</a>
        </div>
    </div>";
    exit;
}

// Gunakan prepared statement agar lebih aman
$stmt = $conn->prepare("INSERT INTO kontak (nama, email, pesan) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama, $email, $pesan);

if ($stmt->execute()) {
    echo "<div style='
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    background:#f0f0f0;
'>
    <div style='
        padding:20px 30px;
        border-radius:10px;
        box-shadow:0 4px 10px rgba(0,0,0,0.2);
        background-color:#4CAF50;
        color:white;
        text-align:center;
        font-size:18px;
        max-width:400px;
    '>
        Data berhasil dikirim!<br><br>
        <a href='../pages/contact.html' style='color:white; text-decoration:underline;'>Kembali ke form</a>
    </div>
</div>";
} else {
    "<div style='
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
        background:#f0f0f0;
    '>
        <div style='
            padding:20px 30px;
            border-radius:10px;
            box-shadow:0 4px 10px rgba(0,0,0,0.2);
            background-color:#f44336;
            color:white;
            text-align:center;
            font-size:18px;
            max-width:400px;
        '>
            Semua field wajib diisi!<br><br>
            <a href='contact.html' style='color:white; text-decoration:underline;'>Gagal Menyimpan</a>
        </div>
    </div>";
}

$stmt->close();
$conn->close();
