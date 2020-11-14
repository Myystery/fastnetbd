<div class="modal-dialog modal-open">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title pull-left">Update '<?= $updatePackage->pName ?>' Package</h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class='panel panel-body'>
                <form novalidate class="form-group" method="post"
                      action="<?= sysUrl('updatePackage/' . $updatePackage->pID) ?>">

                    <div class="form-group">
                        <label for="name">Package Name</label>
                        <input type="text" class="form-control" name="pName" id="pName"
                               value="<?= $updatePackage->pName ?>">
                        <span id="pName_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="pBandwidth">Bandwidth</label>
                        <select class="form-control" name="pBandwidth" id="pBandwidth">
                            <option value="<?= $updatePackage->pBandwidth ?>"
                                    selected> <?= $updatePackage->pBandwidth ?> </option>
                            <?php for ($i = 1; $i < 51; $i++) { ?>
                                <option value="<?= $i ?> Mbps"><?= $i ?> Mbps</option>
                            <?php } ?>
                            <option value="Dedicated">Dedicated</option>
                        </select>
                        <span id="pBandwidth_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="address">Rate (BD)</label>
                        <input type="number" class="form-control" name="pRate" id="pRate"
                               value="<?= $updatePackage->pRate ?>">
                        <span id="pRate_result"></span>
                    </div>


                    <div class="form-group">
                        <label for="contact">Other Facilities</label>
                        <input type="text" class="form-control" name="pOthers" id="pOthers"
                               value="<?= $updatePackage->pOthers ?>">
                        <span id="contact_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="pConnectionType">Connection Type</label>
                        <select class="form-control" name="pConnectionType" id="pConnectionType">
                            <option value="<?= $updatePackage->pConnectionType ?>"
                                    selected> <?= $updatePackage->pConnectionType ?> </option>
                            <option value="Fiber">Fiber</option>
                            <option value="Normal">Normal</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pIpType">IP Type</label>
                        <select class="form-control" name="pIpType" id="pIpType">
                            <option value="<?= $updatePackage->pIpType ?>"
                                    selected> <?= $updatePackage->pIpType ?> </option>
                            <option value="Real">Real</option>
                            <option value="Share">Share</option>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="addPackageBtn">Update Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#pName').change(function () {
            let pName = $('#pName').val();
            if (pName != '') {
                $.ajax({
                    url: "<?=sysUrl("checkPackageAvalibility")?>",
                    method: "POST",
                    data: {pName},
                    success: function (data) {
                        $('#pName_result').html(data);
                    }
                });
            }
        });

        $('#addPackageBtn').on('click', function (event) {
            if ($('#pName').val() == '') {
                event.preventDefault();
                // $.dialog('<p class="danger text-uppercase text-bold-600">Enter Name first !!</p>');
                $('#pName_result').html('<label class="danger text-uppercase text-bold-600">Enter Name !!</label>');
            }
            if ($('#pRate').val() == '') {
                event.preventDefault();
                $('#pRate_result').html('<label class="danger text-uppercase text-bold-600">Enter rate !!</label>');
            }
        });
    });
</script>

