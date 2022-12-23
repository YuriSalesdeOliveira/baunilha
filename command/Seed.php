<?php

namespace Command;

use Composer\Script\Event;

class Seed
{
    public static function run(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        require $vendorDir . '/autoload.php';

        $seeders = app('seeders', []);

        foreach ($seeders as $seeder) {

            (new $seeder)->run();
        }
    }
}
