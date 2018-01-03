<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $datas = \common\models\AdminRoles::find()->all();
    $options = array();
    foreach ($datas as $data) {
        $options[$data->id] = $data->role_name;
    }
    echo $form->field($model, 'role')->dropDownList($options, ['prompt' => 'Select Role']);
    ?>
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?php $model->password_hash = ''; ?>
    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([10 => 'Yes', 0 => 'No']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
