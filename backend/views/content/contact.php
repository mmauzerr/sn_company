<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Content */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="content-form col-md-5">

    <h1>Contact</h1>

    <?php if(!empty($model->id)){?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                //'parent_id',
                'title',
                'excerpt',
                'content:ntext',
                // 'created_by',
                [
                    'label' => 'Create time',
                    'value' => date('d/m/Y', $model->create_time),
                ],
                // 'updated_by',
                [
                    'label' => 'Update time',
                    'value' => date('d/m/Y', $model->update_time),
                ],
                // 'status',
                // 'type',
            ],
        ]) ?>

    <?php }?>

    <?php if(!empty($model->id)){?>
        <h1 style="margin-top:30px;">Update Contact</h1>
    <?php }?>



    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'excerpt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' =>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
