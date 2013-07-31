<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt-PT">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <title>Painel </title>
        
        <link rel="shortcut icon" href="<?=img_path('favicon.ico','admin'); ?>"/>
        <link rel="icon" href="<?=img_path('favicon.ico','admin'); ?>" type="image/x-icon"/>
        
        <link rel="stylesheet" type="text/css" href="<?=css_path('reset')?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?=css_path('style', 'admin')?>" media="screen" />
        
        <script type='text/javascript' src='<?=js_path('jquery')?>'></script>
        <script type='text/javascript' src='<?=js_path('custom','admin')?>'></script>
        
        <!--[if lt IE 9]>
            <script type="text/javascript" src="<?=js_path('excanvas/excanvas','admin')?>"></script>
        <![endif]-->
        <script type="text/javascript" src="<?=js_path('spinners/spinners.min','admin')?>"></script> <!-- optional -->
        <script type="text/javascript" src="<?=js_path('tipped/tipped','admin')?>"></script>

        <link rel="stylesheet" type="text/css" href="<?=css_path('tipped', 'admin')?>" />

    </head>
    <body id="<?=$id_body?>">
        <div id="content">
            <?=$menu?>

            <?=$content?>
        </div>
        <?=$footer?>
    </body>
</html>
    