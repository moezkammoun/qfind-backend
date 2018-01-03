<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QfindServiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qfind-service-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'date from') ?>

    <?= $form->field($model, 'date_to') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'service') ?>

    <?php // echo $form->field($model, 'dou') ?>

    <?php // echo $form->field($model, 'doc') ?>

    <?php // echo $form->field($model, 'cb') ?>

    <?php // echo $form->field($model, 'ub') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
