# lumen-sail
Installing Laravel Sail Package in Lumen

composer require mahdiraad/lumen-sail

Add this line to bootstrap/app.php

$app->register(mahdiraad\LumenSail\LumenSailServiceProvider::class);

