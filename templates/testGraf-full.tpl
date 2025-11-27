  <div class="test">{t}{$graf.planete}{/t}<br /></b>{if $graf.tip eq 'yang'}{t}Najveća potreba{/t}{else}{t}Najveći disbalans{/t}{/if}: <span style="color:red">{t}{$graf.disbalans}{/t}</span></div>
  {if !isset($graf.samojedna)}
  
    <div class="grafikon" >
        <div class="graph">
            {foreach from=$graf.stubovi item=stubs}
                <div class="stubic-holder">
                    
                    <div class="stubic {$stubs.planeta}" style="background:#{$stubs.boja};height:{$stubs.procenat}%">{if $stubs.procenat != 0}<div class="stubic-procenat">{$stubs.procenat|round:0}%</div>{/if}<div class="stubic-text">{$stubs.znak}</div></div>
                    
                </div>
            {/foreach}
            
            <div class="linija linija0"><span class="posto0">0%</span></div>
            <div class="linija linija10"><span class="posto1">10%</span></div>
            <div class="linija linija20"><span class="posto2">20%</span></div>
            <div class="linija linija30 {$graf.tip}"><span class="posto3">30%</span></div>
            <div class="linija linija40"><span class="posto4">40%</span></div>
            <div class="linija linija50 "><span class="posto5">50%</span></div>
            <div class="linija linija60 "><span class="posto6">60%</span></div>
            <div class="linija linija70 {$graf.tip}"><span class="posto7">70%</span></div>
            <div class="linija linija80"><span class="posto8">80%</span></div>
            <div class="linija linija90"><span class="posto9">90%</span></div>
            <div class="linija linija100"><span class="posto10">100%</span></div>
        </div>
        <table class="table main" style="margin-left:30px;" id="tabela{$smarty.foreach.testovi.iteration}">
        <thead>
        <tr class="headerRow" style="display:none"><th>{t}Pitanje{/t}</th><th>{t}Odgovor{/t}</th><th>{t}Planeta{/t}</th><th>{t}Esencija{/t}</th><th>{t}Nivo{/t}</th></tr>
        </thead>
        <tbody>
        {foreach from=$graf.stubovi item=stubs}
            {foreach from=$stubs.pitanja item=pitanje}
                <tr class="klasa {$pitanje.planeta} posto{$pitanje.total}" style="display:none"><td>{t}{$pitanje.pitanje}{/t}</td><td><strong style="color:red">{$pitanje.total}</strong></td><td>{$pitanje.planeta}</td><td>{t}{$pitanje.zivotinja}{/t}</td><td>{t}{$pitanje.nivo}{/t}</td></tr>
            {/foreach}
        {/foreach}
        </tbody>
        </table>
    </div>
    {else} {* SAMO JEDNA PLANETA USPRAVNO *}
    
    <div class="grafikon" style="{if $smarty.foreach.testovi.iteration eq 1}{else}{/if}">
        <div class="graph" style="height:400px;">
            {foreach from=$graf.stubovi item=stubs}
                <div class="stubic-holder2">
                    
                    <div class="stubic-text2">{$stubs.znak}</div><div class="stubic2 {$stubs.planeta}" style="background:#{$stubs.boja};width:{$stubs.procenat|replace:",":"."}%">{if $stubs.procenat != 0}<div class="stubic-procenat2">{$stubs.procenat|round:0}%</div>{/if}</div>
                    
                </div>
            {/foreach}
            
            <div class="linija2 linija0"><span class="posto0">0%</span></div>
            <div class="linija2 linija10"><span class="posto1">10%</span></div>
            <div class="linija2 linija20"><span class="posto2">20%</span></div>
            <div class="linija2 linija30 {$graf.tip}"><span class="posto3">30%</span></div>
            <div class="linija2 linija40"><span class="posto4">40%</span></div>
            <div class="linija2 linija50 "><span class="posto5">50%</span></div>
            <div class="linija2 linija60"><span class="posto6">60%</span></div>
            <div class="linija2 linija70 {$graf.tip}"><span class="posto7">70%</span></div>
            <div class="linija2 linija80"><span class="posto8">80%</span></div>
            <div class="linija2 linija90"><span class="posto9">90%</span></div>
            <div class="linija2 linija100"><span class="posto10">100%</span></div>
        </div>
        <table class="table main" style="margin-left:30px;" id="tabela{$smarty.foreach.testovi.iteration}">
        <thead>
        <tr class="headerRow" style="display:none"><th>{t}Pitanje{/t}</th><th>{t}Odgovor{/t}</th><th>{t}Planeta{/t}</th><th>{t}Esencija{/t}</th><th>{t}Nivo{/t}</th></tr>
        </thead>
        <tbody>
        {foreach from=$graf.stubovi item=stubsa}
            {foreach from=$stubsa.pitanja item=pitanje}
                <tr class="klasa {$pitanje.planeta} posto{$pitanje.total}" style="display:none"><td>{t}{$pitanje.pitanje}{/t}</td><td><strong style="color:red">{$pitanje.total}</strong></td><td>{$pitanje.planeta}</td><td>{t}{$pitanje.zivotinja}{/t}</td><td>{t}{$pitanje.nivo}{/t}</td></tr>
            {/foreach}
        {/foreach}
        </tbody>
        </table>
    </div>
  {/if}{* KRAJ SAMO JEDNA PLANETA USPRAVNO *}


