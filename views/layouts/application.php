<?php

// prevent the direct access
defined('_PREVENT-DIRECT-ACCESS') or die ("Access restrict");

?>

<!doctype html>
<html>
    <head>
        <title>Webservice - Lumturo</title>

        <meta charset='utf-8' />
        
        <meta name="author" content="Bruno Moiteiro" />
        <meta http-equiv="content-language" content="pt-br">
        
        <meta name="description" content="" /> 
        <meta name="keywords" content="" /> 
        
        <!--Com essa tag nada será indexado-->
        <meta name="robots" content="noindex,nofollow">
        
        <!--Styles-->
        <link href="<?php echo WEBSITE ?>/design/stylesheets/style.css" rel="stylesheet" type="text/css" />
        
        
        <link rel="stylesheet" href="design/stylesheets/documenter_style.css" media="all">
        <script src="/scripts/jquery-1.6.2.min.js"></script>
        <script src="/scripts/jquery.scrollTo-1.4.2-min.js"></script>
        <script src="/scripts/jquery.easing.js"></script>
        <style>
            html{background-color:#EEEEEE;color:#383838;}
            ::-moz-selection{background:#333636;color:#00DFFC;}
            ::selection{background:#333636;color:#00DFFC;}
            #documenter_sidebar #documenter_logo{background-image:url();}
            a{color:#008C9E;}
            strong{letter-spacing: 0.8px }
            hr{border-top:1px solid #D4D4D4;border-bottom:1px solid #FFFFFF;}
            #documenter_sidebar, #documenter_sidebar ol a{background-color:#343838;color:#FFFFFF;}
            #documenter_sidebar ol a{-webkit-text-shadow:1px 1px 0px #494F4F;-moz-text-shadow:1px 1px 0px #494F4F;text-shadow:1px 1px 0px #494F4F;}
            #documenter_sidebar ol{border-top:1px solid #212424;}
            #documenter_sidebar ol a{border-top:1px solid #494F4F;border-bottom:1px solid #212424;color:#FFFFFF;}
            #documenter_sidebar ol a:hover{background:#333636;color:#00DFFC;border-top:1px solid #333636;}
            #documenter_sidebar ol a.current{background:#333636;color:#00DFFC;border-top:1px solid #333636;}
            #documenter_copyright{display:block !important;visibility:visible !important;}
        </style>
        <!--Scripts-->
        
    </head>
    
    <body>
    
		<?php include(VIEW_PATH.DS.'layouts'.DS.'messages.php') ?>
        
        <?php 
		
		if(file_exists(VIEW_PATH.DS.$route_app->controller.DS.$route_app->view.".php"))
			include(VIEW_PATH.DS.$route_app->controller.DS.$route_app->view.".php");
		?>
        
    </body>
    
</html>