<?php

//fixed-top
if ($navBarSettings["topBar"]) {
    ?>
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-dark bg-gradient-radial-blue navbar-shadow ">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                                class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                    class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="<?= sysUrl() ?>" data-toggle="tooltip" data-placement="bottom"
                           title=<?= SYSTEM_NAME ?>>
                            <img class="brand-logo" alt="<?= SYSTEM_NAME ?>" src="<?= systemlogoSrc() ?>"
                                 width="32">
                            <span class="brand-text"><?= SYSTEM_NAME ?></span>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                    class="fa fa-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <?php
                        if ($navBarSettings["slideBar"]) {
                            ?>
                            <li class="nav-item d-none d-md-block"><a
                                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                            class="ft-menu"></i></a></li>
                            <?php
                        }
                        ?>
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                        class="ficon ft-maximize"></i></a>
                        </li>

                        <li class="dropdown nav-item">
                            <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"
                               aria-expanded="true">Reports</a>
                            <div class="dropdown-menu dropdown-menu-left">
                                <a class="dropdown-item" href="<?= reportUrl() ?>">
                                    <i class="fa fa-chart-bar"></i>
                                    Report
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item ">
                            <a class="dropdown-togFgle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <img src="<?= currentUserImage() ?>" class="rounded-circle" height="20px"
                                     width="20px">
                                <?php echo currentUserName() ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-toggle="tooltip" data-placement="top" title="Profile"
                                   href="<?= sysUrl('profile') ?>"><i class="ft-home"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" data-toggle="tooltip" data-placement="bottom" title="Logout"
                                   href="<?= sysUrl('signout') ?>"><i class="ft-power"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <?php
}
//top end

//side start
if ($navBarSettings["slideBar"]) {
    ?>
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow menu-collapsible menu-bordered"
         data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main show" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="navigation-header">
                    <span> MAP </span><i class=" ft-minus" data Family-toggle="tooltip" data-placement="right"
                                         data-original-title=<?= SYSTEM_NAME ?>></i>
                </li>

                <li class="nav-item" id="dashboard_nav">
                    <a href="<?= sysUrl() ?>">
                        <i class="ft-home"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <?php if (isAdmin()) { ?>
                    <li class="nav-item"><a href="#" id="users_nav">
                            <i class="fa fa-users"></i>
                            <span class="menu-title"> Customers</span>
                        </a>
                        <ul class="menu-content">
                            <li id="cities_nav">
                                <a class="menu-item" href="<?= sysUrl('cities') ?>">
                                    <i class="fa fa-area-chart"></i> Cities</a>
                            </li>
                            <li id="areas_nav">
                                <a class="menu-item" href="<?= sysUrl('areas') ?>">
                                    <i class="fa fa-chart-area"></i> Areas</a>
                            </li>
                            <li id="customers_nav">
                                <a class="menu-item" href="<?= sysUrl('customers') ?>">
                                    <i class="fa fa-users"></i> Customers</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item" id="dashboard_nav">
                        <a href="<?= sysUrl('team') ?>">
                            <i class="fa fa-user-tie"></i>
                            <span class="menu-title">Employees</span>
                        </a>
                    </li>
                    <li class="nav-item" id="dashboard_nav">
                        <a href="<?= sysUrl('packages') ?>">
                            <i class="fa fa-bezier-curve"></i>
                            <span class="menu-title">Packages</span>
                        </a>
                    </li>
                    <li class="nav-item" id="connection_nav">
                        <a href="<?= sysUrl('connections/active') ?>">
                            <i class="fab fa-connectdevelop"></i>
                            <span class="menu-title"> Connections</span>
                        </a>
                    </li>
                    <li class="nav-item" id="dashboard_nav">
                        <a href="<?= sysUrl('billing') ?>">
                            <i class="fa fa-file-invoice-dollar"></i>
                            <span class="menu-title">Billing</span>
                        </a>
                    </li>
                <?php }
                if (isCoAdmin()) { ?>
                    <li class="nav-item" id="customers_nav">
                        <a href="<?= sysUrl('customers') ?>">
                            <i class="fa fa-users"></i>
                            <span class="menu-title">Customers</span>
                        </a>
                    </li>
                    <li class="nav-item" id="connection_nav">
                        <a href="<?= sysUrl('connections/active') ?>">
                            <i class="fab fa-connectdevelop"></i>
                            <span class="menu-title"> Connections</span>
                        </a>
                    </li>
                    <li class="nav-item" id="dashboard_nav">
                        <a href="<?= sysUrl('billing') ?>">
                            <i class="fa fa-file-invoice-dollar"></i>
                            <span class="menu-title">Billing</span>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item" id="dashboard_nav">
                    <a href="<?= reportUrl('notify') ?>">
                        <i class="fa fa-mail-bulk"></i>
                        <span class="menu-title">Mail</span>
                    </a>
                </li>

        </div>
    </div>
    <?php
}

//global
if (isset($navMeta["active"])) {
    ?>

    <script>
        if (document.getElementById("<?= $navMeta["active"] ?>_nav")) {
            document.getElementById("<?= $navMeta["active"] ?>_nav").className += " active is-shown ";
        }
    </script>
    <?php
}

?>
<div class="app-content content">
    <div class="content-wrapper p-2">
        <?php
        if (!$navMeta["hideContentHeader"]) {
            ?>
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-1 text-md-left text-center">
                    <h3 class="content-header-title mb-0 text-center text-md-left"><?= $navMeta["pageTitle"] ?></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12 text-center text-md-left">
                            <ol class="breadcrumb justify-content-md-start justify-content-center">
                                <?php
                                $navMeta["n"] = 1;
                                foreach ($navMeta["bc"] as $bc) {
                                    ?>
                                    <li
                                            class="breadcrumb-item <?= $navMeta["n"] == sizeof($navMeta["bc"]) ? "active" : "" ?>">

                                        <?php
                                        if ($bc["url"] && isset($bc["url"])) {
                                            ?>
                                            <a href="<?= $bc["url"] ?>"><?= $bc["page"] ?></a>
                                            <?php
                                        } else {
                                            ?><?= $bc["page"] ?>
                                            <?php
                                        }
                                        ?>
                                    </li>
                                    <?php
                                    $navMeta["n"]++;
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-1 text-md-right text-center"
                     id="nav-right-container"></div>
            </div>
            <?php
        }
        if ($navBarSettings["topBar"]) {
        if ($navBarSettings["mainContentCard"]) { ?>
        <div class="content-body bg-white p-1">
            <?php
            }
            }
            ?>

