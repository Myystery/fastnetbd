<div class="modal-dialog modal-open modal-lg">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title">Payment Details </h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class='panel panel-body'>
                <table class="table table-bordered ">
                    <tr class="text-center font-weight-bold text-uppercase">
                        <td colspan="2">Customer's Information</td>
                    </tr>
                    <tr>
                        <td>Customer's Photo</td>
                        <td><img height="50px" width="50px" class="rounded"
                                 src="<?= uploadUrl($customerInfo->cusImage) ?>"/></td>
                    </tr>
                    <tr>
                        <td>Customer's Name</td>
                        <td><?= $customerInfo->cusName ?></td>
                    </tr>
                    <tr>
                        <td>Customer's Email</td>
                        <td><?= $customerInfo->cusEmail ?></td>
                    </tr>
                    <tr>
                        <td>Customer's Phone</td>
                        <td><?= $customerInfo->cusPhone ?></td>
                    </tr>
                    <tr>
                        <td>Customer's Address</td>
                        <td><?= $customerInfo->cusAddress ?></td>
                    </tr>

                    <tr class="text-center font-weight-bold text-uppercase">
                        <td colspan="2">Package's Information</td>
                    </tr>
                    <tr>
                        <td>Package's Name</td>
                        <td><?= $packageInfo->pName ?></td>
                    </tr>
                    <tr>
                        <td>Package's Details</td>
                        <td>
                            <icon class="fa fa-arrow-alt-circle-right"></icon> <?= $packageInfo->pBandwidth ?> <br>
                            <icon class="fa fa-arrow-alt-circle-right"></icon> <?= $packageInfo->pConnectionType ?> <br>
                            <icon class="fa fa-arrow-alt-circle-right"></icon> <?= $packageInfo->pIpType ?> IP <br>
                            <icon class="fa fa-arrow-alt-circle-right"></icon> <?= $packageInfo->pOthers ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Package's Rate</td>
                        <td>
                            <?= $packageInfo->pRate ?> /Month
                        </td>
                    </tr>

                    <tr class="text-center font-weight-bold text-uppercase">
                        <td colspan="2">Connection Information</td>
                    </tr>
                    <tr>
                        <td>Connection Start</td>
                        <td><?= changeDateFormatToLong($conInfo->conStart) ?></td>
                    </tr>
                </table>

                <div class="col-12 text-center text-white">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                        <p>&nbsp; Close &nbsp;</p>
                    </button>
                    <button type="button" id="paymentBtn" class="btn btn-sm btn-success">
                        <p>Payment</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#paymentBtn').on('click', function () {
        $.confirm({
            icon: 'fa fa-file-invoice',
            title: "Payment Confirmation!!",
            theme: 'modern',
            animation: 'scale',
            closeAnimation: 'scale',
            type: 'blue',
            draggable: true,

            content: ' ' +
                '<div class="form-group">' +
                '<select name="selectMonth" id="selectMonth" class="form-control border-bottom-3"> ' +
                '<option value="Jan<?=getCurrentYearOnly()?>">January - <?=getCurrentYearOnly()?></option>' +
                '<option value="Feb<?=getCurrentYearOnly()?>">February - <?=getCurrentYearOnly()?></option>' +
                '<option value="Mar<?=getCurrentYearOnly()?>">March - <?=getCurrentYearOnly()?></option>' +
                '<option value="Apr<?=getCurrentYearOnly()?>">April - <?=getCurrentYearOnly()?></option>' +
                '<option value="May<?=getCurrentYearOnly()?>">May - <?=getCurrentYearOnly()?></option>' +
                '<option value="Jun<?=getCurrentYearOnly()?>">June - <?=getCurrentYearOnly()?></option>' +
                '<option value="Jul<?=getCurrentYearOnly()?>">July - <?=getCurrentYearOnly()?></option>' +
                '<option value="Aug<?=getCurrentYearOnly()?>">August - <?=getCurrentYearOnly()?></option>' +
                '<option value="Sep<?=getCurrentYearOnly()?>">September - <?=getCurrentYearOnly()?></option>' +
                '<option value="Oct<?=getCurrentYearOnly()?>">October - <?=getCurrentYearOnly()?></option>' +
                '<option value="Nov<?=getCurrentYearOnly()?>">November - <?=getCurrentYearOnly()?></option>' +
                '<option value="Dec<?=getCurrentYearOnly()?>">December - <?=getCurrentYearOnly()?></option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<input type="text" id="paymentNote" placeholder="Note [Optional]" class="form-control border-bottom-3"/>' +
                '</div>' +
                '<input class="form-control border-bottom-3" value="<?= $packageInfo->pRate?>"/>',

            buttons: {
                cancel: {
                    btnClass: 'btn-red',
                },
                confirm: {
                    btnClass: 'btn-blue',
                    action: function () {
                        var paymentNote = this.$content.find('#paymentNote').val();
                        var selectedMonth = this.$content.find('select#selectMonth').children("option:selected").val();
                        if (!selectedMonth) {
                            $.alert('<p class="red">Provide a valid month to make change!</p>');
                            return false;
                        } else {
                            saveInvoice(selectedMonth, paymentNote)
                        }
                    }
                }
            }
        });
    });

    function saveInvoice(month, note) {
        payment = {
            payConID: <?=$conInfo->conID?>,
            payAmount: <?=$packageInfo->pRate?>,
            payNote: note,
            payMonth: month
        };
        $.ajax({
            data: payment,
            dataType: 'json',
            method: 'post',
            url: "<?= sysUrl('payment')?>"
        }).done(function (res) {
            window.location.assign("<?=sysUrl("invoice/")?>" + res['conID'] + "/" + res['payID']);
            //console.log(res);
        }).fail(function (err) {
            console.log(err);
        });
    }
</script>
