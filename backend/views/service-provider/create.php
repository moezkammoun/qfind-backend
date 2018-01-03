<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServiceProvider */

$this->title = 'Create Service Provider';
$this->params['breadcrumbs'][] = ['label' => 'Service Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-provider-create">

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
