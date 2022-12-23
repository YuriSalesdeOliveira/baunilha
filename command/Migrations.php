<?php

namespace Command;

use Composer\Script\Event;

class Migrations
{
    public static function migrate(Event $event): void
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        require $vendorDir . '/autoload.php';

        $migrations = app('migrations', []);

        foreach ($migrations as $migration) {

            (new $migration)->up();
        }
    }

    public static function rollback(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        require $vendorDir . '/autoload.php';

        $migrations = app('migrations', []);

        foreach ($migrations as $migration) {

            (new $migration)->down();
        }
    }
}
