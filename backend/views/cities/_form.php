<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Cities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control slug']) ?>
    <?= $form->field($model, 'name_arabic')->textInput(['maxlength' => true, 'class' => 'form-control slug']) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$this->registerJs("
        $(document).ready(function(){
             $('.slug').keyup(function() {
                             $('#cities-canonical_name').val(slug($(this).val()));
                        });
        });

        ");
?>