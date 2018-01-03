<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceProvider */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .bootstrap-timepicker-widget.timepicker-orient-bottom:after {
        bottom: -6px;
        border-bottom: 0;
        border-top: 6px solid #949494;
        /* background: #ccc; */
    }
    .bootstrap-timepicker-widget.dropdown-menu.open {
        display: inline-block;
        background-color: #949494 !important
    }
    a.aws_inner_image i {
        position: absolute;
        top: 44px;
        right: 40px;
    }
    a.aws_inner_image {
        position: relative;
    }

</style>

<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCqutlIKunbpMclG8KfaCSyAYsAjShEShA&callback=initMap&sensor=false&libraries=places'></script>
<div class="service-provider-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-xs-12 col-sm-3">
            <?= $form->field($model, 'name_arabic')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-xs-12 col-sm-6">
            <?php
            $datas = \backend\models\CategoriesMaster::find()->where(['leval' => 1])->all();
            $options = array();
            foreach ($datas as $data) {
                $check_subcategory = \backend\models\CategoriesMaster::find()->where(['parent_id' => $data->id])->all();
                if (empty($check_subcategory)) {
                    $options[$data->id] = $data->name;
                } else {
                    foreach ($check_subcategory as $subcat) {
                        $options[$subcat->id] = $data->name . ' => ' . $subcat->name;
                    }
                }
            }
            echo $form->field($model, 'category_id')->dropDownList($options, ['prompt' => 'Select Cateogry']);
            ?>

        </div>


    </div>



    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <?=
            $form->field($model, 'image[]')->fileInput(['multiple' => true])->hint('Dimension 594*285. Maximum 5 images allowed');
            ?>
            <?php
            if ($model->image != '' && $model->id != "") {

                if ($model->image != '') {
                    $images = explode(',', $model->image);

                    foreach ($images as $image) {
                        $s3 = Yii::$app->get('s3');
                        $url = $s3->commands()->getUrl('service-provider/' . $model->id . '/' . $image)->execute();
                        $return_html = "<img width='150' style='border: 2px solid #d2d2d2;margin-right:.5em;'   src='" . $url . "'/>";

                        echo '<a class="aws_inner_image" href="' . Yii::$app->request->baseUrl . '/service-provider/del-image?id=' . $model->id . '&item=' . $image . '">'
                        . '<i class="glyphicon glyphicon-trash">'
                        . '</i>'
                        . $return_html
                        . '</a>';
                    }
                }
                ?>
                <br>
                <br>
            <?php }
            ?>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>

    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?php
            $citydata = \common\models\Cities::find()->all();
            $options = array();
            foreach ($citydata as $data) {
                $cities[$data->id] = $data->name;
            }
            echo $form->field($model, 'city')->dropDownList($cities, ['prompt' => 'Select City']);
            ?>
        </div>
    </div>



    <div class="row" style="min-height: 500px;">
        <div class="col-xs-12 col-sm-6">
            <div class="location_input">

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'locality')->textarea(['maxlength' => true]) ?>

                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'locality_arabic')->textarea(['maxlength' => true]) ?>

                    </div>
                </div>
                <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="map">



                <div id="us3" style="width: 550px; height: 400px;"></div>
                <div class="clearfix">&nbsp;</div>

            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'working_time_from')->textInput() ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'working_time_to')->textInput() ?>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'snapchat')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'googleplus')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
        </div>

    </div>
    <div class="row">

        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'status')->dropDownList([1 => 'Enable', 0 => 'Disable']) ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs("
            $('#serviceprovider-working_time_from').timepicker();
        "); ?>
<?php $this->registerJs("
            $('#serviceprovider-working_time_to').timepicker();
        "); ?>

<?php
if ($model->latitude != '') {
    $lat = $model->latitude;
} else {
    $lat = 25.286106;
}
if ($model->longitude != '') {
    $lon = $model->longitude;
} else {
    $lon = 51.534817;
}
$this->registerJs("
    var lat = " . $lat . ";
    var lon = " . $lon . ";
$('#us3').locationpicker({
                location: {
//                    latitude: 25.286106,
//                    longitude: 51.534817
                    latitude: lat,
                    longitude: lon
                },
                radius: 1,
                inputBinding: {
                    latitudeInput: $('#serviceprovider-latitude'),
                    longitudeInput: $('#serviceprovider-longitude'),
                   // radiusInput: $('#us3-radius'),
//                    locationNameInput: $('#serviceprovider-locality')
                },
//                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {

                }
            });
        ");
?>
