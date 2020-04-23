<?php

/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 29/03/2020 - config.php
 */
//set global date and time
date_default_timezone_set("Africa/Lagos");
include_once __DIR__ . "/../lib/db.class.php";

class config
{
    private $table_config = "rs_config";
    private $data = null;

    public function __construct()
    {
        $this->getConfig();
    }

    //loader methods
    public function getConfig()
    {
        $res = DB::queryRaw("SELECT * FROM `" . $this->table_config . "`");
        $this->data = $res;
        return $res;
    }

    //global notifications
    public function get_allow_notifications()
    {
        if ($this->data) {
            foreach ($this->data as $k => $v) {
                if ($v['cname'] == 'allow_notifications') {
                    return (int)$v['cvalue'];
                }
            }
        }
    }

    //email notifications
    public function get_allow_email()
    {
        if ($this->data) {
            foreach ($this->data as $k => $v) {
                if ($v['cname'] == 'allow_email') {
                    return (int)$v['cvalue'];
                }
            }
        }
    }

    //maintenance mode
    public function get_maintenance_mode()
    {
        if ($this->data) {
            foreach ($this->data as $k => $v) {
                if ($v['cname'] == 'maintenance_mode') {
                    return (int)$v['cvalue'];
                }
            }
        }
    }

    //allow_feedback
    public function get_allow_feedback()
    {
        if ($this->data) {
            foreach ($this->data as $k => $v) {
                if ($v['cname'] == 'allow_feedback') {
                    return (int)$v['cvalue'];
                }
            }
        }
    }

    //set allow_notifications
    public function set_allow_notifications($arg)
    {
        //update allow notification
        $ins = DB::update($this->table_config, ["cvalue" => $arg], "cname=%s", "allow_notifications");
        return $ins;
    }

    //set allow_email
    public function set_allow_email($arg)
    {
        //update allow notification
        $ins = DB::update($this->table_config, ["cvalue" => $arg], "cname=%s", "allow_email");
        return $ins;
    }

    //set allow_maintenance
    public function set_allow_maintenance($arg)
    {
        //update allow notification
        $ins = DB::update($this->table_config, ["cvalue" => $arg], "cname=%s", "maintenance_mode");
        return $ins;
    }

    //set allow_allow_feedback
    public function set_allow_feedback($arg)
    {
        //update allow notification
        $ins = DB::update($this->table_config, ["cvalue" => $arg], "cname=%s", "allow_feedback");
        return $ins;
    }
}