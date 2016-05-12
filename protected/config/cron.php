<?php
return array(
  
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Cron',
 
    'preload'=>array('log'),
 
    'import'=>array(
        'application.components.*',
        'application.models.*',
		'application.modules.user.*',
		'application.modules.user.models.*',
		
		'application.modules.project.*',
		'application.modules.project.models.*',
		'application.behaviors.*',
    ),

	'modules'=>array(
        'user' => array(
            'tableUsers' => 'Users',
            'tableProfiles' => 'Profiles',
            'tableProfileFields' => 'ProfilesFields',
        ),
		
	),
	
    'components'=>array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'~akoch-ov/logs/admintrix/cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'~akoch-ov/logs/admintrix/cron_trace.log',
                    'levels'=>'trace',
                ),
            ),
        ),
 
        // Соединение с СУБД
		'db'=>include 'db.php',
    ),
);