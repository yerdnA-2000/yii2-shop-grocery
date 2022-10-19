<?php

namespace app\controllers;

use yii\web\Controller;

class AppController extends Controller
{
    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        $this->view->title = \Yii::$app->name;
        return parent::beforeAction($action);
    }

    /**
     * Set meta tags: title, keywords, description
     * @param string|null $_title
     * @param string|null $_keywords
     * @param string|null $_description
     * @return void
     */
    protected function setMeta(
        string $_title = null,
        string $_keywords = null,
        string $_description = null
    ) {
        $this->view->title = $_title;
        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => "$_keywords",
        ]);
        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => "$_description",
        ]);
    }
}