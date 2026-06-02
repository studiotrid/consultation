{* Template za prikaz jednog TS testa - posttest grafikon *}
{if isset($tsTest.post.uradjen) && $tsTest.post.uradjen eq 1}
<div class="ts-posttest-grafikon">
    <h4 class="ts-test-subtitle">{t}Post-test{/t} - {$tsTest.post.vreme|date_format:"%d.%m.%Y"}</h4>
    <div class="graph ts-graph">
        {foreach from=$tsTest.post.stubovi item=stubs}
            <div class="stubic-holder2 ts-stubic-holder">
                <div class="stubic-text2 ts-stubic-text">{$stubs.znak}</div>
                <div class="stubic2 ts-stubic {$stubs.planeta}" style="background:#{$stubs.boja};width:{$stubs.procenat|replace:",":"."}%">
                    {if $stubs.procenat != 0}<div class="stubic-procenat2 ts-stubic-procenat">{$stubs.procenat|round:0}%</div>{/if}
                </div>
            </div>
        {/foreach}
        
        <div class="linija2 linija0"><span class="posto0">0%</span></div>
        <div class="linija2 linija10"><span class="posto1">10%</span></div>
        <div class="linija2 linija20"><span class="posto2">20%</span></div>
        <div class="linija2 linija30"><span class="posto3">30%</span></div>
        <div class="linija2 linija40"><span class="posto4">40%</span></div>
        <div class="linija2 linija50"><span class="posto5">50%</span></div>
        <div class="linija2 linija60"><span class="posto6">60%</span></div>
        <div class="linija2 linija70"><span class="posto7">70%</span></div>
        <div class="linija2 linija80"><span class="posto8">80%</span></div>
        <div class="linija2 linija90"><span class="posto9">90%</span></div>
        <div class="linija2 linija100"><span class="posto10">100%</span></div>
    </div>
    
    {if isset($tsTest.odmor) && $tsTest.odmor != 0}
    <div class="ts-odmor-box">
        <strong>{t}Rest score{/t}:</strong> <span class="ts-odmor-vrednost">{$tsTest.odmor}</span>
    </div>
    {/if}
    
    {if isset($tsTest.post.odgovori) && $tsTest.post.odgovori.odgovor1 neq null && $tsTest.post.odgovori.odgovor1 neq 0}
    <div class="ts-odgovori-box">
        <h5>{t}Answers{/t}:</h5>
        <p><strong>{t}How often did you practice the balancing exercise in the past month?{/t}</strong><br />
        {$tsTest.post.odgovori.odgovor1}</p>
        
        {if isset($tsTest.post.odgovori.odgovor3) && $tsTest.post.odgovori.odgovor3 neq ''}
        <p><strong>{t}Describe the insights you had while practicing the exercise.{/t}</strong><br />
        {$tsTest.post.odgovori.odgovor3}</p>
        {/if}
        
        {if isset($tsTest.post.odgovori.odgovor4) && $tsTest.post.odgovori.odgovor4 neq ''}
        <p><strong>{t}In which area of life did you notice the most changes?{/t}</strong><br />
        {$tsTest.post.odgovori.odgovor4}</p>
        {/if}
    </div>
    {/if}
</div>
{/if}
