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
<style>
    .img-hover:hover {
        border: 2px solid #c8ecff;
    }
</style>
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

    <!-- Topbar Start -->
    <?php include "layouts/layout.header.php"; ?>
    <!-- end Topbar -->

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
                        <h4 class="mb-1 mt-0">System Profile</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" id="app">
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
                                                           value="<?php echo $u['uname']; ?>" placeholder="Full names">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-email">Email</label>
                                                <div class="col-lg-10">
                                                    <input disabled="disabled" type="email" id="example-email"
                                                           name="example-email"
                                                           class="form-control"
                                                           placeholder="<?php echo $u['uemail']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-password">Password</label>
                                                <div class="col-lg-7">
                                                    <input disabled="disabled" type="password" class="form-control"
                                                           id="example-password" value="password">
                                                </div>
                                                <div class="col-lg-3">
                                                    <button data-toggle="modal" data-target="#bs-password-modal"
                                                            type="button"
                                                            class="btn btn-danger w-100">Change
                                                    </button>
                                                </div>
                                            </div>
                                            <!--Modal for password change-->
                                            <div class="modal fade" id="bs-password-modal" tabindex="-1" role="dialog"
                                                 aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="mySmallModalLabel">Change
                                                                Password</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form onsubmit="return false"
                                                                  class="dropdown-menu dropdown-lg p-3"
                                                                  x-placement="bottom-start"
                                                                  style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 29px, 0px);">
                                                                <div class="form-group">
                                                                    <label>Old
                                                                        Password</label>
                                                                    <input v-model="page.password.old" type="password"
                                                                           class="form-control"
                                                                           placeholder="Old Password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>New
                                                                        Password</label>
                                                                    <input v-model="page.password.new1" type="password"
                                                                           class="form-control"
                                                                           placeholder="New Password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Repeat
                                                                        Password</label>
                                                                    <input v-model="page.password.new2" type="password"
                                                                           class="form-control"
                                                                           placeholder="Repeat Password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <span class="badge badge-danger mb-2">{{page.password.msg}}</span>
                                                                    <button onclick="changePassword()"
                                                                            :disabled="page.password.loading"
                                                                            class="btn btn-danger w-100">Apply Changes
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            <!--End of password modal-->

                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label"
                                                       for="example-placeholder">Phone</label>
                                                <div class="col-lg-10">
                                                    <input v-model="page.info.uphone" type="text" class="form-control"
                                                           placeholder="Phone number" id="example-placeholder"
                                                           value="<?php echo $u['uphone']; ?>">
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
                                                       for="example-fileinput">Avatar</label>
                                                <div class="col-lg-10">
                                                    <input onchange="uploadNow()" type="file" accept="image/*"
                                                           class="d-none"
                                                           id="imgfile">
                                                    <img onclick="$('#imgfile').trigger('click')"
                                                         style="cursor: pointer"
                                                         src="<?php echo BASE_URL ?>uploads/profile/<?php echo sha1(get_user_data()['uid']) ?>.jpg?no-cache=<?php echo rand(111, 999) ?>"
                                                         onerror="this.src='<?php echo BASE_URL ?>assets/images/av_man.png'"
                                                         class="avatar-lg rounded-circle mr-2 img-hover" alt="Avatar"/>
                                                    <span style="cursor: default"
                                                          class="badge badge-soft-secondary">{{page.msg}}</span>
                                                </div>
                                            </div>
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
                                                          class="badge badge-soft-secondary mb-2">{{page.info.msg}}</span>
                                                    <button onclick="updateinfo()" class="btn btn-danger w-100">Apply
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
<script src="<?php echo BASE_URL ?>jslib/sup.js?no-cache"></script>
<script>
    //global vue data
    var page_var = {
        progress: false,
        msg: 'Profile Image',
        password: {old: '', new1: '', new2: '', msg: 'No changes were made', loading: false, utoken: USER_TOKEN},
        info: {
            uname: '<?php echo $u['uname'] ?>',
            uphone: '<?php echo $u['uphone'] ?>',
            ucountry: '<?php echo $u['ucountry'] ?>',
            ugender: '<?php echo $u['ugender'] ?>',
            ubio: '<?php echo $u['ubio'] ?>',
            utoken: USER_TOKEN,
            msg: 'No Update !'
        }
    };

    //change password
    function changePassword() {
        var d2 = vue.$data.page.password;
        if (d2.old === '' || d2.new1 === '' || d2.new3 === '') {
            d2.msg = "No new entries !";
            return;
        }
        //compare if n1 an n2 is equal
        if (d2.new1 !== d2.new2) {
            d2.msg = "Password not the same";
            return;
        }
        if (d2.new1.length < 5 && d2.new2.length < 5) {
            d2.msg = "Password length too small";
            return;
        }
        //prepare loading
        d2.msg = "Sending request...";
        setTimeout(function () {
            //sending to network
            axi.post("access/p-update/?agent=axios", d2)
                .then(function (res) {
                    var r = res.data;
                    if (r.status) {
                        //successfully logged
                        d2.msg = "Password changed, takes effect on next login";
                        d2.new1 = '';
                        d2.new2 = '';
                        d2.old = '';
                    } else {
                        d2.msg = r.msg;
                    }
                })
                .catch(function (err) {
                    d2.msg = "Server error, try again";
                })
        }, 2000);
    }
    //upload script
    function uploadNow() {
        $('#imgfile').simpleUpload(BASE_URL + "api/access/upload-dp", {
            name: 'udp',
            data: {utoken: USER_TOKEN},
            allowedExts: ['jpg', 'jpeg', 'png', 'JPG', 'PNG', 'JPEG'],
            maxFileSize: 1000000,
            beforeSend: function (jqXHR, settings) {
                jqXHR.setRequestHeader('RDX-Locker', reedax_token);
            },
            start: function (file) {
                //upload started
                vue.$data.page.progress = true;
            },
            progress: function (progress) {
                //received progress. don't tell anyone that your loading
                vue.$data.page.progress = true;
                vue.$data.page.msg = 'Uploading...' + Math.floor(progress) + "%";
            },
            success: function (data) {
                //reload page when done
                vue.$data.page.progress = false;
                vue.$data.page.msg = 'Image Updated';
                setTimeout(function () {
                    window.location.reload(true);
                }, 1000)
            },
            error: function (error) {
                //upload failed, keep silence when error occur
                vue.$data.page.progress = true;
                vue.$data.page.msg = error.message;
            }
        });
    }
    //update user info
    function updateinfo() {
        var ui = vue.$data.page.info;
        if (ui.uname === '' || ui.ucountry === '' || ui.ugender === '') {
            ui.msg = 'Unable to submit empty data';
            return;
        }
        //sending to server
        axi.post("access/u-update/?agent=axios", ui)
            .then(function (res) {
                var r = res.data;
                ui.msg = r.msg;
            })
            .catch(function (err) {
                ui.msg = "Failed to update";
            })
    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js"></script>
</html>
