<?php

namespace mahdiraad\lumensail\Console\Commands;

use Illuminate\Console\Command;

class SailInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sail:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Laravel Sail\'s default Docker Compose file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	copy(base_path('vendor/laravel/sail/stubs/docker-compose.yml'), base_path('docker-compose.yml'));
	copy(__DIR__ . '/../../../stubs/server.php', base_path('server.php'));

        $environment = file_get_contents(base_path('.env'));

        $environment = str_replace('DB_HOST=127.0.0.1', 'DB_HOST=mysql', $environment);
        $environment = str_replace('MEMCACHED_HOST=127.0.0.1', 'MEMCACHED_HOST=memcached', $environment);
        $environment = str_replace('REDIS_HOST=127.0.0.1', 'REDIS_HOST=redis', $environment);

        $extraEnvironments = [
            "#WWWGROUP=",
            "#WWWUSER=",
            "#APP_PORT=",
            "#FORWARD_DB_PORT=",
            "#FORWARD_REDIS_PORT=",
            "#FORWARD_MAILHOG_PORT=",
            "#FORWARD_MAILHOG_DASHBOARD_PORT=",
        ];
        
        $environment .= "\n". implode("\n", $extraEnvironments);

        file_put_contents(base_path('.env'), $environment);
    }
}

