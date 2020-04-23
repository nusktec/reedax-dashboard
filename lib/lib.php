<?php
session_start();
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 21/03/2020 - lib.php
 * @param string $title
 */
//constants
const CONS_TITLE_STR = "server_title";
const CONS_MENU_STR = "server_menu";
const CONS_USER_DATA = "user_data";
const CONS_SESS_LIFE_SPAN = "session_life_span";

//set global title to session
function set_title($title)
{
    $_SESSION[CONS_TITLE_STR] = $title;
}

//get title from session
function get_title()
{
    $title = @$_SESSION[CONS_TITLE_STR];
    //@$_SESSION[CONS_TITLE_STR] = null; //clear after get
    if (empty($title)) {
        return "Home";
    } else {
        return $title;
    }
}

//set global title to session
function set_sel_menu($menu)
{
    $_SESSION[CONS_MENU_STR] = $menu;
}

//get title from session
function get_sel_menu($expect)
{
    $menu = @$_SESSION[CONS_MENU_STR];
    @$_SESSION[CONS_MENU_STR] = null; //clear after get
    if (empty($menu)) {
        return null;
    } else {
        return ($expect === $menu) ? 'xselected' : null;
    }
}

//authentications checker
function is_logged()
{
    $chk = @$_SESSION[CONS_USER_DATA];
    if ($chk) {
        if (((mktime() - $_SESSION[CONS_SESS_LIFE_SPAN]) - 60 * 45) > 0) {
            //Logout, destroy session, etc.
            remove_user_data();
            return false;
        } else {
            update_user_life_span();
            return true;
        }
    } else {
        return false;
    }
}

//set user data
function set_user_data($data)
{
    $_SESSION[CONS_SESS_LIFE_SPAN] = time();
    $_SESSION[CONS_USER_DATA] = $data;
    return $data;
}

//update user time stamp
function update_user_life_span()
{
    $_SESSION[CONS_SESS_LIFE_SPAN] = time();
}

//get user role number
function user_role_force($force = false, $to)
{
    $utype = $_SESSION[CONS_USER_DATA];
    $n = (int)$utype['utype'];
    if ($force) {
        //redirect to access denied
        if (defined("USER_ROLE")) {
            $ex = USER_ROLE;
            if ($n != $ex) {
                redirect_to(BASE_URL . $to);
            }
        }
    } else {
        return $n;
    }
}

//delete user data
function remove_user_data()
{
    $_SESSION[CONS_USER_DATA] = null;
    $_SESSION[CONS_SESS_LIFE_SPAN] = null;
    session_destroy();
    return false;
}

//get user data
function get_user_data()
{
    if (is_logged()) {
        return $_SESSION[CONS_USER_DATA];
    } else {
        return null;
    }
}

//auto redirect id not logged
function check_redirect($to)
{
    if (!is_logged()) {
        header("location: " . $to);
        die();
    }
}

//just redirect
function redirect_to($to)
{
    header_remove();
    header("location: " . $to);
    die();
}

//get script name
function get_script_name($cfilename = null)
{
    //return custom name passed
    return $cfilename;
}

//time-ago with strings
function timeago_str($date, $raw = false)
{
    $timestamp = $raw ? strtotime($date) : $date;

    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60", "60", "24", "30", "12", "10");

    $currentTime = time();
    if ($currentTime >= $timestamp) {
        $diff = time() - $timestamp;
        for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        return $diff . " " . $strTime[$i] . "(s) ago ";
    }
}

//convert db human time to timestamp
function human_to_timestamp($str_time)
{
    return strtotime($str_time);
}

//time ago in
function get_countries_array()
{
    return $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
}

//return token0r
function get_rdx_token()
{
    return "67d968c16d763d28ff223b2777b7b702b0df94af"; //(3)3b2777b7b7-(1)67d968c16d-(4)02b0df94af-(2)763d28ff22-
    //67d968c16d-763d28ff22-3b2777b7b7-02b0df94af
}

//factorize token and check up
function get_rdx_shuffled($token, $reverse = false)
{
    $code = $token;
    $code1 = substr($code, 0, 10);
    $code2 = substr($code, 10, 10);
    $code3 = substr($code, 20, 10);
    $code4 = substr($code, 30, 10);
    //if reverse is false then return confusion matrix
    if (!$reverse) {
        return $code3 . $code1 . $code4 . $code2;
    } else {
        return $code2 . $code4 . $code1 . $code3;
    }
}

//check empty array
function check_array_empty($arr)
{
    foreach ($arr as $key => $value) {
        if ($value === '' || $value === ' ') {
            return true;
            break;
        }
    }
    return false;
}

//count empty arrays
function count_array_empty($arr, $atleast, $is_boolean = true)
{
    $count_empty = 0;
    foreach ($arr as $key => $value) {
        if (empty($value) || $value === ' ') {
            $count_empty++;
        }
    }
    //check now
    if ($count_empty > $atleast) {
        return $is_boolean ? true : $count_empty;
    } else {
        return $is_boolean ? false : $count_empty;
    }
}

//iterate array and convert str to int
function convert_str_int_Array($arr)
{
    $arr2 = $arr;
    foreach ($arr2 as $key => $value) {
        if (strlen($value) < 11 && is_numeric($value)) {
            $arr2[$key] = (int)$value;
        }
    }
    return $arr2;
}

