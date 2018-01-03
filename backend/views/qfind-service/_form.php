<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QfindService */
/* @var $form yii\widgets\ActiveForm */
$settings = common\models\Settings::find()->where(['status' => 1, 'id' => 1])->one();
?>

<style>
    .dropdown-menu {
        box-shadow: none;
        border-color: #ccc;
        background: #ccc;
    }
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
        border-top: 1px solid #f4f4f4;
        cursor: pointer;
    }

</style>
<div class="qfind-service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $datas = \common\models\ServiceProvider::find()->where(['status' => 1])->all();
    $options = array();
    foreach ($datas as $data) {

        $options[$data->id] = $data->name;
    }
    echo $form->field($model, 'service')->dropDownList($options, ['prompt' => 'Select Service Provider']);
    ?>
    <?= $form->field($model, 'date_from')->textInput(['id' => 'date_from']) ?>

    <?= $form->field($model, 'date_to')->textInput(['id' => 'date_to']) ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'Enable', 0 => 'Disable']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$val = $settings->date_from_buffer;
$this->registerJs("
            $('#date_from').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '$val',
                autoclose: true
            });
        ");
$this->registerJs("
            $('#date_to').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '$val',
                autoclose: true

            });
        ");
?>