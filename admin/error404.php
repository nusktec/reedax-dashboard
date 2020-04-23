<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - admin-login.php
 */
const SPECIAL_CODE = 100;
require_once(__DIR__ . "/../configs/loader.php");
require_once(__DIR__ . "/../lib/lib.php");
//start page scripting
set_title("Error404")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "layouts/layout.head.php"; ?>
</head>

<body>

<body class="authentication-bg">

<div class="account-pages my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-8">
                <div class="text-center">

                    <div>
                        <img src="<?php echo BASE_URL ?>assets/be/images/not-found.png" alt="" class="img-fluid"/>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <h3 class="mt-3">We couldn’t connect the dots</h3>
                <p class="text-muted mb-5">This page was not found. <br/> You may have mistyped the address or the page
                    may have moved.</p>

                <a href="<?php echo BASE_URL ?>admin" class="btn btn-lg btn-primary mt-4">Take me back to Home</a>
            </div>
        </div>
    </div>
    <!-- end container -->
</div>
<!-- end account-pages -->

<!-- Vendor js -->
<script src="<?php echo BASE_URL ?>assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="<?php echo BASE_URL ?>assets/js/app.min.js"></script>

</body>
<!-- end page -->

</body>


<!-- Vendor js -->
<?php include "layouts/layout.foot.php"; ?>
<!--Third party-->
<?php ?>
</body>
<script src="<?php echo BASE_URL ?>jslib/sweetalert.js"></script>
<script src="<?php echo BASE_URL ?>jslib/vue.min.js"></script>
<script src="<?php echo BASE_URL ?>jslib/axios.min.js"></script>
<script>
    //global vue data
    var page_var = {email: '', pass: ''};
    //start script page here
    function login() {
        start_loading('-Please wait...');
        //prepare axios for api calls

    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js"></script>
</html>

