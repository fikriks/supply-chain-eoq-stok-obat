<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Pemesanan;

class LaporanPemesanan extends BaseController
{
    private $Pemesanan;

    public function __construct()
    {
        $this->Pemesanan = new Pemesanan();
    }

    public function index()
    {
        if ($this->request->getGet()) {
            $data['pemesanan'] = $this->Pemesanan->where('tanggal >=', $this->request->getGet('dari_tanggal'))->where('tanggal <=', $this->request->getGet('sampai_tanggal'))->withRelations();
        } else {
            $data['pemesanan'] = $this->Pemesanan->withRelations();
        }

        return view('admin/laporan-pemesanan/index', $data);
    }
}
