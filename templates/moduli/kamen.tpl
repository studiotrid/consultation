{if isset($modulkamen) && isset($modulkamen.tekst) && $modulkamen.tekst neq ''}
<div class="kamenModul ikona" data-tekst="{$modulkamen.tekst|escape:'html'}" title="{t}Click to view Stone Meditation{/t}">
    <img src="/img/kamen.png" alt="{t}Stone Meditation{/t}" />
    <span>{t}Stone Meditation{/t}</span>
</div>
{/if}
