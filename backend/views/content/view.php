<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Content */

$this->title = $model->title;
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
                'title',
                'excerpt',
                [
                    'attribute'=>'Image',
                    'value'=>$model->content,
                    'format' => ['image',['width'=>'50','height'=>'50']],
                ],

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

<div class="content-view col-md-12">
    <div class="col-md-6">
        <h1>Product Gallery Item</h1>

        <?php if(isset($allItem)){?>
        <div style="margin:20px 0">
            <?php foreach($allItem as $item){?>
                <div style="display: inline-block;margin-bottom: 10px">
                    <img src="<?php echo $item['content']?>" width="100px" height="100px"/>
                    <button style="display: block;margin:0 auto;" class="btn btn-danger js-delete" data-id="<?php echo $item['id']?>">delete</button>
                </div>
            <?php }}?>
        </div>

        <?php $form = ActiveForm::begin(); ?>

        <?php echo Html::activeHiddenInput($galleryItem,'parent_id',['value'=>$model->id])?>

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

</div>

<script>

    window.onload = function(e){

        $('.js-delete').click(function(e){
            var el =$(this);
            var confirmBox = confirm("Are you sure you want to delete this image?");
            if(confirmBox){
                var id = el.data('id');
                deleteImg(id,el);
            }
        });
    }

    function deleteImg(id,el){
        $.ajax({
            type: 'POST',
            dataType:'JSON',
            url: '<?php echo Url::toRoute('content/delete-img')?>',
            data: {
                id:id,

            }
        }).done(function(r){
            if(r.success){
                el.parent().remove();

            }else{
                alert(r.message);
            }
        }).fail(function(r){
            if(r.responseText){
                alert(r.responseText);
            }else{
                alert(r.statusText);
            }
        })
    }


</script>

