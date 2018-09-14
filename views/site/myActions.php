<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'My Actions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div>
    <h3>Add User</h3>
    <?php
        Yii::$app->session->getFlash('success');
        $form = ActiveForm::begin([
            'id' => 'add-user-form',
        ]);
    ?>
    <?= $form->field($user, 'first_name') ?>
    <?= $form->field($user, 'last_name') ?>
    <?= $form->field($user, 'email')->input('email') ?>
    <?= $form->field($user, 'personal_code') ?>
    <?= $form->field($user, 'phone') ?>
    <?= $form->field($user, 'active') ?>
    <?= $form->field($user, 'dead') ?>
    <?= $form->field($user, 'lang') ?>

    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end() ?>
    </div>

    <div>
    <h3>Add Loan</h3>
    <?php
        Yii::$app->session->getFlash('success');
        $form = ActiveForm::begin([
            'id' => 'add-loan-form',
        ]);
    ?>
    <?php
        $usersArray = $user::find()->select(['id', 'concat(first_name,\' \',last_name) as name'])->asArray()->all();
        $result = ArrayHelper::map($usersArray, 'id', 'name');
    ?>
    <?= $form->field($loan, 'user_id')->dropDownList($result, ['prompt' => '---- Select User ----'])->label('User') ?>
    <?= $form->field($loan, 'amount') ?>
    <?= $form->field($loan, 'interest') ?>
    <?= $form->field($loan, 'duration') ?>
    <?= 
        $form->field($loan, 'start_date')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '99/99/9999',
        ]);
    ?>
    <?=
        $form->field($loan, 'end_date')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '99/99/9999',
        ]);
    ?>
    <?= $form->field($loan, 'campaign') ?>

    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end() ?>
    </div>
</div>