<div class="modal-dialog modal-open">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title pull-left">Add Customer</h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class='panel panel-body'>
                <form novalidate class="form-group" method="post" enctype="multipart/form-data"
                      action="<?= sysUrl('addCustomer') ?>">

                    <div class="form-group">
                        <label for="cusName">Name</label>
                        <input type="text" class="form-control" name="cusName" id="cusName">
                        <span id="cusName_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="cusEmail">Email</label>
                        <input type="email" class="form-control" name="cusEmail" id="cusEmail">
                    </div>

                    <div class="form-group">
                        <label for="cusPhone">Phone</label>
                        <input type="text" class="form-control" name="cusPhone" id="cusPhone">
                        <span id="cusPhone_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="cusAddress">Address</label>
                        <input type="text" class="form-control" name="cusAddress" id="cusAddress">
                    </div>
                    <div class="form-group">
                        <label for="cusStatus">Status</label>
                        <select class="form-control" name="cusStatus">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>City</label>
                        <select name="cusCityID" id="cusCitySelect" class="form-group" style="width: 100%"></select>
                        <span id="cusCitySelect_result"></span>
                    </div>

                    <div class="form-group">
                        <label>Area</label>
                        <select name="cusAreaID" id="cusAreaSelect" class="form-group" style="width: 100%"></select>
                        <span id="cusAreaSelect_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="cusImage">Image</label>
                        <input class="form-control border-bottom-3 " type="file" multiple name="cusImage"
                               autocomplete="off"
                               accept="image/*">
                    </div>
                    <br/>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="addCustomerBtn">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#cusPhone').change(function () {
            let cusPhone = $('#cusPhone').val();
            if (cusPhone != '') {
                $.ajax({
                    url: "<?=sysUrl("checkCusPhoneAvailability")?>",
                    method: "POST",
                    data: {cusPhone},
                    success: function (data) {
                        $('#cusPhone_result').html(data);
                    }
                });
            }
        });

        $('#cusCitySelect').on('change').select2({
            placeholder: 'Select City',
            ajax: {
                url: '<?=sysUrl("selectCityForArea")?>',
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
        $('#cusCitySelect').on('change', function () {
            var cityID = $("select#cusCitySelect").children("option:selected").val();
            $('#cusAreaSelect').select2({
                placeholder: 'Select Area',
                ajax: {
                    url: '<?=sysUrl("selectAreaForCustomer/")?>' + cityID,
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
        });


        $('#addCustomerBtn').on('click', function (event) {
            if ($('#cusName').val() == '') {
                event.preventDefault();
                // $.dialog('<p class="danger text-uppercase text-bold-600">Enter Name first !!</p>');
                $('#cusName_result').html('<label class="danger text-uppercase text-bold-600">Enter Name !!</label>');
            }

            if ($('#cusPhone').val() == '') {
                event.preventDefault();
                $('#cusPhone_result').html('<label class="danger text-uppercase text-bold-600">Enter Phone !!</label>');
            }

            if ($("select#cusCitySelect").children("option:selected").val() == undefined) {
                event.preventDefault();
                $('#cusCitySelect_result').html('<label class="danger text-uppercase text-bold-600">Select City !!</label>');
            }

            if ($("select#cusAreaSelect").children("option:selected").val() == undefined) {
                event.preventDefault();
                $('#cusAreaSelect_result').html('<label class="danger text-uppercase text-bold-600">Select Area !!</label>');
            }

        });
    });
</script>
<style>
    .select2-container {
        z-index: 100000;
    }
</style>


