<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Edit Pengguna
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('admin/pengguna') ?>" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/pengguna/' . $user->id_user) ?>" method="POST" class="form form-horizontal">
                <input type="hidden" name="_method" value="PUT" />

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="name" placeholder="Nama" value="<?= old('name') ?? $user->name ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Username</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username/Nama Pengguna" value="<?= old('username') ?? $user->username ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?= old('email') ?? $user->secret ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>No Telepon</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" class="form-control" name="telephone" placeholder="Nomor Telepon" value="<?= old('telephone') ?? $user->telephone ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="address" placeholder="Alamat" value="<?= old('address') ?? $user->address ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label>Password</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?= old('password') ?>">
                            <span class="text-muted">Kosongkan bila tidak ingin diubah</span>
                        </div>
                        <div class="col-md-4">
                            <label>Hak Akses</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="group" class="form-control" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach ($groups as $group) : ?>
                                    <option value="<?= $group ?>" <?= (old('group') ?? $user->group) == $group ? 'selected' : '' ?>><?= ucfirst($group) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                        </div>
                        <div class="col-sm-8 d-flex justify-content-start mt-3">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Basic Tables end -->
<?= $this->endSection() ?>