<?php
/**
 * Created by PhpStorm.
 * User: Milos Barlov <mbarlov> milosbarlov@gmail.com
 * Date: 15.7.15. \
 * Time: 14.10
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>



<div class="content-form col-md-5">
    <h1>New Partner</h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'excerpt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->dropDownList($model->getStatus());?>

    <?php echo $form->field($model, 'title')->widget(
        zxbodya\yii2\elfinder\ElFinderInput::className(),
        ['connectorRoute' => 'content/connector',]
    ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
