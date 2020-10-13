<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Comment;
use app\components\Helper;
use app\models\search\CommentSearch;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * Show list comments
     *
     * @return string
     */
    public function actionList()
    {
        $search_model = new CommentSearch();
        $data_provider = $search_model->search(Yii::$app->request->queryParams);
    
        $data_provider->setPagination(['pageSize' => 10]);
    
        $data_provider->setSort([
            'defaultOrder' => [
                'contact_id' => SORT_ASC,
            ],
            'attributes' => [
                'contact_id',
                'email',
            ],
        ]);
        
        return $this->render('list', [
            'data_provider' => $data_provider,
            'search_model' => $search_model,
        ]);
    }
    
    /**
     * Create new comment
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Comment();
    
        if ($model->load(Yii::$app->request->post())) {
    
            $helper = new Helper();
            $contact_id = $helper->getContactID($model->email);

            if($contact_id > 0) {
                $model->contact_id = $contact_id;
    
                if($model->save()) {
                    return $this->redirect(['list']);
                }
                else {
                    $model->addError('email', 'Ошибка ошибка при создании сообщения!');
                }
            }
            else {
                $model->addError('email', 'Ошибка получения или создания контакта!');
            }
            
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
