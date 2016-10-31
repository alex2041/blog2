<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CategoryController extends Controller
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

    public function actionBlockCat($block_id)
    {
        $list = Category::find()
            ->where(['IN', 'block_id', explode(',', $block_id)])
            ->orderBy('id DESC')
            ->all();

        if(count($list)>0) {
            foreach($list as $model) {
                echo "<option value='".$model->id."'>".$model->name."</option>";
            }
        }else{
            echo "<option value=\"\"> --- </option>";
        }
    }

    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
