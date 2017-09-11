var dev_mode = true;

if (dev_mode) {
    //$SITE_ROOT = 'http://streetcarlife.local/';
    var site_root = 'http://localhost/street_car_life/';
    var css_root = site_root + "source/css/";
    var js_root = site_root + "source/js/";
    var image_root = site_root + "source/images/";
} else {
    var site_root = 'http://www.street-car-life.com/';
    var css_root = site_root + "source/css/";
    var js_root = site_root + "source/js/";
    var image_root = site_root + "source/images/";
}
