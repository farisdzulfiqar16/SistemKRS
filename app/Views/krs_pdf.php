<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Rencana Studi (KRS)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1, h2 { text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .table, .table th, .table td { border: 1px solid black; }
        .table th, .table td { padding: 8px; text-align: center; }
    </style>
</head>
<body>

    <h1>Kartu Rencana Studi</h1>
    <p>Nama: 
        
    <h2>Daftar Mata Kuliah</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Kelompok</th>
                <th>Peminatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($mataKuliah as $mk): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($mk['nama']) ?></td>
                    <td><?= esc($mk['sks']) ?></td>
                    <td><?= esc($mk['kelompok']) ?></td>
                    <td><?= esc($mk['peminatan']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Total SKS: <?= array_sum(array_column($mataKuliah, 'sks')) ?></h3>

    <p><a href="/data_mahasiswa" style="color: blue;">Kembali ke Data Mahasiswa</a></p>

</body>
</html>
