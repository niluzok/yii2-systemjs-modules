<?php

namespace niluzok\systemjsmodules;

use yii\web\AssetBundle as YiiAssetBundle;

use niluzok\systemjsmodules\View;

/**
 * Asset bundle that registers js files with position View::POS_JS_MODULES
 * and maps package name to its public url
 */
class AssetBundle extends YiiAssetBundle
{
    /** @var string Js package name (namespace) for modules inside [[baseUrl]] folder */
    public $jsPackageName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->jsOptions['position'] = View::POS_JS_MODULES;

        // if assets are already public and [[jsPackageName]] is empty,
        // I assume that folder name is the package name
        if(!$this->sourcePath and !$this->jsPackageName) {
            $jsPackageName = basename($this->baseUrl);
        }
    }

    /**
     * @inheritdoc
     */
    public function publish($am)
    {
        parent::publish($am);

        // if assets are to be published and [[jsPackageName]] is empty,
        // I assume that [[sourcePath]] folder name si the package name
        if(!$this->jsPackageName) {
            $this->jsPackageName = basename($this->sourcePath);
        }
    }

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        if(isset($view->jsPackageMap[$this->jsPackageName])) {
            throw new yii\base\InvalidConfigException("Js package name '{$this->jsPackageName}' already used and mapped to '{$view->jsPackageMap[$this->jsPackageName]}'");
        }

        $view->jsPackageMap[$this->jsPackageName] = $this->baseUrl;
        
        return parent::registerAssetFiles($view);
    }
}
