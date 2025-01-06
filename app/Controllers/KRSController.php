<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KRSModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class KRSController extends BaseController
{
    public function index()
    {
        $mataKuliahModel = new MataKuliahModel();
        $data['mataKuliah'] = $mataKuliahModel->findAll();

        // Log debugging
        log_message('debug', 'Mata Kuliah: ' . json_encode($data['mataKuliah']));

        // Jika data mata kuliah kosong, kirimkan error
        if (empty($data['mataKuliah'])) {
            return view('krs', ['error' => 'Mata kuliah tidak ditemukan']);
        }

        return view('krs', $data);
    }

    public function getMataKuliah()
    {
        $mataKuliahModel = new MataKuliahModel();

        try {
            $mataKuliah = $mataKuliahModel->findAll();

            return $this->response->setJSON([
                'success' => true,
                'mataKuliah' => $mataKuliah
            ]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data mata kuliah.'
            ]);
        }
    }

    public function searchMataKuliah()
    {
        $search = $this->request->getVar('search');
        $mataKuliahModel = new MataKuliahModel();

        try {
            $mataKuliah = $mataKuliahModel->like('nama', $search)->findAll();

            return $this->response->setJSON([
                'success' => true,
                'mataKuliah' => $mataKuliah
            ]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari mata kuliah.'
            ]);
        }
    }

    public function simpan()
    {
        $krsModel = new KRSModel();
        $mahasiswaModel = new MahasiswaModel();

        // Ambil user_id dari session
        $userId = session()->get('user_id');

        // Periksa apakah user_id tersedia di session
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'User ID tidak ditemukan di session.']);
        }

        // Ambil data mahasiswa berdasarkan user_id
        $mahasiswa = $mahasiswaModel->find($userId);

        // Pastikan mahasiswa ditemukan
        if (!$mahasiswa) {
            return $this->response->setJSON(['success' => false, 'message' => 'Mahasiswa tidak ditemukan.']);
        }

        // Ambil data mata kuliah dari request
        $data = $this->request->getJSON();

        // Cek apakah data mata kuliah ada
        if (!isset($data->mata_kuliah) || empty($data->mata_kuliah)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data mata kuliah tidak valid.']);
        }

        // Simpan data KRS
        try {
            foreach ($data->mata_kuliah as $idMataKuliah) {
                $krsModel->save([
                    'user_id' => $userId,  // Gunakan user_id dari session
                    'mata_kuliah_id' => $idMataKuliah
                ]);
            }

            // Membuat PDF setelah berhasil menyimpan KRS
            $this->generatePDF($mahasiswa, $data->mata_kuliah);

            // Menampilkan hasil KRS di halaman
            return view('krs_result', [
                'mahasiswa' => $mahasiswa,
                'mataKuliah' => $data->mata_kuliah
            ]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan KRS.']);
        }
    }


    private function generatePDF($mahasiswa, $mataKuliah)
    {
        // Menginisialisasi dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Buat konten HTML untuk PDF
        $html = '<h1>Hasil KRS</h1>';
        $html .= '<p>Nama Mahasiswa: ' . esc($mahasiswa['nama']) . '</p>';
        $html .= '<p>NIM: ' . esc($mahasiswa['nim']) . '</p>';
        $html .= '<h3>Mata Kuliah yang Diambil:</h3>';
        $html .= '<table border="1">
                    <thead>
                        <tr>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($mataKuliah as $mk) {
            $html .= '<tr>
                        <td>' . esc($mk['kode']) . '</td>
                        <td>' . esc($mk['nama']) . '</td>
                        <td>' . esc($mk['teori'] + $mk['praktikum']) . '</td>
                      </tr>';
        }

        $html .= '</tbody></table>';

        // Load HTML dan render PDF
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Output PDF ke browser atau simpan
        $dompdf->stream("KRS_" . esc($mahasiswa['nim']) . ".pdf", array("Attachment" => false));
    }

    public function cetak_krs()
    {
        $krsModel = new KRSModel();

        // Ambil user_id dari session
        $userId = session()->get('user_id');

        // Periksa apakah user_id tersedia di session
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'User ID tidak ditemukan di session.']);
        }

        // Ambil data mahasiswa berdasarkan user_id
        $mahasiswa = $krsModel->getMahasiswaData($userId);  // Pastikan ID mahasiswa diteruskan ke sini

        // Pastikan mahasiswa ditemukan
        if (!$mahasiswa) {
            return $this->response->setJSON(['success' => false, 'message' => 'Mahasiswa tidak ditemukan.']);
        }

        // Ambil data mata kuliah yang diambil oleh mahasiswa
        $mataKuliah = $krsModel->getMataKuliahByMahasiswa($mahasiswa['id']);  // Data mata kuliah berdasarkan mahasiswa

        // Menyiapkan HTML untuk ditransformasikan menjadi PDF
        $html = view('krs_pdf', [
            'mahasiswa' => $mahasiswa,
            'mataKuliah' => $mataKuliah
        ]);

        // Setup Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream("krs_" . $mahasiswa['nama'] . ".pdf", ["Attachment" => 0]);
    }
}
