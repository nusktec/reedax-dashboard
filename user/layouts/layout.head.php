<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - layout.head.php
 */
//add config here
define("APP_DIR", true);
include __DIR__ . "/../../models/config.php";
//check if maintenance mode is on
$c = new config();
if ($c->get_maintenance_mode() === 1) {
    if (defined("SPECIAL_CODE") && SPECIAL_CODE !== 401) {
        //redirect if maintenance mode is on
        redirect_to("maintenance");
    }
} else {
    if (defined("SPECIAL_CODE") && SPECIAL_CODE === 401) {
        //redirect if maintenance mode is on
        redirect_to("login");
    }
}
?>
<!-- Basic Page Needs================================================== -->
<title><?php echo get_title() ?> | <? echo META['title']; ?></title>
<meta charset="utf-8">
<meta content="<?php echo META['description'] ?>" name="description"/>
<meta content="<?php echo META['tags'] ?>" name="keywords"/>
<meta content="<?php echo META['author'] ?>" name="author"/>
<!-- Favicon -->
<link href="<?php echo BASE_URL; ?>assets/images/ryd_logo.png" rel="icon" type="image/png">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/fe/css/style.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/fe/css/night-mode.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/fe/css/framework.css">

<!-- icons
================================================== -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/fe/css/icons.css">

<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;display=swap"
      rel="stylesheet">

<script>
    //global vue data
    var BASE_URL = '<?php echo BASE_URL ?>';
    var USER_TOKEN = '<?php echo @get_user_data()['utoken'] ?>';
    //write to local_storage
    var site_token = '<?php echo get_rdx_shuffled(get_rdx_token()) ?>';
    window.localStorage.setItem("reedax-token", site_token);
</script>