<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */


$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/auth/signup/confirm', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