{literal}
<script>
$(document).ready(function(){
    $('.test').on("click",function(){
        $(this).next('.grafikon').toggle();
    });
    
    $('.linija span').on("click",function(){
        var klasa = $(this).attr("class");
        var ri=klasa;
        
        
        var tabela=$(this).parent().parent().next('table');
        var tabelaID = $(tabela).attr('id');
        
        $('#'+ tabelaID + ' .klasa').not('.'+ri).hide();
        $('#'+ tabelaID + ' .'+ri).toggle();
        
        hideHeader('#'+ tabelaID);
    });
    
     $('.linija2 span').on("click",function(){
        var klasa = $(this).attr("class");
        var ri=klasa;
        
        
        var tabela=$(this).parent().parent().next('table');
        var tabelaID = $(tabela).attr('id');
        

        $('#'+ tabelaID + ' .klasa').not('.'+ri).hide();
        $('#'+ tabelaID + ' .'+ri).toggle();
        
        hideHeader('#'+ tabelaID);
    });
    
    $('.stubic').on("click",function(){
        var klasa = $(this).attr("class");
        var ri=klasa.substring(7);
        
        var tabela=$(this).parent().parent().next('table');
        var tabelaID = $(tabela).attr('id');
       
       
        $('#'+ tabelaID + ' .klasa').not('.klasa.'+ri).hide();
        $('#'+ tabelaID + ' .klasa.'+ri).toggle();
        
        hideHeader('#'+ tabelaID);
    });
    
    
    $('.stubic2').on("click",function(){
        var klasa = $(this).attr("class");
        var ri=klasa.substring(8);
        
        var tabela=$(this).parent().parent().next('table');
        var tabelaID = $(tabela).attr('id');
       
       
        $('#'+ tabelaID + ' .klasa').not('.klasa.'+ri).hide();
        $('#'+ tabelaID + ' .klasa.'+ri).toggle();
        
        hideHeader('#'+ tabelaID);
    });
    
});
function hideHeader(tabelaID){
  var ima = false;
   $(tabelaID + ' > tbody  > tr').each(function() {
    if($(this).is(':visible')) ima=true;
   });
   if(!ima) {
    $(tabelaID + ' > thead  > tr').each(function(){
        $(this).hide();
       });
   }
   else {
    $(tabelaID + ' > thead  > tr').each(function(){
        $(this).show();
       });
   }
}
</script>
{/literal}

<style>
.graph{
    width:90%;
    height:200px;
    margin-left:10%;
    padding-left:20px;
    border-left:4px solid #5f95c9;
    border-bottom:4px solid #5f95c9;
    position:relative;
    margin-bottom:40px;
    box-shadow: -1px 1px 2px #DADADA;

}

