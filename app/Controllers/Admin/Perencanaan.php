<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Obat;
use App\Models\Pemesanan;
use App\Models\PenjualanDetail;
use App\Models\Penjualan;

class Perencanaan extends ResourceController
{
    private $Obat, $Pemesanan, $PenjualanDetail, $Penjualan;
    protected $modelName = 'App\Models\Perencanaan';

    public function __construct()
    {
        $this->Obat = new Obat();
        $this->Pemesanan = new Pemesanan();
        $this->PenjualanDetail = new PenjualanDetail();
        $this->Penjualan = new Penjualan();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'kode' => $this->_generateCode(),
            'perencanaan' => $this->model->withRelations(),
            'obat' => $this->Obat->findAll(),
            'periode' => $this->Penjualan->select('YEAR(tanggal) as tahun')->groupBy('YEAR(tanggal)')->findAll()
        ];

        return view('admin/perencanaan/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data['perencanaan'] = $this->model->withRelationsById($id);

        return view('admin/perencanaan/show', $data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $permintaan = 0;
        $avarangeUse = 0;
        $biayaPemesanan = 20000;
        $biayaPenyimpanan = 80000;
        $leadTimeTertinggi = 3;
        $rataRataLeadTime = 1;
        $obat = $this->Obat->find($this->request->getPost('obat_id'));
        $pemesanan = $this->Pemesanan->where('obat_id', $obat->id)->where('status', 'PESANAN_DITERIMA')->where('YEAR(tanggal)', $this->request->getPost('periode'))->findAll();
        $penjualanHarianTertinggi = $this->PenjualanDetail->selectMax('qty')->where('obat_id', $obat->id)->first()->qty;
        $rataRataPenjualanHarian = $this->PenjualanDetail->selectAvg('qty')->where('obat_id', $obat->id)->first()->qty;
        $penjualan = $this->PenjualanDetail->where('obat_id', $obat->id)->where('YEAR(created_at)', $this->request->getPost('periode'))->findAll();

        if (empty($pemesanan)) {
            session()->setFlashdata('error', 'Data pemesanan obat ini belum ada, silahkan melakukan pemesanan data obat terlebih dahulu');

            return redirect()->to('admin/perencanaan');
        }

        if (empty($penjualan)) {
            session()->setFlashdata('error', 'Data penjualan obat ini beluma ada, silahkan melakukan penjualan data obat terlebih dahulu');

            return redirect()->to('admin/perencanaan');
        }

        foreach ($pemesanan as $pmsn) {
            $permintaan += $pmsn->qty;
        }

        foreach ($penjualan as $pnjl) {
            $avarangeUse += $pnjl->qty;
        }

        // EOQ
        $baris1 = 2 * $permintaan * $biayaPemesanan;
        $baris2 = $obat->harga_beli * $biayaPenyimpanan;
        $eoq = $baris1 / $baris2;
        $eoq = sqrt($eoq);
        $eoq = round($eoq, 3) + 0;
        $eoq = ltrim($eoq, '0');
        $eoq = (int) str_replace('.', '', $eoq);
        $frekuensi = round($permintaan / $eoq);
        $daurUlangPemesanan = round(365 / $frekuensi);

        // SS
        $bil1 = ($penjualanHarianTertinggi * $leadTimeTertinggi);
        $bil2 = round($rataRataPenjualanHarian * $rataRataLeadTime);
        $ss = $bil1 - $bil2;

        // ROP
        $leadTime = 2;
        $au = round($avarangeUse / 365, 1);
        $rop = ($leadTime * $au + $ss);
        $rop = $rop + $ss;



        $maximumInventory = $ss + $eoq;

        $request = $this->request->getPost();
        $request['permintaan'] = $permintaan;
        $request['biaya_pemesanan'] = $biayaPemesanan;
        $request['biaya_penyimpanan'] = $biayaPenyimpanan;
        $request['lead_time'] = $leadTime;
        $request['avarange_use'] = $avarangeUse;
        $request['penjualan_harian_tertinggi'] = $penjualanHarianTertinggi;
        $request['lead_time_tertinggi'] = $leadTimeTertinggi;
        $request['rata_rata_penjualan_harian'] = $rataRataPenjualanHarian;
        $request['rata_rata_lead_time'] = $rataRataLeadTime;
        $request['daur_ulang_pemesanan'] = $daurUlangPemesanan;
        $request['safety_stok'] = $ss;
        $request['eoq'] = $eoq;
        $request['rop'] = $rop;
        $request['maximum_inventory'] = $maximumInventory;

        $result = $this->model->save($request);

        if ($result) {
            session()->setFlashdata('message', 'Tambah Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Tambah Data Tidak Berhasil');
        }

        return redirect()->to('admin/perencanaan');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $data['perencanaan'] = $this->model->withRelationsById($id);
        $data['obat'] = $this->Obat->findAll();

        return view('admin/perencanaan/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $baris1 = 2 * $this->request->getPost('permintaan') * $this->request->getPost('biaya_pemesanan');;
        $baris2 = $this->request->getPost('harga') * $this->request->getPost('biaya_penyimpanan');
        $eoq = $baris1 / $baris2;
        $eoq = sqrt($eoq);
        $eoq = round($eoq, 3) + 0;
        $eoq = ltrim($eoq, '0');
        $eoq = (int) str_replace('.', '', $eoq);
        $frekuensi = round($this->request->getPost('permintaan') / $eoq);
        $daurUlangPemesanan = round(365 / $frekuensi);

        $bil1 = ($this->request->getPost('penjualan_harian_tertinggi') * $this->request->getPost('lead_time_tertinggi'));
        $bil2 = ($this->request->getPost('rata_rata_penjualan_harian') * $this->request->getPost('rata_rata_lead_time'));
        $ss = $bil1 - $bil2;

        $leadTime = $this->request->getPost('lead_time');
        $au = $this->request->getPost('avarange_use') / 365;
        $rop = ($leadTime * $au);
        $rop = $rop + $ss;

        $maximumInventory = $ss + $eoq;

        $request = $this->request->getPost();
        $request['daur_ulang_pemesanan'] = $daurUlangPemesanan;
        $request['safety_stok'] = $ss;
        $request['eoq'] = $eoq;
        $request['rop'] = $rop;
        $request['maximum_inventory'] = $maximumInventory;

        $result = $this->model->update($id, $request);

        if ($result) {
            session()->setFlashdata('message', 'Edit Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Edit Data Tidak Berhasil');
        }

        return redirect()->to('admin/perencanaan');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $result = $this->model->delete($id);

        if ($result) {
            session()->setFlashdata('message', 'Hapus Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Hapus Data Tidak Berhasil');
        }

        return redirect()->to('admin/perencanaan');
    }

    protected $maxCode = null;
    public function _generateCode()
    {
        if ($this->maxCode == null) {
            $count = $this->model->countAll();
            $data = $this->model->selectMax('id')->first();

            if ($count > 0) {
                $sale_code       = substr($this->model->select('kode')->where('id', $data->id)->first()->kode, 4);
                $this->maxCode = 'PRN-' . sprintf("%04d", $sale_code + 1);
            } else {
                $this->maxCode = 'PRN-0001';
            }
        } else {
            $sale_code       = substr($this->maxCode, 4);
            $this->maxCode   = 'PRN-' . sprintf("%04d", $sale_code + 1);
        }

        return $this->maxCode;
    }
}
