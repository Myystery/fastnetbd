<?php
/**
 * Suraiya mim
 */
?>

<div class="card">
    <div class="card-body animated slideInRight">
        <h4 class="text-uppercase text-center">Quick Links</h4>
        <div class="d-flex justify-content-center">
            <div class="row justify-content-center">
                <div class="col-12 text-center text-white">
                    <div class="row justify-content-center">
                        <div class="card px-1">
                            <div class="card-body width-100" style="background-color: #607D8B">
                                <a href="<?= sysUrl('packages') ?>" class="text-white">
                                    <i class="fa fa-project-diagram animated infinite pulse delay-2s"></i><br>
                                    <h6 class="text-uppercase font-size-xsmall">&emsp;&emsp;Packages</h6>
                                </a>
                            </div>
                        </div>
                        <div class="card px-1">
                            <div class="card-body width-100" style="background-color: #607D8B">
                                <a href="<?= sysUrl('customers') ?>" class="text-white">
                                    <i class="fa fa-people-carry animated infinite pulse delay-2s "></i><br>
                                    <h6 class="text-uppercase font-size-xsmall">&emsp;Customers&emsp;</h6>
                                </a>
                            </div>
                        </div>
                        <div class="card px-1">
                            <div class="card-body width-100" style="background-color: #607D8B">
                                <a href="<?= sysUrl('connections/active') ?>" class="text-white">
                                    <i class="fab fa-connectdevelop animated infinite pulse delay-2s "></i><br>
                                    <h6 class="text-uppercase font-size-xsmall">&emsp;Conection</h6>
                                </a>
                            </div>
                        </div>
                        <div class="card px-1">
                            <div class="card-body width-100" style="background-color: #607D8B">
                                <a href="<?= sysUrl("team") ?>" class="text-white">
                                    <i class="fa fa-users animated infinite pulse delay-2s "></i><br>
                                    <h6 class="text-uppercase font-size-xsmall">&emsp;&emsp;&emsp;&emsp;Team</h6>
                                </a>
                            </div>
                        </div>
                        <div class="card px-1">
                            <div class="card-body width-100" style="background-color: #607D8B">
                                <a href="<?= sysUrl("billing") ?>" class="text-white">
                                    <i class="fa fa-file-invoice-dollar animated infinite pulse delay-2s "></i><br>
                                    <h6 class="text-uppercase font-size-xsmall">&emsp;&emsp;&emsp;&emsp;Billing</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center animated slideInLeft">
    <div class="col-xl-2 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-primary bg-darken-2">
                        <i class="icon-umbrella font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-primary white media-body">
                        <h5>City Covered</h5>
                        <h5 class="text-bold-400 mb-0">
                            <?php echo $citiesCovered ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-danger bg-darken-2">
                        <i class="icon-bell font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-danger white media-body">
                        <h5>Area Covered</h5>
                        <h5 class="text-bold-400 mb-0">
                            <?php echo $areasCovered ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-cyan bg-darken-2">
                        <i class="icon-bubbles font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-cyan white media-body">
                        <h5>Packages</h5>
                        <h5 class="text-bold-400 mb-0">
                            <?php echo $totalPackages ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-success bg-darken-2">
                        <i class="icon-user-following font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-success white media-body">
                        <h5>Active</h5>
                        <h5 class="text-bold-400 mb-0">
                            <?php echo $totalActiveCustomers ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-warning bg-darken-2">
                        <i class="icon-user-unfollow font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-warning white media-body">
                        <h5>Inactive</h5>
                        <h5 class="text-bold-400 mb-0">
                            <?php echo $totalInactiveCustomers ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-success bg-darken-2">
                        <i class="icon-vector font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-success white media-body">
                        <h5>Team</h5>
                        <h5 class="text-bold-400 mb-0">
                            <?php echo $totalTeamMembers ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>