<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Log;

function getUserIp(): string
{
    $keys = [
        'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR',
    ];

    foreach ($keys as $k) {
        if (isset($_SERVER[ $k ])) {
            /** @var string $data_server */
            $data_server = $_SERVER[ $k ];

            return $data_server;
        }
    }

    return '';
}

/**
 * @param array<mixed> $params
 */
function log_user_error(array $params): void
{
    /** @var non-empty-string $encode_params */
    $encode_params = json_encode($params);

    Log::channel('user_error')->info($encode_params);
}

function getDateFirstMondayOfMonth(): Carbon
{
    if (Carbon::now()->startOfMonth()->isMonday()) {
        return Carbon::now()->startOfMonth();
    }

    return Carbon::now()->startOfMonth()->modify('next monday');
}

function getWorkableDaysOfMonth(Carbon $start_date, bool $included_saturday = false): int
{
    $end_date = $start_date->copy()->endOfMonth();

    return getWorkableDaysOfPeriod($start_date, $end_date, $included_saturday);
}

function getWorkableDaysOfPeriod(Carbon $start_date, Carbon $end_date, bool $included_saturday = false): int
{
    /** @var CarbonPeriod<Carbon> $period */
    $period = CarbonPeriod::create($start_date, $end_date);

    $working_days = 0;

    foreach ($period as $date) {
        if ($date->isWeekday() || ($included_saturday && $date->dayOfWeek === Carbon::SATURDAY)) {
            $working_days++;
        }
    }

    return $working_days;
}

function getMinutesCentieme(?int $minutes): ?int
{
    if (is_null($minutes)) {
        return null;
    }

    return [
        1 => 2, 2 => 3, 3 => 5, 4 => 7, 5 => 8, 6 => 10, 7 => 12, 8 => 13, 9 => 15, 10 => 17, 11 => 18, 12 => 20, 13 => 22, 14 => 23, 15 => 25, 16 => 27,
        17 => 28, 18 => 30, 19 => 32, 20 => 33, 21 => 35, 22 => 37, 23 => 38, 24 => 40, 25 => 42, 26 => 43, 27 => 45, 28 => 47, 29 => 48, 30 => 50, 31 => 52,
        32 => 53, 33 => 55, 34 => 57, 35 => 58, 36 => 60, 37 => 62, 38 => 63, 39 => 65, 40 => 67, 41 => 68, 42 => 70, 43 => 72, 44 => 73, 45 => 75, 46 => 77,
        47 => 78, 48 => 80, 49 => 83, 50 => 85, 51 => 85, 52 => 87, 53 => 88, 54 => 90, 55 => 92, 56 => 93, 57 => 95, 58 => 97, 59 => 98, 60 => 100,
    ][ $minutes ];
}

function getWeekStartDay(Carbon $date): Carbon
{
    return $date->startOfWeek(Carbon::MONDAY);
}

function getWeekEndDay(Carbon $date): Carbon
{
    return $date->endOfWeek(Carbon::SUNDAY);
}