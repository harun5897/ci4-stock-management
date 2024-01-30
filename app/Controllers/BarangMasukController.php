<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BarangMasukController extends BaseController
{
    public function index()
    {
        
        $modelBarang = model('BarangModel');
        $modelBarangMasuk = model('BarangMasukModel');
        $dataBarang = $modelBarang->findAll();
        $barangMasuk = $modelBarangMasuk->findAll();
        return view('BarangMasuk',
            [
                'dataBarang' => $dataBarang,
                'barangMasuk' => $barangMasuk
            ]);
    }
    public function getReport()
    {
        $modelBarang = model('BarangModel');
        $modelBarangMasuk = model('BarangMasukModel');
        $dataBarang = $modelBarang->findAll();
        $barangMasuk = $modelBarangMasuk->findAll();
        return view('/report/ReportBarangMasuk',
            [
                'dataBarang' => $dataBarang,
                'barangMasuk' => $barangMasuk
            ]);
    }
    public function detailBarangMasuk($idBarangMasuk) {
        $modelBarangMasuk = model('BarangMasukModel');
        $detailBarengMasuk = $modelBarangMasuk->find($idBarangMasuk);
        return $this->response->setJSON([
            'success' => true,
            'data' => $detailBarengMasuk,
        ]);
    }
    public function addBarangMasuk() {
        $modelBarang = model('BarangModel');
        $modelBarangMasuk = model('BarangMasukModel');
        $session = session();
        if(!$this->request->getPost('id_barang')) {
            $session->setFlashdata('failed', 'Silahkan pilih nama barang');
            return redirect()->to(base_url('/barang-masuk'));
        }
        if(!$this->request->getPost('jumlah_barang_masuk')) {
            $session->setFlashdata('failed', 'Silahkan isi jumlah barang masuk');
            return redirect()->to(base_url('/barang-masuk'));
        }
        if(!$this->request->getPost('tanggal_barang_masuk')) {
            $session->setFlashdata('failed', 'Silahkan isi tanggal barang masuk');
            return redirect()->to(base_url('/barang-masuk'));
        }

        $dataBarang = $modelBarang->find($this->request->getPost('id_barang'));
        $totalStok = (int)$dataBarang['total_stok'] + (int)$this->request->getPost('jumlah_barang_masuk');
        $modelBarang->update($this->request->getPost('id_barang'), ['total_stok' => $totalStok]);
        $data = [
            'id_barang' =>(int)$this->request->getPost('id_barang'),
            'jumlah_barang_masuk' => (int)$this->request->getPost('jumlah_barang_masuk'),
            'tanggal_barang_masuk' => $this->request->getPost('tanggal_barang_masuk')
        ];
        $modelBarangMasuk->insert($data);
        return redirect()->to(base_url('/barang-masuk'));
    }
    public function updateBarangMasuk() {
        $modelBarang = model('BarangModel');
        $modelBarangMasuk = model('BarangMasukModel');
        $session = session();
        if(!$this->request->getPost('id_barang')) {
            $session->setFlashdata('failed', 'Silahkan pilih nama barang');
            return redirect()->to(base_url('/barang-masuk'));
        }
        if(!$this->request->getPost('jumlah_barang_masuk')) {
            $session->setFlashdata('failed', 'Silahkan isi jumlah barang masuk');
            return redirect()->to(base_url('/barang-masuk'));
        }
        if(!$this->request->getPost('tanggal_barang_masuk')) {
            $session->setFlashdata('failed', 'Silahkan isi tanggal barang masuk');
            return redirect()->to(base_url('/barang-masuk'));
        }
        $dataBarang = $modelBarang->find($this->request->getPost('id_barang'));
        $totalStok = ((int)$dataBarang['total_stok'] - (int)$this->request->getPost('jumlah_barang_masuk_last')) + (int)$this->request->getPost('jumlah_barang_masuk');
        $modelBarang->update($this->request->getPost('id_barang'), ['total_stok' => $totalStok]);
        $data = [
            'id_barang' =>(int)$this->request->getPost('id_barang'),
            'jumlah_barang_masuk' => (int)$this->request->getPost('jumlah_barang_masuk'),
            'tanggal_barang_masuk' => $this->request->getPost('tanggal_barang_masuk')
        ];
        $modelBarangMasuk->update($this->request->getPost('id_barang_masuk'), $data);
        return redirect()->to(base_url('/barang-masuk'));
    }
    public function removeBarangMasuk($idBarangMasuk) {
        $modelBarangMasuk = model('BarangMasukModel');
        $modelBarangMasuk->delete($idBarangMasuk);
        return redirect()->to(base_url('/barang-masuk'));
    }
}
