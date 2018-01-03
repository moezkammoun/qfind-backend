<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Areas */

$this->title = 'Create Areas';
$this->params['breadcrumbs'][] = ['label' => 'Area', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-create">

    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">

                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </div>
    </section>
</div>
