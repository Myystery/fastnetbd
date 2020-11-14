<div id="content-nav-right">
    <div class="btn-group float-md-right" role="group">
        <div class="btn-group" role="group">
            <a class="btn btn-outline-blue-grey"
               modal-toggler="true" data-target="#remoteModal2" data-remote="<?= sysUrl('addPackage') ?>">
                Add Package
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered serverSide-table dtr-inline">
        <thead>
        <tr>
            <th>Name<br></th>
            <th>Bandwidth<br></th>
            <th>Connection Type<br></th>
            <th>IP Type<br></th>
            <th>Extra<br></th>
            <th>Rate<br></th>
            <th>Added By<br></th>
            <th>Added Time<br></th>
            <th>Updated Time<br></th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Name<br></th>
            <th>Bandwidth<br></th>
            <th>Connection Type<br></th>
            <th>IP Type<br></th>
            <th>Extra<br></th>
            <th>Rate<br></th>
            <th>Added By<br></th>
            <th>Added Time<br></th>
            <th>Updated Time<br></th>
            <th>Action</th>
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
                {"visible": false, "targets": [6, 7, 8]},

                {
                    "render": function (data, type, row) {
                        return '<?=CURRENCY?>' + data;
                    },
                    "targets": 5
                },
                {
                    "render": function (data, type, row) {
                        return moment(data).format('ddd MMM, DD, Y  hh:mm A');
                    },
                    "targets": [7, 8]
                }
            ],

            'aoColumns': [{mData: "pName"}, {mData: "pBandwidth"}, {mData: "pConnectionType"},
                {mData: "pIpType"}, {mData: "pOthers"}, {mData: "pRate"}, {mData: "eName"},
                {mData: "pAddedTime"}, {mData: "pUpdatedTime"}, {mData: "actions", bSortable: false}],

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "all"]],

            "iDisplayLength": 10,

            'bProcessing': true,

            "language": {
                processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>'
            },

            'bServerSide': true,

            'sAjaxSource': '<?= sysUrl("getPackages") ?>',

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
            {column_number: 2, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 3, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 4, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 5, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 6, filter_default_label: "Type ...", filter_type: "text"},
            {
                column_number: 7, filter_default_label: ["From Date", "End Date"],
                filter_type: "range_date",
                date_format: 'dd M, yyyy',
                filter_delay: 100,
                filter_reset_button_text: "<i class='fa fa-close'></i>"
            },

            {
                column_number: 8, filter_default_label: ["From Date", "End Date"],
                filter_type: "range_date",
                date_format: 'dd M, yyyy',
                filter_delay: 100,
                filter_reset_button_text: "<i class='fa fa-close'></i>"
            }
        ], "header");
    }
</script>
