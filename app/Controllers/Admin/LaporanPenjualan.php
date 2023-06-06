<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\PenjualanDetail;

class LaporanPenjualan extends BaseController
{
    private $PenjualanDetail;

    public function __construct()
    {
        $this->PenjualanDetail = new PenjualanDetail();
    }

    public function index()
    {
        if ($this->request->getGet()) {
            $data['penjualan'] = $this->PenjualanDetail->where('penjualan.tanggal >=', $this->request->getGet('dari_tanggal'))->where('penjualan.tanggal <=', $this->request->getGet('sampai_tanggal'))->withRelationsAll();
        } else {
            $data['penjualan'] = $this->PenjualanDetail->withRelationsAll();
        }

        return view('admin/laporan-penjualan/index', $data);
    }
}
