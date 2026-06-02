{if isset($modulandjeo_faza2_veza) && isset($modulandjeo_faza2_veza.andjeo) && isset($modulandjeo_faza2_veza.broj)}
<div class="andjeoFaza2VezaModul ikona"
     data-broj="{$modulandjeo_faza2_veza.broj|escape:'html'}"
     data-andjeo="{$modulandjeo_faza2_veza.andjeo|escape:'html'}"
     title="{$modulandjeo_faza2_veza.title|default:'Kliknite za prikaz'|escape:'html'}">
    <img src="/img/andjeo-icon-1024px-.png" alt="Anđeo" />
    <span>Anđeo</span>
</div>
{/if}
