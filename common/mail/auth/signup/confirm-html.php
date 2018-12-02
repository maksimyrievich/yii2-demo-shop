<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>


<html>
<title></title>
<head>
</head>
<body>
    <div style="background: #eff3f6; height: 100%">
        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="10" style="width: 100%; max-width:600px; margin-bottom: 90px; ">
            <tbody>
                <tr>
                    <td style="text-align: left; width: 50%" bgcolor="#eff3f6">
                        <a href="https://avtosezam.ru" target="_blank" rel="noopener noreferrer"><img style="height: auto; max-width: 100%" src="https://static.avtosezam.ru/image/logo.png"></a>
                    </td>
                    <td style="text-align: right;" valign="middle" bgcolor="#eff3f6">
                        <table width="100" height="85" cellspacing="0" cellpadding="0" border="0" align="right" valign="middle">
                            <tbody>
                                <tr valign="middle" height="85">
                                    <td bgcolor="#eff3f6" valign="middle" heidht="85">
                                        <a href="https://twitter.com/avtosezam" style="color: #2fa3e7; text-decoration: none;"
                                            valign="middle" target="_blank" rel="noopener noreferrer">
                                            <img src="<?= Url::to('@static/icon_social_account/twitter.png')?>" style="width: 21px; max-width: 21px;" width="21" alt border="0" align="right" valign="middle">
                                        </a>
                                    </td>
                                    <td bgcolor="#eff3f6" valign="middle" heidht="85">
                                        <a href="https://vk.com/avtosezam" style="color: #2fa3e7; text-decoration: none;"
                                           valign="middle" target="_blank" rel="noopener noreferrer">
                                            <img src="<?= Url::to('@static/icon_social_account/wk.png')?>" style="width: 21px; max-width: 21px;" width="21" alt border="0" align="right" valign="middle">
                                        </a>
                                    </td>
                                    <td bgcolor="#eff3f6" valign="middle" heidht="85">
                                        <a href="https://www.fasebook.com/avtosezam" style="color: #2fa3e7; text-decoration: none;"
                                           valign="middle" target="_blank" rel="noopener noreferrer">
                                            <img src="<?= Url::to('@static/icon_social_account/facebook.png')?>" style="width: 21px; max-width: 21px;" width="21" alt border="0" align="right" valign="middle">
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="background: #ffffff; border-spacing: 0; border-collapse: collapse; width: 95%" cellspacing="0" cellpadding="0" border="0">
                    <td style="padding: 15px; border-collapse: collapse" colspan="2"  align="left">
                        <p style="margin: 0; padding: 0; margin-bottom: 0;font-family: Helvetica,Arial,sans-serif; color: #333; font-size: 14px">Здравствуйте <?= Html::encode($user->username) ?>!</p>
                        <p style="margin: 0; padding: 0; margin-bottom: 0;font-family: Helvetica,Arial,sans-serif; color: #333; font-size: 14px">&nbsp;</p>
                        <p style="margin: 0; padding: 0; margin-bottom: 0;font-family: Helvetica,Arial,sans-serif; color: #333; font-size: 14px">Для завершения регистрации пройдите по ссылке указанной ниже:</p>
                        <p style="margin: 0; padding: 0; margin-bottom: 0;font-family: Helvetica,Arial,sans-serif; color: #333; font-size: 14px"><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>