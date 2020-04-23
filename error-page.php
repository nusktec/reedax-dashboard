<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 21/03/2020 - template.php
 */
require_once(__DIR__ . "/configs/loader.php");
require_once(__DIR__ . "/lib/lib.php");
$to_url = @($_GET['to']) ? base64_decode($_GET['to']) : BASE_URL;
$msg = @($_GET['msg']) ? base64_decode($_GET['msg']) : 'No reason(s) were found !';
//script config start
set_title("Login");
//script config ends
?>
<!doctype html>
<html lang="en">

<head>
    <?php include 'user/layouts/layout.head.php'; ?>
</head>

<body>

<div id="wrapper">
    <!--Main contents-->
    <div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-1-2@m uk-width-1-2@s m-auto text-center">

            <img src="assets/images/maintenance.svg" alt="" class="my-3">

            <h3>Something went wrong !</h3>
            <p class="mb-0"><?php echo $msg; ?></p>
            <a href="<?php echo $to_url ?>" class="button grey my-4 small">
                <i class="icon-feather-arrow-left mr-2"></i> Back Home</a>
            <br/>
            <a href="#modal-close-default" class="grey transition-3d-hover my-4 small" uk-toggle>Notify developer</a>

        </div>
    </div>


    <!-- This is the modal with the default close button -->
    <div id="modal-close-default" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-width-1-3@m uk-text-center bg-gradient-grey uk-light rounded">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="my-3">
                <i class="icon-feather-mail icon-large"></i>
            </div>
            <h4>Notify me when is lanch</h4>
            <p class="mb-4"> Become first one know when we Lanch our site </p>

            <form action="#">

                <input type="text" class="uk-input mb-4" placeholder="Your name">
                <input type="email" class="uk-input mb-4" placeholder="Email Address">
                <input type="submit" class="button white block large mb-0" value="Subscribe">
                <p class="uk-text-small mt-2">No Spam, we promise .</p>

            </form>


        </div>
    </div>
</div>


<?php include 'user/layouts/layout.foot.php'; ?>

</body>

</html>

