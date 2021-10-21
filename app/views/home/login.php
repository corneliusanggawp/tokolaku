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
                                <h3 class="mb-4">Log In</h3>
                            </div>
                            <form action="<?= BASEURL; ?>/home/authLogin" method="post">
                                <div class="form-group">
                                    <input type="text" required="" name="username" id="username" placeholder="Username or Email">
                                </div>
                                <div class="form-group">
                                    <input required="" type="password" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                        <?php Flasher::flash(); ?>
                                </div>
                                <div class="login_footer form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                            <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                        </div>
                                    </div>
                                    <a class="text-muted" href="#">Forgot password?</a>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Log in</button>
                                </div>
                                <div class="text-muted text-center">Don't have account? <a href="<?= BASEURL; ?>/home/register">Sign Up</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>