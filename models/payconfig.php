<?php

/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 16/04/2020 - payconfig.php
 */
include_once __DIR__ . "/../lib/db.class.php";

class payconfig
{
    private $table_payconfig = "rs_payconfig";

    public function __construct()
    {
    }

    //load all default payment in db
    function load_paystack()
    {
        return DB::queryFirstRow("SELECT * FROM `" . $this->table_payconfig . "` WHERE `pprovider`='paystack' LIMIT 1");
    }

    //update paystack data
    function update_paystack($data)
    {
        if (check_array_empty($data)) {
            return $data;
        }
        $upd = DB::update($this->table_payconfig, $data, "pprovider=%s", "paystack");
        return $upd;
    }
}