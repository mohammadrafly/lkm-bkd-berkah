<?php

namespace App\Controllers;

use App\Models\Cabang;
use App\Models\Kolektibilitas;
use App\Models\Laba;
use App\Models\Liabilitas;
use App\Models\Mutasi;
use App\Models\Neraca;
use App\Models\POS2;
use App\Models\User;

class Home extends BaseController
{
    public function index()
    {
        $modelCabang = new Cabang();
        $modelKolektibilitas = new Kolektibilitas();
        $modelLaba = new Laba();
        $modelLiabilitas = new Liabilitas();
        $modelMutasi = new Mutasi();
        $modelNeraca = new Neraca();
        $modelPOS2 = new POS2();
        $modelUser = new User();

        return view('pages/index',[
            'title' => 'Dashboard',
            'user' => $modelUser->countAllResults(),
            'pos2' => $modelPOS2->countAllResults(),
            'neraca' => $modelNeraca->countAllResults(),
            'mutasi' => $modelMutasi->countAllResults(),
            'liabilitas' => $modelLiabilitas->countAllResults(),
            'laba' => $modelLaba->countAllResults(),
            'kolektibilitas' => $modelKolektibilitas->countAllResults(),
            'cabang' => $modelCabang->countAllResults(),
        ]);
    }
}
