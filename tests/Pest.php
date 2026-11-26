<?php

use InEngine\CalendarGoogleAdapter\Tests\Support\Ci;
use InEngine\CalendarGoogleAdapter\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

/**
 * Skip when running under CI (GitHub Actions sets CI / GITHUB_ACTIONS).
 * Local `vendor/bin/pest` still runs these tests.
 */
function skipOnCi(string $reason = 'Skipped on CI; run locally with credentials configured.'): void
{
    if (Ci::running()) {
        test()->markTestSkipped($reason);
    }
}

/**
 * Skip on CI, and locally when Google Calendar OAuth env is not configured.
 */
function skipWithoutGoogleCalendarCredentials(): void
{
    skipOnCi('Requires local Google Calendar OAuth credentials.');

    $clientId = env('GOOGLE_CALENDAR_CLIENT_ID') ?: env('GOOGLE_CLIENT_ID');
    $clientSecret = env('GOOGLE_CALENDAR_CLIENT_SECRET') ?: env('GOOGLE_CLIENT_SECRET');
    $refreshToken = env('GOOGLE_CALENDAR_REFRESH_TOKEN');

    if (blank($clientId) || blank($clientSecret) || blank($refreshToken)) {
        test()->markTestSkipped(
            'Set GOOGLE_CALENDAR_CLIENT_ID/SECRET (or GOOGLE_CLIENT_*) and GOOGLE_CALENDAR_REFRESH_TOKEN to run this test.'
        );
    }
}
