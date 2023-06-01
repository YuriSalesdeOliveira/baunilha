<?php

namespace Command;

use DateTime;

trait GenerateFileNameTrait
{
    public static function generateFileName(string $className): string
    {
        $date = new DateTime();

        $currentDate = $date->format('Y_m_d');

        $currentTimestamp = $date->getTimestamp();

        $standardizedClassName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $className));

        return $currentDate . '_' . $currentTimestamp . '_' . $standardizedClassName;
    }
}