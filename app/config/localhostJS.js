var dev_mode = true;

if (dev_mode) {
    //$SITE_ROOT = 'http://streetcarlife.local/';
    var site_root = 'http://localhost/street_car_life/';
    var file_root = 'C:/wamp/www/street_car_life/';
    var css_root = site_root + "source/css/";
    var js_root = site_root + "source/js/";
    var image_root = site_root + "source/images/";
} else {
    var site_root = 'http://www.kundenforce.com/';
    var file_root = '/home/redmanracer/public_html/';
    var css_root = site_root + "source/css/";
    var js_root = site_root + "source/js/";
    var image_root = site_root + "source/images/";
}
