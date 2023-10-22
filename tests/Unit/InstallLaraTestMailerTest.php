<?php

namespace Niclastimm\LaraTestMailer\Tests\Unit;

use Niclastimm\LaraTestMailer\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class InstallLaraTestMailerTest extends TestCase
{
    /** @test */
    function the_install_command_copies_the_configuration()
    {
        // make sure we're starting from a clean state
        if (File::exists(config_path('laratestmailer.php'))) {
            unlink(config_path('laratestmailer.php'));
        }

        $this->assertFalse(File::exists(config_path('laratestmailer.php')));

        Artisan::call('laratestmailer:install');

        $this->assertTrue(File::exists(config_path('laratestmailer.php')));
    }
}