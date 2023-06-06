<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

class ValidasiPemesanan extends ResourceController
{
    protected $modelName = 'App\Models\Pemesanan';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['pemesanan'] = $this->model->where('status', 'MENUNGGU_KONFIRMASI')->withRelations();

        return view('admin/validasi-pemesanan/index', $data);
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
            session()->setFlashdata('message', 'Edit Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Edit Data Tidak Berhasil');
        }

        return redirect()->to('admin/validasi-pemesanan');
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
