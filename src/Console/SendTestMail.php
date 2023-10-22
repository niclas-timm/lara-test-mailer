<?php

namespace Niclastimm\LaraTestMailer\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Niclastimm\LaraTestMailer\Mail\TestMail;

class SendTestMail extends Command
{
    protected $signature = 'laratestmailer:send {email}';

    protected $description = 'Send a test mail with LaraTestMailer';

    public function handle()
    {
        $this->info("Let's get started..");

        Mail::to($this->argument('email'))->send(new TestMail());

        $this->info("Email sent successfully");

    }
}