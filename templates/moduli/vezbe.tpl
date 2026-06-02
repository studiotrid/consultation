{if isset($modulvezbe) && isset($modulvezbe.tekst) && $modulvezbe.tekst neq ''}
<div class="vezbeModul ikona" data-tekst="{$modulvezbe.tekst|escape:'html'}" title="{t}Click to view exercises{/t}">
    <img src="/img/fizicke-vezbe-za-dati-zivot-icon-1024px-.png" alt="{t}Exercises{/t}" />
    <span>{t}Exercises{/t}</span>
</div>
{/if}
