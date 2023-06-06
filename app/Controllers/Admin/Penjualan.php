<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

use App\Models\Obat;
use App\Models\PenjualanDetail;

class Penjualan extends ResourceController
{
    private $Obat, $PenjualanDetail;
    protected $modelName = 'App\Models\Penjualan';

    public function __construct()
    {
        $this->Obat = new Obat();
        $this->PenjualanDetail = new PenjualanDetail();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['penjualan'] = $this->model->findAll();

        return view('admin/penjualan/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data['penjualan'] = $this->model->find($id);
        $data['penjualanDetail'] = $this->PenjualanDetail->withRelations($id);

        return view('admin/penjualan/show', $data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $data = [
            'obat' => $this->Obat->findAll(),
            'kode' => $this->_generateCode()
        ];

        return view('admin/penjualan/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $requestPenjualan = [
            'kode' =>  $this->request->getPost('kode'),
            'user_id' => auth()->id(),
            'tanggal' =>  $this->request->getPost('tanggal'),
            'total_harga' =>  $this->request->getPost('total_harga'),
            'bayar' =>  $this->request->getPost('bayar'),
            'kembalian' =>  $this->request->getPost('kembalian'),
        ];

        $this->model->save($requestPenjualan);
        $penjualanId = $this->model->getInsertID();

        $data = $this->request->getPost();
        for ($no = 0; $no < count($data['kode_produk']); $no++) {
            $requestPenjualanDetail = [
                'penjualan_id'    => $penjualanId,
                'obat_id'        => $this->Obat->where('kode', $data['kode_produk'][$no])->first()->id,
                'qty'        => $data['kuantitas'][$no],
                'harga'        => $data['harga'][$no],
                'total_harga'        => $data['total'][$no],
            ];

            $this->PenjualanDetail->save($requestPenjualanDetail);
        }

        echo json_encode(["status" => "OK", "code" => 200]);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }

    public function restObat($id)
    {
        $data = $this->Obat->find($id);

        echo json_encode($data);
    }

    protected $maxCode = null;
    public function _generateCode()
    {
        if ($this->maxCode == null) {
            $count = $this->model->countAll();
            $data = $this->model->selectMax('id')->first();

            if ($count > 0) {
                $sale_code       = substr($this->model->select('kode')->where('id', $data->id)->first()->kode, 4);
                $this->maxCode = 'PNJ-' . sprintf("%04d", $sale_code + 1);
            } else {
                $this->maxCode = 'PNJ-0001';
            }
        } else {
            $sale_code       = substr($this->maxCode, 4);
            $this->maxCode   = 'PNJ-' . sprintf("%04d", $sale_code + 1);
        }

        return $this->maxCode;
    }
}
