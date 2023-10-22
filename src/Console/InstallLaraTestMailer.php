<?php

namespace Niclastimm\LaraTestMailer\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallLaraTestMailer extends Command
{
    protected $signature = 'laratestmailer:install';

    protected $description = 'Install the LaraTestMailer';

    public function handle()
    {
        $this->info('Installing LaraTestMailer...');

        $this->info('Publishing configuration...');

        if (! $this->configExists('laratestmailer.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed LaraTestMailer');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Niclastimm\LaraTestMailer\LaraTestMailerServiceProvider",
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}