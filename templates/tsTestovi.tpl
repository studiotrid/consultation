{if isset($sviTest)}
<div style="width:100%;text-align:center;{if $ts_korisnik eq 1}display:none;{/if}"><button id="ts_button" class="btn btn-lg btn-danger">Prikaži testove Tehnologije svesti</button></div>
    <div style="width:100%" class="ts_box {if $ts_korisnik eq 0}dn{/if}">
        {foreach from=$sviTest item=tsTest name=dddd}
            <div class="tsTest">
                <h3>Tehnologija svesti - {$tsTest.nazivPlanete}</h3>
                <div class="predtest"><h2>Pred test</h2>{include file="tsTestGraf.tpl"}</div>
                <div class="posttest"><h2>Post test</h2>{include file="tsPostTestGraf.tpl"}</div>
                <div class="odmor"><h2 >Odmor</h2><span>{if isset($tsTest.odmor) && $tsTest.odmor !=0}{$tsTest.odmor}{else}{/if}</span></div>
                <div class="odgovori">
                {if $tsTest.post.odgovori.odgovor1 neq Null && $tsTest.post.odgovori.odgovor1 neq 0}
                <h2>Odgovori:</h2>
                <p>Koliko ste praktikovali vežbu za balansiranje izazovnog odnosa u proteklih mesec dana?<br />
                <strong>{$tsTest.post.odgovori.odgovor1}</strong></p>
                
                <p>Opišite uvide koje ste imali praktikujući datu vežbu.<br />
                <strong>{$tsTest.post.odgovori.odgovor3}</strong></p>
                
                <p>Na kom životnom planu ste primetili najviše promena? Opišite na koji način ste uspeli da transformišete određeni izazovni odnos?<br />
                <strong>{$tsTest.post.odgovori.odgovor4}</strong></p>
                {/if}
                </div>
            </div>
        {/foreach}
    </div>
{/if}

{literal}
<script>
$(document).ready(function(){
    $('#ts_button').on("click",function(e){
        $('.ts_box').toggleClass('dn');
    });
  
});

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

.grafikonTS{
    margin-top:60px;
    padding-right:30px;
}
.testTS{
    font-size:1.8em;
    margin:20px;
    height:40px;
    line-height:1.2em;
    margin-bottom:30px;
    cursor:pointer;
}
.stubicTS-holder{
    float:left;
    cursor:pointer;
    width:7%;
    margin-left:3%;
    height:100%;
    bottom:-30px;
    position:relative;
}
.stubicTS-holder2{
    
    cursor:pointer;
    height:30px;
    margin-top:10px;
    left:-50px;
    position:relative;
}
.stubicTS-procenat{
    width:100%;
    font-size:1.3em;
    text-align:center;
    position:absolute;
    top:-30px;
}
.stubicTS-procenat2{
    height:30px;
    font-size:1.3em;
    text-align:left;
    position:absolute;
    right:-50px;
}
.stubicTS-text{
    width:100%;
    font-family:astroregular;
    font-size:30px;
    text-align:center;
    position:absolute;
    bottom:-30px;
}
.stubicTS-text2{
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

.predtest,.posttest{
    display:inline-block;
    width:40%;
}
div.predtest{
    border-right:4px solid red;
    margin-right:1%;
    padding-right:1%;
}
.odmor{
    display:inline-block;
    width:8%;
    font-size:20em;
    color:red;
}
.tsTest{
    position:relative;
    padding-bottom:20px;
    margin-bottom:20px;
    border-bottom:4px solid red;
   
}
.tsTest h3{
    text-align:center;
    font-size:50px;
    margin-top:30px;
    margin-bottom:30px;
}
.odmor span{
    position:absolute;
    right:20px;
    bottom:270px;
}
.odmor h2,.predtest h2,.posttest h2{
    color:red;
    line-height:1em;
    font-weight:bold;
}
#ts_button{
    padding:20px;
    font-size:17px;
    margin:0 auto;
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
    bottom:-30px;
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