{if isset($modulprecnik_svesti)}
<div class="precnikSvestiModul ikona"
     data-title="{$modulprecnik_svesti.title|escape:'html'}"
     data-precnik="{$modulprecnik_svesti.precnik}"
     data-half="{$modulprecnik_svesti.half}"
     data-image="{$modulprecnik_svesti.image|escape:'html'}"
     title="Kliknite za prikaz prečnika svesti">
    <img src="/img/precnik-svesti-icon.png" alt="Prečnik svesti" />
    <span>PREČNIK SVESTI</span>
</div>
{/if}