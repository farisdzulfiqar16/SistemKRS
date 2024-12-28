<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KRSModel;
use App\Models\MataKuliahModel;
use CodeIgniter\HTTP\ResponseInterface;

class KRSController extends BaseController
{
    public function index()
    {
        $mataKuliahModel = new MataKuliahModel();
        $data['mataKuliah'] = $mataKuliahModel->findAll();

        // Debug log
        log_message('debug', 'Mata Kuliah: ' . json_encode($data['mataKuliah']));

        if (empty($data['mataKuliah'])) {
            return redirect()->to('/')->with('error', 'Mata kuliah tidak ditemukan.'); // Jika data kosong
        }

        return view('krs', $data);
    }


    public function simpan()
    {
        $krsModel = new KRSModel();
        $mahasiswaId = session()->get('mahasiswa_id'); // Ambil ID mahasiswa dari session
        $mataKuliah = $this->request->getPost('mata_kuliah');

        // Validasi: Cek apakah data mata kuliah ada
        if (!$mataKuliah) {
            return redirect()->back()->with('error', 'Pilih setidaknya satu mata kuliah.');
        }

        // Simpan data ke tabel KRS
        foreach ($mataKuliah as $mkId) {
            $krsModel->insert([
                'mahasiswa_id' => $mahasiswaId,
                'mata_kuliah_id' => $mkId,
                'semester' => 1, // Contoh semester tetap
                'status' => 'diambil',
            ]);
        }

        return redirect()->to('/krs')->with('success', 'KRS berhasil disimpan.');
    }
}