.grafikon{
    margin-top:60px;
    padding-right:30px;
}
.test{
    font-size:1.8em;
    margin:20px;
    height:40px;
    line-height:1.2em;
    margin-bottom:30px;
    cursor:pointer;
}
.stubic-holder{
    float:left;
    cursor:pointer;
    width:7%;
    margin-left:3%;
    height:100%;
    bottom:-30px;
    position:relative;
}
.stubic-holder2{
    
    cursor:pointer;
    height:30px;
    margin-top:10px;
    left:-50px;
    position:relative;
}
.stubic-procenat{
    width:100%;
    font-size:1.3em;
    text-align:center;
    position:absolute;
    top:-30px;
}
.stubic-procenat2{
    height:30px;
    font-size:1.3em;
    text-align:left;
    position:absolute;
    right:-50px;
}
.stubic-text{
    width:100%;
    font-family:astroregular;
    font-size:30px;
    text-align:center;
    position:absolute;
    bottom:-48px;
}
.stubic-text2{
    width:40px;
    font-family:astroregular;
    font-size:30px;
    text-align:left;
    position:absolute;
    left:-10px;
}
.srednjaLinija{
    border-top:3px dashed red;
    background:transparent;
    height:0px;
    width:100%;
    position:absolute;
    top:50%;
    text-indent:-45px;
    left:0;
}
.linija{
    border-bottom:1px dashed #DDD;
    background:transparent;
    height:0px;
    width:100%;
    position:absolute;
    text-indent:-45px;
    left:0;
    z-index:1;
}
.linija.linija0{
        top:100%;
}
.linija.linija10{
        top:90%;
}
.linija.linija20{
        top:80%;
}
.linija.linija30{
        top:70%;
}
.linija.linija40{
        top:60%;
}
.linija.linija50{
        top:50%;
        
}
.linija.linija30.Yin{
    border-bottom:3px dashed red;
    }
.linija.linija70.Yang{
    border-bottom:3px dashed red !important;
    }    
.linija.linija60{
        top:40%;
}
.linija.linija70{
        top:30%;
}
.linija.linija80{
        top:20%;
}
.linija.linija90{
        top:10%;
}
.linija.linija100{
        top:0%;
}
.posto0,.posto1,.posto2,.posto3,.posto4,.posto5,.posto6,.posto7,.posto8,.posto9,.posto10{
    position:relative;
    top:-10px;
    cursor:pointer;
}
.srednjaLinija2{
    border-left:3px dashed red;
    background:transparent;
    height:430px;
    width:0%;
    position:absolute;
    left:calc(50% - 10px);
    text-indent:-15px;
    top:-20px;
}
.linija2{
    border-left:1px dashed #DDD;
    background:transparent;
    height:430px;
    width:0%;
    position:absolute;
    
    text-indent:-15px;
    top:-20px;
}

.linija2.linija0{
      left:calc(0% - 10px);
}
.linija2.linija10{
      left:calc(10% - 10px);
}
.linija2.linija20{
      left:calc(20% - 10px);
}
.linija2.linija30{
    left:calc(30% - 10px);
}
.linija2.linija40{
   left:calc(40% - 10px);
}
.linija2.linija50{
        left:calc(50% - 10px);
}
.linija2.linija30.Yin{
    border-left:3px dashed red;
    }
.linija2.linija70.Yang{
    border-left:3px dashed red;
    } 
.linija2.linija60{
        left:calc(60% - 10px);
}
.linija2.linija70{
        left:calc(70% - 10px);
}
.linija2.linija80{
       left:calc(80% - 10px);
}
.linija2.linija90{
       left:calc(90% - 10px);
}
.linija2.linija100{
        left:calc(100% - 10px);
}

.stubic{
    width:100%;
    position:absolute;
    bottom:30px;
    left:0;
    box-shadow: 0px 0px 2px #DADADA;
    z-index:33;
}
.stubic2{
    height:30px;
    position:absolute;
    left:30px;
    top:0;
    box-shadow: 0px 0px 2px #DADADA;
}
</style>