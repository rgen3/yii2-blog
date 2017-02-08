<?php

namespace rgen3\blog\frontend;

use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'rgen3\blog\controllers';
    public $defaultRoute = 'record';

    public function init()
    {
        parent::init();
        \Yii::$app->setAliases(['@blog/frontend' => __DIR__ ]);

        $this->registerTranslation();
    }

    public function registerTranslation()
    {

        \Yii::$app->i18n->translations['rgen3/blog/frontend/*'] = [
            'class' => PhpMessageSource::class,
            'sourceLanguage' => \Yii::$app->sourceLanguage,
            'basePath' => '@blog/common/messages',
            'fileMap' => [
                'rgen3/blog/frontend/msg' => 'messages.php'
            ]
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('rgen3/blog/frontend/' . $category, $message, $params, $language);
    }
}