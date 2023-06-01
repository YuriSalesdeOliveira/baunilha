<?php

namespace Command;

use Composer\Script\Event;
use DateTime;

class Seeders
{
    use GenerateFileNameTrait;

    public static function create(Event $event): void
    {
        require static::getVendorDir($event) . '/autoload.php';

        [$className] = $event->getArguments();

        $fileName = static::generateFileName($className);

        copy(
            paths('core.skeletons') . '/seeder.php',
            paths('database.seeders') . "/$fileName.php"
        );
    }

    public static function run(Event $event): void
    {
        require static::getVendorDir($event) . '/autoload.php';

        $seederFiles = scandir(paths('database.seeders'));

        if ($seederFiles) {

            foreach ($seederFiles as $file) {

                if ($file != '.' && $file != '..') {

                    $seeder = require_once(paths('database.seeders') . "/$file");

                    $seeder->run();
                }
            }
        }
    }

    protected static function getVendorDir(Event $event)
    {
        return $event->getComposer()->getConfig()->get('vendor-dir');
    }
}
