<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 21/03/2020 - index.php
 */
define("SPECIAL_CODE", 200);
define("USER_ROLE", 1);
define("APP_DIR", true);
require_once(__DIR__ . "/../models/users.php");
require_once(__DIR__ . "/../models/config.php");
require_once(__DIR__ . "/../models/emails.php");
require_once(__DIR__ . "/../models/notifier.php");
require_once(__DIR__ . "/../configs/loader.php");
require_once(__DIR__ . "/../lib/lib.php");
//start page scripting
set_title("Dashboard");
set_sel_menu("dashboard");
//redirect if not login
check_redirect(BASE_URL . "admin/login");
user_role_force(true, "admin/permission");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "layouts/layout.head.php"; ?>
</head>

<body>
<!-- Pre-loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
        </div>
    </div>
</div>
<!-- End Preloader-->

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <?php include "layouts/layout.header.php"; ?>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include "layouts/layout.sidebar.php"; ?>
    <!-- Left Sidebar End -->

    <div class="content-page">
        <!-- content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row page-title align-items-center">
                    <div class="col-sm-4 col-xl-6">
                        <h4 class="mb-1 mt-0">
                            Dashboard </h4>
                    </div>
                    <div class="col-sm-8 col-xl-6">
                        <form class="form-inline float-sm-right mt-3 mt-sm-0">
                            <div class="form-group mb-sm-0 mr-2">
                                <input type="text" class="form-control" id="dash-daterange" style="min-width: 190px;"/>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class='uil uil-file-alt mr-1'></i>Download
                                    <i class="icon"><span data-feather="chevron-down"></span></i></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item notify-item">
                                        <i data-feather="mail" class="icon-dual icon-xs mr-2"></i>
                                        <span>Email</span>
                                    </a>
                                    <a href="#" class="dropdown-item notify-item">
                                        <i data-feather="printer" class="icon-dual icon-xs mr-2"></i>
                                        <span>Print</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item notify-item">
                                        <i data-feather="file" class="icon-dual icon-xs mr-2"></i>
                                        <span>Re-Generate</span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- content -->
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="media p-3">
                                    <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Today
                                                    Revenue</span>
                                        <h2 class="mb-0">$2100</h2>
                                    </div>
                                    <div class="align-self-center">
                                        <div id="today-revenue-chart" class="apex-charts"></div>
                                        <span class="text-success font-weight-bold font-size-13"><i
                                                    class='uil uil-arrow-up'></i> 10.21%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="media p-3">
                                    <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">Product
                                                    Sold</span>
                                        <h2 class="mb-0">1065</h2>
                                    </div>
                                    <div class="align-self-center">
                                        <div id="today-product-sold-chart" class="apex-charts"></div>
                                        <span class="text-danger font-weight-bold font-size-13"><i
                                                    class='uil uil-arrow-down'></i> 5.05%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="media p-3">
                                    <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">New
                                                    Customers</span>
                                        <h2 class="mb-0">11</h2>
                                    </div>
                                    <div class="align-self-center">
                                        <div id="today-new-customer-chart" class="apex-charts"></div>
                                        <span class="text-success font-weight-bold font-size-13"><i
                                                    class='uil uil-arrow-up'></i> 25.16%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="media p-3">
                                    <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">New
                                                    Visitors</span>
                                        <h2 class="mb-0">750</h2>
                                    </div>
                                    <div class="align-self-center">
                                        <div id="today-new-visitors-chart" class="apex-charts"></div>
                                        <span class="text-danger font-weight-bold font-size-13"><i
                                                    class='uil uil-arrow-down'></i> 5.05%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- products -->
                <div class="row">
                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-body pt-2 pb-3">
                                <a href="task-list.html" class="btn btn-primary btn-sm mt-2 float-right">
                                    View All
                                </a>
                                <h5 class="mb-4">Tasks</h5>
                                <div class="slimscroll" style="max-height: 390px;">
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task1">
                                                <label class="custom-control-label font-weight-bold" for="task1">
                                                    Draft the new contract document for
                                                    sales team
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 24 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task2">
                                                <label class="custom-control-label font-weight-bold" for="task2">
                                                    iOS App home page
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 23 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task3">
                                                <label class="custom-control-label font-weight-bold" for="task3">
                                                    Write a release note for Shreyu
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 22 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task4">
                                                <label class="custom-control-label font-weight-bold" for="task4">
                                                    Invite Greeva to a project shreyu admin
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 21 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task5">
                                                <label class="custom-control-label font-weight-bold" for="task5">
                                                    Enable analytics tracking for main website
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 20 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task6">
                                                <label class="custom-control-label font-weight-bold" for="task6">
                                                    Invite user to a project
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 18 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task7">
                                                <label class="custom-control-label font-weight-bold" for="task7">
                                                    Write a release note
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 14 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col-->
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <a href="" class="btn btn-primary btn-sm float-right">
                                    <i class='uil uil-export ml-1'></i> Export
                                </a>
                                <h5 class="card-title mt-0 mb-0">Recent Orders</h5>

                                <div class="table-responsive mt-4">
                                    <table class="table table-hover table-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>#98754</td>
                                            <td>ASOS Ridley High</td>
                                            <td>Otto B</td>
                                            <td>$79.49</td>
                                            <td><span class="badge badge-soft-warning py-1">Pending</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row -->

                <!-- widgets -->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body pt-2">
                                <h5 class="mb-4">Top Performers</h5>
                                <div class="media border-top pt-3">
                                    <img src="assets/images/users/avatar-7.jpg" class="avatar rounded mr-3"
                                         alt="shreyu">
                                    <div class="media-body">
                                        <h6 class="mt-1 mb-0 font-size-15">Shreyu N</h6>
                                        <h6 class="text-muted font-weight-normal mt-1 mb-3">Senior Sales Guy</h6>
                                    </div>
                                    <div class="dropdown align-self-center float-right">
                                        <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                           aria-expanded="false">
                                            <i class="uil uil-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-edit-alt mr-2"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-exit mr-2"></i>Remove from Team</a>
                                            <div class="dropdown-divider"></div>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                        class="uil uil-trash mr-2"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="media mt-1 border-top pt-3">
                                    <img src="assets/images/users/avatar-9.jpg" class="avatar rounded mr-3"
                                         alt="shreyu">
                                    <div class="media-body">
                                        <h6 class="mt-1 mb-0 font-size-15">Greeva Y</h6>
                                        <h6 class="text-muted font-weight-normal mt-1 mb-3">Social Media Campaign</h6>
                                    </div>
                                    <div class="dropdown align-self-center float-right">
                                        <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                           aria-expanded="false">
                                            <i class="uil uil-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-edit-alt mr-2"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-exit mr-2"></i>Remove from Team</a>
                                            <div class="dropdown-divider"></div>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                        class="uil uil-trash mr-2"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="media mt-1 border-top pt-3">
                                    <img src="assets/images/users/avatar-4.jpg" class="avatar rounded mr-3"
                                         alt="shreyu">
                                    <div class="media-body">
                                        <h6 class="mt-1 mb-0 font-size-15">Nik G</h6>
                                        <h6 class="text-muted font-weight-normal mt-1 mb-3">Inventory Manager</h6>
                                    </div>
                                    <div class="dropdown align-self-center float-right">
                                        <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                           aria-expanded="false">
                                            <i class="uil uil-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-edit-alt mr-2"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-exit mr-2"></i>Remove from Team</a>
                                            <div class="dropdown-divider"></div>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                        class="uil uil-trash mr-2"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="media mt-1 border-top pt-3">
                                    <img src="assets/images/users/avatar-1.jpg" class="avatar rounded mr-3"
                                         alt="shreyu">
                                    <div class="media-body">
                                        <h6 class="mt-1 mb-0 font-size-15">Hardik G</h6>
                                        <h6 class="text-muted font-weight-normal mt-1 mb-3">Sales Person</h6>
                                    </div>
                                    <div class="dropdown align-self-center float-right">
                                        <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                           aria-expanded="false">
                                            <i class="uil uil-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-edit-alt mr-2"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-exit mr-2"></i>Remove from Team</a>
                                            <div class="dropdown-divider"></div>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                        class="uil uil-trash mr-2"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="media mt-1 border-top pt-3">
                                    <img src="assets/images/users/avatar-5.jpg" class="avatar rounded mr-3"
                                         alt="shreyu">
                                    <div class="media-body">
                                        <h6 class="mt-1 mb-0 font-size-15">Stive K</h6>
                                        <h6 class="text-muted font-weight-normal mt-1 mb-1">Sales Person</h6>
                                    </div>
                                    <div class="dropdown align-self-center float-right">
                                        <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                           aria-expanded="false">
                                            <i class="uil uil-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-edit-alt mr-2"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                        class="uil uil-exit mr-2"></i>Remove from Team</a>
                                            <div class="dropdown-divider"></div>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                        class="uil uil-trash mr-2"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body pt-2 pb-3">
                                <a href="task-list.html" class="btn btn-primary btn-sm mt-2 float-right">
                                    View All
                                </a>
                                <h5 class="mb-4">Tasks</h5>
                                <div class="slimscroll" style="max-height: 390px;">
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task1">
                                                <label class="custom-control-label font-weight-bold" for="task1">
                                                    Draft the new contract document for
                                                    sales team
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 24 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task2">
                                                <label class="custom-control-label font-weight-bold" for="task2">
                                                    iOS App home page
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 23 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task3">
                                                <label class="custom-control-label font-weight-bold" for="task3">
                                                    Write a release note for Shreyu
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 22 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task4">
                                                <label class="custom-control-label font-weight-bold" for="task4">
                                                    Invite Greeva to a project shreyu admin
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 21 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task5">
                                                <label class="custom-control-label font-weight-bold" for="task5">
                                                    Enable analytics tracking for main website
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 20 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task6">
                                                <label class="custom-control-label font-weight-bold" for="task6">
                                                    Invite user to a project
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 18 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="task7">
                                                <label class="custom-control-label font-weight-bold" for="task7">
                                                    Write a release note
                                                </label>
                                                <p class="font-size-13 text-muted">Due on 14 Aug, 2019</p>
                                            </div> <!-- end checkbox -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body pt-2">
                                <div class="dropdown mt-2 float-right">
                                    <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown"
                                       aria-expanded="false">
                                        <i class="uil uil-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="uil uil-refresh mr-2"></i>Refresh</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="uil uil-user-plus mr-2"></i>Add Member</a>
                                        <div class="dropdown-divider"></div>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item text-danger"><i
                                                    class="uil uil-exit mr-2"></i>Exit</a>
                                    </div>
                                </div>
                                <h5 class="mb-4">Recent Conversation</h5>
                                <div class="chat-conversation">
                                    <ul class="conversation-list slimscroll" style="max-height: 328px;">
                                        <li class="clearfix">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-9.jpg" alt="Female">
                                                <i>10:00</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>Greeva</i>
                                                    <p>
                                                        Hello!
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix odd">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-7.jpg" alt="Male">
                                                <i>10:01</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>Shreyu</i>
                                                    <p>
                                                        Hi, How are you? What about our next meeting?
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-9.jpg" alt="female">
                                                <i>10:01</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>Greeva</i>
                                                    <p>
                                                        Yeah everything is fine
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="clearfix odd">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-7.jpg" alt="male">
                                                <i>10:02</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                    <i>Shreyu</i>
                                                    <p>
                                                        Awesome! let me know if we can talk in 20 min
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <form class="needs-validation" novalidate name="chat-form" id="chat-form">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control chat-input"
                                                       placeholder="Enter your text" required>
                                                <div class="invalid-feedback">
                                                    Please enter your messsage
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit"
                                                        class="btn btn-danger chat-send btn-block waves-effect waves-light">
                                                    Send
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div> <!-- end .chat-conversation-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
        </div> <!-- content -->
        <!-- content -->

        <!-- Footer Start -->
        <?php include "layouts/layout.footer.php"; ?>
        <!-- end Footer -->

    </div>

