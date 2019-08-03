<?php
namespace App\Services;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
class EmailService
{
    /** @var Mailer */
    private $mail;

    /**
     * EmailService constructor.
     * @param Mailer $mail
     */
    public function __construct(Mailer $mail)
    {
        $this->mail = $mail;
    }

    /**
     * 發送Email
     * @param array $request
     */
    public function send(array $request)
    {
        $this->mail->queue('email.index', $request, function (Message $message) {
            $message->sender(env('MAIL_USERNAME'));
            $message->subject(env('MAIL_SUBJECT'));
            $message->to(env('MAIL_TO_ADDR'));
        });
    }
}
