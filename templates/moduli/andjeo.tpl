{if isset($modulandjeo) && isset($modulandjeo.andjeo)}
<div class="andjeoModul ikona" 
     data-andjeo="{$modulandjeo.andjeo|escape:'html'}" 
     data-kamen="{$modulandjeo.kamen|escape:'html'}"
     data-priroda="{$modulandjeo.priroda|escape:'html'}"
     data-faza="{$modulandjeo.faza}"
     data-label="{$modulandjeo.label|escape:'html'}"
     data-label-short="{$modulandjeo.label_short|escape:'html'}"
     title="{$modulandjeo.title|escape:'html'}">
    <img src="/img/andjeo-icon-1024px-.png" alt="{$modulandjeo.label|escape:'html'}" />
    <span>{$modulandjeo.label|escape:'html'}</span>
</div>
{/if}
