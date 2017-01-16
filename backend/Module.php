<?php

namespace rgen3\blog\backend;

use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'rgen3\blog\controllers';
    public $defaultRoute = 'record';

    public function init()
    {
        parent::init();
        \Yii::$app->setAliases(['@blog/common' => __DIR__ . '/../common']);

        $this->registerTranslation();
    }

    public function registerTranslation()
    {

        \Yii::$app->i18n->translations['rgen3/blog/backend/*'] = [
            'class' => PhpMessageSource::class,
            'sourceLanguage' => \Yii::$app->sourceLanguage,
            'basePath' => '@blog/common/messages',
            'fileMap' => [
                'rgen3/blog/backend/admin' => 'admin.php'
            ]
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('rgen3/blog/backend/' . $category, $message, $params, $language);
    }
}