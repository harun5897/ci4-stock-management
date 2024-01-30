<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view('login');
    }
    public function signIn() {
        $username = $this->request->getpost('username');
        $password = $this->request->getpost('password');
        $builder = model('UserModel')->builder();
        $query = $builder->select('*')
        ->where('username', $username)
        ->where('password', $password)
        ->get();
        $result = $query->getRow();
        $session = session();
        if(!$result) {
            $session->setFlashdata('failed', 'Email atau password yang anda masukkan salah');
            return redirect()->to(base_url('/'));
        }
        $session->set('auth', true);
        $session->setFlashdata('success', 'Berhasil login');
        return redirect()->to(base_url('/data-barang'));
    }
    public function signOut() {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
