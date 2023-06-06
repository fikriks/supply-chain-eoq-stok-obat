<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Pemesanan;

class Dashboard extends BaseController
{
    private $Pemesanan;

    public function __construct()
    {
        $this->Pemesanan = new Pemesanan();
    }

    public function index()
    {
        if (auth()->user()->inGroup('supplier')) {
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
