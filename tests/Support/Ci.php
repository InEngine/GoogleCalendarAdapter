<?php

declare(strict_types=1);

namespace InEngine\CalendarGoogleAdapter\Tests\Support;

final class Ci
{
    public static function running(): bool
    {
        return filter_var(getenv('CI') ?: '0', FILTER_VALIDATE_BOOLEAN)
            || filter_var(getenv('GITHUB_ACTIONS') ?: '0', FILTER_VALIDATE_BOOLEAN);
    }
}
