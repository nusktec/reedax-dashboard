<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - admin-login.php
 */
define('SPECIAL_CODE', 100);
require_once(__DIR__ . "/../configs/loader.php");
require_once(__DIR__ . "/../lib/lib.php");
//start page scripting
set_title("Login");
//check if is logged
if (is_logged()) {
    redirect_to(BASE_URL . "admin");
}
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
            <div class="col-xl-10">
                <div class="card" id="app">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6 p-5">
                                <div class="mx-auto mb-5">
                                    <a href="<?php echo BASE_URL . 'admin'; ?>">
                                        <img src="<?php echo BASE_URL ?>assets/images/ryd_logo.png" alt="" height="24"/>
                                        <h3 class="d-inline align-middle ml-1 text-logo">RYD Administrator</h3>
                                    </a>
                                </div>

                                <h6 class="h5 mb-0 mt-4">Welcome back!</h6>
                                <p class="text-muted mt-1 mb-4">Enter your email address and password to
                                    access admin panel.</p>

                                <form action="#" class="authentication-form" onsubmit="return false">
                                    <div class="form-group">
                                        <label class="form-control-label">Email Address</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="mail"></i>
                                                        </span>
                                            </div>
                                            <input :disabled="loading" v-model="page.email" type="email"
                                                   class="form-control" id="email"
                                                   placeholder="hello@coderthemes.com">
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Password</label>
                                        <a href="#" class="float-right text-muted text-unline-dashed ml-1">Forgot your
                                            password?</a>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                            </div>
                                            <input :disabled="loading" v-model="page.pass" type="password"
                                                   class="form-control"
                                                   id="password"
                                                   placeholder="Enter your password">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Remember
                                                me</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <button onclick="process_login()" :disabled="loading"
                                                class="btn btn-primary btn-block"
                                                type="submit"> Proceed {{info}}
                                        </button>
                                    </div>
                                </form>
                                <!--                                    <div class="py-3 text-center"><span class="font-size-16 font-weight-bold">Or</span></div>-->
                                <!--                                    <div class="row">-->
                                <!--                                        <div class="col-6">-->
                                <!--                                            <a href="" class="btn btn-white"><i class='uil uil-google icon-google mr-2'></i>With Google</a>-->
                                <!--                                        </div>-->
                                <!--                                        <div class="col-6 text-right">-->
                                <!--                                            <a href="" class="btn btn-white"><i class='uil uil-facebook mr-2 icon-fb'></i>With Facebook</a>-->
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                            </div>
                            <div class="col-lg-6 d-none d-md-inline-block">
                                <div class="auth-page-sidebar"
                                     style="background-image: linear-gradient(#170227,#0b0b2a);">
                                    <div class="overlay"></div>
                                    <div class="auth-user-testimonial">
                                        <p class="font-size-24 font-weight-bold text-white mb-1">Black Zone - RYD</p>
                                        <p>- Admin User Only -</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Don't have an account? <a href="#"
                                                                        onclick="swal('Access Denied','No signup is allowed','error')"
                                                                        class="text-primary font-weight-bold ml-1">Sign
                                Up</a> | <a href="<?php echo BASE_URL ?>"
                                            class="text-primary font-weight-bold ml-1">Back Home <<</a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

</body>

<!-- Vendor js -->
<?php include "layouts/layout.foot.php"; ?>
<!--Third party-->
<?php ?>
</body>
<script src="<?php echo BASE_URL ?>jslib/sweetalert.js?no-cache=<?php echo rand(111, 999); ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/vue.min.js?no-cache=<?php echo rand(111, 999); ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/axios.min.js?no-cache=<?php echo rand(111, 999); ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/loader.rdx.js?no-cache=<?php echo rand(111, 999); ?>"></script>
<script>
    var page_var = {email: '', pass: ''};
    //wait small
    function process_login() {
        if (vue.$data.page.email === '' || vue.$data.page.pass === '') {
            stop_loading('- No user entries');
            return;
        }
        start_loading('- Please wait...');
        setTimeout(function () {
            login();
        }, 2000);
    }
    //start script page here
    function login() {
        var data = JSON.parse(JSON.stringify(vue.$data.page));
        //prepare axios for api calls
        axi.post("access/login/?agent=axios&desk=true", data)
            .then(function (res) {
                var r = res.data;
                if (r.status) {
                    start_loading('- Decrypting data...');
                    //successfully logged
                    setTimeout(function () {
                        start_loading('- Generating (adm) layout');
                        setTimeout(function () {
                            window.location.href = BASE_URL + 'admin';
                        }, 2000)
                    }, 3000);
                } else {
                    stop_loading('- Invalid email or password !');
                }
            })
            .catch(function (err) {
                stop_loading('- Server side error');
            })
    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js"></script>
</html>

