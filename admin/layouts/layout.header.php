<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - layout.header.php
 */
?>
<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
    <div class="container-fluid">
        <!-- LOGO -->
        <a href="index.html" class="navbar-brand mr-0 mr-md-2 logo">
                        <span class="logo-lg">
                            <img src="<? echo BASE_URL ?>assets/images/ryd_logo.png" alt="" height="24"/>
                            <span class="d-inline h5 ml-1 text-logo">RYD Administrator</span>
                        </span>
            <span class="logo-sm">
                            <img src="<? echo BASE_URL ?>assets/images/ryd_logo.png" alt="" height="24">
                        </span>
        </a>

        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
            <li class="">
                <button class="button-menu-mobile open-left disable-btn">
                    <i data-feather="menu" class="menu-icon"></i>
                    <i data-feather="x" class="close-icon"></i>
                </button>
            </li>
        </ul>

        <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
            <li class="d-none d-sm-block">
                <div class="app-search">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span data-feather="search"></span>
                        </div>
                    </form>
                </div>
            </li>

            <?php $not = $n->get_system_notification(); ?>
            <li class="dropdown notification-list" data-toggle="tooltip" data-placement="left"
                title="<?php echo ($not) ? count($not) . ' new unread notification(s)' : 'No new notification' ?>">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false"
                   aria-expanded="false">
                    <i data-feather="bell"></i>
                    <?php
                    if (count($not) > 0) {
                        ?>
                        <span class="noti-icon-badge"></span>
                        <?php
                    }
                    ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <!-- item-->
                    <div class="dropdown-item noti-title border-bottom">
                        <h5 class="m-0 font-size-16">
                                        <span class="float-right">
                                            <a href="javascript:void(0)" onclick="clear_notifications()"
                                               class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                        </h5>
                    </div>

                    <div class="slimscroll noti-scroll">
                        <!-- item-->
                        <?php
                        if ($not) {
                            foreach ($not as $k => $v) {
                                ?>
                                <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                    <div class="notify-icon bg-primary"><i class="uil uil-bell"></i></div>
                                    <p class="notify-details"><?php echo $v['nbody']; ?>
                                        <small class="text-muted"><?php echo timeago_str(human_to_timestamp($v['ndate'])); ?></small>
                                    </p>
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- All-->
                    <a href="<?php echo BASE_URL ?>admin/messages"
                       class="dropdown-item text-center text-primary notify-item notify-all border-top">
                        View all
                        <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li>

            <li class="notification-list" data-toggle="tooltip" data-placement="left" title="All users">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                    <i data-feather="users"></i>
                </a>
            </li>

            <li class="notification-list" data-toggle="tooltip" data-placement="left" title="Upload new course">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                    <i data-feather="upload"></i>
                </a>
            </li>

        </ul>
    </div>

</div>