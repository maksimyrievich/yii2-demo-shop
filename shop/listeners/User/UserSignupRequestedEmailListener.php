<?php

namespace shop\listeners\User;


use shop\entities\User\events\UserSignUpRequested;
use yii\mail\MailerInterface;

class UserSignupRequestedEmailListener
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(UserSignUpRequested $event): void
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $event->user]
            )
            ->setTo($event->user->email)
            ->setSubject('Регистрация на сайте ' . \Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('При отправке письма произошла ошибка.');
        }
    }
}