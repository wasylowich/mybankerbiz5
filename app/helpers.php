<?php

/**
 * Get the next business day according to criteria
 * @param  integer $days               The number of business days to identify before returning
 * @param  string|Carbon\Carbon  $dt   The datetime from which to start searching
 * @return Carbon\Carbon
 */
function next_business_day($days = 1, $dt = null)
{
    // Ensure $dt is a Carbon instance
    if (is_null($dt)) {
        $dt = Carbon\Carbon::now();
    } elseif (is_string($dt)) {
        $dt = Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $dt);
    }

    // Guard against invalid number of days
    if (!is_int($days) || $days < 0) {
        return $dt;
    }

    // Grab the collection of holiday dates
    $holidays = [];

    // Initialize the number of business days identified so far
    $bizDaysFound = 0;

    // Walk incrementally through dates and identify the specified number of business days
    while ($bizDaysFound < $days) {
        $dt->addDay();

        if ($dt->isWeekday() && !in_array($dt->toDateString(), $holidays)) {
            $bizDaysFound++;
        }
    }

    return $dt;
}
