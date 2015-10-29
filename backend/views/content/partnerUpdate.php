<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Content */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="content-form col-md-5">

    <h1><?php echo $model->excerpt?></h1>

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'excerpt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

   <?php echo $form->field($model, 'status')->dropDownList($model->getStatus());?>

    <?php echo $form->field($model, 'title')->widget(
        zxbodya\yii2\elfinder\ElFinderInput::className(),
        ['connectorRoute' => 'content/connector',]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' =>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
