<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pemesanan;
use App\Models\Penjualan;
use App\Models\Obat;
use App\Models\Perencanaan;

class Dashboard extends BaseController
{
    private $Pemesanan, $Penjualan, $Obat, $Perencanaan;

    public function __construct()
    {
        $this->Pemesanan = new Pemesanan();
        $this->Penjualan = new Penjualan();
        $this->Obat = new Obat();
        $this->Perencanaan = new Perencanaan();
    }

    public function index()
    {
        if (auth()->user()->inGroup('admin', 'manajer', 'staff')) {
            $obat = $this->Obat->findAll();
            $namaObatSafetyStok = [];
            $namaObat = [];
            $stokObat = [];

            foreach ($obat as $ob) {
                $namaObat[] = $ob->nama;
                $stokObat[] = (int) $ob->stok;

                $cekSafetyStok = $this->Perencanaan->where('obat_id', $ob->id)->first();
                if (!empty($cekSafetyStok)) {
                    $safety = $cekSafetyStok->safety_stok;
                    $safetyStok = $ob->stok - $safety;
                    if ($safetyStok <= 10) {
                        $namaObatSafetyStok[] = $ob->nama;
                    }
                }
            }

            $totalBarangMasuk = 0;
            $totalBarangKeluar = 0;
            $barangMasuk = $this->Pemesanan->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluar = $this->Penjualan->where('YEAR(tanggal)', date('Y'))->withRelations();

            foreach ($barangMasuk as $brgMsk) {
                $totalBarangMasuk += $brgMsk->qty;
            }

            foreach ($barangKeluar as $brgKlr) {
                $totalBarangKeluar += $brgKlr->qty;
            }

            $barangMasukJanuari = $this->Pemesanan->where('MONTH(tanggal)', '01')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarJanuari = $this->Penjualan->where('MONTH(tanggal)', '01')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukFebruari = $this->Pemesanan->where('MONTH(tanggal)', '02')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarFebruari = $this->Penjualan->where('MONTH(tanggal)', '02')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukMaret = $this->Pemesanan->where('MONTH(tanggal)', '03')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarMaret = $this->Penjualan->where('MONTH(tanggal)', '03')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukApril = $this->Pemesanan->where('MONTH(tanggal)', '04')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarApril = $this->Penjualan->where('MONTH(tanggal)', '04')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukMei = $this->Pemesanan->where('MONTH(tanggal)', '05')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarMei = $this->Penjualan->where('MONTH(tanggal)', '05')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukJuni = $this->Pemesanan->where('MONTH(tanggal)', '06')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarJuni = $this->Penjualan->where('MONTH(tanggal)', '06')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukJuli = $this->Pemesanan->where('MONTH(tanggal)', '07')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarJuli = $this->Penjualan->where('MONTH(tanggal)', '07')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukAgustus = $this->Pemesanan->where('MONTH(tanggal)', '08')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarAgustus = $this->Penjualan->where('MONTH(tanggal)', '08')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukSeptember = $this->Pemesanan->where('MONTH(tanggal)', '09')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarSeptember = $this->Penjualan->where('MONTH(tanggal)', '09')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukOktober = $this->Pemesanan->where('MONTH(tanggal)', '10')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarOktober = $this->Penjualan->where('MONTH(tanggal)', '10')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukNovember = $this->Pemesanan->where('MONTH(tanggal)', '11')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarNovember = $this->Penjualan->where('MONTH(tanggal)', '11')->where('YEAR(tanggal)', date('Y'))->withRelations();
            $barangMasukDesember = $this->Pemesanan->where('MONTH(tanggal)', '12')->where('YEAR(tanggal)', date('Y'))->findAll();
            $barangKeluarDesember = $this->Penjualan->where('MONTH(tanggal)', '12')->where('YEAR(tanggal)', date('Y'))->withRelations();

            $barangMasukJan = 0;
            $barangKeluarJan = 0;
            $barangMasukFeb = 0;
            $barangKeluarFeb = 0;
            $barangMasukMar = 0;
            $barangKeluarMar = 0;
            $barangMasukApr = 0;
            $barangKeluarApr = 0;
            $barangMasukMai = 0;
            $barangKeluarMai = 0;
            $barangMasukJun = 0;
            $barangKeluarJun = 0;
            $barangMasukJul = 0;
            $barangKeluarJul = 0;
            $barangMasukAgt = 0;
            $barangKeluarAgt = 0;
            $barangMasukSpt = 0;
            $barangKeluarSpt = 0;
            $barangMasukOkt = 0;
            $barangKeluarOkt = 0;
            $barangMasukNov = 0;
            $barangKeluarNov = 0;
            $barangMasukDes = 0;
            $barangKeluarDes = 0;

            foreach ($barangMasukJanuari as $brgMskJan) {
                $barangMasukJan += $brgMskJan->qty;
            }

            foreach ($barangKeluarJanuari as $brgKlrJan) {
                $barangKeluarJan += $brgKlrJan->qty;
            }

            foreach ($barangMasukFebruari as $brgMskFeb) {
                $barangMasukFeb += $brgMskFeb->qty;
            }

            foreach ($barangKeluarFebruari as $brgKlrFeb) {
                $barangKeluarFeb += $brgKlrFeb->qty;
            }

            foreach ($barangMasukMaret as $brgMskMar) {
                $barangMasukMar += $brgMskMar->qty;
            }

            foreach ($barangKeluarMaret as $brgKlrMar) {
                $barangKeluarMar += $brgKlrMar->qty;
            }

            foreach ($barangMasukApril as $brgMskApr) {
                $barangMasukApr += $brgMskApr->qty;
            }

            foreach ($barangKeluarApril as $brgKlrApr) {
                $barangKeluarApr += $brgKlrApr->qty;
            }

            foreach ($barangMasukMei as $brgMskMai) {
                $barangMasukMai += $brgMskMai->qty;
            }

            foreach ($barangKeluarMei as $brgKlrMai) {
                $barangKeluarMai += $brgKlrMai->qty;
            }

            foreach ($barangMasukJuni as $brgMskJun) {
                $barangMasukJun += $brgMskJun->qty;
            }

            foreach ($barangKeluarJuni as $brgKlrJun) {
                $barangKeluarJun += $brgKlrJun->qty;
            }

            foreach ($barangMasukJuli as $brgMskJul) {
                $barangMasukJul += $brgMskJul->qty;
            }

            foreach ($barangKeluarJuli as $brgKlrJul) {
                $barangKeluarJul += $brgKlrJul->qty;
            }

            foreach ($barangMasukAgustus as $brgMskAgt) {
                $barangMasukAgt += $brgMskAgt->qty;
            }

            foreach ($barangKeluarAgustus as $brgKlrAgt) {
                $barangKeluarAgt += $brgKlrAgt->qty;
            }

            foreach ($barangMasukSeptember as $brgMskSpt) {
                $barangMasukSpt += $brgMskSpt->qty;
            }

            foreach ($barangKeluarSeptember as $brgKlrSpt) {
                $barangKeluarSpt += $brgKlrSpt->qty;
            }

            foreach ($barangMasukOktober as $brgMskOkt) {
                $barangMasukOkt += $brgMskOkt->qty;
            }

            foreach ($barangKeluarOktober as $brgKlrOkt) {
                $barangKeluarOkt += $brgKlrOkt->qty;
            }

            foreach ($barangMasukNovember as $brgMskNov) {
                $barangMasukNov += $brgMskNov->qty;
            }

            foreach ($barangKeluarNovember as $brgKlrNov) {
                $barangKeluarNov += $brgKlrNov->qty;
            }

            foreach ($barangMasukDesember as $brgMskDes) {
                $barangMasukDes += $brgMskDes->qty;
            }

            foreach ($barangKeluarDesember as $brgKlrDes) {
                $barangKeluarDes += $brgKlrDes->qty;
            }

            $totalBarangMasukKeluarJanuari = $barangMasukJan + $barangKeluarJan;
            $totalBarangMasukKeluarFebruari = $barangMasukFeb + $barangKeluarFeb;
            $totalBarangMasukKeluarMaret = $barangMasukMar + $barangKeluarMar;
            $totalBarangMasukKeluarApril = $barangMasukApr + $barangKeluarApr;
            $totalBarangMasukKeluarMei = $barangMasukMai + $barangKeluarMai;
            $totalBarangMasukKeluarJuni = $barangMasukJun + $barangKeluarJun;
            $totalBarangMasukKeluarJuli = $barangMasukJul + $barangKeluarJul;
            $totalBarangMasukKeluarAgustus = $barangMasukAgt + $barangKeluarAgt;
            $totalBarangMasukKeluarSeptember = $barangMasukSpt + $barangKeluarSpt;
            $totalBarangMasukKeluarOktober = $barangMasukOkt + $barangKeluarOkt;
            $totalBarangMasukKeluarNovember = $barangMasukNov + $barangKeluarNov;
            $totalBarangMasukKeluarDesember = $barangMasukDes + $barangKeluarDes;

            $data = [
                'namaObatSafetyStok' => $namaObatSafetyStok,
                'namaObat' => $namaObat,
                'stokObat' => $stokObat,
                'barangMasuk' => $barangMasuk,
                'barangKeluar' => $barangKeluar,
                'totalBarangMasuk' => $totalBarangMasuk,
                'totalBarangKeluar' => $totalBarangKeluar,
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
                'konfirmasi' => $this->Pemesanan->where('status', 'DIVALIDASI_OLEH_MANAJER')->countAllResults(),
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
