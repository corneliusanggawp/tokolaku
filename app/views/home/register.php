<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?= BASEURL; ?>/home" rel="nofollow">Home</a>
                <span></span> Register
            </div>
        </div>
    </div>
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3 class="mb-30">Buat Akun Baru</h3>
                            </div>
                            <p class="mb-30 font-sm"> Data pribadi Anda akan digunakan untuk mendukung pengalaman Anda di seluruh situs web ini, untuk mengelola akses ke akun Anda. </p>
                            <form action="<?= BASEURL; ?>/home/authRegister" method="post">
                                <div class="form-group">
                                    <input type="text" required="" name="username" id="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" required="" name="email" id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input required="" type="password" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input required="" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm password">
                                </div>
                                    <div class="form-group"> <?php Flasher::flash(); ?>
                                </div>
                                <br>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Daftar</button>
                                </div>
                            </form>
                            <div class="text-muted text-center">Sudah punya akun? <a href="<?= BASEURL; ?>/home/login">Masuk</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>