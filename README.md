# Amcrest AD110 Night Vision Script
Automatically turn off/on night vision based on local sunrise/sunset times

# !!! USE AT OWN RISK !!! 

This script addresses an issue with the Amcrest AD110 that many people are having with Night Vision.  At night time, when Night Vision is set to Auto, the camera can get stuck in a reboot cycle if the lighting conditions are bright enough to toggle night vision. This seems to cause the camera to go into a reboot loop after toggling Night Vision a few times.  This doesn't happen if the Night Vision mode is set to on or off.  This script attempts to address this common problem by determining based on sunrise/sunset of your lat/lng if night vision should be enabled.

#  Amcrest Forum Discussions

[AD110 Frequent Reconnects Reboots](https://amcrest.com/forum/ip-cameras-f18/ad110-frequent-reconnects-reboots-t13755.html)

[AD110 Doorbell Persistent Night Vision Off](https://amcrest.com/forum/amcrest-smart-home-f32/ad110-doorbell-persistent-night-vision-off-t13999.html)

[Amcrest AD110 Doorbell Night Mode Issue](https://amcrest.com/forum/ip-cameras-f18/amcrest-ad110-doorbell-night-mode-issue-t13518.html)

[Video Doorbell AD110 Losing Connection at Night](https://amcrest.com/forum/amcrest-smart-home-f32/video-doorbell-ad110-losing-connection-at-night-t13712.html)

[AD110 Doorbell Auto Night Vision Reboot](https://amcrest.com/forum/ip-cameras-f18/ad110-doorbell-auto-night-vision-reboot-t14774.html)

### Configuration

Get a valid timezone value from [here](https://www.php.net/manual/en/timezones.php)

    define('TIMEZONE', "America/New_York");

Get your city's lattitude and longitude values, in this case Atlanta.

    define('LAT', 33.7490);
    define('LNG', -84.3880);
    
It's best to have a dedicated IP address assigned to your ip camera, in my case it's 100

    define('IP_CAM', '192.168.1.100');
    
## Usage
People purchase the AD110 because it's one of the few doorbell cams that support Onvif which allows you to record to an NVR of your choice.  To run this script make sure you have php installed and run it on a cron job.  I have it running every 20 minutes.

## API
Official Amcrest api documentation is hard to come by.  However I was able to find these two relevant api calls to help make this script.

    // mode values can be Off, ForceOn, SmartLight
    http://<IP_ADDRESS>/cgi-bin/configManager.cgi?action=setConfig&Lighting[0][0].Mode=<MODE>

### Example

This turns on Night Vision, should return "OK"

      http://192.168.1.100/cgi-bin/configManager.cgi?action=setConfig&Lighting[0][0].Mode=ForceOn

This returns the existing value of Night Vision

    http://192.168.1.100/cgi-bin/configManager.cgi?action=getConfig&name=Lighting

You'll recieve a response

    table.Lighting[0][0].MiddleLight[0].Light=20
    table.Lighting[0][0].Mode=ForceOn



