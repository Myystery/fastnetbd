<?php
/*
 * Author Suraya Islam Mim <suraiyaislam30@gmail.com>
 * Dont change without permission
 */
?>
</div>
</div>
</div>

<?php if ($navBarSettings["mainContentCard"]) { ?>
    <!--footer-->
    <footer class="footer footer-static footer-light navbar-border">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">Copyright &copy; <?= date("Y") ?> All rights reserved.</span>
            <span class="float-md-right d-block d-md-inline-block d-none d-lg-block text-align-right">Developed By <a
                        href="https://www.facebook.com/suraiya.mim.12" target="blank">mim</a></span>
        </p>
    </footer>
<?php } ?>

<!--loading animation-->
<div class="loader"
     style='    background: url(<?= propertyUrl("images/loading.GIF") ?>) no-repeat scroll 50% 50% rgba(200,220,255,.7);
             height: 100%;    left: 0;    position: fixed;    top: 0;    width: 100%;    z-index: 999999999;'></div>

<!--Modal PopUp-->
<div class="modal fade" id="remoteModal1" role="dialog" aria-hidden="true"></div>
<div class="modal fade" id="remoteModal2" role="dialog" aria-hidden="true"
     style="z-index: 99999; background: rgba(1,1,1,.5);"></div>

<!--Start vendor js-->
<script src="<?= propertyUrl() ?>js/vendors.min.js" type="text/javascript"></script>
<script src="<?= propertyUrl() ?>js/jquery/popper.min.js" type="text/javascript"></script>
<script src="<?= propertyUrl() ?>js/core/bootstrap.min.js" type="text/javascript"></script>

<script src="<?= propertyUrl() ?>js/core/app.js" type="text/javascript"></script>
<script src="<?= propertyUrl() ?>js/core/app-menu.js" type="text/javascript"></script>

<script src="<?= propertyUrl() ?>js/charts/morris.min.js" type="text/javascript"></script>
<script src="<?= propertyUrl() ?>js/charts/raphael.min.js" type="text/javascript"></script>

<script src="<?= propertyUrl() ?>js/forms/form-login-register.min.js"></script>
<script src=" <?= propertyUrl() ?>js/forms/select/select2.full.min.js"></script>
<script src="<?= propertyUrl() ?>js/forms/validation/jqBootstrapValidation.js"
        type="text/javascript"></script>

<script src="<?= propertyUrl() ?>js/pickers/dateTime/moment-with-locales.min.js"
        type="text/javascript"></script>
<script src="<?= propertyUrl() ?>js/pickers/dateTime/bootstrap-datetimepicker.min.js"
        type="text/javascript"></script>
<script src="<?= propertyUrl() ?>js/pickers/daterange/daterangepicker.js"
        type="text/javascript"></script>

<script src="<?= propertyUrl() ?>js/extensions/redoctor.js" type="text/javascript"></script>
<script src="<?= propertyUrl() ?>js/extensions/toastr.min.js" type="text/javascript"></script>

<script src="<?= propertyUrl() ?>js/datatables/datatables.min.js"></script>

<script src="<?= propertyUrl() ?>js/jquery/jquery-ui.min.js"></script>
<script src="<?= propertyUrl() ?>js/jquery/jquery-confirm.min.js"></script>
<script src="<?= propertyUrl() ?>js/jquery/jquery.fancybox.js" type="text/javascript"></script>

<script src="<?= propertyUrl() ?>js/scripts.js" type="text/javascript"></script>
<script src="<?= propertyUrl() ?>js/custom.js" type="text/javascript"></script>
<!-- End vendor js-->

<!--Effect animation-->
<script>
    if (document.getElementById("content-nav-right")) {
        $("#nav-right-container").html($("#content-nav-right").html());
        $("#content-nav-right").remove();
    }

    if ($("#accounting")) {
        $("#accounting").fancybox({
            fitToView: false,
            width: '95%',
            height: '95%',
            autoSize: false,
            closeClick: false,
            openEffect: 'none',
            closeEffect: 'none'
        });
    }

    function validate(e, field, des, msg, customCondition = null) {
        if ($('#' + field).val() == '' || customCondition) {
            e.preventDefault();
            $('#' + des).html('<label class="danger text-uppercase text-bold-600">' + msg + '</label>');
        } else
            $('#' + des).html('')
    }

</script>

<!--Toaster effect options-->
<script>
    <?php  if ($navBarSettings["topAlert"]) {?>
    // $('.loader').show();
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "5000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    <?php
    if (isset($_SESSION["altMsg"])) {
    ?>
    toastr['<?= isset($_SESSION["altMsgType"]) ? $_SESSION["altMsgType"] : "info" ?>'](" <?= $_SESSION['altMsg'] ?>");
    <?php
    unset($_SESSION["altMsg"]);
    }
    ?>
    <?php } ?>
</script>

<style>
    .ui-icon-circle-triangle-w {
        border: solid black;
        border-width: 0 2px 2px 0;
        display: inline-block;
        padding: 5px;
        transform: rotate(135deg);
        -webkit-transform: rotate(135deg);
    }

    .ui-icon-circle-triangle-e {
        border: solid black;
        border-width: 0 2px 2px 0;
        display: inline-block;
        padding: 5px;
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
    }
</style>
</body>
</html>