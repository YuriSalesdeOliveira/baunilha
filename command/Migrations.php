<?php

namespace Command;

use Composer\Script\Event;

class Migrations
{
    use GenerateFileNameTrait;

    public static function create(Event $event): void
    {
        require static::getVendorDir($event) . '/autoload.php';

        [$className] = $event->getArguments();

        $fileName = static::generateFileName($className);

        copy(
            paths('core.skeletons') . '/migration.php',
            paths('database.migrations') . "/$fileName.php"
        );
    }

    public static function refresh(Event $event): void
    {
        static::rollback($event);
        static::migrate($event);
    }

    public static function migrate(Event $event): void
    {
        require static::getVendorDir($event) . '/autoload.php';

        $migrationFiles = scandir(paths('database.migrations'));

        if ($migrationFiles) {

            foreach ($migrationFiles as $file) {

                if ($file != '.' && $file != '..') {

                    $migration = require(paths('database.migrations') . "/$file");

                    $migration->up();
                }
            }
        }
    }

    public static function rollback(Event $event): void
    {
        require static::getVendorDir($event) . '/autoload.php';

        $migrationFiles = scandir(paths('database.migrations'));

        if ($migrationFiles) {

            foreach (array_reverse($migrationFiles) as $file) {

                if ($file != '.' && $file != '..') {

                    $migration = require(paths('database.migrations') . "/$file");

                    $migration->down();
                }
            }
        }
    }

    protected static function getVendorDir(Event $event)
    {
        return $event->getComposer()->getConfig()->get('vendor-dir');
    }
}
