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
require_once(__DIR__ . "/../models/notifier.php");
//start page scripting
set_title("List Users");
set_sel_menu("List Users");
//redirect if not login
check_redirect(BASE_URL . "admin/login");
user_role_force(true, "admin/permission");
//window action token

$users = new users();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "layouts/layout.head.php"; ?>
    <!-- plugin css -->
    <link href="<?php echo BASE_URL ?>assets/be/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo BASE_URL ?>assets/be/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo BASE_URL ?>assets/be/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo BASE_URL ?>assets/be/libs/datatables/select.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
</head>

<body>
<script>
    //state instant form id
    var TMP_FORM_TOKEN = '<?php echo get_instant_form(); ?>';
    //load data from db
    var users = <?php echo json_encode($users->getAllActive(true)); ?>;
    var admins = <?php echo json_encode($users->getAllAdmin(true)); ?>;
    var banned = <?php echo json_encode($users->getAllBanned(true)); ?>;
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
                        <h4 class="mb-1 mt-0">List Users</h4>
                    </div>
                </div>
                <!--Start main rol-->
                <div class="row" id="app">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-1">Users Action Table</h4>
                                <p class="sub-header">
                                    View &amp; manage user privilege with actions buttons
                                    <br/>
                                    <strong class="text-danger">{{page.session}}</strong>
                                </p>
                                <div class="btn-group mb-2">
                                    <button onclick="dataSetter('users')" type="button" class="btn btn-secondary btn-sm">Actives</button>
                                    <button onclick="dataSetter('banned')" type="button" class="btn btn-secondary btn-sm">Banned</button>
                                    <button onclick="dataSetter('admin')" type="button" class="btn btn-secondary btn-sm">Admins</button>
                                </div>
                                <table id="datatable-buttons" class="table dt-responsive nowrap justify-content-center">
                                    <thead>
                                    <tr>
                                        <th>DP</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>Misc.</th>
                                        <th>Mobile Device</th>
                                        <th>Last Seen</th>
                                        <th>Confirm</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(i,k) in page.data.table">
                                        <td>
                                            <img :id="'img-'+i.uid"
                                                 :src="BASE_URL+'uploads/profile/'+i.img+'.jpg?no-cache='+getRandom(5000)"
                                                 @error="changeImg(i.uid,i.ugender)"
                                                 alt="image" class="avatar-xs rounded-circle">
                                        </td>
                                        <td>{{i.uname}} <i v-if="parseInt(i.uswore)===1"
                                                           class="uil uil-check-circle"
                                                           title="Approved Account"></i></td>
                                        <td>{{i.uemail}} <i v-if="parseInt(i.utype)===2" class="uil uil-award-alt"
                                                            title="Is Admin"></i></td>
                                        <td>{{i.ugender}}</td>
                                        <td>{{(i.uphone==='')?'No Phone':i.uphone}}</td>
                                        <td>{{i.ucountry}}</td>
                                        <td>
                                            <span class="badge badge-primary badge-pill">{{itb(i.uskill)?'Have Skill':'No Skill'}}</span>
                                            <span class="badge badge-secondary badge-pill">{{itb(i.ustudent)?'Student':'Worker'}}</span>
                                        </td>
                                        <td><span class="badge badge-warning badge-pill">{{i.umobile}}</span></td>
                                        <td>{{(i.ulast_seen===null||i.ulast_seen==='')?'No Time':i.ulast_seen}}</td>
                                        <td>
                                            <span v-if="itb(i.uverify)"
                                                  class="badge badge-success badge-pill">Verified</span>
                                            <span v-else="itb(i.uverify)" class="badge badge-warning badge-pill">Not Verified</span>
                                        </td>
                                        <td>
                                            <button @click="openWin(BASE_URL+'admin/user/edit-revoke/'+i.uid+'/'+TMP_FORM_TOKEN)"
                                                    class="btn btn-sm btn-secondary btn-rounded">
                                                Revoke-Edit <i class="uil uil-pen"
                                                               style="font-size: 10px"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--Global modal dialog-->
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
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
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/dataTables.keyTable.min.js"></script>

<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/buttons.html5.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/buttons.flash.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/buttons.print.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/buttons.pdf.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/buttons.zip.min.js"></script>
<!-- Data-tables init 2-->
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/dataTables.keyTable.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>assets/be/libs/datatables/dataTables.select.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>assets/be/js/pages/datatables.init.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>

<script src="<?php echo BASE_URL ?>jslib/sweetalert.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/vue.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/axios.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script>
    //global vue data
    var page_var = {
        progress: false,
        msg: 'User List',
        data: {table: users},
        session: 'Calculating form action time...'
    };
    //timer
    (function () {
        var timer = null;
        var sec = 241;
        timer = setInterval(function () {
            sec--;
            page_var.session = "Form actions session time is less than " + sec + " secs";
            if (sec < 1) {
                page_var.session = "No active form session, reload !";
                clearInterval(timer);
            }
        }, 1000);
    })();
    //image changer
    function changeImg(id, gender) {
        $('#img-' + id).attr("src", BASE_URL + 'assets/images/' + (gender === 'M' ? 'av_man.png' : 'av_girl.png'));
    }
    //data setter
    function dataSetter(type) {
        switch (type) {
            case 'users':
                //set user here
                page_var.data.table = users;
                break;
            case 'admin':
                //set admin here
                page_var.data.table = admins;
                break;
            case 'banned':
                //set banned here
                page_var.data.table = banned;
                break;
            default:
                //replace user again
                page_var.data.table = users;
        }
    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script>
    //count down
</script>
</html>
