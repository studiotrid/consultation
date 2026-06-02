{if isset($modulrituali) && isset($modulrituali.tekst) && $modulrituali.tekst neq ''}
<div class="ritualiModul ikona" data-tekst="{$modulrituali.tekst|escape:'html'}" title="{t}Click to view ritual{/t}">
    <img src="/img/rituali.png" alt="{t}Ritual{/t}" />
    <span>{t}Ritual{/t}</span>
</div>
{/if}
