<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CountriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countries-index">
    <section class="content-header">

        <h1><?= Html::encode($this->title) ?></h1>
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        
        <ol class="breadcrumb">

            <?= Html::a('Create Countries', ['create'], ['class' => 'btn btn-success']) ?>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                                                    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
        'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                                'id',
            'sortname',
            'name',
            'phonecode',

                   //['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\ActionColumn',
                    'header' => 'view',
                    'template' => '{view}'],
                    ['class' => 'yii\grid\ActionColumn',
                    'header' => 'update',
                    'template' => '{update}'],
                    ['class' => 'yii\grid\ActionColumn',
                    'header' => 'delete',
                    'template' => '{delete}',
                    ],
                    ],
                    ]); ?>
                                            </div>
        </div>
    </section>
</div>
