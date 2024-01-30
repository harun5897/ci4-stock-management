<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PelangganController extends BaseController
{
    public function index()
    {
        $model = model('PelangganModel');
        $dataPelanggan = $model->findAll();
        return view('pelanggan', ['dataPelanggan' => $dataPelanggan]);
    }
    public function detailPelanggan($idPelanggan) {
        $model = model('PelangganModel');
        $detailPelanggan = $model->find($idPelanggan);
        return $this->response->setJSON([
            'success' => true,
            'data' => $detailPelanggan,
        ]);
    }
    public function addPelanggan() {
        $model = model('PelangganModel');
        $data = [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $model->insert($data);
        return redirect()->to(base_url('/data-pelanggan'));
    }
    public function updatePelanggan() {
        $model = model('PelangganModel');
        $idPelanggan = $this->request->getPost('id_pelanggan');
        $dataPelanggan = [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $model->update($idPelanggan, $dataPelanggan);
        return redirect()->to(base_url('/data-pelanggan'));
    }
    public function removePelanggan($idPelanggan) {
        $model = model('PelangganModel');
        $model->delete($idPelanggan);
        return redirect()->to(base_url('/data-pelanggan'));
    }
}
