<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SupplierController extends BaseController
{
    public function index()
    {
        $model = model('SupplierModel');
        $dataSupplier = $model->findAll();
        return view('supplier', ['dataSupplier' => $dataSupplier]);
    }
    public function detailSupplier($idSupplier) {
        $model = model('SupplierModel');
        $detailSupplier = $model->find($idSupplier);
        return $this->response->setJSON([
            'success' => true,
            'data' => $detailSupplier,
        ]);
    }
    public function addSupplier() {
        $model = model('SupplierModel');
        $data = [
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $model->insert($data);
        return redirect()->to(base_url('/data-supplier'));
    }
    public function updateSupplier() {
        $model = model('SupplierModel');
        $idSupplier = $this->request->getPost('id_supplier');
        $dataSupplier = [
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $model->update($idSupplier, $dataSupplier);
        return redirect()->to(base_url('/data-supplier'));
    }
    public function removeSupplier($idSupplier) {
        $model = model('SupplierModel');
        $model->delete($idSupplier);
        return redirect()->to(base_url('/data-supplier'));
    }
}
