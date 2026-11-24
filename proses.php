
<?php
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nim = trim($_POST["nim"] ?? "");
    $nama = trim($_POST["nama"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $jenis_kelamin = trim($_POST["jenis_kelamin"] ?? "");
    $alamat = trim($_POST["alamat"] ?? "");

    // Validasi data
    if (
        empty($nim) ||
        empty($nama) ||
        empty($prodi) ||
        empty($jenis_kelamin) ||
        empty($alamat)
    ) {
        die("Semua data wajib diisi!");
    }

    if (!ctype_digit($nim) || strlen($nim) > 20) {
        die("NIM harus berupa angka dan maksimal 20 digit!");
    }

    if (!in_array($prodi, [
        "D3 Teknik Informatika",
        "D3 Teknik Mesin"
    ])) {
        die("Program studi tidak valid!");
    }

    if (!in_array($jenis_kelamin, [
        "Laki-laki",
        "Perempuan"
    ])) {
        die("Jenis kelamin tidak valid!");
    }

    // Menyimpan data menggunakan prepared statement
    $query = "INSERT INTO mahasiswa
              (nim, nama, prodi, jenis_kelamin, alamat)
              VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $query);

    if (!$stmt) {
        die("Query gagal disiapkan: " . mysqli_error($koneksi));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $nim,
        $nama,
        $prodi,
        $jenis_kelamin,
        $alamat
    );

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: form.php?status=sukses");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Akses tidak diizinkan!";
}
?>
