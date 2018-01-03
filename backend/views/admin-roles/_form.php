<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdminRoles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-roles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'category_access')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>
    <?= $form->field($model, 'advt_access')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>
    <?= $form->field($model, 'cms_access')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
