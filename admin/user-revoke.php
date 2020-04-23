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
//find user or return
$id = @$_GET['id'];
$token = @$_GET['token'];
if (!isset($id) || !isset($token)) die("Invalid url parsed");
//get token 4 min expiration
if (!verify_instant_form($token, 4)) die("Invalid token request <a href='#' onclick='window.close()'> Close Me >></a>");
$user = new users();
//end of user find
$user = $user->findID($id);
if (!$user) die("Invalid user id request <a href='#' onclick='window.close()'> Close Me >></a>");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "layouts/layout.head.php"; ?>
</head>

<body>
<script>
    var USER_TMP = <?php echo json_encode($user)?>;
</script>
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

    <div style="display: none">
        <!-- Top-bar Start -->
        <?php include "layouts/layout.header.php"; ?>
        <!-- end Top-bar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include "layouts/layout.sidebar.php"; ?>
        <!-- Left Sidebar End -->
    </div>
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <!-- content -->
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-md-12">
                    <h4 class="mb-1 mt-0">Revoke <?php echo $user['uname']; ?></h4>
                </div>
            </div>

            <!--Start main rol-->
            <div class="row" id="app">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" id="app2">
                            <h4 class="header-title mt-0">User Data</h4>
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
                                            <div class="col-12">
                                                <input type="email" id="example-email"
                                                       name="example-email"
                                                       class="form-control"
                                                       v-model="page.info.uemail"
                                                       placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <button :disabled="page.rvk" @click="revoke_acc()"
                                                        class="btn btn-outline-secondary w-100 btn-sm"
                                                        style="cursor: pointer">
                                                    {{page.revokeBtn}} <i class="uil uil-lock-slash"></i>
                                                </button>
                                            </div>
                                            <div class="col-4">
                                                <button onclick="reset_password()"
                                                        class="btn btn-outline-danger w-100 btn-sm"
                                                        style="cursor: pointer">
                                                    Reset Password <i class="uil uil-padlock"></i>
                                                </button>
                                            </div>
                                            <div class="col-4">
                                                <button @click="ban_btn()"
                                                        class="btn btn-outline-secondary w-100 btn-sm"
                                                        style="cursor: pointer">
                                                    {{itb(page.info.ustatus)?'Ban User Account':'Unbanned Account'}} <i
                                                            class="uil uil-user-times"></i>
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
                                                    <?php
                                                    foreach (get_countries_array() as $key => $value) {
                                                        ?>
                                                        <option value="<?php echo $value ?>"
                                                                selected><?php echo $value ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <option selected
                                                            value="<?php echo $user['ucountry'] ?>"><?php echo $user['ucountry'] ?></option>
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
                                            <div class="card">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-md-7">
                                                        <div class="card-body">
                                                            <h5 class="card-title font-size-16">Profile
                                                                ({{itb(page.info.ustatus)?'Active':'Banned'}}) <i
                                                                        v-if="parseInt(page.info.uswore)===1"
                                                                        class="uil uil-check-circle"
                                                                        title="Is Admin"></i></h5>
                                                            <p class="card-text text-muted">{{page.info.ubio}}</p>
                                                            <p class="card-text">
                                                                <small class="text-muted">Joined at
                                                                    {{page.info.ucreated}}
                                                                </small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <img src="<?php echo BASE_URL ?>uploads/profile/<?php echo sha1($user['uid']) ?>.jpg?no-cache=<?php echo rand(111, 999) ?>"
                                                             onerror="this.src='<?php echo BASE_URL ?>assets/images/noimage.jpg'"
                                                             class="card-img"
                                                             alt="...">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xl-4">
                                                <div class="mt-4 mt-xl-0">
                                                    <h5 class="font-size-15 mb-1">Bio &amp; Special Ctrl.</h5>
                                                    <p class="sub-header">
                                                        Skills, technicality and others
                                                    </p>
                                                    <span class="badge badge-primary badge-pill">{{itb(page.info.uskill)?'Have Skill':'No Skill'}}</span>
                                                    <span class="badge badge-secondary badge-pill">{{itb(page.info.ustudent)?'Student':'Worker'}}</span>
                                                    <span class="badge badge-warning badge-pill">{{page.info.umobile}}</span>
                                                    <span onclick="btn_adm()"
                                                          :class="'badge'+' '+(sti(page.info.utype)===2?'badge-danger':'badge-success')+' badge-pill'"
                                                          style="cursor: pointer">{{sti(page.info.utype)===2?'Remove Admin':'Make Admin'}}</span>
                                                    <span onclick="verify_btn()"
                                                          :class="'badge'+' '+(sti(page.info.uswore)===1?'badge-danger':'badge-info')+' badge-pill'"
                                                          style="cursor: pointer">{{sti(page.info.uswore)===1?'Remove Verification':'Verify Account'}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"
                                                   for="example-week"></label>
                                            <div class="col-lg-10">
                                                    <span style="cursor: default"
                                                          class="badge badge-soft-secondary mb-2">{{page.msg}}</span>
                                                <button onclick="updates()" class="btn btn-danger w-100">Apply
                                                    Updates
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
</div>
<!-- END wrapper -->

<!-- Vendor js -->
<?php include "layouts/layout.foot.php"; ?>
<!--Third party-->
<?php if (@isset($_GET['banned']) && @$_GET['banned'] === true) { ?>
    <div style="background-color: rgba(0,0,0,0.6); position: absolute; top: 0; left: 0; right: 0; bottom: 0;">

    </div>
<?php } ?>
</body>
<script src="<?php echo BASE_URL ?>jslib/sweetalert.js?no-cache==<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/vue.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/axios.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script>
    //remove class
    window.onload = function () {
        document.body.className = "";
    };
    //global vue data
    var page_var = {
        progress: false,
        msg: '',
        rvk: false,
        revokeBtn: 'Revoke User',
        info: USER_TMP
    };
    //verify user function
    function verify_btn() {
        page_var.info.uswore === "1" ? page_var.info.uswore = "0" : page_var.info.uswore = "1"
    }
    //ban user function
    function ban_btn() {
        page_var.info.ustatus === "1" ? page_var.info.ustatus = "0" : page_var.info.ustatus = "1"
    }
    //revoke_access
    function revoke_acc() {
        page_var.info.utoken = "adc7eacdc554141e3db5142fbbb354c7-reedax-reset-" + getRandom(5000);
        page_var.rvk = true;
        page_var.revokeBtn = "User Revoked";
    }
    //make admin_access
    function btn_adm() {
        page_var.info.utype === "2" ? page_var.info.utype = "0" : page_var.info.utype = "2"
    }
    //start script page here
    function updates() {
        //sending to network
        axi.post("access/x-update/?agent=axios", page_var.info)
            .then(function (res) {
                var r = res.data;
                if (r.status) {
                    //successfully logged
                    page_var.msg = "Profile Settings Changed";
                    setTimeout(function () {
                        page_var.msg = "";
                    }, 5000);
                } else {
                    page_var.msg = r.msg;
                }
            })
            .catch(function (err) {
                page_var.msg = "Server error, try again";
            })
    }
    //revoke password
    function reset_password() {
        axi.post("access/x-update-reset/?agent=axios", {uid: page_var.info.uid})
            .then(function (res) {
                var r = res.data;
                if (r.status) {
                    //successfully logged
                    page_var.msg = r.msg;
                    swal("New Password", r.msg);
                } else {
                    page_var.msg = r.msg;
                }
            })
            .catch(function (err) {
                page_var.msg = "Server error, try again";
            })
    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
</html>
