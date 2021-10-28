<footer class="main-footer font-xs">
    <div class="row pb-30 pt-15">
        <div class="col-sm-6">
            <script>
            document.write(new Date().getFullYear())
            </script> © | <?= APPNAME; ?> - Ecommerce Webiste
        </div>
        <div class="col-sm-6">
            <div class="text-sm-end"> All rights reserved </div>
        </div>
    </div>
</footer>
</main>
<script src="<?= BASEURL; ?>/backend/js/vendors/jquery-3.6.0.min.js"></script>
<script src="<?= BASEURL; ?>/backend/js/vendors/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL; ?>/backend/js/vendors/select2.min.js"></script>
<script src="<?= BASEURL; ?>/backend/js/vendors/perfect-scrollbar.js"></script>
<script src="<?= BASEURL; ?>/backend/js/vendors/jquery.fullscreen.min.js"></script>
<script src="<?= BASEURL; ?>/backend/js/vendors/chart.js"></script>
<!-- Sweet Alert -->
<script src="<?= BASEURL; ?>/vendor/SweetAlert/sweetalert2.all.min.js"></script>
<?= SweetAlert::sweetAlert() ?>
<?= SweetAlert::sweetToast() ?>
<!-- Croppie -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<!-- Main Script -->
<script src="<?= BASEURL; ?>/backend/js/main.js" type="text/javascript"></script>
<script src="<?= BASEURL; ?>/backend/js/custom-chart.js" type="text/javascript"></script>
<script src="<?= BASEURL; ?>/js/script.js"></script>
</body>

</html>