<div class="modal-dialog modal-open">
    <div class="modal-content rounded-bottom">
        <div class="modal-header">
            <h4 class="modal-title">Update: <?= $updateEmployee->eName ?></h4>
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class='panel panel-body'>
                <form novalidate class="form-group" method="post" enctype="multipart/form-data"
                      action="<?= sysUrl('updateEmployee/' . $updateEmployee->eID) ?>">

                    <div class="form-group">
                        <label for="eName">Name</label>
                        <input type="text" class="form-control" name="eName" id="eName"
                               value="<?= $updateEmployee->eName ?>">
                        <span id="eName_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="eGender">Gender</label>
                        <select class="form-control" name="eGender">
                            <option value="<?= $updateEmployee->eGender ?>"
                                    selected> <?= $updateEmployee->eGender ?> </option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Undefined">Undefined</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="eEmail">Email</label>
                        <input type="email" class="form-control" name="eEmail" id="eEmail"
                               value="<?= $updateEmployee->eEmail ?>">
                        <span id="eEmail_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="ePhone">Phone</label>
                        <input type="number" class="form-control" name="ePhone" id="ePhone"
                               value="<?= $updateEmployee->ePhone ?>">
                        <span id="ePhone_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="eAddress">Address</label>
                        <input type="text" class="form-control" name="eAddress" id="eAddress"
                               value="<?= $updateEmployee->eAddress ?>">
                    </div>

                    <div class="form-group">
                        <label for="eDepartment">Department</label>
                        <select class="form-control" name="eDepartment" id="dynamicDesignation">
                            <option value="<?= $updateEmployee->eDepartment ?>"
                                    selected> <?= $updateEmployee->eDepartment ?>
                            </option>
                            <option value="CEO">CEO</option>
                            <option value="Director">Director</option>
                            <option value="Support">Support</option>
                            <option value="Technical">Technical</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Accounts">Accounts</option>
                            <option value="HR & Admin">HR & Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="eDesignation">Designation</label>
                        <select class="form-control" name="eDesignation" id="selectDesignation">
                            <option value="<?= $updateEmployee->eDesignation ?>"
                                    selected> <?= $updateEmployee->eDesignation ?>
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="eSalary">Salary</label>
                        <input type="text" class="form-control" name="eSalary" id="eSalary"
                               value="<?= $updateEmployee->eSalary ?>">
                        <span id="eSalary_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="eJoiningDate">Joining Date</label>
                        <input type="text" class="form-control" name="eJoiningDate" id="eJoiningDate"
                               value="<?= changeDateFormatToLong($updateEmployee->eJoiningDate) ?>">
                    </div>

                    <div class="form-group">
                        <label for="eResigningDate">Resigning Date</label>
                        <input type="text" class="form-control" name="eResigningDate" id="eResigningDate"
                               value="<?= $updateEmployee->eResigningDate ? changeDateFormatToLong($updateEmployee->eResigningDate) : '' ?>">
                        <span id="eResigningDate_result"></span>
                    </div>

                    <div class="form-group">
                        <label for="eImage">Image</label>
                        <?php if ($updateEmployee->eImage) { ?>
                            <img src="<?= uploadUrl($updateEmployee->eImage) ?>" height="100px" width="100px">
                        <?php } ?>
                        <input class="form-control border-bottom-3 " type="file" multiple name="eImage"
                               autocomplete="off" accept="image/*">
                    </div>
                    <br/>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="updateEmployeeBtn">Update Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#dynamicDesignation').on('click', function (event) {
            let c = $("select#dynamicDesignation").children("option:selected").val();
            // console.log(c);
            switch (c) {
                case 'Support':
                    $('#selectDesignation').html(
                        '<option value="Head of Department">Head of Department</option>' +
                        '<option value="Chief Engineer">Chief Engineer</option>' +
                        '<option value="Senior Engineer">Senior Engineer</option>' +
                        '<option value="Assistant Engineer">Assistant Engineer</option>' +
                        '<option value="Junior Engineer">Junior Engineer</option>'
                    )
                    break;
                case 'Technical':
                    $('#selectDesignation').html(
                        '<option value="Technical In Charge">Technical In Charge</option>' +
                        '<option value="Executive">Executive</option>' +
                        '<option value="Senior Technician">Senior Technician</option>' +
                        '<option value="Technician">Technician</option>' +
                        '<option value="Junior Technician">Junior Technician</option>'
                    )
                    break;
                case 'Marketing':
                    $('#selectDesignation').html(
                        '<option value="Head of Department">Head of Department</option>' +
                        '<option value="Assistant Manager">Assistant Manager</option>' +
                        '<option value="Senior Executive">Senior Executive</option>' +
                        '<option value="Executive">Executive</option>' +
                        '<option value="Junior Executive">Junior Executive</option>'
                    )
                    break;
                case 'Accounts':
                    $('#selectDesignation').html(
                        '<option value="Manager">Manager</option>' +
                        '<option value="Senior Executive">Senior Executive</option>' +
                        '<option value="Executive">Executive</option>' +
                        '<option value="Senior Bill Collector">Senior Bill Collector</option>' +
                        '<option value="Junior Bill Collector">Junior Bill Collector</option>'
                    )
                    break;
                case 'HR & Admin':
                    $('#selectDesignation').html(
                        '<option value="Manager">Manager</option>' +
                        '<option value="Admin">Admin</option>' +
                        '<option value="Co-Admin">Co-Admin</option>' +
                        '<option value="Executive">Executive</option>' +
                        '<option value="Office Assistant">Office Assistant</option>'
                    )
                    break;

                default:
                    $('#selectDesignation').html('')
                    break;

            }
        });

        $('#eName').change(function (event) {
            let eName = $('#eName').val();
            if (eName != '') {
                $.ajax({
                    url: "<?=sysUrl("checkEmployeeAvalibility")?>",
                    method: "POST",
                    data: {eName},
                    success: function (data) {
                        $('#eName_result').html(data);
                    }
                });
            }
        });


        $(function () {
            $('input[name="eJoiningDate"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10),
                locale: {
                    format: 'DD MMMM, Y'
                }
            });
        });

        $(function () {
            $('input[name="eResigningDate"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10),
                locale: {
                    format: 'DD MMMM, Y'
                }
            });
        });

        $('#updateEmployeeBtn').on('click', function (event) {
            validate(event, 'eName', 'eName_result', 'Enter Name !!')
            validate(event, 'eSalary', 'eSalary_result', 'Enter Salary !!')

            let phone = $('#ePhone').val()
            let phnRegex = /(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/
            validate(event, 'ePhone', 'ePhone_result', 'Enter valid Phone !!',
                !phnRegex.test(phone)
            )
            let type = $("select#selectDesignation").children("option:selected").val();
            if (type == 'Admin' || type == 'Co-Admin') {
                validate(event, 'eEmail', 'eEmail_result', 'Email Required [Login Purpose]!!')
                validate(event, 'uPassword', 'uPassword_result',
                    'Password Must Contain 4 Digits !!', $('#uPassword').val().toString().length < 4)
            }
        });
    });
</script>

