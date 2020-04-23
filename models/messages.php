<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 09/04/2020 - messages.php
 */
if (!defined('APP_DIR')) die("No direct access");
include_once __DIR__ . "/../lib/db.class.php";

class messages
{
    private $table_msg = "rs_messages";

    public function __construct()
    {
    }

    //fetch system messages only
    public function get_sys_messages_all()
    {
        $rd = DB::query("SELECT M.*, (SUBSTRING_INDEX(U.uname,' ',1)) AS uname, U.uemail, U.uid FROM `" . $this->table_msg . "` AS M JOIN `rs_users` AS U ON M.mfrom=U.uid  WHERE `msystem`=1 ORDER BY `mread` DESC");
        if ($rd) {
            return array_reverse($rd);
        } else {
            return false;
        }
    }

    //fetch system messages unread only
    public function get_sys_messages_unread()
    {
        $rd = DB::query("SELECT M.*, U.uname, U.uemail, U.uid FROM `" . $this->table_msg . "` AS M JOIN `rs_users` AS U ON M.mfrom=U.uid  WHERE `msystem`=1 AND `mread`=0");
        if ($rd) {
            return array_reverse($rd);
        } else {
            return false;
        }
    }

    //fetch system messages only unread
    public function get_sys_messages_read()
    {
        $rd = DB::query("SELECT M.*, U.uname, U.uemail, U.uid FROM `" . $this->table_msg . "` AS M JOIN `rs_users` AS U ON M.mfrom=U.uid  WHERE `msystem`=1 AND `mread`=1");
        if ($rd) {
            return array_reverse($rd);
        } else {
            return false;
        }
    }

    //fetch system sent messages
    public function get_sys_messages_sent($id)
    {
        $logged_id = $id;
        $rd = DB::query("SELECT M.*, (SUBSTRING_INDEX(U.uname,' ',1)) as uname, U.uemail, U.uid FROM `" . $this->table_msg . "` AS M JOIN `rs_users` AS U ON M.mfrom=U.uid WHERE `mfrom`=" . $logged_id . " AND `msystem`=0");
        if ($rd) {
            return array_reverse($rd);
        } else {
            return false;
        }
    }

    //send message to system admin
    public function send_system_msg($d)
    {
        //confirm user
        $user_id = DB::queryFirstRow("SELECT * FROM `rs_users` WHERE `uemail`='" . $d['to'] . "' LIMIT 1");
        if ($user_id) {
            $ins = DB::insert($this->table_msg, ['mfrom' => $d['from'], 'mdata' => $d['sub'] . ": " . $d['msg'], 'mto' => $user_id['uid']]);
            if ($ins) {
                return 200;
            }
            return 300;
        } else {
            return 404;
        }
    }

    //clear messages
    function clear_messages($data)
    {
        if (check_array_empty($data)) {
            return 404;
        }
        //proceed
        $target = $data['target'];
        switch ($target) {
            case 'inbox':
                //mark as view
                DB::update($this->table_msg, ['mread' => 1], "mid=%i", $data['mid']);
                return 200;
            case 'sent':
                //mark as view
                DB::update($this->table_msg, ['mread' => 1], "mid=%i", $data['mid']);
                return 200;
                break;
            default:
                return 500;
        }
    }
}