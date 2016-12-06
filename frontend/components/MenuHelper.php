<?php

namespace frontend\components;

use yii;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use frontend\assets\AppAsset;
use backtend\models\PolicyProcedureMenu;
class MenuHelper {

    public static function getMenu($id) {
        $parent = $id;
        $result = static::getMenuRecrusive($parent);
        return $result;
    }

    public static function getTopMenu() {
        $parent = null;
        $result = static::getMenuRecrusive($parent);
        return $result;
    }

    private static function getMenuRecrusive($parent) {

        $items = PolicyProcedureMenu::find()
                ->where(['parent' => $parent, 'flag' => 1])
                ->orderBy([
                    'sort' => SORT_ASC,
                ])
                ->asArray()
                ->all();

        $result = [];
        if (is_array($items) && !empty($items)) {
            $linkOptions['data-toggle'] = 'dropdown';
            Html::addCssClass($options, ['widget' => 'dropdown']);
            Html::addCssClass($linkOptions, ['widget' => 'dropdown-toggle']);
        }
        foreach ($items as $item) {

            $result[] = [
                'label' => $item['label'],
                'url' => array($item['url']),
                'items' => static::getMenuRecrusive($item['id']),
                'Options' => 'dropdown',
                '<ul class="dropdown-menu"></li>',
            ];
        }
        return $result;
    }

}
