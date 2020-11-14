<div class="modal-dialog modal-lg ">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title pull-left">Notify Customer in Email</h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class='panel panel-body'>
                <form novalidate class="form-group" method="post"
                      action="<?= reportUrl('notifyCustomer/' . $cusInfo->cusID) ?>">
                    <div class="form-group">
                        <label for="due">Due</label>
                        <select class="form-control" name="due" id="due">
                            <option value="Jan<?= getCurrentYearOnly() ?>">January
                                - <?= getCurrentYearOnly() ?></option>
                            <option value="Feb<?= getCurrentYearOnly() ?>">February
                                - <?= getCurrentYearOnly() ?></option>
                            <option value="Mar<?= getCurrentYearOnly() ?>">March - <?= getCurrentYearOnly() ?></option>
                            <option value="Apr<?= getCurrentYearOnly() ?>">April - <?= getCurrentYearOnly() ?></option>
                            <option value="May<?= getCurrentYearOnly() ?>">May - <?= getCurrentYearOnly() ?></option>
                            <option value="Jun<?= getCurrentYearOnly() ?>">June - <?= getCurrentYearOnly() ?></option>
                            <option value="Jul<?= getCurrentYearOnly() ?>">July - <?= getCurrentYearOnly() ?></option>
                            <option value="Aug<?= getCurrentYearOnly() ?>">August - <?= getCurrentYearOnly() ?></option>
                            <option value="Sep<?= getCurrentYearOnly() ?>">September
                                - <?= getCurrentYearOnly() ?></option>
                            <option value="Oct<?= getCurrentYearOnly() ?>">October
                                - <?= getCurrentYearOnly() ?></option>
                            <option value="Nov<?= getCurrentYearOnly() ?>">November
                                - <?= getCurrentYearOnly() ?></option>
                            <option value="Dec<?= getCurrentYearOnly() ?>">December
                                - <?= getCurrentYearOnly() ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="lateFee">Late Fee</label>
                        <input type="number" step="any" class="form-control" name="lateFee" id="lateFee">
                        <span id="lateFee_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="mailTo">Mail To</label>
                        <input type="text" class="form-control" name="mailTo" id="mailTo"
                               value="<?= $cusInfo->cusEmail ?>">
                        <span id="mailTo_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="mailSub">Mail Subject</label>
                        <input type="email" class="form-control" name="mailSub" id="mailSub"
                               value="About bill for internet service">
                        <span id="mailSub_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="mail">Mail Body</label>
                        <textarea class="form-control" name="mail" id="mail" rows="8" cols="100"/>
                        <span id="mail_result"></span>
                    </div>
                    <br/>
                    <br/>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Send Mail</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>