<?php

namespace Niclastimm\LaraTestMailer\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Niclastimm\LaraTestMailer\Mail\TestMail;
use Niclastimm\LaraTestMailer\Tests\TestCase;

class SendTestMailCommandTest extends TestCase
{
    /** @test */
    public function it_sends_test_mail_when_executing_command()
    {
        Mail::fake();

        Mail::assertNothingSent();

        Artisan::call('laratestmailer:send test@email.com');

        Mail::assertSent(TestMail::class, function (TestMail $mail) {
            return $mail->hasSubject('Test Email via LaraTestMailer');
        });
    }
}