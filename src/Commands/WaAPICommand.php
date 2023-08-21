<?php

namespace WaAPI\WaAPI\Commands;

use Illuminate\Console\Command;

class WaAPICommand extends Command
{
    public $signature = 'waapi-laravel-sdk';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
