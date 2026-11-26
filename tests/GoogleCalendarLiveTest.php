<?php

declare(strict_types=1);

/**
 * Live Google Calendar OAuth — skipped on CI; run locally with refresh token set.
 */

use Illuminate\Support\Facades\Http;
use InEngine\GoogleCalendarAdapter\GoogleOAuthAccessToken;

it('refreshes a real Google access token', function (): void {
    skipWithoutGoogleCalendarCredentials();

    config()->set('google-calendar-adapter.client_id', env('GOOGLE_CALENDAR_CLIENT_ID') ?: env('GOOGLE_CLIENT_ID'));
    config()->set('google-calendar-adapter.client_secret', env('GOOGLE_CALENDAR_CLIENT_SECRET') ?: env('GOOGLE_CLIENT_SECRET'));
    config()->set('google-calendar-adapter.refresh_token', env('GOOGLE_CALENDAR_REFRESH_TOKEN'));
    config()->set(
        'google-calendar-adapter.redirect_uri',
        env('GOOGLE_CALENDAR_REDIRECT_URI') ?: env('GOOGLE_REDIRECT_URI') ?: 'http://localhost/auth/callback'
    );

    Http::allowStrayRequests();

    $token = app(GoogleOAuthAccessToken::class)->get();

    expect($token)->toBeString()->not->toBeEmpty();
})->group('local-credentials');
