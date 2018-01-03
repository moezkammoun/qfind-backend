<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\States */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="states-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
 <?php
    $country = ArrayHelper::map(\common\models\Countries::find()->all(), 'id', 'name');
    echo $form->field($model, 'country_id')->dropDownList($country, ['prompt' => 'Select Country']);
    ?>
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
