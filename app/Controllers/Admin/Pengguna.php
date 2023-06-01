<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Models\GroupModel;

class Pengguna extends ResourceController
{
    private $UserIdentity, $GroupModel;
    protected $modelName = 'App\Models\UserModel';

    public function __construct()
    {
        $this->UserIdentity = new UserIdentityModel();
        $this->GroupModel = new GroupModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'users' => $this->model->getIdentity(),
            'identities' => $this->UserIdentity->findAll()
        ];

        return view('admin/pengguna/index', $data);
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
        $data['groups'] = ['admin', 'manajer', 'staff', 'supplier', 'pegawai'];

        return view('admin/pengguna/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if (!$this->validate([
            'name' => 'required|min_length[3]',
            'username' => 'required|is_unique[users.username]',
            'email' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'group' => 'required|in_list[admin,manajer,staff,supplier,pegawai]',
            'password' => 'required|min_length[7]'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->to('admin/pengguna');
        }

        $request = [
            'username' => str_replace(' ', '', strtolower($this->request->getPost('username'))),
            'telephone' => $this->request->getPost('telephone'),
            'address' => $this->request->getPost('address'),
            'active' => 1
        ];

        $result = $this->model->save($request);
        $userId = $this->model->getInsertID();

        $requestIdentity = [
            'user_id' => $userId,
            'type' => 'email_password',
            'name' => $this->request->getPost('name'),
            'secret' => $this->request->getPost('email'),
            'secret2' => password_hash(base64_encode(hash('sha384', $this->request->getPost('password'), true)), PASSWORD_DEFAULT)
        ];

        $this->UserIdentity->save($requestIdentity);

        $requestGroup = [
            'user_id' => $userId,
            'group' => $this->request->getPost('group')
        ];

        $this->GroupModel->save($requestGroup);

        if ($result) {
            session()->setFlashdata('message', 'Tambah Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Tambah Data Tidak Berhasil');
        }

        return redirect()->to('admin/pengguna');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $data = [
            'groups' => ['admin', 'manajer', 'staff', 'supplier', 'pegawai'],
            'user' => $this->model->getIdentityById($id)
        ];

        return view('admin/pengguna/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if (!$this->validate([
            'name' => 'required|min_length[3]',
            'username' => 'required|is_unique[users.username,id,' . $id . ']',
            'email' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'group' => 'required|in_list[admin,manajer,staff,supplier,pegawai]',
            'password' => 'permit_empty|min_length[7]'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->to('admin/pengguna');
        }

        $request = [
            'username' => str_replace(' ', '', strtolower($this->request->getPost('username'))),
            'telephone' => $this->request->getPost('telephone'),
            'address' => $this->request->getPost('address'),
            'active' => 1
        ];

        $result = $this->model->update($id, $request);

        $identityId = $this->UserIdentity->select('id AS identity_id')->where('user_id', $id)->first()->identity_id;

        $requestIdentity = [
            'id' => $identityId,
            'user_id' => $id,
            'type' => 'email_password',
            'name' => $this->request->getPost('name'),
            'secret' => $this->request->getPost('email')
        ];

        if (!empty($this->request->getPost('password'))) {
            $requestIdentity += [
                'secret2' => password_hash(base64_encode(hash('sha384', $this->request->getPost('password'), true)), PASSWORD_DEFAULT)
            ];
        }
        $this->UserIdentity->save($requestIdentity);

        $user = $this->model->find($id);
        $user->syncGroups($this->request->getPost('group'));

        if ($result) {
            session()->setFlashdata('message', 'Edit Data Berhasil');
        } else {
            session()->setFlashdata('error', 'Edit Data Tidak Berhasil');
        }

        return redirect()->to('admin/pengguna');
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

        return redirect()->to('admin/pengguna');
    }
}