//get random number
function get_random($length = 5, $flag, $allCaps = false, $allow_sym = false)
{
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $str_lower = strtolower($str);
    $symbol = "?!&()=+";
    $numbers = "134567890";
    $output = $str;
    //if isNumeric is true
    if ($flag === 1) {
        //random here
        $res = "";
        $output = $numbers;
        for ($i = 0; $i <= $length; $i++) {
            $res .= $output[rand(1, strlen($output) - 1)];
        }
        return $res;
    }
    if ($flag === 2) {
        //random here
        $res = "";
        $output = $str . $str_lower . $numbers;
        if ($allow_sym) {
            $output .= $symbol;
        }
        for ($i = 0; $i <= $length; $i++) {
            $res .= $output[rand(1, strlen($output) - 1)];
        }
        if ($allCaps) return strtoupper($res);
        return $res;
    }
}

//set instant form val
function get_instant_form($base64 = true)
{
    return $base64 ? base64_encode(revo_char(time())) : revo_char(time());
}

//set instant form val reverse
function verify_instant_form($code, $expected = 1)
{
    $time_stamp = base64_decode($code);
    $time_stamp = revo_char_rev($time_stamp);
    return ((int)((time() - (int)$time_stamp) / 60)) <= $expected;
}

function revo_char($data)
{
    $rnd = $data . "R";
    $rnd = str_replace("1", "Q", $rnd);
    $rnd = str_replace("2", "B", $rnd);
    $rnd = str_replace("3", "C", $rnd);
    $rnd = str_replace("4", "Z", $rnd);
    $rnd = str_replace("5", "E", $rnd);
    $rnd = str_replace("6", "F", $rnd);
    $rnd = str_replace("7", "K", $rnd);
    $rnd = str_replace("8", "H", $rnd);
    $rnd = str_replace("9", "M", $rnd);
    $rnd = str_replace("0", "J", $rnd);
    return $rnd;
}

function revo_char_rev($data)
{
    $rnd = $data;
    $rnd = str_replace("Q", "1", $rnd);
    $rnd = str_replace("B", "2", $rnd);
    $rnd = str_replace("C", "3", $rnd);
    $rnd = str_replace("Z", "4", $rnd);
    $rnd = str_replace("E", "5", $rnd);
    $rnd = str_replace("F", "6", $rnd);
    $rnd = str_replace("K", "7", $rnd);
    $rnd = str_replace("H", "8", $rnd);
    $rnd = str_replace("M", "9", $rnd);
    $rnd = str_replace("J", "0", $rnd);
    $rnd = str_replace("R", "", $rnd);
    return $rnd;
}


//get utc sample
function get_utc_sample()
{
    return date("Y - m - d H:i:s", time() - date("Z"));
}

//send a fill to the clients
function send_a_file($filename)
{
    if (file_exists($filename)) {

        //Get file type and set it as Content Type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        header('Content-Type: ' . finfo_file($finfo, $filename));
        finfo_close($finfo);

        //Use Content-Disposition: attachment to specify the filename
        header('Content-Disposition: attachment; filename=' . basename($filename));

        //No cache
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        //Define file size
        header('Content-Length: ' . filesize($filename));

        ob_clean();
        flush();
        readfile($filename);
        exit;
    }
}

//send one signal messages
function SendOneSignalMessage($title, $message, $appId, $aoth)
{
    // Your code here!
    $fields = array(
        'app_id' => $appId,
        'included_segments' => ["Active Users", "Inactive Users"],
        'contents' => array("en" => $message),
        'headings' => array("en" => $title),
        'data' => array(),
        'largeIcon' => '',
    );

    $fields = json_encode($fields);
    //print("\nJSON sent:\n");
    //print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic ' . $aoth));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

//video player
function setPlayer($filepath)
{
    $my_video_basename = $filepath;//filter to have a trust filename

    $file = $my_video_basename;

    if (!file_exists($file)) return;

    $fp = @fopen($file, 'rb');
    $size = filesize($file); // File size
    $length = $size;           // Content length
    $start = 0;               // Start byte
    $end = $size - 1;       // End byte
    header('Content-type: video/mp4');
    header("Accept-Ranges: 0-$length");
    header("Accept-Ranges: bytes");
    if (isset($_SERVER['HTTP_RANGE'])) {
        $c_start = $start;
        $c_end = $end;
        list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
        if (strpos($range, ',') !== false) {
            header('HTTP/1.1 416 Requested Range Not Satisfiable');
            header("Content-Range: bytes $start-$end/$size");
            exit;
        }
        if ($range == '-') {
            $c_start = $size - substr($range, 1);
        } else {
            $range = explode('-', $range);
            $c_start = $range[0];
            $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
        }
        $c_end = ($c_end > $end) ? $end : $c_end;
        if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
            header('HTTP/1.1 416 Requested Range Not Satisfiable');
            header("Content-Range: bytes $start-$end/$size");
            exit;
        }
        $start = $c_start;
        $end = $c_end;
        $length = $end - $start + 1;
        fseek($fp, $start);
        header('HTTP/1.1 206 Partial Content');
    }
    header("Content-Range: bytes $start-$end/$size");
    header("Content-Length: " . $length);
    $buffer = 1024 * 8;
    while (!feof($fp) && ($p = ftell($fp)) <= $end) {
        if ($p + $buffer > $end) {
            $buffer = $end - $p + 1;
        }
        set_time_limit(0);
        echo fread($fp, $buffer);
        ob_flush();
    }
    fclose($fp);
    exit();
}
