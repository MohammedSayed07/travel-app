<?php

namespace app\core;


use DateTime;

class DateUtils
{
    public static function isOutdated(string $date): bool
    {
        return  new DateTime() > new DateTime($date);
    }

    public static function calculateDateUntil(string $date): int
    {
        $currentDate = new DateTime();
        $untilDate = new DateTime($date);

        $untilDate->modify('-8 day');

        $days = 0;

        if (((int)$untilDate->format('d') >= (int)$currentDate->format('d')) &&
            ((int)$untilDate->format('m') + 1 === (int)$currentDate->format('m')) &&
            ((int)$untilDate->format('y') === (int)$currentDate->format('y'))) {

            $days = (int)$untilDate->format('d') - (int)$currentDate->format('d');

        }

        return $days;
    }

    public static function formatDate(string $date, int $daysToAddOrSubtract): string
    {
        $formatDate = new DateTime($date);
        $formatDate->modify("$daysToAddOrSubtract day");
        return $formatDate->format('Y-m-d');
    }
}