<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BarangKeluarController extends BaseController
{
    public function index()
    {
        $modelBarang = model('BarangModel');
        $modelBarangKeluar = model('BarangKeluarModel');
        $dataBarang = $modelBarang->findAll();
        $barangKeluar = $modelBarangKeluar->findAll();
        return view('BarangKeluar',
            [
                'dataBarang' => $dataBarang,
                'barangKeluar' => $barangKeluar
            ]);
    }
    public function getReport()
    {
        $modelBarang = model('BarangModel');
        $modelBarangKeluar = model('BarangKeluarModel');
        $dataBarang = $modelBarang->findAll();
        $barangKeluar = $modelBarangKeluar->findAll();
        return view('/report/ReportBarangKeluar',
            [
                'dataBarang' => $dataBarang,
                'barangKeluar' => $barangKeluar
            ]);
    }
    public function detailBarangKeluar($idBarangKeluar) {
        $modelBarangKeluar = model('BarangKeluarModel');
        $detailBarengKeluar = $modelBarangKeluar->find($idBarangKeluar);
        return $this->response->setJSON([
            'success' => true,
            'data' => $detailBarengKeluar,
        ]);
    }
    public function addBarangKeluar() {
        $modelBarang = model('BarangModel');
        $modelBarangKeluar = model('BarangKeluarModel');
        $session = session();
        if(!$this->request->getPost('id_barang')) {
            $session->setFlashdata('failed', 'Silahkan pilih nama barang');
            return redirect()->to(base_url('/barang-keluar'));
        }
        if(!$this->request->getPost('jumlah_barang_keluar')) {
            $session->setFlashdata('failed', 'Silahkan isi jumlah barang keluar');
            return redirect()->to(base_url('/barang-keluar'));
        }
        if(!$this->request->getPost('tanggal_barang_keluar')) {
            $session->setFlashdata('failed', 'Silahkan isi tanggal barang keluar');
            return redirect()->to(base_url('/barang-keluar'));
        }
        $dataBarang = $modelBarang->find($this->request->getPost('id_barang'));
        if($dataBarang['total_stok'] < $this->request->getPost('jumlah_barang_keluar')) {
            $session->setFlashdata('failed', 'Stok barang tidak cukup');
            return redirect()->to(base_url('/barang-keluar'));
        }
        $totalStok = (int)$dataBarang['total_stok'] - (int)$this->request->getPost('jumlah_barang_keluar');
        $modelBarang->update($this->request->getPost('id_barang'), ['total_stok' => $totalStok]);
        $data = [
            'id_barang' =>(int)$this->request->getPost('id_barang'),
            'jumlah_barang_keluar' => (int)$this->request->getPost('jumlah_barang_keluar'),
            'tanggal_barang_keluar' => $this->request->getPost('tanggal_barang_keluar')
        ];
        $modelBarangKeluar->insert($data);
        return redirect()->to(base_url('/barang-keluar'));
    }
    public function updateBarangKeluar() {
        $modelBarang = model('BarangModel');
        $modelBarangKeluar = model('BarangKeluarModel');
        $session = session();
        if(!$this->request->getPost('id_barang')) {
            $session->setFlashdata('failed', 'Silahkan pilih nama barang');
            return redirect()->to(base_url('/barang-keluar'));
        }
        if(!$this->request->getPost('jumlah_barang_keluar')) {
            $session->setFlashdata('failed', 'Silahkan isi jumlah barang keluar');
            return redirect()->to(base_url('/barang-keluar'));
        }
        if(!$this->request->getPost('tanggal_barang_keluar')) {
            $session->setFlashdata('failed', 'Silahkan isi tanggal barang keluar');
            return redirect()->to(base_url('/barang-keluar'));
        }
        $dataBarang = $modelBarang->find($this->request->getPost('id_barang'));
        if($dataBarang['total_stok'] < $this->request->getPost('jumlah_barang_keluar')) {
            $session->setFlashdata('failed', 'Stok barang tidak cukup');
            return redirect()->to(base_url('/barang-keluar'));
        }
        $dataBarang = $modelBarang->find($this->request->getPost('id_barang'));
        $totalStok = ((int)$dataBarang['total_stok'] + (int)$this->request->getPost('jumlah_barang_keluar_last')) - (int)$this->request->getPost('jumlah_barang_keluar');
        $modelBarang->update($this->request->getPost('id_barang'), ['total_stok' => $totalStok]);
        $data = [
            'id_barang' =>(int)$this->request->getPost('id_barang'),
            'jumlah_barang_keluar' => (int)$this->request->getPost('jumlah_barang_keluar'),
            'tanggal_barang_keluar' => $this->request->getPost('tanggal_barang_keluar')
        ];
        $modelBarangKeluar->update($this->request->getPost('id_barang_keluar'), $data);
        return redirect()->to(base_url('/barang-keluar'));
    }
    public function removeBarangKeluar($idBarangKeluar) {
        $modelBarangKeluar = model('BarangKeluarModel');
        $modelBarangKeluar->delete($idBarangKeluar);
        return redirect()->to(base_url('/barang-keluar'));
    }
}
