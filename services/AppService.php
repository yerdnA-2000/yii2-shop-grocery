<?php

namespace app\services;

use yii\web\View;

class AppService
{
    /**
     * Set meta tags for view: title, keywords, description
     * @param View $view
     * @param string|null $_title
     * @param string|null $_keywords
     * @param string|null $_description
     * @return void
     */
    protected function setMeta(
        View $view,
        string $_title = null,
        string $_keywords = null,
        string $_description = null
    ) {
        $view->title = $_title;
        $view->registerMetaTag([
            'name' => 'keywords',
            'content' => "$_keywords",
        ]);
        $view->registerMetaTag([
            'name' => 'description',
            'content' => "$_description",
        ]);
    }
}