<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cabang;
use App\Models\Kolektibilitas;

class KolektibilitasController extends BaseController
{
    public function index()
    {
        helper('number');
        $model = new Kolektibilitas();
        $modelCabang = new Cabang();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/data/dataKolektibilitas', [
            //dd([
                'title' => 'Data Kolektibilitas',
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
                'text' => 'Gagal membuat kolektibilitas'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil membuat kolektibilitas'
        ]);
    }

    public function update($id = null) 
    {
        $model = new Kolektibilitas();
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
                'text' => 'Gagal update kolektibilitas'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil update kolektibilitas'
        ]);
    }

    public function delete($id = null) 
    {
        $model = new Kolektibilitas();
        if (!$model->where('id', $id)->delete($id)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal hapus kolektibilitas'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasi hapus kolektibilitas'
        ]);
    }
}
