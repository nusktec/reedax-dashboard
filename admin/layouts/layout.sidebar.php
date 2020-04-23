<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - layout.sidebar.php
 */
?>
<!--side menu special hover effect-->
<style>
    .xselected {
        border-left: 3px solid #5369f8;
        color: #5369f8;
        background-color: #f7f7ff;
    }
</style>
<!--End of special menu effect-->
<div class="left-side-menu">
    <div class="media user-profile mt-2 mb-2">
        <img src="<?php echo BASE_URL ?>uploads/profile/<?php echo sha1(get_user_data()['uid']) ?>.jpg?no-cache=<?php echo rand(111, 999) ?>"
             onerror="this.src='<?php echo BASE_URL ?>assets/images/av_man.png'" class="avatar-sm rounded-circle mr-2"
             alt="Avatar"/>

        <div class="media-body">
            <h6 class="pro-user-name mt-0 mb-0"><?php echo $u['uname']; ?></h6>
            <span class="pro-user-desc">Administrator</span>
        </div>
        <div class="dropdown align-self-center profile-dropdown-menu">
            <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
               aria-expanded="false">
                <span data-feather="chevron-down"></span>
            </a>
            <div class="dropdown-menu profile-dropdown">
                <a href="<?php echo BASE_URL ?>admin/system/profile" class="dropdown-item notify-item">
                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                    <span>Profile</span>
                </a>

                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                    <span>Change Password</span>
                </a>

                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i data-feather="help-circle" class="icon-dual icon-xs mr-2"></i>
                    <span>Dev. Support</span>
                </a>

                <a href="#" onclick="swal('Navigation','No Screen Lock !')" class="dropdown-item notify-item">
                    <i data-feather="lock" class="icon-dual icon-xs mr-2"></i>
                    <span>Lock Screen</span>
                </a>

                <div class="dropdown-divider"></div>

                <a href="<? echo BASE_URL ?>admin/logout" class="dropdown-item notify-item">
                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-content">
        <!--- Side-menu -->
        <div id="sidebar-menu" class="slimscroll-menu">
            <ul class="metismenu" id="menu-bar">
                <li class="menu-title">Navigation</li>

                <li class="<?php echo get_sel_menu('dashboard'); ?>">
                    <a href="<?php echo BASE_URL ?>admin">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="<?php echo get_sel_menu('messages'); ?>">
                    <a href="<?php echo BASE_URL ?>admin/messages">
                        <i data-feather="message-circle"></i>
                        <span> Messages </span>
                    </a>
                </li>
                <li class="menu-title">H.Resources</li>
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="users"></i>
                        <span> App Users </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="<?php echo BASE_URL ?>admin/user/history">History</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL ?>admin/user/list">List Users</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL ?>admin/user/add">Add New</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="video"></i>
                        <span> Video Courses </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="<?php echo BASE_URL ?>admin/courses/list">List Courses</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title">System Administrator</li>
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="credit-card"></i>
                        <span> Payment </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="<?php echo BASE_URL ?>admin/payment/history">Payment History</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL ?>admin/payment/config">API Config</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="settings"></i>
                        <span> System Config</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="<?php echo BASE_URL ?>admin/system/profile">Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL ?>admin/system/settings">Settings</a>
                        </li>
                    </ul>
                </li>
                <!--Blank and sample menu-->
                <li class="menu-title">Blank</li>
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="inbox"></i>
                        <span> Blank </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="#">Menu</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>