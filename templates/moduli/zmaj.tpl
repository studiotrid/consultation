{if isset($modulzmaj) && isset($modulzmaj.ime)}
<div class="zmajModul ikona" 
     data-ime="{$modulzmaj.ime|escape:'html'}" 
     data-slika="{$modulzmaj.slika|escape:'html'}" 
     data-priroda="{$modulzmaj.priroda|escape:'html'}" 
     title="{t}Click to view Dragon information{/t}">
    <img src="/img/zmaj-icon-1024px-.png" alt="{t}Dragon{/t}" />
    <span>{t}Dragon{/t}</span>
</div>
{/if}
