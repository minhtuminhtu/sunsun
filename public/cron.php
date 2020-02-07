<?php

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

exec("alias php=\'/usr/local/php7.3/bin/php\'");
$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArrayInput(['command' => 'reminder:cron']),
    new Symfony\Component\Console\Output\ConsoleOutput
);

$kernel->terminate($input, $status);

exit($status);
