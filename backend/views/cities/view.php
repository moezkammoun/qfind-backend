<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Areas */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-view">

    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>

        <ol class="breadcrumb">

            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">

                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
//            'state_id',
                    ],
                ])
                ?>

            </div>
        </div>
    </section>
</div>
