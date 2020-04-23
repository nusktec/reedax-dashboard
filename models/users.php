<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 22/03/2020 - users.php
 */
if (!defined('APP_DIR')) die("No direct access");
include_once __DIR__ . "/../lib/db.class.php";

class users
{
    private $table_name = 'rs_users';
    private $email = null;
    private $pass = null;
    private $uid = null;
    private $data = null;
    private $is_loaded = false;

    /**
     * users constructor.
     * @param null $email
     * @param null $pass
     * @param int $uid
     */
    public function __construct($email = null, $pass = null, $uid = null)
    {
        $this->email = $email;
        $this->pass = $pass;
        $this->uid = $uid;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return null
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param null $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return null
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param null $uid
     * @param bool $reload
     * @return $this
     */
    public function setUid($uid, $reload = false)
    {
        $this->uid = $uid;
        if ($reload) {
            return $this->getData();
        }
        return $this;
    }

    /**
     * @return null
     */
    public function getData()
    {
        //DB::debugMode();
        //query db
        if ($this->uid == null) {
            $read = DB::queryFirstRow("SELECT * FROM `" . $this->table_name . "` WHERE (`uemail`='" . $this->email . "' AND `upass`='" . $this->pass . "') LIMIT 1");
            if ($read) {
                //add token now
                $token = sha1($read['uid'] . time());
                //$this->updateRow(['utoken' => $token], "uid=%i", $read['uid']);
                DB::query("UPDATE `rs_users` SET `utoken`='$token' WHERE `uid`=" . $read['uid']);
                $read['utoken'] = $token;
                $this->setIsLoaded(true);
                $this->setUid($read['uid']);
            } else {
                session_destroy();
                $this->setIsLoaded(false);
            }
            return $read;
        } else {
            $read = DB::queryFirstRow("SELECT * FROM `" . $this->table_name . "` WHERE (`uid`=" . $this->uid . ") LIMIT 1");
            if ($read) {
                $this->setIsLoaded(true);
                $this->setUid($read['uid']);
            } else {
                session_destroy();
                $this->setIsLoaded(false);
            }
            return $read;
        }
    }

    /**
     * @return bool
     */
    public function isIsLoaded()
    {
        return $this->is_loaded;
    }

    /**
     * @param bool $is_loaded
     */
    private function setIsLoaded($is_loaded)
    {
        $this->is_loaded = $is_loaded;
    }

    //verify token
    function tokenResolver($token)
    {
        $rd = DB::queryFirstRow("SELECT * FROM `" . $this->table_name . "` WHERE `utoken`='" . $token . "' LIMIT 1");
        return $rd;
    }

    //update records
    function updateRow($data, $where, $arg)
    {
        $upd = DB::update($this->table_name, $data, $where, $arg);
        return $upd;
    }

    //token resolver
    function verify_token($token)
    {
        $rd = DB::queryFirstRow("SELECT * FROM `" . $this->table_name . "` WHERE `utoken`='" . $token . "' LIMIT 1");
        if ($rd) {
            return (int)$rd['uid'];
        } else {
            //logout
            session_destroy();
            die(json_encode(array("status" => false, "data" => [], "msg" => "User terminated, logout and re-login")));
        }
    }

    //find id
    function findID($id)
    {
        return DB::queryFirstRow("SELECT * FROM `" . $this->table_name . "` WHERE `uid`=" . $id . " LIMIT 1");
    }

    //public data
    function getAllActive($except = null)
    {
        if ($except != null) {
            //specifying email or id
            return DB::query("SELECT SHA1(tb.uid) as img, tb.* FROM " . $this->table_name . " tb WHERE `utype`!=1 AND `ustatus`=1");
        } else {
            return DB::query("SELECT SHA1(tb.uid) as img, tb.* FROM " . $this->table_name . " tb WHERE `ustatus`=1");
        }
    }

    //insert into db
    function insertNewUser($data, $returnID = false)
    {
        $d = $data;
        if (!is_array($d) && count($d) < 5) {
            //invalid data format
            return 100;
        }
        //check if email exist
        if (!isset($d['uemail'])) {
            return 101;
        }
        //check email
        $chk = DB::queryFirstRow("SELECT * FROM `" . $this->table_name . "` WHERE `uemail`='" . $d['uemail'] . "'");
        if ($chk) {
            return 300;
        }
        //sort password first
        $d['upass'] = sha1($d['upass']);
        //insert as fresh
        $ins = DB::insert($this->table_name, $d);
        return ($ins && $returnID) ? DB::insertId() : 200;
    }

    //public data
    function getAllAdmin($except = null)
    {
        if ($except != null) {
            //specifying email or id
            return DB::query("SELECT SHA1(tb.uid) as img, tb.* FROM " . $this->table_name . " tb WHERE `utype`=2");
        } else {
            return DB::query("SELECT SHA1(tb.uid) as img, tb.* FROM " . $this->table_name . " tb WHERE `ustatus`=2");
        }
    }

    //public data of non-active
    function getAllBanned($except = null)
    {
        if ($except != null) {
            //specifying email or id
            return DB::query("SELECT SHA1(tb.uid) as img, tb.* FROM " . $this->table_name . " tb WHERE `tb`.`utype`!=1 AND `tb`.`ustatus`=0");
        } else {
            return DB::query("SELECT SHA1(tb.uid) as img, tb.* FROM " . $this->table_name . " tb WHERE `tb`.`ustatus`=0");
        }
    }
}