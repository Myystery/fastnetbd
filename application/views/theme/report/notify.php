<div class="table-responsive">
    <table class="table table-striped table-bordered serverSide-table dtr-inline">
        <thead>
        <tr>
            <th>Customer Name<br></th>
            <th>Employee Name<br></th>
            <th>Mail<br></th>
            <th>Added Time<br></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Customer Name<br></th>
            <th>Employee Name<br></th>
            <th>Mail<br></th>
            <th>Added Time<br></th>
        </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    var Table, selectedIDs = [];
    window.onload = function () {
        getTableData();
    }

    function getTableData() {
        Table = $('.serverSide-table').DataTable({
            order: [[0, "ASC"]],
            "columnDefs": [
                {"visible": false, "targets": 3},

                {
                    "render": function (data, type, row) {
                        let pa = JSON.parse(data)
                        return '<strong>To</strong>: ' + pa.mailTo +
                            '<br><strong>Subject</strong>: ' + pa.mailSub +
                            '<br><strong>Mail</strong>: ' + atob(pa.body)
                    },
                    "targets": 2
                },
                {
                    "render": function (data, type, row) {
                        return moment(data).format('ddd MMM, DD, Y  hh:mm A');
                    },
                    "targets": 3
                }
            ],

            'aoColumns': [{mData: "cusName"}, {mData: "eName"}, {mData: "mail"}, {mData: "addTime"}],

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "all"]],

            "iDisplayLength": 10,

            'bProcessing': true,

            "language": {
                processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>'
            },

            'bServerSide': true,

            'sAjaxSource': '<?= reportUrl("getNotifications") ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {
                $.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': function (d, e, f) {
                        fnCallback(d, e, f);
                        //console.log(d)
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        if (jqXHR.jqXHRstatusText)
                            alert(jqXHR.jqXHRstatusText);
                    }
                });
            },

            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {

            },
            dom: '<"pull-left"B><"pull-right"f>rt<"pull-right"l>ip',

            buttons: [
                {
                    extend: "copy",
                    charset: "utf-8",
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            header: function (data, column, row) {
                                return data.split('<')[0];
                            }
                        }
                    }
                },

                {
                    extend: "csv",
                    charset: "utf-8",
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            header: function (data, column, row) {
                                return data.split('<')[0];
                            }
                        }
                    }
                },

                {
                    extend: "excel",
                    charset: "utf-8",
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            header: function (data, column, row) {
                                return data.split('<')[0];
                            }
                        }
                    }
                },

                {
                    extend: "pdf",
                    charset: "utf-8",
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            header: function (data, column, row) {
                                return data.split('<')[0];
                            }
                        }
                    }
                },

                {
                    extend: "print",
                    charset: "utf-8",
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            header: function (data, column, row) {
                                return data.split('<')[0];
                            }
                        }
                    }
                },
                'colvis'
            ]
        });
        yadcf.init(Table, [
            {column_number: 0, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 1, filter_default_label: "Type ...", filter_type: "text"},
            {
                column_number: 3, filter_default_label: ["From Date", "End Date"],
                filter_type: "range_date",
                date_format: 'dd M, yyyy',
                filter_delay: 100,
                filter_reset_button_text: "<i class='fa fa-close'></i>"
            }
        ], "header");
    }
</script>