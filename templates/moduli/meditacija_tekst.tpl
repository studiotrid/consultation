{if isset($modulmeditacija_tekst) && isset($modulmeditacija_tekst.tekst) && $modulmeditacija_tekst.tekst neq ''}
<div class="meditacijaTekstModul ikona" data-tekst="{$modulmeditacija_tekst.tekst|escape:'html'}" title="{t}Click to view Meditation{/t}">
    <img src="/img/meditacije-za-dati-zivot-icon-1024px-.png" alt="{t}Meditation{/t}" />
    <span>{t}Meditation{/t}</span>
</div>
{/if}
