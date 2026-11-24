<?php
require_once "koneksi.php";

$sql = "SELECT * FROM mahasiswa";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
</head>

<body>
   <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nim']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td><?php echo htmlspecialchars($row['prodi']); ?></td>
                    <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>