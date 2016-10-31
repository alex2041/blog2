<?php

namespace app\controllers;

use app\models\Language;
use app\models\State;
use Yii;
use app\models\Post;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\Cookie;

class PostController extends Controller
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

    public function actionIndex()
    {
        stats();

        $cookies = Yii::$app->request->cookies;

        $query = Post::find()->where(['state_id' => State::ALL]);
        ($cookies->get('language') && in_array($cookies->getValue('language'), Language::$index)) ? $query->andWhere(['lang' => $cookies->getValue('language')]) : '';
        $query->orderBy('id DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['defaultPageSize' => 10, 'totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);

    }

    public function actionCat($id)
    {
        stats();

        $query = $this->findModelsByCat($id);
        $countQuery = clone $query;
        $pages = new Pagination(['defaultPageSize' => 10, 'totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('cat', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    public function actionView($id)
    {
        stats();

        return $this->render('view', [
            'post' => $this->findModel($id),
        ]);
    }

    public function actionLanguage($id)
    {
        $cookies = Yii::$app->response->cookies;

        if(in_array($id, Language::$index)){
            $cookies->add(new Cookie([
                'name' => 'language',
                'value' => $id,
            ]));
        }else{
            $cookies->remove('language');
        }
        
        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModel($id)
    {
        if (($model = Post::find()->where(['id' => $id])->andWhere(['IN', 'state_id', [State::ALL, State::CAT]])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelsByCat($cat_id)
    {
        $cookies = Yii::$app->request->cookies;

        $query = Post::find()->where(['category_id' => $cat_id])->andWhere(['IN', 'state_id', [State::ALL, State::CAT]]);
        ($cookies->get('language') && in_array($cookies->getValue('language'), Language::$index)) ? $query->andWhere(['lang' => $cookies->getValue('language')]) : '';
        $query->orderBy('id DESC');

        if (!empty($query)) {
            return $query;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
