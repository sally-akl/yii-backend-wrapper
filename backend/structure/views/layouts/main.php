<!DOCTYPE html>
<html dir="<?php echo Yii::t('app', 'DIR'); ?>" >
    <head lang="<?php echo Yii::app()->language ?>">
        <meta charset="UTF-8">
		<?php echo $this->renderCss(); ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <!-- ICon Title -->
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl ?>/AymaXTrack/img/icon.png" type="image/x-icon" />
        <!----------- CSS Files --------------->

        <!-- Material Design fonts -->
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
        <!----------- CSS Files --------------->


        <link rel="shortcut icon" href="AymaXTrack/brand/favicon.ico"/>
        <script src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDWovqH5UTD6biy1x8o7324DUlBVpH4Gs4&libraries=places&language=<?php echo Yii::app()->language ?>&region=SA"></script>


        <script>


           window.pathname = '<?php echo Yii::app()->request->baseUrl ?>/';
           window.basepathname = '<?php echo Yii::app()->params['remoteServer'] ?>/';
           window.NODEURL = '<?php echo Yii::app()->params['nodeurl'] ?>';
           window.realbase = '<?php echo Yii::app()->getBaseUrl(true); ?>';
           window.DIR = '<?php echo Yii::t('app', 'DIR'); ?>';
           window.DIRS = '<?php echo Yii::t('app', 'Left'); ?>';
           window.DIRS2 = '<?php echo Yii::t('app', 'Right'); ?>';
           window.APIMODE = '<?php echo Yii::app()->params['apimode'] ?>';
           window.activelang = "<?php echo Yii::t('app', 'DIR'); ?>";
			

        </script>

        <?
        $bugmod = 2;
        ?>







    </head>
    <body>
        <div id="pop1" class="popover " style="width: 350px; display: none;"></div>

     <?php  echo $content; ?>
     <?php  $this->renderJs("bottom"); ?>

    </body>
</html>
