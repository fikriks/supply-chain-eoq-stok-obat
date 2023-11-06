<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

class PermintaanObat extends ResourceController
{
    protected $modelName = 'App\Models\Pemesanan';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'permintaanMenungguKonfirmasi' => $this->model->where('status', 'DIVALIDASI_OLEH_MANAJER')->where('pemesanan.supplier_id', auth()->id())->withRelations(),
            'permintaanKirimObat' => $this->model->where('status', 'DIVALIDASI_OLEH_SUPPLIER')->orWhere('status', 'DIKIRIM')->where('pemesanan.supplier_id', auth()->id())->withRelations(),
            'permintaanSukses' => $this->model->where('status', 'PESANAN_DITERIMA')->where('pemesanan.supplier_id', auth()->id())->withRelations()
        ];

        return view('admin/permintaan-obat/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
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
        //
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
        $result =  $this->model->update($id, $this->request->getPost());

        if ($result) {
            session()->setFlashdata('message', 'Permintaan Obat diterima');
        } else {
            session()->setFlashdata('error', 'Edit Data Tidak Berhasil');
        }

        return redirect()->to('admin/permintaan-obat');
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
}
