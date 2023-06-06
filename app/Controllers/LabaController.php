<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\Cabang;
use App\Models\Laba;
use App\Models\Akun;

class LabaController extends BaseController
{
    public function index()
    {
        helper('number');
        $model = new Laba();
        $modelCabang = new Cabang();
        $modelAkun = new Akun();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/data/dataLaba', [
                'title' => 'Data Laba',
                'content' => $model->getAllAssociateData(),
                'cabang' => $modelCabang->findAll(),
                'akun' => $modelAkun->findAll(),
            ]);
        }

        $data = [
            'author' => session()->get('id'),
            'kategori' => $this->request->getVar('kategori'),
            'kode_akun' => $this->request->getVar('kode_akun'),
            'cabang' => $this->request->getVar('cabang'),
            'dana' => $this->request->getVar('dana'),            
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal membuat laba'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil membuat laba'
        ]);
    }

    public function update($id = null) 
    {
        $model = new Laba();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = [
            'kategori' => $this->request->getVar('kategori'),
            'kode_akun' => $this->request->getVar('kode_akun'),
            'cabang' => $this->request->getVar('cabang'),
            'dana' => $this->request->getVar('dana'),            
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if (!$model->update($id, $data)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal update laba'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil update laba'
        ]);
    }

    public function delete($id = null) 
    {
        $model = new Laba();
        if (!$model->where('id', $id)->delete($id)) {
            return $this->response->setJSON([
                'status' => FALSE,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal hapus laba'
            ]);
        }

        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasi hapus laba'
        ]);
    }

    public function export($start, $end)
    {
        helper('number');
        $model = new Laba();
        $dataUser = $model->findDataInBetween($start, $end);
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'No.')
        ->setCellValue('B1', 'Nama Akun')
        ->setCellValue('C1', 'Kode Akun')
        ->setCellValue('D1', 'Nama Cabang')
        ->setCellValue('E1', 'Kategori')
        ->setCellValue('F1', 'Dana');


        $column = 2;
        $no = 1;
        $total = 0; // Variable to store the total value

        // tulis data mobil ke cell
        foreach($dataUser as $data) {
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $column, $no++)
            ->setCellValue('B' . $column, $data['nama_akun'])
            ->setCellValue('C' . $column, $data['kode_akun'])
            ->setCellValue('D' . $column, $data['nama_cabang'])
            ->setCellValue('E' . $column, $data['kategori'])
            ->setCellValue('F' . $column, number_to_currency($data['dana'], 'IDR'));

        $total += $data['dana']; // Add the "Dana" value to the total
        $column++;
        }

        // Add the total row
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('E' . $column, 'Total:')
        ->setCellValue('F' . $column, number_to_currency($total, 'IDR'));

        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan Laba '. $start . ' - ' . $end ;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
