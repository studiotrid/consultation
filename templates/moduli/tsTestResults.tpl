
{* Template for TS Test results - icon and graphs *}
{if isset($tsTest)}
<div class="tsTestResults ikona" title="{t}Click to view Consciousness Technology test results{/t}">
    <span>{t}CT TEST RESULTS{/t}<br>
    <small style="font-size:0.8em;">{$tsTest.nazivPlanete}</small></span>
</div>

<div class="tsTestGrafikoni dn">
    <h2 style="text-align:center; margin: 20px 0; color: #5f95c9;">
        {t}Consciousness Technology{/t} - {$tsTest.nazivPlanete}
    </h2>
    
    {* Pre-test grafikon *}
    <div style="margin-bottom: 30px; max-width: 100%; overflow-x: hidden;">
        <div class="tsTestHeaderRow">
            <h3 style="text-align:center; color: #d9534f; margin: 0;">{t}Pre-Test{/t} - {$tsTest.vreme|date_format:"%d.%m.%Y."}</h3>
        </div>
        <div class="grafikon" style="max-width: 100%;">
            <div class="graph" style="height:400px; max-width: 100%;">
                {foreach from=$tsTest.stubovi item=stubs}
                    <div class="stubic-holder2">
                        <div class="stubic-text2">{$stubs.znak}</div>
                        <div class="stubic2 {$stubs.planeta}" style="background:#{$stubs.boja};width:{$stubs.procenat|replace:",":"."}%">
                            {if $stubs.procenat != 0}
                                <div class="stubic-procenat2">{$stubs.procenat|round:0}%</div>
                            {/if}
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
        </div>
    </div>
    
    {* Odmor section - between graphs if posttest exists *}
    {if isset($tsTest.post.id) && $tsTest.post.id neq '' && $tsTest.post.uradjen eq 1}
        {if isset($tsTest.post.odgovor2a) && $tsTest.post.odgovor2a neq '' && $tsTest.post.odgovor2a neq 0}
        {assign var="prosek" value=($tsTest.post.odgovor2a + $tsTest.post.odgovor2b + $tsTest.post.odgovor2c) / 3}
        <div style="background: rgba(95, 149, 201, 0.1); padding: 30px; margin: 40px 0; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); border: 2px solid #5f95c9;">
            <h3 style="text-align:center; color: #e2c197; margin-bottom: 25px; font-size: 24px;">Stanje odmornosti nakon 28 dana prakse</h3>
            <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 20px;">
                <div style="text-align: center; flex: 1; min-width: 150px;">
                    <div style="font-size: 14px; color: #e2c197; margin-bottom: 10px;">Mentalni odmor</div>
                    <div style="font-size: 48px; font-weight: bold; color: #5f95c9;">{$tsTest.post.odgovor2a}</div>
                    <div style="font-size: 12px; color: #e2c197;">/10</div>
                </div>
                <div style="text-align: center; flex: 1; min-width: 150px;">
                    <div style="font-size: 14px; color: #e2c197; margin-bottom: 10px;">Fizički odmor</div>
                    <div style="font-size: 48px; font-weight: bold; color: #5f95c9;">{$tsTest.post.odgovor2b}</div>
                    <div style="font-size: 12px; color: #e2c197;">/10</div>
                </div>
                <div style="text-align: center; flex: 1; min-width: 150px;">
                    <div style="font-size: 14px; color: #e2c197; margin-bottom: 10px;">Emotivni odmor</div>
                    <div style="font-size: 48px; font-weight: bold; color: #5f95c9;">{$tsTest.post.odgovor2c}</div>
                    <div style="font-size: 12px; color: #e2c197;">/10</div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 2px dashed rgba(226, 193, 151, 0.3);">
                <div style="font-size: 16px; color: #e2c197; margin-bottom: 10px;">Prosečan odmor</div>
                <div style="font-size: 60px; font-weight: bold; color: #5cb85c;">{$prosek|string_format:"%.1f"}</div>
                <div style="font-size: 14px; color: #e2c197;">/10</div>
            </div>
        </div>
        {/if}
    
        {* Post-test grafikon *}
        <div style="margin-bottom: 30px; max-width: 100%; overflow-x: hidden;">
            <div class="tsTestHeaderRow">
                <h3 style="text-align:center; color: #5cb85c; margin: 0;">{t}Post-Test{/t} - {$tsTest.post.vreme|date_format:"%d.%m.%Y."}</h3>
            </div>
            <div class="grafikon" style="max-width: 100%;">
                <div class="graph" style="height:400px; max-width: 100%;">
                    {foreach from=$tsTest.post.stubovi item=stubs}
                        <div class="stubic-holder2">
                            <div class="stubic-text2">{$stubs.znak}</div>
                            <div class="stubic2 {$stubs.planeta}" style="background:#{$stubs.boja};width:{$stubs.procenat|replace:",":"."}%">
                                {if $stubs.procenat != 0}
                                    <div class="stubic-procenat2">{$stubs.procenat|round:0}%</div>
                                {/if}
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
                    <div class="linija2 linija70"><span class="osto7">70%</span></div>
                    <div class="linija2 linija80"><span class="posto8">80%</span></div>
                    <div class="linija2 linija90"><span class="posto9">90%</span></div>
                    <div class="linija2 linija100"><span class="posto10">100%</span></div>
                </div>
            </div>
        </div>
    {/if}
    
    {* Display posttest additional answers if available *}
    {if isset($tsTest.post.odgovor1) && $tsTest.post.odgovor1 neq ''}
    <div style="background: rgba(95, 149, 201, 0.1); padding: 30px; margin-top: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 2px solid rgba(95, 149, 201, 0.3);">
        <h3 style="text-align:center; color: #e2c197; margin-bottom: 30px;">Odgovori nakon mesec dana prakse</h3>
        
        <div style="margin-bottom: 25px;">
            <strong style="color: #e2c197; font-size: 16px;">Koliko ste praktikovali vežbu za balansiranje izazovnog odnosa u proteklih mesec dana?</strong>
            <p style="margin: 10px 0; padding: 10px; background: rgba(95, 149, 201, 0.1); border-left: 4px solid #5f95c9; color: #e2c197;">{$tsTest.post.odgovor1}</p>
        </div>
        
        {if isset($tsTest.post.odgovor3) && $tsTest.post.odgovor3 neq ''}
        <div style="margin-bottom: 25px;">
            <strong style="color: #e2c197; font-size: 16px;">Opišite uvide koje ste imali praktikujući datu vežbu:</strong>
            <p style="margin: 10px 0; padding: 15px; background: rgba(95, 149, 201, 0.1); border-left: 4px solid #5f95c9; line-height: 1.6; color: #e2c197;">{$tsTest.post.odgovor3|nl2br}</p>
        </div>
        {/if}
        
        {if isset($tsTest.post.odgovor4) && $tsTest.post.odgovor4 neq ''}
        <div style="margin-bottom: 25px;">
            <strong style="color: #e2c197; font-size: 16px;">Na kom životnom planu ste primetili najviše promena?</strong>
            <p style="margin: 10px 0; padding: 15px; background: rgba(95, 149, 201, 0.1); border-left: 4px solid #5f95c9; line-height: 1.6; color: #e2c197;">{$tsTest.post.odgovor4|nl2br}</p>
        </div>
        {/if}
    </div>
    {/if}
