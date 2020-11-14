<?= setAlertMsgFromViewPage("Payment complete!!", SUCCESS); ?>

<div class="row justify-content-center">
    <div class="col-6 doPrint">
        <section class="card">
            <div id="invoice-template" class="card-body d-flex flex-column doPrint">
                <!-- Invoice Company Details -->
                <div class="row">
                    <div class="col-md-6 col-sm-12 text-center text-md-left">
                        <div class="media">
                            <img src="<?= systemlogoSrc() ?>" alt="company logo" class="h-25 w-25">
                            <div class="media-body">
                                <ul class="ml-2 px-0 list-unstyled">
                                    <li style="font-weight: 900; font-size: xx-large"><?= systemName() ?></li>
                                    <li><?= SYSTEM_ADDRESS ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center text-md-right">
                        <h3>INVOICE</h3>
                        <p><?= $paymentInfo->payReference ?></p>
                    </div>
                </div>
                <!--/ Invoice Company Details -->

                <!-- Invoice Customer Details -->
                <div id="invoice-customer-details" class="row">
                    <div class="col-sm-12 text-center text-md-left">
                        <p class="text-muted"><br>Bill To</p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center text-md-left">
                        <ul class="px-0 list-unstyled">
                            <li class="text-bold-600">
                                <?= $customerInfo->cusName ?> [ <?= $customerInfo->cusPhone ?>]
                            </li>
                            <li><?= $customerInfo->cusEmail ?> </li>
                            <li><?= $customerInfo->cusAddress ?></li>
                            <li><?= $areaInfo->areaName ?>, <?= $cityInfo->cityName ?></li>
                    </div>
                    <div class="col-md-6 col-sm-12 text-md-right">
                        <p><span class="text-muted">Invoice Date :
                            </span> <?= changeDateFormatToLong($paymentInfo->payAddedTime) ?>
                        </p>
                        <p><span class="text-muted">Member Since :
                            </span> <?= changeDateFormatToLong($conInfo->conStart) ?>
                        </p>
                        <p><span class="text-muted">Team Member : </span><?= $employeeInfo->eName ?></p>
                        <!--                        <p><span class="text-muted">Payment Type : </span>Cash</p>-->
                    </div>
                </div>
                <!--/ Invoice Customer Details -->

                <!-- Invoice Items Details -->
                <div id="invoice-items-details" class="pt-2">
                    <div class="row">
                        <div class="table-responsive col-sm-12">
                            <table class="table">
                                <thead class="table-success">
                                <tr>
                                    <th class="p-1">Package</th>
                                    <th class="text-right p-1">Month</th>
                                    <th class="text-right p-1">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="p-1">
                                        <p><?= $packageInfo->pName ?></p>
                                    </td>
                                    <td class="text-right p-1"><?= $paymentInfo->payMonth ?></td>
                                    <td class="text-right p-1"><?= CURRENCY . $packageInfo->pRate ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-auto">
                        <div class="col-12 text-right">
                            <p class="lead text-uppercase"> Total Due</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="p-1">SubTotal</td>
                                        <td class="text-right p-1"><?= CURRENCY . $paymentInfo->payAmount ?></td>
                                    </tr>
                                    <tr>
                                        <td class="p-1">Total</td>
                                        <td class="text-right p-1"><?= CURRENCY . $paymentInfo->payAmount ?></td>
                                    </tr>
                                    <tr class="grey-blue">
                                        <td class="text-bold-600 p-1">Payment Made</td>
                                        <td class="text-bold-600 text-right p-1"><?= CURRENCY . $paymentInfo->payAmount ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center col-sm-12 py-1">
                <p>Thanks for staying with - <strong> <?= systemName() ?> </strong></p>
            </div>
        </section>
    </div>
</div>
<!-- Invoice Footer -->
<div class="dontPrint">
    <div id="invoice-footer">
        <div class="row">
            <div class="col-md-12 text-center col-sm-12">
                <button type="button" onclick="window.location=document.referrer"
                        class="btn btn-red my-1">
                    <i class="fa fa-fast-backward"></i> BACK
                </button>
                <button type="button" onclick="window.print()"
                        class="btn btn-grey-blue my-1">
                    <i class="fa fa-print"></i> PRINT
                </button>
            </div>
        </div>
    </div>
</div>
<!--/ Invoice Footer -->
<style>
    @media print {
        .dontPrint {
            display: none;
        }

        .doPrint {
            display: block;
        }
    }
</style>