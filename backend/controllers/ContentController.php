<?php

namespace backend\controllers;

use Yii;
use common\models\Content;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\MainGallery;
use common\models\MainGalleryItems;
use zxbodya\yii2\elfinder\ConnectorAction;
use common\models\search\MainGallerySearch;
use yii\helpers\Json;
use common\models\AboutUs;
use common\models\ProductGallery;
use common\models\ProductGalleryItem;
use common\models\search\ProductGallerySearch;
use common\models\Contact;
//use common\models\Partner;
//use common\models\search\PartnerSearch;
//use common\models\History;
//use common\models\Servicing;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ContentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'connector' => array(
                'class' => ConnectorAction::className(),
                'settings' => array(
                    'root' => Yii::getAlias('@webroot') . '/uploads/',
                    'URL' => Yii::getAlias('@web') . '/uploads/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
                )
            ),
        ];
    }

    /**
     * Lists all Content models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductGallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Content model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id = NULL)
    {
        $model = $this->findModel($id);
        $galleryItem = new ProductGalleryItem();

        $allItem = Content::find()->where(['parent_id'=>$model->id,'type'=>5])->all();

        if($galleryItem->load(Yii::$app->request->post())){
            $galleryItem->created_by = Yii::$app->user->identity->id;
            $galleryItem->status = 1;
            if($galleryItem->save()){
                $model = $this->findModel($galleryItem->parent_id);
                return $this->redirect(['view','id'=>$model->id]);
            }
        }

        return $this->render('view', [
            'model' => $model,
            'galleryItem'=>$galleryItem,
            'allItem'=>$allItem
        ]);
    }

    /**
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductGallery();

        if (Yii::$app->request->post()) {
            $model->attributes = Yii::$app->request->post('ProductGallery');
            $model->created_by = Yii::$app->user->identity->id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                print_r($model->errors);exit();
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateMainGallery($id){

        $mainGallery = MainGallery::findOne($id);

        if(Yii::$app->request->isPost){
            $mainGallery->attributes = Yii::$app->request->post('MainGallery');

            if($mainGallery->save()){
                 return $this->redirect(['content/view-main-gallery','id'=>$mainGallery->id]);
            }
        }

        return $this->render('mainGalleryCreate',[
            'mainGallery'=>$mainGallery,
        ]);

    }

    public function actionCreateMainGallery(){
        $mainGallery = new MainGallery();

        if(Yii::$app->request->isPost){
            $mainGallery->attributes = Yii::$app->request->post('MainGallery');
            $mainGallery->content = 'content';
            $mainGallery->created_by = Yii::$app->user->identity->id;
            if($mainGallery->save()){
                return $this->redirect(['content/view-main-gallery','id'=>$mainGallery->id]);
            }
        }

        return $this->render('mainGalleryCreate',[
            'mainGallery'=>$mainGallery,
        ]);

    }

    public function actionMainGallery()
    {
        $searchModel = new MainGallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('mainGalleryIndex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    public function actionViewMainGallery($id = NULL)
    {
        $model = $this->findModel($id);
        $galleryItem = new MainGalleryItems();
        $allItem = Content::find()->where(['parent_id'=>$model->id,'type'=>2])->all();

        if($galleryItem->load(Yii::$app->request->post())){
            $galleryItem->created_by = Yii::$app->user->identity->id;
            $galleryItem->status = 1;
            if($galleryItem->save()){
                $model = $this->findModel($galleryItem->parent_id);
                return $this->redirect(['content/view-main-gallery','id'=>$model->id]);
            }
        }

        return $this->render('viewMainGallery',[
            'model' => $model,
            'allItem'=>$allItem,
            'galleryItem'=>$galleryItem,
        ]);
    }

    public function actionDeleteImg(){

        if(Yii::$app->request->isAjax){
            $id = Yii::$app->request->post('id');

            $model = $this->findModel($id);
            if($model->delete()){
                echo Json::encode(['success'=>true,'message'=>'Image is deleted']);
                Yii::$app->end();
            }else{
                echo Json::encode(['success'=>false,'message'=>'Image is not deleted']);
                Yii::$app->end();
            }
        }
    }

    public function actionAboutUs(){

        $model = AboutUs::find()->where(['type'=>3])->one();

        if(empty($model->attributes)){
            $model = new AboutUs();
        };
        if(Yii::$app->request->isPost){
            $model->attributes = Yii::$app->request->post('AboutUs');
            $model->created_by = Yii::$app->user->identity->id;
            $model->status = 1;

            if($model->save()){

                return $this->redirect(['content/about-us','model'=>$model]);
            }
        }

        return $this->render('about_us',[
            'model' => $model,
        ]);

    }

    public function actionHistory()
    {
        $model = History::find()->where(['type'=>8])->one();

        if(empty($model->attributes)){
            $model = new History();
        };
        if(Yii::$app->request->isPost){
            $model->attributes = Yii::$app->request->post('History');
            $model->created_by = Yii::$app->user->identity->id;
            $model->status = 1;

            if($model->save()){
                return $this->redirect(['history','model'=>$model]);
            }
        }

        return $this->render('history',[
            'model' => $model,
        ]);


    }

    public function actionServicing()
    {
        $model = Servicing::find()->where(['type'=>9])->one();

        if(empty($model->attributes)){
            $model = new Servicing();
        };
        if(Yii::$app->request->isPost){
            $model->attributes = Yii::$app->request->post('Servicing');
            $model->created_by = Yii::$app->user->identity->id;
            $model->status = 1;

            if($model->save()){
                return $this->redirect(['servicing','model'=>$model]);
            }
        }

        return $this->render('servicing',[
            'model' => $model,
        ]);


    }

    public function actionContact()
    {
        $model = Contact::find()->where(['type'=>6])->one();

        if(empty($model->attributes)){
            $model = new Contact();
        };
        if(Yii::$app->request->isPost){
            $model->attributes = Yii::$app->request->post('Contact');
            $model->created_by = Yii::$app->user->identity->id;
            $model->status = 1;

            if($model->save()){
                return $this->redirect(['contact','model'=>$model]);
            }else{
                print_r($model->errors);exit();
            }
        }

        return $this->render('contact',[
            'model' => $model,
        ]);


    }

    public function actionDeleteProductGallery($id){
        if($this->findModel($id)->delete()){
            $this->deleteAllChildren($id);
            return $this->redirect(['index']);
        }
    }


    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()){
            $this->deleteAllChildren($id);
            return $this->redirect(['content/main-gallery']);
        }

    }

    public function actionPartnerIndex()
    {
        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('partnerIndex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPartnerView($id){
        $model = $this->findModel($id);

        return $this->render('partnerView',[
            'model'=>$model,
        ]);
    }

    public function actionPartnerCreate(){
        $model = new Partner();

        if(Yii::$app->request->isPost){
            $model->attributes = Yii::$app->request->post('Partner');
            if(Yii::$app->request->post('Partner')['title'] == null ){
                $model->title = 'title';
            }
            $model->created_by = Yii::$app->user->identity->id;
            if($model->save()){
                return $this->redirect(['content/partner-view','id'=>$model->id]);
            }else{
                print_r($model->errors);exit();
            }
        }

        return $this->render('partnerCreate',[
            'model'=>$model,
        ]);
    }

    public function actionPartnerUpdate($id)
    {
        $model = Partner::findOne($id);

        if(Yii::$app->request->isPost){
            $model->attributes = Yii::$app->request->post('Partner');
            if(Yii::$app->request->post('Partner')['title'] == null ){
                $model->title = 'title';
            }

            if($model->save()){
                return $this->redirect(['content/partner-view','id'=>$model->id]);
            }else{
                print_r($model->errors);exit();
            }
        }

        return $this->render('partnerUpdate',[
            'model'=>$model,
        ]);
    }

    public function actionPartnerDelete($id)
    {
        if($this->findModel($id)->delete()){
            return $this->redirect(['content/partner-index']);
        }
    }



    protected function deleteAllChildren($id){
        $models = Content::find()->where(['parent_id'=>$id])->all();

        if(!empty($models)){
            foreach($models as $model){
                $model->delete();
            }
        }

    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Content::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
