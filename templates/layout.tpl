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
    
    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#977141">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Consultation Portal">
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/img/consultation-192.png">

    
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />

    <link type="text/css" rel="stylesheet" href="/inc/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

<body class="{if isset($bodyClass)}{$bodyClass}{/if}">
{include file="header.tpl"}


            {$content}
            {if isset($addition)}{$addition}{/if}
       


{include file="footer.tpl"}


    
    <script src="/inc/js/bootstrap.bundle.min.js"></script>
    <script src="/inc/js/custom.js?{$rnd}"></script>
        <script>
                // Register service worker to enable PWA install prompt
                if ('serviceWorker' in navigator) {
                        window.addEventListener('load', function() {
                                navigator.serviceWorker.register('/service-worker.js', { scope: '/' });
                        });
                }
        </script>

    </head>
    {if isset($additional_js)}{foreach from=$additional_js item=js}<script src="{$basepath}inc/js/{$js}"></script>{/foreach}{/if} 
	{if isset($additional_head_script)}<script>{$additional_head_script}</script>{/if}
    <script src="/inc/js/notification-status.js"></script>

{if isset($additional_body_script)}<script>{$additional_body_script}</script>{/if}

<style>
    #pwa-install-banner { 
        position: fixed; 
        right: 16px; 
        bottom: 16px; 
        z-index: 9998; 
        background: #977141; 
        color: #fff; 
        padding: 12px 14px; 
        border-radius: 12px; 
        box-shadow: 0 6px 18px rgba(0,0,0,0.15); 
        display: none;
        max-width: calc(100% - 32px);
        word-wrap: break-word;
        animation: slideInUp 0.5s ease-out;
    }
    #pwa-install-banner button { 
        margin-left: 10px; 
        background: #fff; 
        color: #977141; 
        border: 0; 
        padding: 8px 12px; 
        border-radius: 10px; 
        font-weight: 600; 
        cursor: pointer;
        white-space: nowrap;
    }
    #pwa-install-banner button:disabled { 
        opacity: 0.6; 
        cursor: not-allowed; 
    }
    @media (max-width: 600px) {
        #pwa-install-banner {
            right: 10px;
            bottom: 10px;
            left: 10px;
            max-width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        #pwa-install-banner span {
            flex: 1;
        }
        #pwa-install-banner button {
            margin-left: 0;
            padding: 6px 10px;
            font-size: 12px;
        }
    }
    @keyframes slideInUp {
        from {
            transform: translateY(100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<div id="pwa-install-banner" aria-live="polite">
    <span>{t}Install the app for quicker access{/t}</span>
    <button id="pwa-install-btn" type="button">{t}Install{/t}</button>
</div>

<script>
    (function(){
        var deferredPrompt;
        var banner = document.getElementById('pwa-install-banner');
        var btn = document.getElementById('pwa-install-btn');
        
        // Check if already running in PWA mode (standalone or fullscreen display-mode)
        const isRunningAsApp = window.matchMedia('(display-mode: standalone)').matches ||
                              window.matchMedia('(display-mode: fullscreen)').matches ||
                              window.matchMedia('(display-mode: minimal-ui)').matches ||
                              navigator.standalone === true; // iOS Safari

        // If already running as app, don't show install prompt
        if (isRunningAsApp) {
            if (banner) banner.style.display = 'none';
            return;
        }

        window.addEventListener('beforeinstallprompt', function(e){
            // Only show if not already in app mode
            if (!isRunningAsApp) {
                e.preventDefault();
                deferredPrompt = e;
                if (banner) banner.style.display = 'block';
            }
        });

        window.addEventListener('appinstalled', function(){
            deferredPrompt = null;
            if (banner) banner.style.display = 'none';
        });

        if (btn) {
            btn.addEventListener('click', function(){
                if (!deferredPrompt) return;
                btn.disabled = true;
                deferredPrompt.prompt();
                deferredPrompt.userChoice.finally(function(){
                    deferredPrompt = null;
                    btn.disabled = false;
                    if (banner) banner.style.display = 'none';
                });
            });
        }
    })();
</script>


</body></html>
