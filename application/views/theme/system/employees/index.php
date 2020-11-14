<div id="content-nav-right">
    <div class="btn-group float-md-right" role="group">
        <div class="btn-group" role="group">
            <a class="btn btn-outline-blue-grey"
               modal-toggler="true" data-target="#remoteModal2" data-remote="<?= sysUrl('addEmployee') ?>">
                Add Employee
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered serverSide-table dtr-inline">
        <thead>
        <tr>
            <th>Image<br></th>
            <th>Name<br></th>
            <th>Email<br></th>
            <th>Gender<br></th>
            <th>Contact<br></th>
            <th>Address<br></th>
            <th>Department <br></th>
            <th>Designation<br></th>
            <th>Salary<br></th>
            <th>Joining Date<br></th>
            <th>Resigning Date<br></th>
            <th>Added Time<br></th>
            <th>Updated Time<br></th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Image<br></th>
            <th>Name<br></th>
            <th>Email<br></th>
            <th>Gender<br></th>
            <th>Contact<br></th>
            <th>Address<br></th>
            <th>Department <br></th>
            <th>Designation<br></th>
            <th>Salary<br></th>
            <th>Joining Date<br></th>
            <th>Resigning Date<br></th>
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
            order: [[1, "ASC"]],
            "columnDefs": [
                {"visible": false, "targets": [8, 9, 10, 11, 12]},
                {
                    "data": "img",
                    "render": function (data, type, row) {
                        if (data != null)
                            return '<img height="50px" width="50px" class="rounded-circle" src="<?=uploadUrl()?>' + data + '"/>';
                        else
                            return '<img height="50px" width="50px" class="rounded-circle" src="<?=propertyUrl()?>' + 'images/no-img.png' + '"/>';
                    },
                    "targets": 0
                },
                {
                    "render": function (data, type, row) {
                        return data ? data : '<span class="badge-sm badge-pill badge-warning"> N/A </span>';
                    },
                    "targets": 2
                },
                {
                    "render": function (data, type, row) {
                        return moment(data).format('ddd MMM, DD, Y  hh:mm A');
                    },
                    "targets": [11, 12]
                },
                {
                    "render": function (data, type, row) {
                        if (data != null)
                            return moment(data).format('ddd MMM, DD, Y');
                        else
                            return data
                    },
                    "targets": [9, 10]
                }
            ],

            'aoColumns': [{mData: "eImage"}, {mData: "eName"}, {mData: "eEmail"}, {mData: "eGender"}, {mData: "ePhone"}, {mData: "eAddress"},
                {mData: "eDepartment"}, {mData: "eDesignation"}, {mData: "eSalary"}, {mData: "eJoiningDate"},
                {mData: "eResigningDate"}, {mData: "eAddedTime"}, {mData: "eUpdatedTime"},
                {
                    mData: "actions",
                    bSortable: false
                }],

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "all"]],

            "iDisplayLength": 10,

            'bProcessing': true,

            "language": {
                processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>'
            },

            'bServerSide': true,

            'sAjaxSource': '<?= sysUrl("getTeam") ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {
                $.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': function (d, e, f) {
                        fnCallback(d, e, f);
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
            {column_number: 1, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 2, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 3, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 4, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 5, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 6, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 7, filter_default_label: "Type ...", filter_type: "text"},
            {column_number: 8, filter_default_label: "Type ...", filter_type: "text"},
            {
                column_number: 9, filter_default_label: ["From Date", "End Date"],
                filter_type: "range_date",
                date_format: 'dd M, yyyy',
                filter_delay: 100,
                filter_reset_button_text: "<i class='fa fa-close'></i>"
            },

            {
                column_number: 10, filter_default_label: ["From Date", "End Date"],
                filter_type: "range_date",
                date_format: 'dd M, yyyy',
                filter_delay: 100,
                filter_reset_button_text: "<i class='fa fa-close'></i>"
            },
            {
                column_number: 11, filter_default_label: ["From Date", "End Date"],
                filter_type: "range_date",
                date_format: 'dd M, yyyy',
                filter_delay: 100,
                filter_reset_button_text: "<i class='fa fa-close'></i>"
            },
            {
                column_number: 12, filter_default_label: ["From Date", "End Date"],
                filter_type: "range_date",
                date_format: 'dd M, yyyy',
                filter_delay: 100,
                filter_reset_button_text: "<i class='fa fa-close'></i>"
            },
        ], "header");
    }
</script>

