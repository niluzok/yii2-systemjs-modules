=Readme

I recently decided to learn about js modules and module loaders and because es6 has specification for modules and module loaders I decided to go with SystemJs that polifills future loader implementation.
So now I need somehow to use togeteher yii's asset pipeline and SystemJs.

First my need is to use AssetBundles to publish js but do not render script tags and SystemJs should now where my assets were published and load them asynchronously.

Now it is just it. No other SystemJs mambo-jumbo)

=Class description

==View
Uses jsFiles with View::POS_JS_MODULES position to generate map config option of SystemJs and adds script tag with this configuration to body end

==AssetBundle
Registers js files with position View::POS_JS_MODULES and tells View to map package name in [[AssetBundle::jsPackageName]] to folder [[AssetBundle::baseUrl]] so you can address individual files in bundle (js-modules) like

import someModule from 'package-name/some-module.js'
