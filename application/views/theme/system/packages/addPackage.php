<div class="modal-dialog modal-open">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title pull-left">Add Package</h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class='panel panel-body'>
                <form novalidate class="form-group" method="post"
                      action="<?= sysUrl('addPackage') ?>">

                    <div class="form-group">
                        <label for="pName">Package Name</label>
                        <select class="form-control" name="pName">
                            <option value="Direct Optical Fiber">Direct Optical Fiber</option>
                            <option value="Dedicated Internet">Dedicated Internet</option>
                            <option value="Point-Point Dedicated Fiber">Point-Point Dedicated Fiber</option>
                            <option value="Virtual Private Network">Virtual Private Network</option>
                            <option value="Web Server">Web Server</option>
                            <option value="ADS Server">ADS Server</option>
                            <option value="LAN Infrastructure">LAN Infrastructure</option>
                            <option value="File Server">File Server</option>
                            <option value="Media Server">Media Server</option>
                            <option value="Mail Server">Mail Server</option>
                            <option value="Domain & Hosting">Domain & Hosting</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pBandwidth">Bandwidth</label>
                        <select class="form-control" name="pBandwidth" id="pBandwidth">
                            <?php for ($i = 1; $i < 51; $i++) { ?>
                                <option value="<?= $i ?> Mbps"><?= $i ?> Mbps</option>
                            <?php } ?>
                            <option value="Dedicated">Dedicated</option>
                            <option value="None">None</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pRate">Rate (BD)</label>
                        <input type="number" class="form-control" name="pRate" id="pRate">
                        <span id="pRate_result"></span>
                    </div>


                    <div class="form-group">
                        <label for="pOthers">Other Facilities</label>
                        <input type="text" class="form-control" name="pOthers" id="pOthers">
                        <span id="contact_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="pConnectionType">Connection Type</label>
                        <select class="form-control" name="pConnectionType" id="pConnectionType">
                            <option value="Fiber">Fiber Optics</option>
                            <option value="Normal">Normal Connection</option>
                            <option value="None">None</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pIpType">IP Type</label>
                        <select class="form-control" name="pIpType" id="pIpType">
                            <option value="Real">Real IP</option>
                            <option value="Share">Share IP</option>
                            <option value="NA">NA</option>
                        </select>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="addPackageBtn">Add Package</button>
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
                    url: "<?=sysUrl("checkPackageAvailability")?>",
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
            // if ($("select#pBandwidth").children("option:selected").val() == undefined) {
            //     event.preventDefault();
            //     $('#pBandwidth_result').html('<label class="danger text-uppercase text-bold-600">Enter bandwidth !!</label>');
            // }
        });
    });
</script>

