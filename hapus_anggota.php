<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["id"])) {
    header("Location: data_anggota.php");
    exit;
}

require_once __DIR__ . "/koneksi.php";

$id = $_POST["id"];

$sql = "DELETE FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: data_anggota.php");
}

mysqli_close($koneksi);

exit;