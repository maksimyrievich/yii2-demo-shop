<?php

namespace shop\listeners\User;


use shop\entities\User\events\UserSignUpConfirmed;
use yii\mail\MailerInterface;

class UserSignupConfirmedEmailListener
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(UserSignUpConfirmed $event): void
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/registered-html', 'text' => 'auth/signup/registered-text'],
                ['user' => $event->user]
            )
            ->setTo($event->user->email)
            ->setSubject('Учётные данные с сайта ' . \Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('При отправке письма произошла ошибка.');
        }
    }
}