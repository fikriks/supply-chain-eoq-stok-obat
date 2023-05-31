<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="row h-100">
    <div class="col-lg-5 col-12">

        <div id="auth-left">
            <div class="auth-logo">
            </div>

            <h1 class="auth-title">Log in.</h1>

            <?php if (session('error') !== null) : ?>
                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
            <?php endif ?>

            <?php if (session('message') !== null) : ?>
                <div class="alert alert-success" role="alert"><?= session('message') ?></div>
            <?php endif ?>

            <form action="<?= site_url('/') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="username" class="form-control form-control-xl" placeholder="Username" value="<?= old('username') ?>" autofocus="" autocomplete="off" required>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" value="" autocomplete="off" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>
<?= $this->endSection() ?>