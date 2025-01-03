<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KRSModel;
use App\Models\MahasiswaModel;
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
            return redirect()->to('/')->with('error', 'Mata kuliah tidak ditemukan.');
        }

        return view('krs', $data);
    }


    public function getMataKuliah()
    {
        $mataKuliahModel = new MataKuliahModel();
        $mataKuliah = $mataKuliahModel->findAll();

        if (!empty($mataKuliah)) {
            return $this->response->setJSON([
                'success' => true,
                'mataKuliah' => $mataKuliah
            ]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function simpan()
    {
        $krsModel = new KrsModel();
        $data = $this->request->getJSON();

        if (!empty($data->mata_kuliah)) {
            foreach ($data->mata_kuliah as $idMataKuliah) {
                $krsModel->save([
                    'user_id' => session()->get('user_id'),
                    'mata_kuliah_id' => $idMataKuliah
                ]);
            }
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }
}
