<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoriesMaster */

$this->title = 'Update Categories Master: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categories-master-update">
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
