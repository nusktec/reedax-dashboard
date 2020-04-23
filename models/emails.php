<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 06/04/2020 - emails.php
 */
if (!defined('APP_DIR')) die("No direct access");
include_once __DIR__ . "/../lib/db.class.php";

class emails
{
    private $emails_table = "rs_emails";

    public function __construct()
    {
    }

    //add new subscribers
    public function add_new_email($name, $email)
    {
        //first check if user exist
        $rd = DB::query("SELECT * FROM `" . $this->emails_table . "` WHERE `eemail`='" . $email . "' LIMIT 1");
        if ($rd) {
            return false;
        }
        //add new email
        $ins = DB::insert($this->emails_table, ['ename' => $name, 'eemail' => $email]);
        return $ins;
    }

    //read all emails
    public function get_all_emails()
    {
        $rd = DB::query("SELECT * FROM `" . $this->emails_table);
        return $rd;
    }
}