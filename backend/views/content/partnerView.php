<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Content */

$this->title = $model->excerpt;
$this->params['breadcrumbs'][] = ['label' => 'Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-view col-md-12">
    <div class="col-md-6">
        <h1><?= Html::encode($this->title) ?></h1>


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                // 'parent_id',
               // 'title',
                'excerpt',
               'content',

                [
                    'label' => 'Create time',
                    'value' => date('d/m/Y', $model->create_time),
                ],

                [
                    'label' => 'Update time',
                    'value' => date('d/m/Y', $model->update_time),
                ],
                [
                    'label'=>'status',
                    'value'=>$model->status == 1?'active':'deleted'
                ],

            ],
        ]) ?>
    </div>
</div>




