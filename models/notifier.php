<?php

/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 29/03/2020 - notifier.php
 */
include_once __DIR__ . "/../lib/db.class.php";

class notifier
{
    private $table_noti = "rs_noti";

    public function __construct()
    {
    }

    //fetch system notifications
    public function get_system_notification()
    {
        $rd = DB::query("SELECT * FROM `" . $this->table_noti . "` WHERE `nsystem`=1 AND `nseen`=0");
        if ($rd) {
            $rd = array_reverse($rd);
        }
        return $rd;
    }

    //clear system notifications
    public function clear_system_notification()
    {
        $upd = DB::update($this->table_noti, ["nseen" => 1], "nsystem=%i", 1);
        return $upd;
    }

    //read notifications table
    public function get_all_notifications_for_table()
    {
        $rd = DB::query("SELECT nid as mid, nbody as mdata, nseen as mread, nfrom as mfrom, ndate as mdate, (SUBSTRING_INDEX(U.uname,' ',1)) as uname, U.uemail FROM `" . $this->table_noti . "` AS N JOIN `rs_users` AS U ON N.nfrom=U.uid ORDER BY `nseen` ASC");
        return $rd;
    }

    //send notification
    public function send_notification($to, $data)
    {
        if (!$data) {
            return 3;
        }
        if ($to) {
            //find the user
            //get user uid before insert
            $find_user = DB::queryFirstRow("SELECT * FROM `rs_users` WHERE `uemail`='" . $to . "' LIMIT 1");
            if (!$find_user) {
                return 2;
            } else {
                //get user name before insert
                $ins = DB::insert($this->table_noti, ['nbody' => $data, 'nfrom' => 0, 'nto' => (int)$find_user['uid']]);
                return 1;
            }
        }
        //for general user
        $ins = DB::insert($this->table_noti, ['nbody' => $data, 'nto' => 0, 'nfrom' => 0]);
        //general notifications
        if ($ins) {
            return 1;
        } else {
            return 3;
        }
    }
}