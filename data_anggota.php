<?php
require_once __DIR__ . "/koneksi.php";

$sql = "SELECT * FROM anggota ORDER BY nama_lengkap ASC";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Gagal mengambil data: " . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, "UTF-8"));
}

$jumlah_data = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header-bar">
            <div>
                <h1>Data Anggota Perpustakaan</h1>
                <p class="subtitle">Daftar anggota yang sudah terdaftar</p>
            </div>
            <a href="form_anggota.php" class="btn-tambah">+ Tambah Anggota</a>
        </div>

        <div class="info-box">
            Jumlah Data: <strong><?php echo $jumlah_data; ?></strong>
        </div>

        <?php if ($jumlah_data === 0) { ?>
            <p class="kosong">Belum ada data anggota.</p>
        <?php } else { ?>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Anggota</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Jenis Anggota</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($baris = mysqli_fetch_assoc($result)) {
                        $jenis = $baris["jenis_anggota"];
                        $badge_class = "badge-mhs";
                        if ($jenis === "Dosen") {
                            $badge_class = "badge-dosen";
                        } elseif ($jenis === "Tenaga Kependidikan") {
                            $badge_class = "badge-tendik";
                        }
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($baris["no_anggota"], ENT_QUOTES, "UTF-8"); ?></td>
                        <td><?php echo htmlspecialchars($baris["nama_lengkap"], ENT_QUOTES, "UTF-8"); ?></td>
                        <td><?php echo htmlspecialchars($baris["email"], ENT_QUOTES, "UTF-8"); ?></td>
                        <td><?php echo htmlspecialchars($baris["no_hp"], ENT_QUOTES, "UTF-8"); ?></td>
                        <td>
                            <span class="badge <?php echo $badge_class; ?>">
                                <?php echo htmlspecialchars($jenis, ENT_QUOTES, "UTF-8"); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($baris["alamat"], ENT_QUOTES, "UTF-8"); ?></td>
                        <td>
                            <form action="hapus_anggota.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo($baris["no_anggota"]); ?>">
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</body>
</html>
<?php
mysqli_close($koneksi);
?>