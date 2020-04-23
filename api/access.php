<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 22/03/2020 - access.php
 */
define("APP_DIR", TRUE);
define("APP_USE_IMG", TRUE);
include 'controller.php';
include 'cmd.php';
//switching
switch ($cmd) {
    case 'login':
        login($data, $desk);
        break;
    case 'upload-dp':
        upload_imageDp();
        break;
    case 'p-update':
        change_password($data);
        break;
    case 'u-update':
        update_info($data);
        break;
    case 'c-update':
        update_config($data);
        break;
    case 'add-subscriber':
        add_email_sub($data);
        break;
    case 'notifications-send':
        send_notifications($data);
        break;
    case 'notifications-clear':
        clear_notifications();
        break;
    case 'messages-send':
        send_messages($data);
        break;
    case 'messages-clear-new':
        clear_new_messages($data);
        break;
    case 'update-payconfig':
        update_payconfig($data);
        break;
    case 'x-update-reset':
        update_user_reset($data);
        break;
    case 'x-update':
        update_user_data($data);
        break;
    case 'x-user-add':
        //function name
        insert_new_user($data);
        break;
    case 'cmd-name':
        //function name
        break;
    default:
        die(writer_json(false, [], "No valid command name"));
        break;
}

//functions list
function login($data, $desk = false)
{
    $d = cmd_access_login($data);
    if ($d == 100) {
        exit(writer_json(false, $data, "bad required args"));
    }
    if ($d == 300) {
        exit(writer_json(false, [], "user is locked by the super administrator"));
    }
    if ($d === null || $d === 404) {
        exit(writer_json(false, $d, "not a registered user"));
    } else {
        set_user_data($d);
        exit(writer_json(true, $d, "success"));
    }
}

/**Administrator command**/
//change dp images
function upload_imageDp()
{
    $utoken = @$_REQUEST['utoken'];
    $file = @$_FILES['udp'];
    if (@$file['error'] == UPLOAD_ERR_OK && isset($utoken)) {
        //confirm the token
        $usr = new users();
        $uid = (int)$usr->verify_token($utoken);
        if ($usr === 0) {
            exit(writer_json(true, [], "User not available..."));
        } else {
            //check file size and reject
            $size = (float)$file['size'] / 1024 / 1024;
            if ($size > 0.9) {
                die(writer_json(false, [], "File size too big "));
            }
            $file_name = sha1($uid);
            //make dir for dp
            @mkdir("../uploads/profile/");
            //resize image
            $img = new \Gumlet\ImageResize($file['tmp_name']);
            $img->scale(30);
            $img->resizeToHeight(500);
            $img->save("../uploads/profile/" . $file_name . ".jpg");
            //change permission
            chmod("../uploads/profile/" . $file_name . ".jpg", 0777);
            die(writer_json(true, [$file], "Successful"));
        }
    } else {
        die(writer_json(false, [], "Error uploading dp"));
    }
}

//change password
function change_password($data)
{
    $upd = cmd_access_change($data);
    if ($upd === 404) {
        exit(writer_json(false, [], "User not found !"));
    }
    if ($upd === 300) {
        exit(writer_json(false, [], "Old password mis-matched"));
    }
    if ($upd === 200) {
        exit(writer_json(true, [], "Password changed, takes effect on next login"));
    }
}

//update info
function update_info($data)
{
    $upd = cmd_access_update($data);
    if ($upd === 200) {
        die(writer_json(true, $upd, "Updated at " . get_utc_sample()));
    } else {
        die(writer_json(false, $upd, "Update failed !"));
    }
}

//update config
function update_config($data)
{
    $upd = cmd_access_config_update($data);
    if ($upd === 200) {
        die(writer_json(true, $upd, "Updated at " . get_utc_sample()));
    } else {
        die(writer_json(true, $upd, "Update failed !"));
    }
}

//add email subscribers
function add_email_sub($data)
{
    $upd = cmd_add_email_sub($data);
    if ($upd === 200) {
        die(writer_json(true, $upd, "Successfully add !"));
    } else {
        die(writer_json(false, $upd, "Subscribers already exist"));
    }
}

//send notifications
function send_notifications($data)
{
    $send = cmd_send_notification($data);
    if ($send === 200) {
        die(writer_json(true, $send, "Successfully sent !"));
    } else if ($send === 300) {
        die(writer_json(false, $send, "Invalid user email"));
    } else {
        die(writer_json(false, $send, "Unable to send notification"));
    }
}

//clear notifications
function clear_notifications()
{
    cmd_clear_notifications();
    die(writer_json(true, "cleared", "Cleared !"));
}

//send messages
function send_messages($data)
{
    $msg = cmd_send_messages($data);
    if ($msg === 404) {
        die(writer_json(false, $msg, "Unable to send message"));
    }
    if ($msg === 300) {
        die(writer_json(false, $msg, "Unable to send message (no user)"));
    }
    if ($msg === 200) {
        die(writer_json(true, $msg, "Message sent successfully"));
    }
}

//clear new messaged
function clear_new_messages($data)
{
    $clear = cmd_clear_new_message($data);
    die(writer_json(false, $clear, "Data accessed !"));
}

//update configurations
function update_payconfig($data)
{
    $pay = cmd_update_payconfig($data);
    if ($pay) {
        die(writer_json(true, $pay, "Saved !"));
    } else {
        die(writer_json(false, $pay, "Not saved (Retry)"));
    }
}

//updates users
function update_user_data($data)
{
    $upd = cmd_update_user($data);
    if ($upd == 200) {
        die(writer_json(true, $upd, "Saved !"));
    } else {
        die(writer_json(false, $upd, "Not saved (Retry)"));
    }
}

//updates users banned
function update_user_reset($data)
{
    $new_pass = get_random(8, 2);
    //minimize password
    $new_pass = substr($new_pass, 0, 10);
    $upd = cmd_update_user_reset($data['uid'], $new_pass);
    if ($upd == 200) {
        die(writer_json(true, $upd, "Safe Keep: " . $new_pass));
    } else {
        die(writer_json(false, $upd, "Not saved (Retry)"));
    }
}

//insert command
function insert_new_user($data)
{
    $ins = cmd_insert_user($data);
    if ($ins == 200) {
        die(writer_json(true, $ins, "Records added"));
    } elseif ($ins == 300) {
        die(writer_json(false, $ins, "Email already exist..."));
    } elseif ($ins == 101) {
        die(writer_json(false, $ins, "No email presents"));
    } else {
        die(writer_json(false, $ins, "Unable to insert (Retry)"));
    }
}