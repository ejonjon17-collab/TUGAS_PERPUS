<?php
require_once __DIR__ . "/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Akses tidak diizinkan.");
}

$label_field = [
    "no_anggota" => "Nomor anggota",
    "nama_lengkap" => "Nama lengkap",
    "email" => "Email",
    "no_hp" => "Nomor telepon",
    "jenis_anggota" => "Jenis anggota",
    "alamat" => "Alamat",
];
$data = [];

foreach ($label_field as $field => $label) {
    if (!isset($_POST[$field]) || !is_string($_POST[$field])) {
        http_response_code(400);
        exit(htmlspecialchars($label . " wajib diisi.", ENT_QUOTES, "UTF-8"));
    }

    $data[$field] = trim($_POST[$field]);
    if ($data[$field] === "") {
        http_response_code(400);
        exit(htmlspecialchars($label . " wajib diisi.", ENT_QUOTES, "UTF-8"));
    }
}

if (filter_var($data["email"], FILTER_VALIDATE_EMAIL) === false) {
    http_response_code(400);
    exit("Format email tidak valid.");
}

$jenis_anggota_valid = [
    "Mahasiswa",
    "Dosen",
    "Tenaga Kependidikan",
];
if (!in_array($data["jenis_anggota"], $jenis_anggota_valid, true)) {
    http_response_code(400);
    exit("Jenis anggota tidak valid.");
}

$query = "INSERT INTO anggota
          (no_anggota, nama_lengkap, email, no_hp, jenis_anggota, alamat)
          VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $query);

if (!$stmt) {
    http_response_code(500);
    exit("Query gagal disiapkan: " . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, "UTF-8"));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssss",
    $data["no_anggota"],
    $data["nama_lengkap"],
    $data["email"],
    $data["no_hp"],
    $data["jenis_anggota"],
    $data["alamat"]
);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
    header("Location: form_anggota.php?status=success");
    exit;
}

$error = mysqli_stmt_error($stmt);
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
http_response_code(500);
exit("Gagal menyimpan data anggota: " . htmlspecialchars($error, ENT_QUOTES, "UTF-8"));

?>