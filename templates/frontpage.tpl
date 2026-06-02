<div class="container" style="margin-top:60px;text-align:center;margin-bottom:60px;">
    <h2 class="senka">{t}Welcome to Your Personal Astro-Energetic Space{/t}</h2>
    <h3 class="senka" style="margin-top:30px;">{t}This is where your journey into awareness, balance, and your inner map of time begins.{/t}</h3>
</div>

<div class="container ">
    {assign var="prosiriKolonu37" value=false}
    {if isset($smarty.get.tip)}
        {if $smarty.get.tip == 37}
            {assign var="prosiriKolonu37" value=true}
        {/if}
    {elseif isset($lastKonsultacijaTip) && $lastKonsultacijaTip == 37}
        {assign var="prosiriKolonu37" value=true}
    {/if}
  <div class="row g-3  px-4 p-0">
        <div class="gradient-border blue col-12 {if $prosiriKolonu37}col-md-10{else}col-md-6{/if} p-4 px-4 levos">
        {if isset($levo)}{$levo}
        {else}
        {if isset($lastKonsultacija) && is_array($lastKonsultacija)}
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
                    <h4>{t}Next scheduled consultation{/t}<br />{$sledeca|date_format:$date_format} {t}in{/t} {$sledeca|date_format:"%H:%M"}</h4>
                {/if}
            </div>
        {/if}
        {/if}
        {if !isset($levo) && isset($buduceKonsultacije) && $buduceKonsultacije|@count gt 0}
            <div class="upcomingConsultations text-start" style="margin-top:15px;">
                <h5 class="mb-2">{t}Upcoming consultations{/t}</h5>
                <ul class="list-unstyled mb-0">
                {foreach from=$buduceKonsultacije item=upcoming}
                    <li><strong>
                        {if isset($upcoming.faza) && isset($upcoming.brojKonsultacijeUFazi) && $upcoming.faza > 0 && $upcoming.brojKonsultacijeUFazi > 0}
                            {$upcoming.naziv} {$upcoming.faza}/{$upcoming.brojKonsultacijeUFazi}
                        {else}
                            {$upcoming.naziv}
                        {/if}
                    </strong> - {$upcoming.startTime|date_format:$date_format} {$upcoming.startTime|date_format:"%H:%M"}</li>
                {/foreach}
                </ul>
            </div>
        {/if}
    </div>

    <div class="col-12 {if $prosiriKolonu37}col-md-2{else}col-md-6{/if} px-0 px-md-3">
        <div class="row {if $prosiriKolonu37}row-cols-1 row-cols-md-1{else}row-cols-2 row-cols-md-3{/if} g-3 justify-content-center">
            {if isset($sveKonsultacije) && is_array($sveKonsultacije)}
            {foreach from=$sveKonsultacije item=konsult}
                <div class="col text-center ">
                    <div class="gradient-border blue p-2 box {if $konsult.koliko gt 0}ima{/if}" data-tip="{$konsult.id}">
                        <img src="/img/{$konsult.logo}" class="img-fluid mb-2" style="max-height:120px;width:auto" alt="{$konsult.naziv}" />
                        <br />
                        <span>{t}{$konsult.naziv}{/t}</span> 
                        {if $konsult.koliko gt 0}<span class="broj">{$konsult.koliko}</span>{/if}
                    </div>
                </div>
            {/foreach}
            {/if}
            {if isset($nevezaniTestovi)}
                <div class="col text-center ">
                    <div class="gradient-border blue p-2 box ima" data-tip="0">
                        <img src="/img/test.png" class="img-fluid mb-2" style="max-height:120px;width:auto" alt="Testovi" />
                        <br />
                        <span>{t}Testovi{/t}</span> 
                        {if $nevezaniTestovi|count gt 0}<span class="broj">{$nevezaniTestovi|count}</span>{/if}
                    </div>
                </div>
            {/if}
        </div>
    </div> 
  </div>
</div>
