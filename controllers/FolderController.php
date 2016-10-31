<?php

namespace app\controllers;

use Yii;
use app\models\Folder;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class FolderController extends Controller
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

    public function actionIndex()
    {
        $models = Folder::find()->orderBy('id DESC')->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Folder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
