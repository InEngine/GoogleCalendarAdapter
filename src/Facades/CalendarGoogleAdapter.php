<?php

namespace InEngine\CalendarGoogleAdapter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \InEngine\CalendarGoogleAdapter\CalendarGoogleAdapter
 */
class CalendarGoogleAdapter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \InEngine\CalendarGoogleAdapter\CalendarGoogleAdapter::class;
    }
}
