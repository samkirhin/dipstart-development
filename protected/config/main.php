<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
date_default_timezone_set('Europe/Moscow');
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'New Dipstart',
    //'defaultController' => 'user/default',
    'language' => 'ru',
    // preloading 'log' component
    'preload'=>array('log','booster'),
    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.models.*',
        'application.modules.rights.components.*',
        'application.modules.project.*',
        'application.modules.project.models.*',
        'application.modules.project.controllers.*',
        'application.extensions.yiifilemanager.*',
        'application.extensions.yiifilemanagerfilepicker.*',
        'application.extensions.helpers.EDownloadHelper',
    ),
    'modules'=>array(
        'user' => array(
            // названия таблиц взяты по умолчанию, их можно изменить
            'tableUsers' => 'Users',
            'tableProfiles' => 'Profiles',
            'tableProfileFields' => 'ProfilesFields',
        ),
        'rights',
        'project',
        'mailbox'=>
            array(
                'userClass' => 'User',
                'userIdColumn' => 'id',
                'usernameColumn' =>  'username',
            ),
        // uncomment the following to enable the Gii tool
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'158358',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
    ),
    // application components
    'components'=>array(
        'user'=>array(
            'class' => 'RWebUser',
            'loginUrl'=>array('user/login'),
            'allowAutoLogin'=>false,
        ),
        'authManager'=>array(
            'class'=>'RDbAuthManager',
            'defaultRoles' => array('Guest') // ��������� ����
        ),
        'booster' => array(
            'class' => 'application.extensions.booster.components.Booster',
        ),
        'fileman' => array(
            'class'=>'application.extensions.yiifilemanager.YiiDiskFileManager',
            'storage_path' => 'uploads',
        ),
        'jsonRequest' => array(
            'class' => 'JsonHttpRequest'
        ),
        // uncomment the following to enable URLs in path-format
        /*
        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),*/
        // uncomment the following to use a MySQL database
        //local server
        /*'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=dipstart',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        */
        //dev server
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=dipstart',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CWebLogRoute',
                    'categories' => 'application',
                    'levels'=>'error, warning, trace, profile, info',
                    'showInFireBug' => true
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'webmaster@dipstart.ru',
    ),
);