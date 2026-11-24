
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Mahasiswa</title>
</head>
<body>

    <h2>Form Pendaftaran Mahasiswa</h2>

    <form action="proses.php" method="POST">
        <label>NIM:</label>
        <br><input type="text" name="nim" required maxlength="20">
        <br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" required>
        <br><br>

        <label>Program Studi:</label><br>
        <select name="prodi" required>
            <option value="">-- Pilih Prodi --</option>
            <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
            <option value="D3 Teknik Mesin">D3 Teknik Mesin</option>
        </select>
        <br><br>

        <label>Jenis Kelamin:</label><br>
        <input type="radio" name="jenis_kelamin" value="Laki-laki" required>
        Laki-laki
        <input type="radio" name="jenis_kelamin" value="Perempuan">
        Perempuan
        <br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required></textarea>
        <br><br>

        <button type="submit">Simpan Data</button>
    </form>

</body>
</html>
