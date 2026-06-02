{if isset($modulinkarnacije) && (
    $modulinkarnacije.prethodna_cart neq '' ||
    $modulinkarnacije.naredna_cart neq '' ||
    $modulinkarnacije.prethodna_pol neq '' ||
    $modulinkarnacije.naredna_pol neq ''
)}
<div class="inkarnacijeModul ikona"
     data-prethodna-cart="{$modulinkarnacije.prethodna_cart|escape:'html'}"
     data-prethodna-pol="{$modulinkarnacije.prethodna_pol|escape:'html'}"
     data-naredna-cart="{$modulinkarnacije.naredna_cart|escape:'html'}"
     data-naredna-pol="{$modulinkarnacije.naredna_pol|escape:'html'}"
     title="{t}Click to view incarnation charts{/t}">
    <img src="/img/karmicka.png" alt="{t}Incarnation Charts{/t}" />
    <span>{t}INCARNATIONS{/t}</span>
</div>
{/if}
