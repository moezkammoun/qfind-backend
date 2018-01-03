<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoriesMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-master-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control slug']); ?>
    <?= $form->field($model, 'name_arabic')->textInput(['maxlength' => true, 'class' => 'form-control ']); ?>

    <?= $form->field($model, 'canonical_name')->hiddenInput(['maxlength' => true])->label(FALSE)->error(FALSE) ?>


    <?php
    $cats = $model->categorySubTree();
    ?>

    <?= $form->field($model, 'parent_id')->dropDownList($cats, ['prompt' => 'Select Parent']) ?>

    <?=
    $form->field($model, 'icon')->fileInput(['id' => 'img-field']);
    ?>




    <div class="row">
        <div class="col-sm-10">
            <input type="hidden" id="image_id" value="<?= $model->icon; ?>">
            <?php
            if ($model->icon != '' && $model->id != "") {

                if ($model->icon != '') {

                    echo '<a href="' . Yii::$app->request->baseUrl . '/categories-master/del-image?id=' . $model->id . '&item=' . $model->icon . '">'
                    . '<i class="glyphicon glyphicon-trash">'
                    . '<img width="125" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/categories-master/' . $model->id . '/icon/' . $model->icon . '" />'
                    . '</i></a>';
                }
                ?>
                <br>
                <br>
            <?php }
            ?>

        </div>
    </div>


    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("
        $(document).ready(function(){

             $('.slug').keyup(function() {
                             $('#categoriesmaster-canonical_name').val(slug($(this).val()));
                        });
        });

        ");
?>
<?php
//$this->registerJs("
//        $(document).ready(function(){
//            if($('#image_id').val())
//            {
//
//            $('.input-group').hide()
//            }
//
//
//          });
//
//        ");
?>