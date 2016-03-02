<?php

namespace niluzok\systemjsmodules;

use yii\helpers\Html;

use yii\web\View as YiiView;

/**
 * View that use js files with position POS_JS_MODULES and [[jsPackageMap]]
 * that AssetBundle has filled to config SystemJs that it can load this modules
 * properly 
 */
class View extends YiiView
{
    /**
     * Js module files (es6)
     *
     * To register js file as module and do not render script tag for file,
     * but load it in future with SystemJs you should use register js file
     * with this position constant
     */
    const POS_JS_MODULES = 50;

    /** @var array 'map' config option for System Js that maps package name to public folder */
    public $jsPackageMap = [];

    /**
     * @inheritdoc
     */
    protected function renderBodyEndHtml($ajaxMode)
    {
        $scriptTags = [];
        $scriptTags[] = parent::renderBodyEndHtml($ajaxMode);
        
        if(!empty($this->jsPackageMap)) {
            $systemJsMapConfigJson = json_encode($this->jsPackageMap);
            $scriptTags[] = Html::script("System.config({map: $systemJsMapConfigJson})", ['type' => 'text/javascript']);
        }

        return implode("\n", $scriptTags);
    }
}