<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 20/03/2020 - layout.head.php
 */
//global data
if (SPECIAL_CODE === 200) {
    $u = new users();
    $c = new config();
    $n = new notifier();
    $u = $u->setUid(get_user_data()['uid'])->getData(); //user data
}
?>
<!-- Basic Page Needs-->
<meta charset="utf-8"/>
<title><?php echo get_title(); ?> | <? echo META['title']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="<?php echo META['description'] ?>" name="description"/>
<meta content="<?php echo META['tags'] ?>" name="keywords"/>
<meta content="<?php echo META['author'] ?>" name="author"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo BASE_URL ?>assets/images/ryd_logo.png">

<!-- plugins -->
<link href="<?php echo BASE_URL ?>assets/be/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL ?>assets/be/libs/summernote/summernote-bs4.css" rel="stylesheet" type="text/css"/>

<!-- App css -->
<link href="<?php echo BASE_URL ?>assets/be/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL ?>assets/be/css/icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BASE_URL ?>assets/be/css/app.min.css" rel="stylesheet" type="text/css"/>
<script>
    //global vue data
    var BASE_URL = '<?php echo BASE_URL ?>';
    var USER_ID = '<?php echo @$u['uid'] ?>';
    var USER_TOKEN = '<?php echo @get_user_data()['utoken'] ?>';
    //write to local_storage
    var site_token = '<?php echo get_rdx_shuffled(get_rdx_token()) ?>';
    window.localStorage.setItem("reedax-token", site_token);
</script>