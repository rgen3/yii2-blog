# yii2-blog

Installation
============

Backend config example

```
'blog' => [
            'class' => rgen3\blog\backend\Module::class,
            'controllerMap' => [
                'record' => [
                    'class' => '\rgen3\blog\backend\controllers\RecordController'
                ],
                'category' => [
                    'class' => '\rgen3\blog\backend\controllers\CategoryController'
                ]
            ],
//            'basePath' => '@backend'
        ],
```

Use basePath to set own directory to override templates