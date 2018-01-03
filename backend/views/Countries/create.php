<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Countries */

$this->title = 'Create Countries';
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countries-create">

    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">

                <?= $this->render('_form', [
                'model' => $model,
                ]) ?>
            </div>
        </div>
    </section>
</div>
