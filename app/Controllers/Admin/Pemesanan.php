<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Models\Obat;

class Pemesanan extends ResourceController
{
    private $Obat, $User;
    protected $modelName = 'App\Models\Pemesanan';

    public function __construct()
    {
        $this->Obat = new Obat();
        $this->User = new UserModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['pemesanan'] = $this->model->withRelations();

        return view('admin/pemesanan/index', $data);
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
            'kode' => $this->_generateCode(),
            'obat' => $this->Obat->findAll(),
            'supplier' => $this->User->getIdentity()
        ];

        return view('admin/pemesanan/new', $data);
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
            'obat_id' => 'required',
            'supplier_id' => 'required',
            'qty' => 'required'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }

        $request = $this->request->getPost();
        $hargaObat = $this->Obat->find($request['obat_id'])->harga_beli;
        $request['user_id'] = auth()->id();
        $request['total_harga'] = $request['qty'] * $hargaObat;
        $request['status'] = "MENUNGGU_KONFIRMASI";

        $result = $this->model->save($request);

        if ($result) {
            session()->setFlashdata('message', 'Tambah Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Tambah Data Tidak Berhasil');
        }

        return redirect()->to('admin/pemesanan');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $data = [
            'pemesanan' => $this->model->find($id),
            'obat' => $this->Obat->findAll(),
            'supplier' => $this->User->getIdentity()
        ];

        return view('admin/pemesanan/edit', $data);
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
            'obat_id' => 'required',
            'supplier_id' => 'required',
            'qty' => 'required'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->to('admin/pemesanan');
        }

        $request = $this->request->getPost();
        $request['user_id'] = auth()->id();

        $result =  $this->model->update($id, $request);

        if ($result) {
            session()->setFlashdata('message', 'Edit Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Edit Data Tidak Berhasil');
        }

        return redirect()->to('admin/pemesanan');
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

        return redirect()->to('admin/pemesanan');
    }

    protected $maxCode = null;
    public function _generateCode()
    {
        if ($this->maxCode == null) {
            $count = $this->model->countAll();
            $data = $this->model->selectMax('id')->first();

            if ($count > 0) {
                $sale_code       = substr($this->model->select('kode')->where('id', $data->id)->first()->kode, 4);
                $this->maxCode = 'PMS-' . sprintf("%04d", $sale_code + 1);
            } else {
                $this->maxCode = 'PMS-0001';
            }
        } else {
            $sale_code       = substr($this->maxCode, 4);
            $this->maxCode   = 'PMS-' . sprintf("%04d", $sale_code + 1);
        }

        return $this->maxCode;
    }
}
