<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?= BASEURL; ?>/home" rel="nofollow">Home</a>
                <span></span> Login
            </div>
        </div>
    </div>
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3 class="mb-4">Masuk</h3>
                            </div>
                            <form action="<?= BASEURL; ?>/home/authLogin" method="post">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" placeholder="Username atau Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                        <?php Flasher::flash(); ?>
                                </div>
                                <br>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Masuk</button>
                                </div>
                                <div class="text-muted text-center">Tidak Punya Akun? <a href="<?= BASEURL; ?>/home/register">Daftar</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>