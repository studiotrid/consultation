{if isset($modulvodic) && isset($modulvodic.zivotinja)}
<div class="vodicModul ikona" 
     data-zivotinja="{$modulvodic.zivotinja|escape:'html'}" 
     data-priroda="{$modulvodic.priroda|escape:'html'}"
     data-ritual="{$modulvodic.ritual|escape:'html'}"
     data-prikazi-ritual="{$modulvodic.prikazi_ritual}"
     data-faza="{$modulvodic.faza}"
     data-label="{$modulvodic.label|escape:'html'}"
     title="{$modulvodic.title|escape:'html'}">
    <img src="/img/1024px-zivotni-vodic-icon.png" alt="{$modulvodic.label|escape:'html'}" />
    <span>{$modulvodic.label|escape:'html'}</span>
</div>
{/if}
