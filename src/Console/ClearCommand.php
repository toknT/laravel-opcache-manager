<?php

namespace Toknsit\LaravelOpcacheManager\Console;

use Error;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;
use Throwable;

class ClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opcache-manager:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear php opcache of web server from cli';

    /**
     * @return int
     */
    public function handle(): int
    {
        $this->info('step 1 create a signed url');
        $url = URL::temporarySignedRoute('opcache.refresh.trigger', now()->addSeconds(6));
        $this->info('step 2 access the url to clear opcache');
        try {
            $clearResult = file_get_contents($url);
        } catch (Throwable $th) {
            $this->error('fail to clear opcache, message: ' . $th->getMessage());
            return 1;
        }
        if (json_decode($clearResult) !== 'success') {
            $this->error('fail to clear opcache');
            return 1;
        }
        $this->info('opcache cleared');
        return 0;
    }
}
