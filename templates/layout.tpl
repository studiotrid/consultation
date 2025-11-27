{locale path="../locale" domain="messages"}
<!DOCTYPE html>
<html lang="{if isset($language)}{$language}{else}en{/if}">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{t}Consultation Page{/t}">
    <title>{if isset($meta_title)}{$meta_title}{else}{t}Consultation{/t}{/if}</title>
    
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />

    <link type="text/css" rel="stylesheet" href="/inc/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <link type="text/css" rel="stylesheet" media="all" href="/inc/css/custom.css?{$rnd}"/>
   
    <!--<script src="/inc/js/jquery-1.12.4.min.js"></script>-->
    <script src="/inc/js/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script type="text/javascript">
        var language="{$smarty.session.language}";
    </script>
    
    {if isset($additional_css)}{foreach from=$additional_css item=css}<link href="{$basepath}include/css/{$css}" type="text/css" rel="stylesheet" media="screen" />{/foreach}{/if}
    {if isset($additional_js)}{foreach from=$additional_js item=js}<script src="/inc/js/{$js}"></script>{/foreach}{/if}


    </head>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<body class="">
{include file="header.tpl"}


            {$content}
            {if isset($addition)}{$addition}{/if}
       


{include file="footer.tpl"}


    
    <script src="/inc/js/bootstrap.bundle.min.js"></script>
    <script src="/inc/js/custom.js?{$rnd}"></script>

    </head>
    {if isset($additional_js)}{foreach from=$additional_js item=js}<script src="{$basepath}inc/js/{$js}"></script>{/foreach}{/if} 
	{if isset($additional_head_script)}<script>{$additional_head_script}</script>{/if}
    

{if isset($additional_body_script)}<script>{$additional_body_script}</script>{/if}


</body></html>
