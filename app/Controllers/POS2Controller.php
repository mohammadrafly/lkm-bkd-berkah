<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Akun;
use App\Models\Cabang;
use App\Models\POS2;

class POS2Controller extends BaseController
{
    public function index()
    {
        $model = new POS2();
        $modelCabang = new Cabang();
        $modelAkun = new Akun();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/data/dataPos2', [
            //dd([
                'title' => 'Data POS2',
                'content' => $model->getAllAssociateData(),
                'cabang' => $modelCabang->findAll(),
                'akun' => $modelAkun->findAll()
            ]);
        }

        $data = [
            'author' => session()->get('id'),
            'kategori' => $this->request->getVar('kategori'),
            'kode_akun' => $this->request->getVar('kode_akun'),
            'cabang' => $this->request->getVar('cabang'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal membuat pos2'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil membuat pos2'
        ]);
    }

    public function update($id = null) 
    {
        $model = new POS2();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = [
            'kategori' => $this->request->getVar('kategori'),
            'kode_akun' => $this->request->getVar('kode_akun'),
            'cabang' => $this->request->getVar('cabang'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if (!$model->update($id, $data)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal update pos2'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil update pos2'
        ]);
    }

    public function delete($id = null) 
    {
        $model = new POS2();
        if (!$model->where('id', $id)->delete($id)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal hapus pos2'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasi hapus pos2'
        ]);
    }
}
