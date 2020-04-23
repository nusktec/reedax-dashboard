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
require_once(__DIR__ . "/../models/payconfig.php");
//start page scripting
set_title("Payment Config");
set_sel_menu("config");
//redirect if not login
check_redirect(BASE_URL . "admin/login");
user_role_force(true, "admin/permission");
//call on new instance
$pay = new payconfig();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "layouts/layout.head.php"; ?>
</head>

<body>
<script>
    var payconfig = <?php echo json_encode($pay->load_paystack(), true); ?>;
    payconfig.pupdate_user = <?php echo $u['uid']; ?>;
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
                        <h4 class="mb-1 mt-0">Payment Config</h4>
                    </div>
                </div>

                <!--Start main rol-->
                <div class="card p-2" id="app">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body">
                                <h4 class="header-title mt-0">Paystack Config</h4>
                                <p class="sub-header">
                                    See paystack dev. documentation for proper setups <a target="_blank"
                                                                                         href="https://developers.paystack.co/docs">paystack
                                        doc</a>
                                </p>

                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">SK Live</div>
                                    </div>
                                    <input v-model="page.data.psecret_key" type="text" class="form-control"
                                           placeholder="Secrete Key Live">
                                </div>

                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">PK Live</div>
                                    </div>
                                    <input v-model="page.data.ppublic_key" type="text" class="form-control"
                                           placeholder="Public Key Live">
                                </div>

                                <div class="row">
                                    <div class="input-group mb-2 col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Charges %</div>
                                        </div>
                                        <input v-model="page.data.pcharges" type="text" class="form-control"
                                               placeholder="0.00%">
                                    </div>
                                    <div class="input-group mb-2 col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Dollar Rate</div>
                                        </div>
                                        <input v-model="page.data.pdol_rate" type="text" class="form-control"
                                               placeholder="365.00">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mt-4 col-6">
                                        <div class="custom-control custom-switch mb-2">
                                            <input
                                                    onclick="page_var.data.pc_allowed=(this.checked)?1:0"
                                                    :checked="itb(page.data.pc_allowed)" type="checkbox"
                                                    class="custom-control-input" id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1">Allow users to pay
                                                service charges</label>
                                        </div>
                                    </div>
                                    <div class="mt-4 col-6">
                                        <button :disabled="loading" onclick="update_config()"
                                                class="btn btn-outline-secondary btn-sm w-100">{{info}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-6">
                            <div class="card-body">
                                <h4 class="header-title mt-0">Quick Menus</h4>
                                <div class="mt-3">
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input onclick="page_var.data.penabled=(this.checked)?1:0"
                                               :checked="itb(page.data.penabled)" type="checkbox"
                                               class="custom-control-input"
                                               id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Enable Paystack</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input onclick="page_var.data.pdol_support=(this.checked)?1:0"
                                               :checked="itb(page.data.pdol_support)"
                                               class="custom-control-input" id="customCheck12" type="checkbox">
                                        <label class="custom-control-label" for="customCheck12">Support Dollar</label>
                                    </div>
                                </div>

                                <h4 class="font-size-15 mt-3">Default Currency</h4>
                                <div class="">
                                    <div class="custom-control custom-radio mb-2">
                                        <input v-model="page.data.pdefault" type="radio" id="customRadio1"
                                               name="customRadio"
                                               class="custom-control-input" value="naira">
                                        <label class="custom-control-label" for="customRadio1">Naira (&#8358;)</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input v-model="page.data.pdefault"
                                               type="radio" id="customRadio2" name="customRadio"
                                               class="custom-control-input" value="dollar">
                                        <label class="custom-control-label" for="customRadio2">Dollar ($)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    var button_txt = "Save";
    //global vue data
    var page_var = {
        progress: false,
        msg: 'Nothing',
        data: payconfig
    };
    //start script page here
    function update_config() {
        //sending to network
        start_loading("Saving...");
        axi.post("access/update-payconfig/?agent=axios", page_var.data)
            .then(function (res) {
                var r = res.data;
                if (r.status) {
                    //successfully logged
                    stop_loading(r.msg);
                } else {
                    stop_loading(r.msg);
                }
            })
            .catch(function (err) {
                page_var.msg = "Server error, try again";
            })
    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script>
    vue.$data.info = button_txt;
</script>
</html>
