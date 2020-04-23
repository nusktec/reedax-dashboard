<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 22/03/2020 - permission.php
 */
require_once(__DIR__ . "/../configs/loader.php");
require_once(__DIR__ . "/../lib/lib.php");
//start page scripting
set_title("Permission");
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
                        <img src="<?php echo BASE_URL ?>assets/be/images/server-down.png" alt="" class="img-fluid"/>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <h3 class="mt-3">Opps, something went wrong</h3>
                <p class="text-muted mb-5">Server Error 500. We apoligise and are fixing the problem.<br/> Please try
                    again at a later stage.</p>

                <a href="<?php echo BASE_URL ?>admin/" class="btn btn-lg btn-primary mt-4">Take me back to Home</a><br/>
                <a href="<?php echo BASE_URL ?>admin/logout" class="btn btn-sm btn-outline-danger mt-4">Logout</a>
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

<!-- Vendor js -->
<?php include "layouts/layout.foot.php"; ?>
<!--Third party-->
<?php ?>
</body>
</html>

