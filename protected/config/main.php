<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$theme = 'gentelella';
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'tsurayya_store',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
                'application.modules.srbac.controllers.SBaseController',
                'ext.yii-mail.YiiMailMessage',
                
    ),

    'modules'=>array(
        // uncomment the following to enable the Gii tool
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'12345',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
                'home'=>array('layoutPath' => "themes/$theme/views/layouts"),
                'login'=>array('layoutPath' => "themes/$theme/views/layouts"),
                'dashboard'=>array('layoutPath' => "themes/$theme/views/layouts"),
                'admin'=>array('layoutPath' => "themes/$theme/views/layouts",
                    'modules'=>array(
                        'report'=>array('layoutPath' => "themes/$theme/views/layouts",
                        )
                    )
                ),
    ),

    // application components
    'components'=>array(
            'user'=>array(
                    // enable cookie-based authentication
                    'allowAutoLogin'=>true,
                    'loginUrl' => array('/login')
            ),
            // uncomment the following to enable URLs in path-format
            'urlManager'=>array(
                'urlSuffix'=>'.html',
                'urlFormat'=>'path',
                'showScriptName'=>false,
                'rules'=>array(
                        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
            // 'db'=>array(
            //     'connectionString'=>'mysql:host=localhost;dbname=tsurayya_store',
            //     'emulatePrepare' => true,
            //     'username' => 'root',
            //     'password' => '',
            //     'charset' => 'utf8',
            // ),
            // /*idHOstinger*/
            'db'=>array(
                'connectionString'=>'mysql:host=127.0.0.1;dbname=u246930799_tsur',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ),
            // /*000webhost*/
            // 'db'=>array(
            //     'connectionString'=>'mysql:host=localhost;dbname=id1301634_tsurayyastore',
            //     'emulatePrepare' => true,
            //     'username' => 'id1301634_tsurayyastore',
            //     'password' => 'tsurayyastore',
            //     'charset' => 'utf8',
            // ),
            'errorHandler'=>array(
                    // use 'site/error' action to display errors
                    'errorAction'=>'site/error',
            ),
            'log'=>array(
                    'class'=>'CLogRouter',
                    'routes'=>array(
                            array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'error, warning',
                            ),
                            // uncomment the following to show log messages on web pages
                            /*
                            array(
                                    'class'=>'CWebLogRoute',
                            ),
                            */
                    ),
            ),

            'authManager'=>array(
                'class'=>'application.modules.srbac.components.SDbAuthManager',
                'connectionID'=>'db',
                'itemTable'=>'AuthItem',        
                'assignmentTable'=>'AuthAssignment',
                'itemChildTable'=>'AuthItemChild'
            ),

            'mail' => array(
                'class' => 'ext.yii-mail.YiiMail',
                'transportType'=>'smtp',
                'transportOptions'=>array(
                        'host'=>'localhost',
                        'username'=>'fajar@localhost',
                        'password'=>'indratmo',
                        'port'=>'25',                       
                ),
                'viewPath' => 'application.modules.ContactUs.views.mail',           
        ),

            
        ),

        //Load theme
        'theme'=>$theme,
        
    // application-level parameters that can be accessed
    // using Yii::app()->params['uploadUrl']
    'params'=>array(
        // this is used in contact page
        // 'adminEmail'=>'webmaster@example.com',
        // 'logo'=>'/images/logo_new.png',
        // 'uploadUrl'=> 'images/rdonews/',/*from root*/
        'uploadUrl'=> 'images/',/*from root*/

    ),
        
        //Set default controller
         //'defaultController' => 'welcome'

    'language'=>'en',
    //Set default controller
    'defaultController' => 'login',
);