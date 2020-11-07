<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

require __DIR__ . '/vendor/autoload.php';

use Madam\App;



// Run the app
$app = new App();
$app->run();
