<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt-PT">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <title>Imob - Venda de Imóveis</title>
        
        <meta http-equiv="Content-language" content="pt-PT" />
        <meta name="zone" content="PT"/>
        
        <link rel="shortcut icon" href="<?=img_path('favicon.ico','site'); ?>"/>
        <link rel="icon" href="<?=img_path('favicon.ico','site'); ?>" type="image/x-icon"/>
        
        <link rel="stylesheet" type="text/css" href="<?=css_path('reset')?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?=css_path('style', 'site')?>" media="screen" />
        
        <script type='text/javascript' src='<?=js_path('jquery')?>'></script>
        
        <script language="javascript">
            var site_url="<?= site_url(); ?>";
            
        </script>
        <script type='text/javascript' src='<?=js_path('custom','site')?>'></script>
        
        <script type="text/javascript" src="<?=js_path('fancybox-1.3.4/jquery.easing-1.3.pack','site')?>"></script>
        <script type="text/javascript" src="<?=js_path('fancybox-1.3.4/jquery.mousewheel-3.0.4.pack','site')?>"></script>
        <script type="text/javascript" src="<?=js_path('fancybox-1.3.4/jquery.fancybox-1.3.4','site')?>"></script>
        <link rel="stylesheet" type="text/css" href="<?=js_path('','site')?>fancybox-1.3.4/jquery.fancybox-1.3.4.css" media="screen"/>
        
        
    </head>
    <body id="home">
        <div class="wrapper">
            <!-- begin header-->
            <div id="header">
                <div class="logo">
                    <a href="<?= site_url(); ?>"><img src="<?=img_path('imob.png', 'site')?>" alt="Imob"/></a>
                </div>
                <div class="nav">
                    
                    <?=site_nav()?>
                    
                </div>
            </div>
            <!-- end header-->
            <!-- begin main-->
            <div id="main">
                
                <?=$destaques?>
                
                <!-- begin content-main -->
                <div class="content-main">
                    
                    <?=$content?>
                    
                    <?=$sidebar?>
                    
                </div>
                <!-- end content-main -->
                
            </div>  
            <!-- end main-->
            <div class="clearing"></div>
            <!-- begin footer-->
            <div id="footer">
                <div class="copyright">
                    <p>Copyright © 2012 Imob - Venda de Imóveis.</p>
                </div>
                <div class="links">
                                        
                    <?=site_nav()?>
                    
                </div>
            </div>
            <!-- end footer-->
        </div>

    </body>
</html>