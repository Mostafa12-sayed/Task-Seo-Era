<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallProject extends Command
{
    // Command signature: php artisan install:project projectname
    protected $signature = 'install:project {name}';

    protected $description = 'Run composer install, migrations, seeders, and Passport install for a project setup';

    public function handle()
    {
        $name = $this->argument('name');

        $this->info("Installing project: $name");

        // Run composer install
        $this->info("Running composer install...");
        exec('composer install', $composerOutput, $composerStatus);
        $this->output->writeln($composerOutput);
        if ($composerStatus !== 0) {
            $this->error(' Composer install failed.');
            return 1;
        }

        // Run migrations
        $this->info(" Running migrations...");
        $this->call('migrate', ['--force' => true]);
        $this->info(" Migrations completed.");

        // Install Passport
        $this->info(string: " Installing Passport...");
        $this->call('passport:install');
        $this->info(" Passport installation completed.");

        // Run seeders
        $this->info(" Running seeders...");
        $this->call('db:seed', ['--force' => true]);
        $this->info(" Seeders completed.");

        $this->info(" Project '$name' installed successfully!");

        return 0;
    }
}
