<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 22/03/2020 - logout.php
 */
require_once(__DIR__ . "/../configs/loader.php");
require_once(__DIR__ . "/../lib/lib.php");
remove_user_data();
redirect_to(BASE_URL . "admin/login");