<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/fpdf/fpdf.php';

use Madam\App;


// Run the app
$app = new App();

// This will show the debug or error log of application
$app->run($showError);
