<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Content */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="content-form col-md-5">

    <h1><?php echo $mainGallery->title?></h1>

    <?php if(isset($allItem)){?>
        <div style="margin:20px 0">
            <?php foreach($allItem as $item){?>
                <div style="display: inline-block;margin-bottom: 10px">
                    <img src="<?php echo $item['content']?>" width="100px" height="100px"/>
                    <button style="display: block;margin:0 auto;" class="btn btn-danger" data-id="<?php echo $item['id']?>">delete</button>
                </div>
        </div>
        <?php }}?>
    <?php $form = ActiveForm::begin(); ?>

    <?php echo Html::activeHiddenInput($galleryItem,'parent_id',['value'=>$mainGallery->id])?>

    <?= $form->field($galleryItem, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($galleryItem, 'excerpt')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($galleryItem, 'content')->widget(
        zxbodya\yii2\elfinder\ElFinderInput::className(),
        ['connectorRoute' => 'content/connector',]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' =>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
