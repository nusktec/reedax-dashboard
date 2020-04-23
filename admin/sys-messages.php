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
set_title("Messages");
set_sel_menu('messages');
//redirect if not login
check_redirect(BASE_URL . "admin/login");
user_role_force(true, "admin/permission");
//page initializer
$msg = new messages();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "layouts/layout.head.php"; ?>
</head>
<body>
<style>
    .soft-danger {
        background-color: #fff1f1 !important;
        color: #ff5c75 !important;
        font-weight: bold;
    }
</style>
<script>
    var msg_all = <?php echo json_encode($msg->get_sys_messages_all()) ?>;
    var msg_sent = <?php echo json_encode($msg->get_sys_messages_sent((int)$u['uid'])) ?>;
    var msg_noti = <?php echo json_encode($n->get_all_notifications_for_table()) ?>;
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
                        <h4 class="mb-1 mt-0">Messages & Notifications</h4>
                    </div>
                </div>
                <!--Start main rol-->
                <div class="row" id="app">
                    <div class="col-12">
                        <div class="email-container bg-transparent">
                            <!-- Left sidebar -->
                            <div class="inbox-leftbar card">

                                <a href="javascript:void(0)" onclick="composeNewMsg()" class="btn btn-danger btn-block">Compose</a>

                                <div class="mail-list mt-4">
                                    <a href="javascript:void(0)" onclick="load_data('inbox')"
                                       class="list-group-item border-0"
                                       :class="(page.focus==='inbox')?'font-weight-bold text-danger':''">
                                        <i class="uil uil-envelope-alt font-size-15 mr-1"></i>Inbox<span
                                                class="badge float-right ml-2 mt-1"></span></a>
                                    <a href="javascript:void(0)" onclick="load_data('sent')"
                                       class="list-group-item border-0"
                                       :class="(page.focus==='sent')?'font-weight-bold text-danger':''"><i
                                                class="uil uil-envelope-share font-size-15 mr-1"></i>Sent Messages</a>
                                    <a href="javascript:void(0)" onclick="load_data('noti')"
                                       class="list-group-item border-0"
                                       :class="(page.focus==='noti')?'font-weight-bold text-danger':''"><i
                                                class="uil uil-bell font-size-15 mr-1"></i>Notifications</a>
                                    <div class="btn-group dropdown mt-0 mr-1">
                                        <a href="javascript:void(0)"
                                           class="list-group-item border-0"
                                           :class="(page.focus==='notify')?'font-weight-bold text-danger':''"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="uil uil-bell-school font-size-15 mr-1"></i>Notify Users</a>
                                        <form onsubmit="return false" class="dropdown-menu dropdown-lg p-3"
                                              x-placement="bottom-start"
                                              style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 29px, 0px);">
                                            <div class="form-group">
                                                <label for="exampleDropdownFormEmail2">Email (specify user)</label>
                                                <input v-model="page.noti.user" type="text" class="form-control"
                                                       id="exampleDropdownFormEmail2"
                                                       placeholder="Leave it blank to notify all">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleDropdownFormPassword2">{{page.noti.error}}</label>
                                                <textarea v-model="page.noti.msg" cols="3" rows="3" class="form-control"
                                                          id="exampleDropdownFormPassword2"
                                                          placeholder="Message"></textarea>
                                            </div>
                                            <button :disabled="(page.noti.sending)" onclick="send_notification()"
                                                    type="submit"
                                                    class="btn btn-danger w-100">Notify Now
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <!-- end chatbox -->
                            </div>
                            <!-- End Left sidebar -->
                            <!-- start right sidebar -->
                            <div class="inbox-rightbar">
                                <div class="d-inline-block align-middle float-lg-right">
                                    <div class="row">
                                        <div class="col-8 align-self-center">
                                            Showing 1 - 1 of 1
                                        </div> <!-- end col-->
                                        <div class="col-4">
                                            <div class="btn-group float-right">
                                                <button type="button" class="btn btn-white btn-sm"><i
                                                            class="uil uil-angle-left"></i></button>
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                            class="uil uil-angle-right"></i></button>
                                            </div>
                                        </div> <!-- end col-->
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <h5 class="mt-3 mb-2 font-size-16">{{page.title}}</h5>
                                    <ul v-if="page.isComp" class="message-list">
                                        <div>
                                            <div class="form-group">
                                                <input v-model="page.comp.to" type="email" class="form-control"
                                                       placeholder="To">
                                            </div>

                                            <div class="form-group">
                                                <input v-model="page.comp.sub" type="text" class="form-control"
                                                       placeholder="Subject">
                                            </div>
                                            <div class="form-group">
                                            <textarea v-model="page.comp.msg" cols="9" rows="5"
                                                      class="note-codable form-control"
                                                      role="textbox"
                                                      aria-multiline="true"></textarea>
                                            </div>
                                            <div class="form-group pt-2">
                                                <span class="badge badge-secondary">{{page.comp.error}}</span>
                                                <div class="text-right">
                                                    <button onclick="page_var.isComp=false;" type="button"
                                                            class="btn btn-danger mr-1"><i
                                                                class="uil uil-arrow-circle-left ml-2"></i> Back
                                                    </button>
                                                    <button onclick="send_message()" :disabled="(page.comp.sending)"
                                                            class="btn btn-primary">
                                                        <span>Send</span> <i
                                                                class="uil uil-message ml-2"></i></button>
                                                </div>
                                            </div>

                                        </div> <!-- end card-->
                                    </ul>
                                    <ul v-else="page.isComp" class="message-list">
                                        <li class="unread" v-for="(d,k,i) in page.data" :title="'Delivered on '+d.mdate"
                                            v-bind:key="k" @click="del(k,d.mid)"
                                            :class="(k===page.selected)?'soft-danger':''">
                                            <div class="col-mail col-mail-1">
                                                <div class="checkbox-wrapper-mail">
                                                    <input type="checkbox" id="chk1">
                                                    <label for="chk1" class="toggle"></label>
                                                </div>
                                                <span class="star-toggle uil text-warning"
                                                      :class="(d.mread==='0')?'uil-star':''"></span>
                                                <a href="javascript:void(0)"
                                                   class="title">{{d.uname+' ('+d.uemail+')'}}</a>
                                            </div>
                                            <div class="col-mail col-mail-2">
                                                <a href="javascript:void(0)" class="subject">{{d.mdata}}
                                                    <span class="badge badge-soft-secondary">{{full_time(Date.parse(d.mdate))}}</span>
                                                </a>
                                                <div class="date">{{time_ago(Date.parse(d.mdate))}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end right sidebar -->
                            <div class="clearfix"></div>
                        </div>
                    </div> <!-- end Col -->
                </div><!-- End row -->

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
<script src="<?php echo BASE_URL ?>assets/be/js/pages/email-inbox.init.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<!--Third party-->
<?php ?>
</body>
<script src="<?php echo BASE_URL ?>jslib/sweetalert.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/vue.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/axios.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script>
    //class switcher
    function load_data(type) {
        page_var.focus = type;
        //change topic
        switch (type) {
            case 'inbox':
                page_var.title = 'Inbox';
                page_var.data = msg_all;
                break;
            case 'noti':
                page_var.title = 'Notifications';
                page_var.data = msg_noti;
                break;
            case 'sent':
                page_var.title = 'Sent';
                page_var.data = msg_sent;
                break;
            case 'notify':
                page_var.title = 'Notifier';
                break;
            default:
                page_var.title = 'Inbox';
                page_var.data = msg_all;
                break
        }
        //reset
        page_var.selected = null;
        page_var.onDel = null;
        page_var.isComp = false;
    }
    //global vue data
    var page_var = {
        progress: false,
        msg: 'Settings',
        focus: 'inbox',
        title: 'Inbox',
        data: msg_all,
        selected: null,
        onDel: null,
        isComp: false,
        cdata: null,
        noti: {error: 'Message', user: '', msg: '', sending: false},
        comp: {to: '', sub: '', msg: '', error: '', sending: false}
    };
    //get selected
    function del(del, mid) {
        page_var.selected = del;
        page_var.onDel = mid;
        //clear message read
        var post_del = {mid: mid, target: page_var.focus};
        axi.post("access/messages-clear-new/?agent=axios", post_del)
            .then(function (res) {
                //cleared
            })
            .catch(function (err) {
                //silence error
                //clear
            })

    }
    //compose active
    function composeNewMsg() {
        page_var.isComp = true;
        page_var.title = "Compose"
    }
    //send notification
    function send_notification() {
        var ndata = page_var.noti;
        if (!ndata.msg) {
            ndata.error = "Message is empty";
            return;
        }
        ndata.error = "Sending...";
        ndata.sending = true;
        //sending to server
        axi.post("access/notifications-send/?agent=axios", {msg: ndata.msg, user: ndata.user})
            .then(function (res) {
                var r = res.data;
                if (r.status) {
                    //successfully logged
                    ndata.sending = false;
                    ndata.error = r.msg;
                    ndata.msg = '';
                    ndata.user = '';
                } else {
                    ndata.sending = false;
                    ndata.error = r.msg;
                }
            })
            .catch(function (err) {
                ndata.error = "Server error, try again";
            })
    }
    //start script page here
    function send_message() {
        var m = page_var.comp;
        if (m.to === '' || m.sub === '' || m.msg === '') {
            //msg is empty
            m.error = 'Message compulsory fields are are empty';
            return;
        }
        m.error = "Please wait...";
        m.sending = true;
        m.from = <?php echo $u['uid'] ?>;
        //sending to network
        axi.post("access/messages-send/?agent=axios", m)
            .then(function (res) {
                var r = res.data;
                console.log(r);
                if (r.status) {
                    //successfully logged
                    m.sending = false;
                    page_var.comp.error = r.msg;
                    page_var.comp.msg = '';
                    page_var.comp.sub = '';
                    page_var.comp.to = '';
                } else {
                    page_var.comp.error = r.msg;
                    m.sending = false;
                }
            })
            .catch(function (err) {
                page_var.msg = "Server error, try again";
            })
    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
</html>