</div>

<style>
    .tsTestGrafikoni .tsTestHeaderRow {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 34px;
    }
    .tsTestGrafikoni .grafikon {
        margin-top: 12px;
    }
    .tsTestGrafikoni .graph {
        width: 90%;
        height: 400px;
        margin-left: 10%;
        padding-left: 20px;
        border-left: 4px solid #5f95c9;
        border-bottom: 4px solid #5f95c9;
        position: relative;
        margin-bottom: 40px;
        overflow: visible;
    }
    .tsTestGrafikoni .stubic-holder2 {
        cursor: pointer;
        height: 30px;
        margin-top: 10px;
        left: -50px;
        position: relative;
    }
    .tsTestGrafikoni .stubic2 {
        height: 30px;
        position: absolute;
        left: 30px;
        top: 0;
        box-shadow: 0 0 2px #dadada;
        min-width: 2px;
        z-index: 2;
    }
    .tsTestGrafikoni .stubic-text2 {
        width: 40px;
        font-family: astroregular;
        font-size: 30px;
        line-height: 1;
        text-align: left;
        position: absolute;
        left: -10px;
        top: -2px;
    }
    .tsTestGrafikoni .stubic-procenat2 {
        height: 30px;
        font-size: 1.3em;
        text-align: left;
        position: absolute;
        right: -50px;
        top: 0;
        line-height: 30px;
        white-space: nowrap;
        z-index: 3;
    }
    .tsTestGrafikoni .linija2 {
        border-left: 1px dashed #ddd;
        background: transparent;
        height: 430px;
        width: 0;
        position: absolute;
        text-indent: -15px;
        top: -20px;
    }
    .tsTestGrafikoni .linija2.linija0 { left: calc(0% - 10px); }
    .tsTestGrafikoni .linija2.linija10 { left: calc(10% - 10px); }
    .tsTestGrafikoni .linija2.linija20 { left: calc(20% - 10px); }
    .tsTestGrafikoni .linija2.linija30 { left: calc(30% - 10px); }
    .tsTestGrafikoni .linija2.linija40 { left: calc(40% - 10px); }
    .tsTestGrafikoni .linija2.linija50 { left: calc(50% - 10px); }
    .tsTestGrafikoni .linija2.linija60 { left: calc(60% - 10px); }
    .tsTestGrafikoni .linija2.linija70 { left: calc(70% - 10px); }
    .tsTestGrafikoni .linija2.linija80 { left: calc(80% - 10px); }
    .tsTestGrafikoni .linija2.linija90 { left: calc(90% - 10px); }
    .tsTestGrafikoni .linija2.linija100 { left: calc(100% - 10px); }
    .tsTestGrafikoni .posto0,
    .tsTestGrafikoni .posto1,
    .tsTestGrafikoni .posto2,
    .tsTestGrafikoni .posto3,
    .tsTestGrafikoni .posto4,
    .tsTestGrafikoni .posto5,
    .tsTestGrafikoni .posto6,
    .tsTestGrafikoni .posto7,
    .tsTestGrafikoni .posto8,
    .tsTestGrafikoni .posto9,
    .tsTestGrafikoni .posto10 {
        position: relative;
        top: -10px;
    }
</style>

<script type="text/javascript">
    $(document).off('click.tsTestResults').on('click.tsTestResults', '.tsTestResults', function(){
        var $grafikoni = $(this).next('.tsTestGrafikoni');
        $grafikoni.toggleClass('dn');
        $(this).toggleClass('active');

        if(!$grafikoni.hasClass('dn')) {
            $('html, body').animate({
                scrollTop: $grafikoni.offset().top - 100
            }, 500);
        }
    });
</script>

{/if}
