<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1 class="mt-4">Input KRS</h1>
    <p>Silakan pilih mata kuliah yang ingin Anda ambil:</p>

    <form action="/krs/simpan" method="POST">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($mataKuliah)): ?>
                    <?php foreach ($mataKuliah as $mk): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="mata_kuliah[]" value="<?= $mk['id'] ?>">
                            </td>
                            <td><?= esc($mk['kode']) ?></td>
                            <td><?= esc($mk['nama']) ?></td>
                            <td><?= esc($mk['teori'] + $mk['praktikum']) ?></td>
                            <td><?= esc($mk['semester']) ?></td>
                            <td><?= esc($mk['min_sks'] ?? 'Tidak Ada') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada mata kuliah tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Simpan KRS</button>
    </form>
</div>
<?= $this->endSection() ?>