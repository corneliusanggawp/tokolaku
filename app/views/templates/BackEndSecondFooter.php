<footer class="main">
    <div class="container pb-20 wow fadeIn animated">
        <div class="row">
            <div class="col-lg-12">
                <p class="text-center font-sm text-muted mb-0">&copy; 2021 | <strong class="text-brand"><?= APPNAME; ?></strong> - Ecommerce Webiste </p>
            </div>
            <div class="col-lg-12">
                <p class="text-center font-sm text-muted mb-0"> Develop by <?= DEVELOPER; ?> | All rights reserved </p>
            </div>
        </div>
    </div>
</footer>
</main>
<script src="<?= BASEURL; ?>/backend/js/vendors/jquery-3.6.0.min.js"></script>
<script src="<?= BASEURL; ?>/backend/js/vendors/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL; ?>/backend/js/vendors/jquery.fullscreen.min.js"></script>
<!-- Main Script -->
<script src="<?= BASEURL; ?>/backend/js/main.js" type="text/javascript"></script>
<!-- Sweet Alert -->
<script src="<?= BASEURL; ?>/vendor/SweetAlert/sweetalert2.all.min.js"></script>
<?= SweetAlert::sweetAlert() ?>
<?= SweetAlert::sweetToast() ?> 
</body>

</html>