<section class="content-main mt-50">
    <div class="card mx-auto card-login">
        <div class="card-body">
            <h4 class="card-title mb-4">Login</h4>
            <form action="<?= BASEURL; ?>/admin/authLogin" method="post">
                <div class="mb-3">
                    <input class="form-control" name="username" id="username" placeholder="Username or email" type="text">
                </div>
                <div class="mb-3">
                    <input class="form-control" name="password" id="password" placeholder="Password" type="password">
                </div>
                <div class="mb-3">
                    <?php Flasher::flash(); ?>
                </div>
                <div class="mb-3">
                    <a href="#" class="float-end font-sm text-muted">Forgot password?</a>
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input">
                        <span class="form-check-label">Remember</span>
                    </label>
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary w-100"> Login </button>
                </div>
            </form>
            <p class="text-center mb-4">Don't have account? <a href="<?= BASEURL; ?>/admin/register">Sign up</a></p>
        </div>
    </div>
</section>