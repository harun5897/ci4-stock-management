<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DataBarangController extends BaseController
{
    public function index()
    {
        $model = model('BarangModel');
        $dataBarang = $model->findAll();
        return view('DataBarang', ['dataBarang' => $dataBarang]);
    }
    public function getReport(){
        $model = model('BarangModel');
        $dataBarang = $model->findAll();
        return view('/report/ReportBarang', ['dataBarang' => $dataBarang]);
    }
    public function detailBarang($idBarang) {
        $model = model('BarangModel');
        $detailBarang = $model->find($idBarang);
        return $this->response->setJSON([
            'success' => true,
            'data' => $detailBarang,
        ]);
    }
    public function addBarang() {
        $model = model('BarangModel');
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_satuan' => (int)$this->request->getPost('harga_satuan'),
            'total_stok' => null
        ];
        $model->insert($data);
        return redirect()->to(base_url('/data-barang'));
    }
    public function updateBarang() {
        $model = model('BarangModel');
        $idBarang = $this->request->getPost('id_barang');
        $dataBarang = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_satuan' => (int)$this->request->getPost('harga_satuan'),
            'total_stok' => (int)$this->request->getPost('total_stok')
        ];
        $model->update($idBarang, $dataBarang);
        return redirect()->to(base_url('/data-barang'));
    }
    public function removeBarang($idBarang) {
        $model = model('BarangModel');
        $model->delete($idBarang);
        return redirect()->to(base_url('/data-barang'));
    }
}
