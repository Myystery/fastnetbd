<div class="modal-dialog modal-open">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title pull-left">Update: <?= $updateArea->areaName ?></h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class='panel panel-body'>
                <form novalidate class="form-group" method="post"
                      action="<?= sysUrl('updateArea/' . $updateArea->areaID) ?>">
                    <div class="form-group">
                        <label for="areaName">Area Name</label>
                        <input type="text" class="form-control" name="areaName" id="areaName"
                               value="<?= $updateArea->areaName ?>">
                        <span id="areaName_result"></span>
                    </div>
                    <div class="form-group">
                        <label for="areaCityID">Area: City</label>
                        <select name="areaCityID" id="areaCityID" class="form-group" style="width: 100%"></select>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="addCityBtn">Update Area</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#areaName').change(function () {
            let areaName = $('#areaName').val();
            if (areaName != '') {
                $.ajax({
                    url: "<?=sysUrl("checkAreaAvalibility")?>",
                    method: "POST",
                    data: {areaName},
                    success: function (data) {
                        $('#areaName_result').html(data);
                    }
                });
            }
        });


        $('#addAreaBtn').on('click', function (event) {
            if ($('#areaName').val() == '') {
                event.preventDefault();
                // $.dialog('<p class="danger text-uppercase text-bold-600">Enter Name first !!</p>');
                $('#areaName_result').html('<label class="danger text-uppercase text-bold-600">Enter Area Name !!</label>');
            }
        });

        $('#areaCityID').select2({
            placeholder: 'Select City',
            ajax: {
                url: '<?=sysUrl("selectCityForArea")?>',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    });
    var newOption = new Option("<?= $chCity->cityName ?>", <?= $chCity->cityID ?>, false, false);
    $('#areaCityID').append(newOption).trigger('change');

</script>

