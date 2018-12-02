<?php

namespace shop\useCases\auth;

use shop\access\Rbac;
use shop\entities\User\User;
use shop\forms\auth\SignupForm;
use shop\repositories\UserRepository;
use shop\services\RoleManager;
use shop\services\TransactionManager;
use yii\mail\MailerInterface;
use Yii;

class SignupService
{
    private $users;
    private $roles;
    private $transaction;
    private $mailer;

    public function __construct(UserRepository $users, RoleManager $roles, TransactionManager $transaction, MailerInterface $mailer)
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
        $this->mailer = $mailer;
    }
    //Сервисная функция регистрации пользователя в базе данных. В качестве аргумента может принимать форму
    //в принципе любую. Ничего не возвращает
    public function signup(SignupForm $form): void
    {
        //Создаем нового юзера заполняем ему все поля и свойства
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->phone,
            $form->password
        );

        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });


    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Токен подтверждения не найден');
        }
        //Возвращаем юзера с таким токеном в переменную юзер
        $user = $this->users->getByEmailConfirmToken($token);
        //
        $user->confirmSignup();
        $this->users->save($user);
    }
}