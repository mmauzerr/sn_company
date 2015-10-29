<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Partner';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create new partner', ['partner-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            // 'parent_id',
           // 'title',
            'excerpt',
            'content:ntext',
            // 'created_by',
            // 'create_time:datetime',
            // 'updated_by',
            // 'update_time:datetime',
            [
                'label'=>'status',
                'attribute'=>'status',
                'value'=>function($model){
                    return $model->status==1?'active':'deleted';
                }
            ],
            // 'type',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url = Url::toRoute(['content/partner-view','id'=>$model->id]);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('yii', 'Create'),
                        ]);
                    },
                    'update'=>function($url,$model){
                        $url = Url::toRoute(['content/partner-update','id'=>$model->id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        $url = Url::toRoute(['content/delete-product-gallery','id'=>$model->id]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Create'),
                            'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                            'data-method' => 'post',
                        ]);
                    },

                ]

            ],
        ],
    ]); ?>

</div>
