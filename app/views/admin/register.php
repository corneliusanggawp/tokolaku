<section class="content-main mt-50">
    <div class="card mx-auto card-login">
        <div class="card-body">
            <h4 class="card-title mb-4">Create an Account</h4>
            <form action="<?= BASEURL; ?>/admin/authRegister" method="post">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control" name="username" id="username"  placeholder="Your username" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" name="email" id="email" placeholder="Your email" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" name="password" id="password" placeholder="Password" type="password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm password</label>
                    <input class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" type="password">
                </div>
                <div class="mb-3">
                    <p class="small text-center text-muted">By signing up, you confirm that you’ve read and accepted our User Notice and Privacy Policy.</p>
                </div>
                <div class="mb-3">
                    <?php Flasher::flash(); ?>
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary w-100"> Register </button>
                </div>
            </form>
            <p class="text-center mb-2">Already have an account? <a href="<?= BASEURL; ?>/admin/login">Sign in now</a></p>
        </div>
    </div>
</section>