<?php
    exec("alias php=\'/usr/local/php7.3/bin/php\'");
    exec("php artisan reminder:cron 1>> /dev/null 2>&1");
?>
