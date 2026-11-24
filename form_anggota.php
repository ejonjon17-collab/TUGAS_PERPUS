
<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Anggota</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="form-container">
        <div class="form-header">
            <h1>Form Pendaftaran Anggota Perpustakaan</h1>
            <p class="subtitle">Lengkapi data berikut untuk mendaftar sebagai anggota.</p>
        </div>

        <?php if ($status === 'success') { ?>
            <p class="sukses">Data berhasil disimpan ke database.</p>
        <?php } ?>

        <form class="form-anggota" action="proses_anggota.php" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label for="no_anggota">Nomor Anggota</label>
                    <input type="text" name="no_anggota" id="no_anggota" required>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" required>
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor Telepon Seluler</label>
                    <input type="tel" name="no_hp" id="no_hp" required>
                </div>

                <div class="form-group">
                    <label for="jenis_anggota">Jenis Anggota</label>
                    <select name="jenis_anggota" id="jenis_anggota" required>
                        <option value="">-- Pilih Jenis Anggota --</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Dosen">Dosen</option>
                        <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                    </select>
                </div>

                <div class="form-group form-group-full">
                    <label for="alamat">Alamat Anggota</label>
                    <textarea name="alamat" id="alamat" rows="4" required></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn-primary" type="submit">Daftar Anggota</button>
                <a class="btn-secondary" href="data_anggota.php">Kembali ke Data Anggota</a>
            </div>
        </form>
    </main>
</body>
</html>
