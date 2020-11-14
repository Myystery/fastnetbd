<div id="content-nav-right">
    <div class="btn-group float-md-right" role="group">
        <div class="btn-group" role="group">
            <a class="btn btn-outline-blue-grey"
               href=" <?= sysUrl() ?>"> Back </a>
        </div>
    </div>
</div>

<form class="form" novalidate action="<?= sysUrl("profile") ?>" method="post" enctype="multipart/form-data">
    <div class="form-body">
        <h4 class="form-section"><i class="fa fa-user"></i> Personal Info</h4>
        <div class="row">
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control border-primary" required name="eName"
                           data-validation-required-message="Enter valid name"
                           value="<?= $profile->eName ?>">
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>

            <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control border-primary" required name="eEmail"
                           data-validation-required-message="Enter valid email"
                           value="<?= $profile->eEmail ?>">
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control border-primary" required name="ePhone"
                           data-validation-required-message="Enter valid email"
                           value="<?= $profile->ePhone ?>">
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>

            <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control border-primary" required name="eAddress"
                           data-validation-required-message="Enter valid email"
                           value="<?= $profile->eAddress ?>">
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>

            <div class="col-md-6">
                <fieldset class="form-group">
                    <label>Gender</label>
                    <select class="form-control border-primary" required name="eGender"
                            data-validation-required-message="Enter valid email">
                        <option value="<?= $profile->eGender ?>" selected><?= $profile->eGender ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <p class="help-block m-0 danger"></p>
                </fieldset>
            </div>
        </div>

        <h4 class="form-section"><i class="ft-lock"></i>Password</h4>
        <fieldset class="form-group">
            <label>Password[keep it blank, if you do not want to change]</label>
            <input class="form-control border-primary" type="password" name="password" autocomplete="off">
        </fieldset>

        <h4 class="form-section"><i class="ft-image"></i>Image</h4>
        <fieldset class="form-group">
            <?php if ($profile->eImage) { ?>
            <p style="text-align:center;">
                <img align="center" src="<?= uploadUrl($profile->eImage) ?>" height="200px" max-width="200px">
                <?php } ?>
        </fieldset>
        <fieldset class="form-group">
            <label>Image [Max Size: 5 MB] [keep it blank, if you do not want to change]</label>
            <input class="form-control border-primary" type="file" name="eImage" id="eImage" accept="image/*"
                   aria-invalid="true">
        </fieldset>

    </div>

    <div class="form-actions right">
        <button type="button" class="btn btn-warning mr-1">
            <i class="ft-x"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-check-square"></i> Save
        </button>
    </div>
</form>