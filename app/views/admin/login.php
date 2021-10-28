<section class="content-main mt-50">
    <div class="card mx-auto card-login">
        <div class="card-body">
            <h4 class="card-title mb-4">Masuk</h4>
            <form action="<?= BASEURL; ?>/admin/authLogin" method="post">
                <div class="mb-3">
                    <input class="form-control" name="username" id="username" placeholder="Username atau email" type="text" required>
                </div>
                <div class="mb-3">
                    <input class="form-control" name="password" id="password" placeholder="Password" type="password" required>
                </div>
                <div class="mb-3">
                    <?php Flasher::flash(); ?>
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary w-100"> Login </button>
                </div>
            </form>
            <p class="text-center mb-4">Tidak Punya Akun? <a href="<?= BASEURL; ?>/admin/register">Daftar</a></p>
        </div>
    </div>
</section>