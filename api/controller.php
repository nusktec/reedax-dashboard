<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 22/03/2020 - controller.php
 */
if (!defined('APP_DIR')) die("No direct access");
//make a json header
require(__DIR__ . "/../lib/loader.php");
require('auth.php');
require(__DIR__ . "/../configs/loader.php");
header("Content-Type: application/json");
//validate incoming
$get_agent = @$_GET['agent']; //specify agent
$cmd = @$_GET['cmd']; //get command from query
$desk = @($_GET['desk']) ? true : false; //specify if from mobile
//filter data
$data = null;
if ($get_agent === 'axios') {
    $data = (array)json_decode(file_get_contents('php://input'));
} else {
    $data = $_REQUEST;
}
//unset unwanted cmd key
//unset($data['agent']);
//start casing
if (empty($data) || @count($data) < 1) {
    exit(writer_json(false, [], "Not enough args passed"));
}
//output writer
function writer_json($status, $data, $msg = "success")
{
    return json_encode(array("status" => $status, "data" => $data, "msg" => $msg));
}