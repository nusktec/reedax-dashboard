<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 22/03/2020 - cmds.php
 */
//error_reporting(0);
if (!defined('APP_DIR')) die("No direct access");
//include user model
include "../models/users.php";
include "../models/config.php";
include "../models/emails.php";
include "../models/notifier.php";
include "../models/messages.php";
include "../models/payconfig.php";

//Access api controllers
function cmd_access_login($data)
{
    if (!isset($data['email']) || !isset($data['pass'])) {
        return 100;
    }
    //start to fetch
    $usr = new users();
    $usr->setEmail($data['email']);
    $usr->setPass(sha1($data['pass']));
    $usr->setUid(0);
    $usr = $usr->getData();
    if ($usr === null) {
        return 404;
    }
    if (@$usr['ustatus'] === '0') {
        return 300;
    }
    return $usr;
}

//change password
function cmd_access_change($data)
{
    if (!isset($data['utoken']) || !isset($data['old'])) {
        return 100;
    }
    $tkn = $data['utoken'];
    $user = new users();
    //confirm utoken
    $uid = $user->verify_token($tkn);
    //start to fetch
    $user->setUid($uid);
    $usr = $user->getData();
    if ($usr === null) {
        return 404;
    }
    if ($usr['upass'] === sha1($data['old'])) {
        //prepare update
        $user->updateRow(['upass' => sha1($data['new1'])], "uid=%i", $uid);
        return 200;
    } else {
        return 300;
    }
}

//update user info
function cmd_access_update($data)
{
    $tkn = $data['utoken'];
    //remove token from updates
    unset($data['utoken']);
    unset($data['msg']);
    $dt = $data;
    if (!isset($tkn) || empty($tkn)) {
        return 100;
    }
    $user = new users();
    //do confirm token
    $uid = $user->verify_token($tkn);
    //check array empty
    if (!count_array_empty($dt, 2)) {
        //straight to execution
        $user->updateRow($dt, "uid=%i", $uid);
        return 200;
    }
    return 300;
}

//update admin config info
function cmd_access_config_update($data)
{
    //straight to execution
    $config = new config();
    //separate data
    switch (strtolower($data['type'])) {
        case 'noti':
            $config->set_allow_notifications((int)$data['value']);
            break;
        case 'email':
            $config->set_allow_email((int)$data['value']);
            break;
        case 'main':
            $config->set_allow_maintenance((int)$data['value']);
            break;
        case 'feed':
            $config->set_allow_feedback((int)$data['value']);
            break;
        default:
            null;
    }
    return 200;
}

//add email subscribers
function cmd_add_email_sub($data)
{
    if (!check_array_empty($data)) {
        //proceed adding user
        $email = new emails();
        $put = $email->add_new_email($data['name'], $data['email']);
        if ($put) {
            return 200;
        }
    }
    return 300;
}

//send notification
function cmd_send_notification($data)
{
    $not = new notifier();
    $req = $not->send_notification($data['user'], $data['msg']);
    if ($req === 1) {
        //inserted
        return 200;
    } else if ($req === 2) {
        //user not found
        return 300;
    } else {
        //unable to insert
        return 404;
    }
}

//clear notifications
function cmd_clear_notifications()
{
    $not = new notifier();
    $not->clear_system_notification();
    return true;
}

//send messages
function cmd_send_messages($data)
{
    //check array is clean
    if (check_array_empty($data)) {
        return 404;
    }
    //continue to db
    $msg = new messages();
    return $msg->send_system_msg($data);
}

//clear new messages
function cmd_clear_new_message($data)
{
    $msg = new messages();
    return $msg->clear_messages($data);
}

//update payment data
function cmd_update_payconfig($data)
{
    $pay = new payconfig();
    return $pay->update_paystack($data);
}

//update user info
function cmd_update_user($data)
{
    $uid = (int)$data['uid'];
    //remove token from updates
    unset($data['uid']);
    //iterate and convert
    foreach ($data as $key => $value) {
        if (strlen($value) === 1 && is_numeric($value)) {
            $data[$key] = (int)$value;
        }
    }
    $dt = $data;
    $user = new users();
    //check array empty
    //straight to execution
    $user->updateRow($dt, "uid=%i", $uid);
    return 200;
}

//update user info
function cmd_update_user_reset($uid, $newpass)
{
    $uid = (int)$uid;
    //remove token from updates
    $user = new users();
    //straight to execution
    $user->updateRow(['upass' => sha1($newpass)], "uid=%i", $uid);
    return 200;
}

//insert users
function cmd_insert_user($data)
{
    $usr = new users();
    return $usr->insertNewUser($data);
}