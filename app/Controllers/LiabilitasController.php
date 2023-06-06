<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Liabilitas;
use App\Models\Cabang;
use App\Models\Akun;

class LiabilitasController extends BaseController
{
    public function index()
    {
        helper('number');
        $model = new Liabilitas();
        $modelCabang = new Cabang();
        $modelAkun = new Akun();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/data/dataLiabilitas', [
                'title' => 'Data Liabilitas',
                'content' => $model->getAllAssociateData(),
                'cabang' => $modelCabang->findAll(),
                'akun' => $modelAkun->findAll()
            ]);
        }

        $data = [
            'author' => session()->get('id'),
            'cabang' => $this->request->getVar('cabang'),
            'dana' => $this->request->getVar('dana'),
            'nasabah' => $this->request->getVar('nasabah'),
            'keterangan' => $this->request->getVar('keterangan'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal membuat liabilitas'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil membuat liabilitas'
        ]);
    }

    public function update($id = null) 
    {
        $model = new Liabilitas();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = [
            'cabang' => $this->request->getVar('cabang'),
            'dana' => $this->request->getVar('dana'),
            'nasabah' => $this->request->getVar('nasabah'),
            'keterangan' => $this->request->getVar('keterangan'),                      
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if (!$model->update($id, $data)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal update liabilitas'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil update liabilitas'
        ]);
    }

    public function delete($id = null) 
    {
        $model = new Liabilitas();
        if (!$model->where('id', $id)->delete($id)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal hapus liabilitas'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasi hapus liabilitas'
        ]);
    }
}
