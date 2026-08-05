<?php

namespace InEngine\CalendarGoogleAdapter\Commands;

use Illuminate\Console\Command;

class CalendarGoogleAdapterCommand extends Command
{
    public $signature = 'calendar-google-adapter';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
