<div id="content-nav-right">
    <div class="btn-group float-md-right" role="group">
        <div class="btn-group" role="group">
            <a class="btn btn-outline-blue-grey" id="dataToggle" modal-toggler="false" data-target="#remoteModal2"
               data-remote="">
                Notify Customer
            </a>
        </div>
    </div>
</div>


<form method="post" class="form-group" action="<?= reportUrl() ?>">
    <div class="form-group">
        <select name="customer" id="customerSelect" class="form-group"
                style="width: 100%"></select>
    </div>
</form>

<div class="card text-center" id="prioritys">
    <div class="card-body">
        <div class="row animated zoomIn">
            <div class="col-md">
                <div class="card-header">
                    <h3 class="card-title text-bold-500"> Customers Report</h3>
                </div>
                <div class="card-body">
                    <div id="customerChart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#customerSelect').select2({
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

        $("select#customerSelect").change(function () {
            loadReports($(this).children("option:selected").val());
        });

        function loadReports(cus) {
            $.ajax({
                url: "<?=reportUrl('getReport') ?>",
                method: "POST",
                dataType: "json",
                data: {cus: cus},
                success: function (data) {
                    $("#customerChart").empty();
                    Morris.Bar({
                        element: 'customerChart',
                        data: data,
                        xkey: 'month',
                        ykeys: ['amount'],
                        labels: ['Amount'],
                        xLabelAngle: 20,
                        parseTime: false,
                        resize: true,
                    });
                }
            });
        }

        $('#dataToggle').click(function () {
            let cus = $("select#customerSelect").children("option:selected").val() || null;
            if (cus == null) {
                $.dialog('<p class="red">Select Customer!!</p>');
            } else {
                document.getElementById('dataToggle').setAttribute('data-remote', '<?= reportUrl('notifyCustomer/')?>' + cus)
                document.getElementById('dataToggle').setAttribute('modal-toggler', 'true')
            }
        })
    });
</script>

