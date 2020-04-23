<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 22/03/2020 - auth.php
 */
// array holding allowed Origin domains
header("Content-Type: application/json");
$allowedOrigins = array(
    //'(http(s)://)?(www\.)?my\-domain\.com'
    'http://localhost'
);
$reedax_locker_token = get_rdx_token();
$rdx_locker = @apache_request_headers()['RDX-Locker'];
//lock if not authenticated
if ($rdx_locker !== $reedax_locker_token || $rdx_locker === null) {
    die(json_encode(array("status" => false, "data" => [], "msg" => "Invalid authorization scheme 001 ")));
}
//proceed to header removal
if (@in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins) || in_array(strtolower("http://" . $_SERVER['HTTP_HOST']), $allowedOrigins)) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, RDX-Locker, X-Requested-With');
} else {
    die(json_encode(array("status" => false, "data" => [], "msg" => "Authentication not confirmed ")));
}