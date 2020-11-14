<div class="modal-dialog modal-open">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title pull-left">Add City</h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class='panel panel-body'>
                <form novalidate class="form-group" method="post"
                      action="<?= sysUrl('addCity') ?>">

                    <div class="form-group">
                        <label for="cityName">City Name</label>
                        <input type="text" class="form-control" name="cityName" id="cityName">
                        <span id="cityName_result"></span>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="addCityBtn">Add Area</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#cityName').change(function () {
            let cityName = $('#cityName').val();
            if (cityName != '') {
                $.ajax({
                    url: "<?=sysUrl("checkCityAvailability")?>",
                    method: "POST",
                    data: {cityName},
                    success: function (data) {
                        $('#cityName_result').html(data);
                    }
                });
            }
        });
        $('#addCityBtn').on('click', function (event) {
            if ($('#cityName').val() == '') {
                event.preventDefault();
                // $.dialog('<p class="danger text-uppercase text-bold-600">Enter Name first !!</p>');
                $('#cityName_result').html('<label class="danger text-uppercase text-bold-600">Enter City Name !!</label>');
            }
        });
    });
</script>

