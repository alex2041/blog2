<?php

namespace app\controllers;

use app\models\Folder;
use Yii;
use app\models\Note;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class NoteController extends Controller
{
    public $layout = 'note';

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

    public function actionIndex($n_id = false, $f_id = null)
    {
        stats();

        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $items = [
                'name' => $this->findModel($n_id)->name,
                'content' => $this->findModel($n_id)->content
            ];

        }else{
            $query = Note::find();

            if($f_id){
                $query->andWhere(['folder_id' => $f_id]);
            }

            $models = $query->orderBy('id DESC')->indexBy('id')->all();
            $folders = Folder::find()->indexBy('id')->all();

            return $this->render('index', [
                'models' => $models,
                'folders' => $folders,
                'f_id' => $f_id,
                'n_id' => $n_id ? $n_id : current($models)->id
            ]);
        }
    }

    public function actionView($id)
    {
        stats();

        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $items = [
                'name' => $this->findModel($id)->name,
                'content' => $this->findModel($id)->content
            ];

        }else{
            $models = Note::find()->where(['folder_id' => $id])->orderBy('id DESC')->indexBy('id')->all();
            $folders = Folder::find()->indexBy('id')->all();

            return $this->render('index', [
                'models' => $models,
                'folders' => $folders,
                'f_id' => $id,
                'ln_id' => current($models)->id
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Note::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
