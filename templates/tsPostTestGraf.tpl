
    <div class="testTS">{$tsTest.post.vreme|date_format:"%d.%m.%Y. "} <font style="color:">{$tsTest.nazivPlanete}</font><br /></b></div>
    {if $tsTest.post.uradjen eq 1}
    <div class="grafikon" style="">
        <div class="graph" style="height:400px;">
            {foreach from=$tsTest.post.stubovi item=stubs}
                <div class="stubic-holder2">
                    
                    <div class="stubic-text2">{$stubs.znak}</div><div class="stubic2 {$stubs.planeta}" style="background:#{$stubs.boja};width:{$stubs.procenat|replace:",":"."}%">{if $stubs.procenat != 0}<div class="stubic-procenat2">{$stubs.procenat|round:0}%</div>{/if}</div>
                    
                </div>
            {/foreach}
            
            <div class="linija2 linija0"><span class="posto0">0%</span></div>
            <div class="linija2 linija10"><span class="posto1">10%</span></div>
            <div class="linija2 linija20"><span class="posto2">20%</span></div>
            <div class="linija2 linija30 "><span class="posto3">30%</span></div>
            <div class="linija2 linija40"><span class="posto4">40%</span></div>
            <div class="linija2 linija50 "><span class="posto5">50%</span></div>
            <div class="linija2 linija60"><span class="posto6">60%</span></div>
            <div class="linija2 linija70 "><span class="posto7">70%</span></div>
            <div class="linija2 linija80"><span class="posto8">80%</span></div>
            <div class="linija2 linija90"><span class="posto9">90%</span></div>
            <div class="linija2 linija100"><span class="posto10">100%</span></div>
        </div>
        <table class="table main" style="margin-left:30px;" id="tabelaps{$smarty.foreach.dddd.iteration}">
        <thead>
        <tr class="headerRow" style="display:none"><th>Pitanje</th><th>Odgovor</th><th>Planeta</th><th>Esencija</th><th>Nivo</th></tr>
        </thead>
        <tbody>
        {foreach from=$tsTest.post.stubovi item=stubsa}
            {foreach from=$stubsa.pitanja item=pitanje}
                <tr class="klasa {$pitanje.planeta} posto{$pitanje.total}" style="display:none"><td>{$pitanje.pitanje}</td><td><strong style="color:red">{$pitanje.total}</strong></td><td>{$cakresve.{$pitanje.cakra}} - {$pitanje.planeta}</td><td>{$pitanje.zivotinja}</td><td>{$pitanje.nivo}</td></tr>
            {/foreach}
        {/foreach}
        </tbody>
        </table>
    </div>
    {/if}