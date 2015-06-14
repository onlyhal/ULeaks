<?php

namespace frontend\controllers;

use app\models\Images;
use app\models\Universities;
use app\models\User;
use Yii;
use app\models\Articles;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends Controller
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

    /**
     * Lists all Articles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Articles::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = Articles::findOne($id);
        $model_image = Images::find()->where(['id_article' => $model->id])->all();
        $model_university = Universities::findOne($model->id_university);
        $model_user = User::findOne($model->id_user);
        return $this->render('view', [
            'model' => $model,
            'model_image' => $model_image,
            'university' => $model_university->name,
            'user' => $model_user->username,
        ]);
    }

    /**
     * Creates a new Articles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->session['id_user']){

            $model = new Articles();
            $model_university = Universities::find()->all();
            $id_user = Yii::$app->session['id_user'];
        if ($model->load(Yii::$app->request->post())) {
            $model->id_user = $id_user;
            $model->date = date('Y-m-d');
            $model->id_university = $_POST['id_university'];

            $model->save();
           if($_FILES['pictures']){
                $path = 'media/articles/'.(string)$model->id;
                @mkdir($path, 0777);
                for($i = 0, $files_count = count($_FILES['pictures']['name']); $i < $files_count; $i++){
                    copy($_FILES['pictures']['tmp_name'][$i],$path."/".basename($_FILES['pictures']['name'][$i]));
                    $model_images = new Images();
                    $model_images->id_article = $model->id;
                    $model_images->src = $path."/".basename($_FILES['pictures']['name'][$i]);
                    $model_images->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model_university' => $model_university,
            ]);
        }
        }else{
            return $this->goHome();
        }
    }

    /**
     * Updates an existing Articles model.
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

    /**
     * Deletes an existing Articles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Articles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
