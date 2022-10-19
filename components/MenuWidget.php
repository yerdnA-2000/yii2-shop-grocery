<?php

namespace app\components;

use app\models\Category;
use yii\base\Widget;

/**
 * Menu categories widget
 * @extends Widget
 */
class MenuWidget extends Widget
{
    /**
     * @var $tpl string template menu widget
     * @var $ul_class string class for html tag <ul>
     * @var $data array categories array data
     */
    public $tpl;
    public string $ul_class;
    public array $data;
    public array $tree;
    public $menuHtml;

    /**
     * @return void
     */
    public function init()
    {
        parent::init();
        if (empty($this->ul_class)) {
            $this->ul_class = 'menu';
        }
        if (empty($this->tpl)) {
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    /**
     * @return string|void
     */
    public function run()
    {
        //get cache
        $menu = \Yii::$app->cache->get('menu');
        if ($menu) {
            return $menu;
        }

        $this->data = Category::find()->select(['id', 'parent_id', 'title'])->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = '<ul class="' . $this->ul_class . '">';
        $this->menuHtml .= $this->getMenuHtml($this->tree);
        $this->menuHtml .= '</ul>';

        //set cache
        \Yii::$app->cache->set('menu', $this->menuHtml, 60);

        return $this->menuHtml;
    }

    /**
     * @return array value for tree
     */
    protected function getTree(): array
    {
        $_tree = [];
        foreach ($this->data as $_id => &$_node) {
            if (!$_node['parent_id']) {
                $_tree[$_id] = &$_node;
            } else {
                $this->data[$_node['parent_id']]['children'][$_node['id']] = &$_node;
            }
        }
        return $_tree;
    }

    /**
     * @param $_tree
     * @return string
     */
    protected function getMenuHtml($_tree)
    {
        $_str = '';
        foreach ($_tree as $_category) {
            $_str .= $this->catToTemplate($_category);
        }
        return $_str;
    }

    /**
     * @param $category array
     * @return false|string
     */
    protected function catToTemplate($category)
    {
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }

}
