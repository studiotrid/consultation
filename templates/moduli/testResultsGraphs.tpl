
{* Template for displaying test result graphs - shown after all module icons *}
{* The icon is shown in test.tpl, this only displays the graph content *}
{if isset($modultestTest) && count($modultestTest)>0}
    {foreach from=$modultestTest item=graf}
        <div class="testGrafikoni dn">
            <h3>{t}Test taken on{/t} {$graf.datum|date_format:"%d.%m.%Y"} {t}at{/t} {$graf.vreme|date_format:"%H:%M"}</h3>
            <div class="testGrafikonContainer " id="testGrafikonContainer{$graf.broj}">
                {include file="testGraf-full.tpl"} 
            </div>
        </div>
    {/foreach}
{/if}
