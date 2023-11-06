<?php

namespace App\Controllers\Admin;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\RESTful\ResourceController;

class ObatSupplier extends ResourceController
{
    protected $modelName = 'App\Models\ObatSupplier';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        if (auth()->user()->inGroup('supplier')){
            $data['ObatSupplier'] = $this->model->withRelationsById(user_id())->findAll();
        } else {
            $data['ObatSupplier'] = $this->model->withRelations()->findAll();
        }

        return view('admin/obat-supplier/index', $data);
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
        return view('admin/obat-supplier/new');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if (!$this->validate([
            'nama' => 'required',
            'kategori_obat' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $requestObatSupplier = [
            'nama' =>  $this->request->getPost('nama'),
            'kategori_obat' =>  $this->request->getPost('kategori_obat'),
            'user_id' => auth()->id(),
            'stok' =>  $this->request->getPost('stok'),
            'harga' =>  $this->request->getPost('harga')
        ];

        $result = $this->model->save($requestObatSupplier);

        if ($result) {
            session()->setFlashdata('message', 'Tambah Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Tambah Data Tidak Berhasil');
        }

        return redirect()->to('admin/obat-supplier');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $data = [
            'obatSupplier' => $this->model->find($id)
        ];

        return view('admin/obat-supplier/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if (!$this->validate([
            'nama' => 'required',
            'kategori_obat' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $requestObatSupplier = [
            'nama' =>  $this->request->getPost('nama'),
            'kategori_obat' =>  $this->request->getPost('kategori_obat'),
            'user_id' => auth()->id(),
            'stok' =>  $this->request->getPost('stok'),
            'harga' =>  $this->request->getPost('harga')
        ];

        $result = $this->model->update($id, $requestObatSupplier);

        if ($result) {
            session()->setFlashdata('message', 'Edit Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Edit Data Tidak Berhasil');
        }

        return redirect()->to('admin/obat-supplier'); 
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

        return redirect()->to('admin/obat-supplier');
    }

    public function restObat($id)
    {
        $data = $this->model->where('user_id', $id)->findAll();

        echo json_encode($data);
    }

    public function restObatQty($id)
    {
        $data = $this->model->find($id);

        echo json_encode($data);
    }
}
