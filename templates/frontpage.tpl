<div class="container" style="margin-top:60px;text-align:center;margin-bottom:60px;">
    <h2 class="senka">{t}Welcome to Your Personal Astro-Energetic Space{/t}</h2>
    <h3 class="senka" style="margin-top:30px;">{t}This is where your journey into awareness, balance, and your inner map of time begins.{/t}</h3>
</div>

<div class="container ">
  <div class="row g-3  px-4 p-0">
    <div class="gradient-border blue col-12 col-md-6 p-4 px-4">
        {if isset($levo)}{$levo}
        {else}
        {if isset($lastKonsultacija)}
            <div class="modulHolder">
            {foreach from=$lastKonsultacija item=moduls name=mso}
                {if $smarty.foreach.mso.first}
                    <h3><strong>{t}{$moduls.naziv}{/t}</strong> / {$moduls.startTime|date_format:$date_format}</h3>
                    {if isset($moduls.nextConsult) && $moduls.nextConsult neq ''}{assign var="sledeca" value=$moduls.nextConsult}{/if}
                {else}
                    {$moduls}
                {/if}
            {/foreach}
                {if isset($sledeca)}
                    <h4>{t}Next scheduled consultation{/t}<br />{$sledeca|date_format:$date_format} {t}in{/t} {$sledeca|date_format:"%H:%i"}</h4>
                {/if}
            </div>
        {/if}
        {/if}
    </div>

    <div class="col-12 col-md-6 px-0 px-md-3">
        <div class="row row-cols-2 row-cols-md-3 g-3 justify-content-center">
            {foreach from=$sveKonsultacije item=konsult}
                <div class="col text-center ">
                    <div class="gradient-border blue p-2 box {if $konsult.koliko gt 0}ima{/if}" data-tip="{$konsult.id}">
                        <img src="/img/{$konsult.logo}" class="img-fluid mb-2" alt="{$konsult.naziv}" />
                        <br />
                        <span>{t}{$konsult.naziv}{/t}</span> 
                        {if $konsult.koliko gt 0}<span class="broj">{$konsult.koliko}</span>{/if}
                    </div>
                </div>
            {/foreach}
        </div>
    </div> 
  </div>
</div>
