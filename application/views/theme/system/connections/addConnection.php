<div class="modal-dialog modal-open">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title pull-left">Add Connection</h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class='panel panel-body'>
                <form novalidate class="form-group" method="post" enctype="multipart/form-data"
                      action="<?= sysUrl('addConnection') ?>">

                    <div class="form-group">
                        <label>Customer</label>
                        <select name="conCusID" id="conCusSelect" class="form-group" style="width: 100%"></select>
                        <span id="conCusSelect_result"></span>
                    </div>

                    <div class="form-group">
                        <label>Package</label>
                        <select name="conPackID" id="conPackSelect" class="form-group" style="width: 100%"></select>
                        <span id="conPackSelect_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="conStart">Start Date</label>
                        <input type="text" class="form-control" name="conStart" id="conStart">
                        <span id="conStart_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="conDetail">Detail</label>
                        <input class="form-control" name="conDetail" id="conDetail"
                               placeholder="If Real IP, state usernane and password by seperating ; else state share ip">
                        <span id="conDetail_result"></span>
                    </div>
                    <br/>
                    <br/>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="addConnectionBtn">Add Connection</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#conCusSelect').select2({
            placeholder: 'Select Customer',
            ajax: {
                url: '<?=sysUrl("selectCustomer")?>',
                dataType: 'json',
                processResults: function (data) {
                    //console.log(data)
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('#conPackSelect').select2({
            placeholder: 'Select Package',
            ajax: {
                url: '<?=sysUrl("selectPackage")?>',
                dataType: 'json',
                processResults: function (data) {
                    //console.log(data)
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('#conStart').daterangepicker({
            parentEl: ".modal-body",
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'), 10),
            locale: {
                format: 'DD MMMM, Y'
            }
        });


        $('#addConnectionBtn').on('click', function (event) {
            if ($('#conStart').val() == '') {
                event.preventDefault();
                $('#conStart_result').html('<label class="danger text-uppercase text-bold-600">Enter Start Date !!</label>');
            }
            if ($('#conDetail').val() == '') {
                event.preventDefault();
                $('#conDetail_result').html('<label class="danger text-uppercase text-bold-600">Enter Details !!</label>');
            }

            if ($("select#conCusSelect").children("option:selected").val() == undefined) {
                event.preventDefault();
                $('#conCusSelect_result').html('<label class="danger text-uppercase text-bold-600">Select Customer !!</label>');
            }

            if ($("select#conPackSelect").children("option:selected").val() == undefined) {
                event.preventDefault();
                $('#conPackSelect_result').html('<label class="danger text-uppercase text-bold-600">Select Package !!</label>');
            }

        });
    });
</script>
<style>
    .select2-container {
        z-index: 100000;
    }
</style>


