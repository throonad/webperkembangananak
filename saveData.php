<?php

$host = "localhost";
$user = "tumx1921_Admin1921_x";
$pass = "abwtfj6wHfpN54";
$dbname = "tumx1921_perkembangan_anak";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  echo json_encode(['status' => 'error', 'message' => 'Koneksi gagal']);
  exit;
}

// Ambil data JSON dari request
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['namaAnak'])) {
  echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
  exit;
}

$namaAnak = $conn->real_escape_string($data['namaAnak']);
$nama_orangtua = $conn->real_escape_string($data['nama_orangtua']);
$tanggalLahir = $conn->real_escape_string($data['tanggalLahir']);
$result = $conn->real_escape_string($data['status']); // NORMAL / TIDAK NORMAL

$sql = "INSERT INTO perkembangan_anak (nama_anak, nama_orangtua, tanggal_lahir, hasil) 
        VALUES ('$namaAnak', '$nama_orangtua', '$tanggalLahir', '$result')";

if ($conn->query($sql) === TRUE) {
  echo json_encode(['status' => 'success']);
} else {
  echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$conn->close();