</div>
<!-- END wrapper -->

<!-- Vendor js -->
<?php include "layouts/layout.foot.php"; ?>
<!--Third party-->
<?php ?>
</body>
<script src="<?php echo BASE_URL ?>jslib/sweetalert.js"></script>
<script src="<?php echo BASE_URL ?>jslib/vue.min.js?no-cache"></script>
<script src="<?php echo BASE_URL ?>jslib/axios.min.js?no-cache"></script>
<script>
    //axios header
    var header = {'Content-Type': 'application/x-www-form-urlencoded'};
    //global vue data
    var BASE_URL = '<?php echo BASE_URL ?>';
    var page_var = {email: '', pass: ''};
    //start script page here
    function login() {
        var data = JSON.parse(JSON.stringify(vue.$data.page));
        start_loading('-Please wait...');
        //prepare axios for api calls
        axios.post(BASE_URL + "api/access/login/?agent=axios", data, header)
            .then(function (res) {
                var r = res.data;
                if (r.status) {
                    //successfully logged
                    setTimeout(function () {
                        start_loading('-Decrypting data...');
                        window.location.href = BASE_URL + 'admin';
                    }, 2000);
                } else {
                    stop_loading('-No user matched !');
                }
            })
            .catch(function (err) {
                stop_loading('-Server side error');
            })
    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js"></script>
</html>
