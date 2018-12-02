<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 02.09.2018
 * Time: 18:40
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;


    /**
     * RBAC generator
     */
class RbacController extends Controller
{
    /**
     * Generates roles
     */
    public function actionInit()
    {
        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();

        $adminPanel = $auth->createPermission('adminPanel');
        $adminPanel->description = 'Admin panel';
        $auth->add($adminPanel);

        $user = $auth->createRole('user');
        $user->description = 'User';
        $auth->add($user);

        $manager = $auth->createRole('manager');
        $manager->description = 'Manager';
        $auth->add($manager);

        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $auth->add($admin);

        $auth->addChild($admin, $user);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $adminPanel);

        $this->stdout('Done!' . PHP_EOL);
    }
}
