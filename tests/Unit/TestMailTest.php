<?php

namespace Niclastimm\LaraTestMailer\Tests\Unit;

use Illuminate\Support\Facades\Mail;
use Niclastimm\LaraTestMailer\Mail\TestMail;
use Niclastimm\LaraTestMailer\Tests\TestCase;

class TestMailTest extends TestCase
{
    /** @test */
    public function it_can_send_test_mail()
    {
        Mail::fake();

        Mail::assertNothingSent();

        Mail::to('test@email.com')->send(new TestMail());

        Mail::assertSent(TestMail::class, function (TestMail $mail) {
            return $mail->hasSubject('Test Email via LaraTestMailer');
        });
    }
}