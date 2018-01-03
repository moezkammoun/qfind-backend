<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdminRolesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-roles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'role_name') ?>

    <?= $form->field($model, 'cb') ?>

    <?= $form->field($model, 'ub') ?>

    <?= $form->field($model, 'doc') ?>

    <?php // echo $form->field($model, 'dou') ?>

    <?php // echo $form->field($model, 'category_access') ?>

    <?php // echo $form->field($model, 'advt_access') ?>

    <?php // echo $form->field($model, 'cms_access') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
