<section class="content-main mt-50">
    <div class="card mx-auto card-login">
        <div class="card-body">
            <h4 class="card-title mb-4">Buat Akun Baru</h4>
            <form action="<?= BASEURL; ?>/admin/authRegister" method="post">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control" name="username" id="username"  placeholder="Your username" type="text" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" name="email" id="email" placeholder="Your email" type="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" name="password" id="password" placeholder="Password" type="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Konfirmasi Password" type="password" required>
                </div>
                <div class="mb-3">
                    <?php Flasher::flash(); ?>
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                </div>
            </form>
            <p class="text-center mb-2">Sudah punya akun? <a href="<?= BASEURL; ?>/admin/login">Masuk</a></p>
        </div>
    </div>
</section>