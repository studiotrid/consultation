{if isset($modulvodjena) && isset($modulvodjena.naziv)}
<div class="vodjenaModul ikona" 
     data-naziv="{$modulvodjena.naziv|escape:'html'}" 
     title="{t}Click to view Guided Meditation{/t}">
    <img src="/img/vodjena-meditacija-icon-1024px-.png" alt="{t}Guided Meditation{/t}" />
    <span>{t}Guided Meditation{/t}</span>
</div>
{/if}
