<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 21/03/2020 - template.php
 */
define("SPECIAL_CODE", 401);
require_once("configs/loader.php");
require_once("lib/lib.php");
//script config start
set_title("Maintenance");
//script config ends
?>
<!doctype html>
<html lang="en">

<head>
    <?php include 'user/layouts/layout.head.php'; ?>
</head>

<body>

<div id="wrapper">
    <!-- Content / End -->

    <div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-1-2@m uk-width-1-2@s m-auto text-center">

            <img src="<?php echo BASE_URL; ?>assets/fe/images/maintenance.svg" alt="" class="my-3">

            <h3>We're making some improvements</h3>
            <p class="mb-0"> We apologize for the inconvenience but we are currently <br> undergoing planned
                maintenance.</p>
            <a href="#modal-close-default" class="button grey transition-3d-hover my-4 small" uk-toggle>
                <i class="icon-feather-clock mr-2"></i> Notify me</a>

        </div>
    </div>


    <!-- This is the modal with the default close button -->
    <div id="modal-close-default" uk-modal>
        <div id="app"
             class="uk-modal-dialog uk-modal-body uk-width-1-3@m uk-text-center bg-gradient-grey uk-light rounded">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="my-3">
                <i class="icon-feather-mail icon-large"></i>
            </div>
            <h4>Notify me when is launch</h4>
            <p class="mb-4"> Become first to know when we launch our site or back online</p>

            <form action="#" onsubmit="return false">
                <p>{{page.msg}}</p>
                <input v-model="page.data.name" type="text" class="uk-input mb-4" placeholder="Your name">
                <input v-model="page.data.email" type="email" class="uk-input mb-4" placeholder="Email Address">
                <input onclick="add_subscriber()" type="submit" class="button white block large mb-0" :value="page.btn">
                <p class="uk-text-small mt-2">No Spam, we promise.</p>

            </form>


        </div>
    </div>
</div>


<?php include 'user/layouts/layout.foot.php'; ?>

</body>
<script src="<?php echo BASE_URL ?>jslib/sweetalert.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/vue.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/axios.min.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script src="<?php echo BASE_URL ?>jslib/sup.js?no-cache=<?php echo rand(1111, 9999) ?>"></script>
<script>
    //global vue data
    var page_var = {
        progress: false,
        msg: '',
        btn: 'Subscribe',
        data: {name: '', email: ''}
    };
    //change password
    function add_subscriber() {
        //check user input
        var data = vue.$data.page.data;
        if (data.email === '' || data.name === '') {
            page_var.msg = "User detail appears blank";
            return;
        }
        //sending to network
        axi.post("access/add-subscriber/?agent=axios", data)
            .then(function (res) {
                var r = res.data;
                if (r.status) {
                    //successfully logged
                    page_var.msg = "Successfully subscribed !";
                    data.email = '';
                    data.name = '';
                } else {
                    page_var.msg = r.msg;
                }
            })
            .catch(function (err) {
                page_var.msg = "Server error, try again";
            })
    }
</script>
<script src="<?php echo BASE_URL ?>jslib/main.rdx.js"></script>
</html>

