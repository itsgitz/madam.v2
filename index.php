<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

require __DIR__ . '/vendor/autoload.php';

use Madam\App;


// Run the app
$app = new App();

// This will show the debug or error log of application
$showError = true;
$app->run($showError);
