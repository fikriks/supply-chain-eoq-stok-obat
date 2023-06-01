<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

use App\Models\KategoriObat;
use App\Models\Satuan;
use App\Models\UserModel;

class Obat extends ResourceController
{
    private $KategoriObat, $Satuan, $User;
    protected $modelName = 'App\Models\Obat';

    public function __construct()
    {
        $this->KategoriObat = new KategoriObat();
        $this->Satuan = new Satuan();
        $this->User = new UserModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        if ($this->request->getGet()) {
            $data['obat'] = $this->model->withRelations()->where('obat.nama', $this->request->getGet('obat'))->findAll();
        } else {
            $data['obat'] = $this->model->withRelations()->findAll();
        }

        return view('admin/obat/index', $data);
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
        $data = [
            'kategoriObat' => $this->KategoriObat->findAll(),
            'satuanObat' => $this->Satuan->findAll(),
            'supplier' => $this->User->getIdentity()
        ];

        return view('admin/obat/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if (!$this->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kategori_obat_id' => 'required',
            'supplier_id' => 'required',
            'satuan_id' => 'required',
            'stok' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'expired' => 'required'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $result = $this->model->save($this->request->getPost());

        if ($result) {
            session()->setFlashdata('message', 'Tambah Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Tambah Data Tidak Berhasil');
        }

        return redirect()->to('admin/obat');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $data = [
            'kategoriObat' => $this->KategoriObat->findAll(),
            'satuanObat' => $this->Satuan->findAll(),
            'supplier' => $this->User->getIdentity(),
            'obat' => $this->model->find($id)
        ];

        return view('admin/obat/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if (!$this->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kategori_obat_id' => 'required',
            'supplier_id' => 'required',
            'satuan_id' => 'required',
            'stok' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'expired' => 'required'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $result = $this->model->update($id, $this->request->getPost());

        if ($result) {
            session()->setFlashdata('message', 'Edit Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Edit Data Tidak Berhasil');
        }

        return redirect()->to('admin/obat');
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

        return redirect()->to('admin/obat');
    }
}
