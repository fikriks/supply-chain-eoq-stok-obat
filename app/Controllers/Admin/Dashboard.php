<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pemesanan;
use App\Models\Penjualan;
use App\Models\Obat;

class Dashboard extends BaseController
{
    private $Pemesanan, $Penjualan, $Obat;

    public function __construct()
    {
        $this->Pemesanan = new Pemesanan();
        $this->Penjualan = new Penjualan();
        $this->Obat = new Obat();
    }

    public function index()
    {
        if (auth()->user()->inGroup('admin', 'manajer', 'staff')) {
            $obat = $this->Obat->findAll();

            foreach ($obat as $ob) {
                $namaObat[] = $ob->nama;
                $stokObat[] = $ob->stok;
            }

            $barangMasuk = $this->Pemesanan->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluar = $this->Penjualan->where('YEAR(tanggal)', date('Y'))->findAll();

            $barangMasukJanuari = $this->Pemesanan->where('MONTH(tanggal)', '01')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarJanuari = $this->Penjualan->where('MONTH(tanggal)', '01')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukFebruari = $this->Pemesanan->where('MONTH(tanggal)', '02')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarFebruari = $this->Penjualan->where('MONTH(tanggal)', '02')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukMaret = $this->Pemesanan->where('MONTH(tanggal)', '03')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarMaret = $this->Penjualan->where('MONTH(tanggal)', '03')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukApril = $this->Pemesanan->where('MONTH(tanggal)', '04')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarApril = $this->Penjualan->where('MONTH(tanggal)', '04')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukMei = $this->Pemesanan->where('MONTH(tanggal)', '05')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarMei = $this->Penjualan->where('MONTH(tanggal)', '05')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukJuni = $this->Pemesanan->where('MONTH(tanggal)', '06')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarJuni = $this->Penjualan->where('MONTH(tanggal)', '06')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukJuli = $this->Pemesanan->where('MONTH(tanggal)', '07')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarJuli = $this->Penjualan->where('MONTH(tanggal)', '07')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukAgustus = $this->Pemesanan->where('MONTH(tanggal)', '08')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarAgustus = $this->Penjualan->where('MONTH(tanggal)', '08')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukSeptember = $this->Pemesanan->where('MONTH(tanggal)', '09')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarSeptember = $this->Penjualan->where('MONTH(tanggal)', '09')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukOktober = $this->Pemesanan->where('MONTH(tanggal)', '10')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarOktober = $this->Penjualan->where('MONTH(tanggal)', '10')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukNovember = $this->Pemesanan->where('MONTH(tanggal)', '11')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarNovember = $this->Penjualan->where('MONTH(tanggal)', '11')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangMasukDesember = $this->Pemesanan->where('MONTH(tanggal)', '12')->where('YEAR(tanggal)', date('Y'))->countAllResults();
            $barangKeluarDesember = $this->Penjualan->where('MONTH(tanggal)', '12')->where('YEAR(tanggal)', date('Y'))->countAllResults();

            $totalBarangMasukKeluarJanuari = $barangMasukJanuari + $barangKeluarJanuari;
            $totalBarangMasukKeluarFebruari = $barangMasukFebruari + $barangKeluarFebruari;
            $totalBarangMasukKeluarMaret = $barangMasukMaret + $barangKeluarMaret;
            $totalBarangMasukKeluarApril = $barangMasukApril + $barangKeluarApril;
            $totalBarangMasukKeluarMei = $barangMasukMei + $barangKeluarMei;
            $totalBarangMasukKeluarJuni = $barangMasukJuni + $barangKeluarJuni;
            $totalBarangMasukKeluarJuli = $barangMasukJuli + $barangKeluarJuli;
            $totalBarangMasukKeluarAgustus = $barangMasukAgustus + $barangKeluarAgustus;
            $totalBarangMasukKeluarSeptember = $barangMasukSeptember + $barangKeluarSeptember;
            $totalBarangMasukKeluarOktober = $barangMasukOktober + $barangKeluarOktober;
            $totalBarangMasukKeluarNovember = $barangMasukNovember + $barangKeluarNovember;
            $totalBarangMasukKeluarDesember = $barangMasukDesember + $barangKeluarDesember;

            $data = [
                'namaObat' => $namaObat,
                'stokObat' => $stokObat,
                'barangMasuk' => $barangMasuk,
                'barangKeluar' => $barangKeluar,
                'totalBarangMasukKeluar' => [
                    $totalBarangMasukKeluarJanuari,
                    $totalBarangMasukKeluarFebruari,
                    $totalBarangMasukKeluarMaret,
                    $totalBarangMasukKeluarApril,
                    $totalBarangMasukKeluarMei,
                    $totalBarangMasukKeluarJuni,
                    $totalBarangMasukKeluarJuli,
                    $totalBarangMasukKeluarAgustus,
                    $totalBarangMasukKeluarSeptember,
                    $totalBarangMasukKeluarOktober,
                    $totalBarangMasukKeluarNovember,
                    $totalBarangMasukKeluarDesember
                ],
            ];

            return view('admin/dashboard/index', $data);
        } else if (auth()->user()->inGroup('supplier')) {
            $data = [
                'konfirmasi' => $this->Pemesanan->where('status', 'MENUNGGU_KONFIRMASI')->countAllResults(),
                'dikirim' => $this->Pemesanan->where('status', 'DIKIRIM')->countAllResults(),
                'sukses' => $this->Pemesanan->where('status', 'SUKSES')->countAllResults(),
                'dibatalkan' => $this->Pemesanan->where('status', 'DIBATALKAN')->countAllResults()
            ];

            return view('admin/dashboard/index', $data);
        } else {
            return view('admin/dashboard/index');
        }
    }
}
