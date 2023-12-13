<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Models\Obat;
use App\Models\ObatSupplier;

class Pemesanan extends ResourceController
{
    private $Obat, $User, $ObatSupplier;
    protected $modelName = 'App\Models\Pemesanan';

    public function __construct()
    {
        $this->Obat = new Obat();
        $this->User = new UserModel();
        $this->ObatSupplier = new ObatSupplier();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'permintaanMenungguKonfirmasi' => $this->model->where('status', 'MENUNGGU_KONFIRMASI_MANAJER')->withRelations(),
            'pesananDikirim' => $this->model->where('status', 'DIKIRIM')->withRelations(),
            'pesananDiterima' => $this->model->where('status', 'PESANAN_DITERIMA')->withRelations()
        ];

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
            'obat' => $this->ObatSupplier->findAll(),
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

        $obatSupplier = $this->ObatSupplier->find($request['obat_id']);
        $kurangiStokObat = $obatSupplier->stok - $request['qty'];
        $this->ObatSupplier->update($obatSupplier->id, [
            'stok' => $kurangiStokObat
        ]);

        $hargaObat = $obatSupplier->harga;
        $request['supplier_id'] = $this->User->find($this->request->getPost('supplier_id'))->id;
        $request['total_harga'] = $request['qty'] * $hargaObat;
        $request['status'] = "MENUNGGU_KONFIRMASI_MANAJER";

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
            'obat' => $this->ObatSupplier->findAll(),
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
        if ($this->request->getPost('status')) {
            $result =  $this->model->update($id, $this->request->getPost());

            $obat = $this->Obat->where('kode', $this->request->getPost('kode_obat'))->first();

            if($obat){
                // Pengurangan Stok
                $stok = $obat->stok + $this->request->getPost('kuantitas');

                $this->Obat->update($obat->id, [
                    'stok' => $stok
                ]);
                // End Pengurangan Stok
            }  else {
                $obatSupplier = $this->ObatSupplier->where('kode', $this->request->getPost('kode_obat'))->first();

                $this->Obat->save([
                    'kode' => $obatSupplier->kode,
                    'nama'=> $obatSupplier->nama,
                    'kategori_obat_id' => $obatSupplier->kategori_obat_id,
                    'supplier_id' => $obatSupplier->user_id,
                    'satuan_id' => $obatSupplier->satuan_id,
                    'stok' => $this->request->getPost('kuantitas'),
                    'harga_beli' => $obatSupplier->harga,
                    'harga_jual' => $obatSupplier->harga + 2000,
                    'expired' => $obatSupplier->expired,
                ]);
            }
           
            if ($result) {
                session()->setFlashdata('message', 'Obat Telah diterima');
            } else {
                session()->setFlashdata('error', 'Edit Data Tidak Berhasil');
            }

            return redirect()->to('admin/pemesanan');
        }

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
        $request['supplier_id'] = auth()->id();

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
