<?php

namespace app\core;


use DateTime;

class DateUtils
{
    public static function isOutdated(DateTime $tripEndDate): bool
    {
        return  new DateTime() > $tripEndDate;
    }

    public static function calculateDateUntil(DateTime $tripEndDate): int
    {
        $currentDate = new DateTime();

        $tripEndDate->modify('-8 day');

        $days = 0;

        if (((int)$tripEndDate->format('d') >= (int)$currentDate->format('d')) &&
            ((int)$tripEndDate->format('m') + 1 === (int)$currentDate->format('m')) &&
            ((int)$tripEndDate->format('y') === (int)$currentDate->format('y'))) {

            $days = (int)$tripEndDate->format('d') - (int)$currentDate->format('d');

        }

        return $days;
    }

    public static function formatDate(DateTime $date, int $daysToAddOrSubtract): string
    {
        $date->modify("$daysToAddOrSubtract day");
        return $date->format('Y-m-d');
    }
}