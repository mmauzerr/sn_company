<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Main Gallery';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Gallery', ['create-main-gallery'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'excerpt',
          //  'content:ntext',
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
                        $url = Url::toRoute(['content/view-main-gallery','id'=>$model->id]);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('yii', 'Create'),
                        ]);
                    },
                    'update'=>function($url,$model){
                        $url = Url::toRoute(['content/update-main-gallery','id'=>$model->id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                    }

                ]

            ],
        ],
    ]); ?>

</div>
