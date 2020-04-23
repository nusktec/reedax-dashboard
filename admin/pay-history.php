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
set_title("Payment History")
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
                        <h4 class="mb-1 mt-0">Payment History</h4>
                    </div>
                </div>

                <!--Start main rol-->

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
        msg: 'Settings'
    };
    //start script page here
    function login() {
        //sending to network
        axi.post("access/c-update/?agent=axios", {type: type, value: iv})
            .then(function (res) {
                var r = res.data;
                location.reload(true);
                if (r.status) {
                    //successfully logged
                    page_var.msg = "System Settings Changed";
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
