<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 21/03/2020 - template.php
 */
define('SPECIAL_CODE', 200);
define("USER_ROLE", 1);
define("APP_DIR", true);
require_once(__DIR__ . "/../configs/loader.php");
require_once(__DIR__ . "/../lib/lib.php");
require_once(__DIR__ . "/../models/config.php");
require_once(__DIR__ . "/../models/users.php");
require_once(__DIR__ . "/../models/emails.php");
require_once(__DIR__ . "/../models/notifier.php");
require_once(__DIR__ . "/../models/messages.php");
//start page scripting
set_title("Profile");
set_sel_menu("profile");
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
<div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
        </div>
    </div>
</div>
<!-- Begin page -->
<div id="wrapper">

    <!-- Top-bar Start -->
    <?php include "layouts/layout.header.php"; ?>
    <!-- end Top-bar -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include "layouts/layout.sidebar.php"; ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <!-- content -->
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row page-title">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="float-right mt-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>admin">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href=""><?php echo get_title(); ?></a></li>
                            </ol>
                        </nav>
                        <h4 class="mb-1 mt-0">User Add</h4>
                    </div>
                </div>

                <!--Start main rol-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" id="app">
                                <h4 class="header-title mt-0">Data Sheet</h4>
                                <p class="sub-header">
                                    Edit - Update - Task
                                </p>
                                <form onsubmit="return false" class="form-horizontal">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="simpleinput">Names</label>
                                                <div class="col-lg-10">
                                                    <input v-model="page.info.uname" type="text" class="form-control"
                                                           id="simpleinput"
                                                           value="" placeholder="Full names">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-email">Email</label>
                                                <div class="col-lg-10">
                                                    <input v-model="page.info.uemail"
                                                           type="email" id="example-email"
                                                           name="example-email"
                                                           class="form-control"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-password">Password</label>
                                                <div class="col-lg-7">
                                                    <input v-model="page.info.upass"
                                                           disabled="disabled" type="text" class="form-control"
                                                           id="example-password" value="">
                                                </div>
                                                <div class="col-lg-3">
                                                    <button onclick="shufflePass()"
                                                            type="button"
                                                            class="btn btn-danger w-100">Generate New
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-placeholder">Phone</label>
                                                <div class="col-lg-10">
                                                    <input v-model="page.info.uphone" type="text" class="form-control"
                                                           placeholder="Phone number" id="example-placeholder"
                                                           value="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-date">Country</label>
                                                <div class="col-lg-10">
                                                    <select v-model="page.info.ucountry" class="form-control"
                                                            id="example-date" type="text">
                                                        <option selected
                                                                value="<?php echo $u['ucountry'] ?>"><?php echo $u['ucountry'] ?></option>
                                                        <?php
                                                        foreach (get_countries_array() as $key => $value) {
                                                            ?>
                                                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-month">Gender</label>
                                                <div class="col-lg-10">
                                                    <select v-model="page.info.ugender" class="form-control"
                                                            id="example-month">
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <!--second view-->
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-textarea">Bio</label>
                                                <div class="col-lg-10">
                                                            <textarea v-model="page.info.ubio" class="form-control"
                                                                      rows="5"
                                                                      id="example-textarea"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-week"></label>
                                                <div class="col-lg-10">
                                                    <span style="cursor: default"
                                                          class="badge badge-soft-secondary mb-2">{{info}}</span>
                                                    <button :disabled="loading" onclick="addNewUser()"
                                                            class="btn btn-secondary w-100">Add
                                                        New User
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div><!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->

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
<script src="<?php echo BASE_URL ?>jslib/sweetalert.js?no-cache==<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/vue.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/axios.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script>
    //global vue data
    var page_var = {
        progress: false,
        msg: '',
        info: {upass: '', ugender: "M", ucountry: "Nigeria"}
    };
    //start script page here
    function addNewUser() {
        if (Object.keys(page_var.info).length < 5) {
            stop_loading("Empty data");
            return;
        }
        start_loading("Please wait...");
        //sending to network
        axi.post("access/x-user-add/?agent=axios", page_var.info)
            .then(function (res) {
                var r = res.data;
                if (r.status) {
                    //successfully logged
                    page_var.info.uname = "";
                    page_var.info.uemail = "";
                    page_var.info.ubio = "";
                    page_var.info.uphone = "";
                    shufflePass();
                    stop_loading(page_var.msg = r.msg);
                } else {
                    stop_loading(page_var.msg = r.msg);
                }
            })
            .catch(function (err) {
                stop_loading("Error occur...");
            })
    }
    //random user
    function shufflePass() {
        page_var.info.upass = getRandomChar(8);
    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
</html>
