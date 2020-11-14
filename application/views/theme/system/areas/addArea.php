<div class="modal-dialog modal-open">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title pull-left">Add Area</h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <fieldset class='panel panel-body'>
                <form novalidate class="form-group" method="post"
                      action="<?= sysUrl('addArea') ?>">
                    <fieldset class="form-group">
                        <label for="areaName">Area: Name</label>
                        <input type="text" class="form-control" name="areaName" id="areaName">
                        <span id="areaName_result"></span>
                    </fieldset>
                    <fieldset class="form-group">
                        <label>Area: City</label>
                        <select name="areaCityID" id="areaCitySelect" class="form-group" style="width: 100%"></select>
                        <span id="areaCitySelect_result"></span>
                    </fieldset>
                    <fieldset class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="addAreaBtn">Add Area</button>
                    </fieldset>
                </form>
            </fieldset>
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
                    url: "<?=sysUrl("checkAreaAvailability")?>",
                    method: "POST",
                    data: {areaName},
                    success: function (data) {
                        $('#areaName_result').html(data);
                    }
                });
            }
        });


        $('#addAreaBtn').on('click', function (event) {
            validate(event, 'areaName', 'areaName_result', 'Enter Area Name !!')
            let customCondition = $("select#areaCitySelect").children("option:selected").val() == undefined
            validate(event, 'select#areaCitySelect', 'areaCitySelect_result', 'Select City !!', customCondition)
        });

        $('#areaCitySelect').select2({
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
    });
</script>

<style>
    .select2-container {
        z-index: 100000;
    }
</style>

