<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cabang;
use App\Models\Mutasi;

class MutasiController extends BaseController
{
    public function index()
    {
        helper('number');
        $model = new Mutasi();
        $modelCabang = new Cabang();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/data/dataMutasi', [
            //dd([
                'title' => 'Master Mutasi',
                'content' => $model->getAllAssociateData(),
                'cabang' => $modelCabang->findAll(),
            ]);
        }

        $data = [
            'author' => session()->get('id'),
            'cabang' => $this->request->getVar('cabang'),
            'dana' => $this->request->getVar('dana'),
            'kategori' => $this->request->getVar('kategori'),
            'waktu' => $this->request->getVar('waktu'),   
            'nasabah' => $this->request->getVar('nasabah'),         
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal membuat mutasi'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil membuat mutasi'
        ]);
    }

    public function update($id = null) 
    {
        $model = new Mutasi();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = [
            'cabang' => $this->request->getVar('cabang'),
            'dana' => $this->request->getVar('dana'),
            'kategori' => $this->request->getVar('kategori'),
            'waktu' => $this->request->getVar('waktu'),   
            'nasabah' => $this->request->getVar('nasabah'),            
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if (!$model->update($id, $data)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal update mutasi'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil update mutasi'
        ]);
    }

    public function delete($id = null) 
    {
        $model = new Mutasi();
        if (!$model->where('id', $id)->delete($id)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal hapus mutasi'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasi hapus mutasi'
        ]);
    }
}
