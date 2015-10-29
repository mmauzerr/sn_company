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
    <h1>Main Gallery</h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($mainGallery, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($mainGallery, 'excerpt')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($mainGallery, 'status')->dropDownList($mainGallery->getStatus());?>

    <div class="form-group">
        <?= Html::submitButton($mainGallery->isNewRecord ? 'Create' : 'Update', ['class' => $mainGallery->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
