<?php

// Set your time zone - https://www.php.net/manual/en/timezones.php
define('TIMEZONE', "America/New_York");

// Your lat/lng
define('LAT', 33.7490);
define('LNG', -84.3880);

// Camera's IP on your local network
define('IP_CAM', '192.168.1.100');

// Account's username/password
define('USER', "admin");
define('PASS', "PASSWORD HERE");

// Config settings, do not change
define('IR_ON', "ForceOn");
define('IR_OFF', "Off");

date_default_timezone_set(TIMEZONE);

$sunData = date_sun_info(time(), LAT, LNG);

function getNightVisionMode($time, $sunData)
{
    if ($time > $sunData['sunrise'] && $time < $sunData['sunset']) {
        return IR_OFF;
    }

    return IR_ON;
}

$ch = curl_init('http://' . IP_CAM . '/cgi-bin/configManager.cgi?action=setConfig&Lighting[0][0].Mode=' . getNightVisionMode(time(), $sunData));
curl_setopt($ch, CURLOPT_USERPWD, USER . ":" . PASS);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$response = curl_exec($ch);
curl_close($ch);

// Outputs response
echo $response;
