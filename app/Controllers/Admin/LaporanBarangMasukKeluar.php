<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Obat;

class LaporanBarangMasukKeluar extends BaseController
{
    private $Obat;

    public function __construct()
    {
        $this->Obat = new Obat();
    }

    public function index()
    {
        if ($this->request->getGet()) {
            $data['obat'] = $this->Obat->where('pemesanan.tanggal >=', $this->request->getGet('dari_tanggal'))->where('pemesanan.tanggal <=', $this->request->getGet('sampai_tanggal'))->withRelations();
        } else {
            $data['obat'] = $this->Obat->withRelationsMasukKeluar();
        }

        return view('admin/laporan-barang-masuk-keluar/index', $data);
    }

    function exportPdf()
    {
        if ($this->request->getGet()) {
            $data['obat'] = $this->Obat->where('pemesanan.tanggal >=', $this->request->getGet('dari_tanggal'))->where('pemesanan.tanggal <=', $this->request->getGet('sampai_tanggal'))->withRelations();
        } else {
            $data['obat'] = $this->Obat->withRelationsMasukKeluar();
        }

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('admin/laporan-barang-masuk-keluar/pdf', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}
