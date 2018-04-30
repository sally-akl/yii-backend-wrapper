<?php


return array(
        'sourcePath'=>'D:\AfaqyMax\NewTrackV4\protected', // eg. '/projects/myproject/protected'
        'messagePath'=>'D:\AfaqyMax\NewTrackV4\protected/messages2', // '/projects/myproject/protected/messages'
        'languages'=>array('en','ar'), // according to your translation needs
        'fileTypes'=>array('php'),
        'overwrite'=>false,
        'removeOld'=>false,
        'sort'=>true,
        'exclude'=>array(
                '.svn',
                '.gitignore',
                'yiilite.php',
                'yiit.php',
                '/i18n/data',
                '/messages',
                '/vendors',
                'yiic.php',
                'UserModule.php', // if you are using yii-user ... 
        ),
);
