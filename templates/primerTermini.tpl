<div id="dragonispit-form" title="{if $ulogovankorisnik.lang eq 1}Kvalitet položenog ispita{else}The quality of the exam you passed{/if}">
    <form method="POST" action="?upisdragonispita=1">
        <input type="hidden" name="ispitID" id="ispitID" value="{$prikaziDragonTest.id}"/>
        
        <h4>{if $ulogovankorisnik.lang eq 1}Kvalitet položenog ispita za aktiviranje{else}The quality of the exam you passed for the activation of the{/if} {$prikaziDragonTest.centar}. {if $ulogovankorisnik.lang eq 1}({$prikaziDragonTest.planeta}) čakre, intenziteta{else}({$prikaziDragonTest.planetaen}) chakra, intensity {/if} {$prikaziDragonTest.intenzitet}, {$prikaziDragonTest.datum|date_format:"%A, %d.%m.%Y"}</h4>
        {if $prikaziDragonTest.test eq 3}
            1.	{if $ulogovankorisnik.lang eq 1}Navedite akcije koje ste danas napravili, a koje prevazilaze vaše lične potrebe u užem smislu i podržavaju kolektiv ili nešto od opšteg značaja!{else}List the activities you undertook today, which transcend your personal needs in a narrow sense and support the society or something of general importance!{/if}<br />
        {else if $prikaziDragonTest.test eq 2}
            1.	{if $ulogovankorisnik.lang eq 1}Koje ste svoje talente danas otkrili?{else}Which talents did you discover today?{/if}<br />
        {else if $prikaziDragonTest.test eq 4}
            1.	{if $ulogovankorisnik.lang eq 1}U kojoj meri ste danas vidoviti ili ste u stanju da “downloadujete” informacije iz Višeg Izvora Svesti?{else}To what extent are you psychic today or able to ’download’ information from the Higher Self? {/if}<br />
        {else}
            1.	{if $ulogovankorisnik.lang eq 1}Kako ste se osećali u ovom periodu?{else}How did you feel during this time period?{/if}<br />
        {/if}

        
            <label class="radiocheck"><input type="radio" name="odgovor1" value="0"/> {if $ulogovankorisnik.lang eq 1}loše{else}poor{/if}</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="1"/> 1</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="2"/> 2</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="3"/> 3</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="4"/> 4</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="5" checked=""/> 5</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="6"/> 6</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="7"/> 7</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="8"/> 8</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="9"/> 9</label>
            <label class="radiocheck"><input type="radio" name="odgovor1" value="10"/> {if $ulogovankorisnik.lang eq 1}savršeno{else}perfect{/if}</label>
            
            <textarea name="odgovor1text" ></textarea>
        
        {if $prikaziDragonTest.test eq 3}
            2.	{if $ulogovankorisnik.lang eq 1}Navedite sinhronicitet koji ste prepoznali u odnosima sa drugim ljudima ili situacijama?{else}List a synchronicity which you recognized in relationships with other people or situations?{/if}<br />
        {else if $prikaziDragonTest.test eq 2}
            2.	{if $ulogovankorisnik.lang eq 1}Šta ste na nivou odnosa uspeli da postignete ili koje su nove veze koje ste danas uspeli da ostvarite?{else}What did you manage to achieve in your relationships? What new relationships did you manage to form today? {/if}<br />
        {else if $prikaziDragonTest.test eq 4}
            2.	{if $ulogovankorisnik.lang eq 1}Da li danas umete da “plešete” sa Srodnom Dušom?{else}Could you ’dance’ with your Soulmate today?{/if}<br />
        {else}
            2.	{if $ulogovankorisnik.lang eq 1}Kako ste se objektivno ponašali, odnosno reagovali?{else}What was the objective nature of your behaviour or your reactions?{/if}<br />
        {/if}
            <label class="radiocheck"><input type="radio" name="odgovor2" value="0"/> {if $ulogovankorisnik.lang eq 1}loše{else}poor{/if}</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="1"/> 1</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="2"/> 2</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="3"/> 3</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="4"/> 4</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="5" checked=""/> 5</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="6"/> 6</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="7"/> 7</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="8"/> 8</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="9"/> 9</label>
            <label class="radiocheck"><input type="radio" name="odgovor2" value="10"/> {if $ulogovankorisnik.lang eq 1}savršeno{else}perfect{/if}</label>
            <textarea name="odgovor2text" ></textarea>
       
       {if $prikaziDragonTest.test eq 3}
            3.	{if $ulogovankorisnik.lang eq 1}Da li ste prepoznali da svi ljudi i okolnosti danas rade za vaše najviše dobro, odnosno da vas podržavaju na putu vaše Svrhe?{else}Have you recognized that all people and circumstances work for your greatest good, and that they support you on your journey to your Purpose?{/if}<br />
        {else if $prikaziDragonTest.test eq 2}
            3.	{if $ulogovankorisnik.lang eq 1}Koje ste stvari danas uspeli da materijalizujete sa najmanje napora?{else}Which things did you manage to materialize today with least effort?{/if}<br />
        {else if $prikaziDragonTest.test eq 4}
            3.	{if $ulogovankorisnik.lang eq 1}U kojoj meri se Vašim prisustvom sve stvari iz određenog stanja entropije spontano dovode u stanje “reda” i “super reda”?{else}To what extent does your presence help all things spontaneously transform from a certain state of entropy to a state of ’order’ or ’super order’? {/if}<br />
        {else}
            3.	{if $ulogovankorisnik.lang eq 1}Kakve su bile realne okolnosti kroz događaje ili ljude koje ste sretali?{else}What was the real nature of the circumstances today, regarding the events that happened or the people you encountered?{/if}<br />
        {/if}

            <label class="radiocheck"><input type="radio" name="odgovor3" value="0"/> {if $ulogovankorisnik.lang eq 1}loše{else}poor{/if}</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="1"/> 1</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="2"/> 2</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="3"/> 3</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="4"/> 4</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="5" checked=""/> 5</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="6"/> 6</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="7"/> 7</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="8"/> 8</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="9"/> 9</label>
            <label class="radiocheck"><input type="radio" name="odgovor3" value="10"/> {if $ulogovankorisnik.lang eq 1}savršeno{else}perfect{/if}</label>
            <textarea name="odgovor3text" ></textarea>
        
               <p class="clearfix" style="clear:both;">
              <button class="btn btn-large btn-warning" type="submit">{if $ulogovankorisnik.lang eq 1}Snimi{else}Save{/if}</button>
              <button class="btn btn-large" type="button" onclick="$('#dragonispit-form').dialog('close');">{if $ulogovankorisnik.lang eq 1}Odustani{else}Cancel{/if}</button>
              </p>
    </form>
</div>

{literal}
<style>
.radiocheck{
   display:inline-block;
   width:20px;
   text-align:center;
    margin:0 16px;
}
label{
    font-weight:bold;
}
textarea{
    height:90px !important;
}
input[type='range']{
    width:100%;
}
input[type='range']:focus{
    outline: none;
}
div.datalist {
    width:100%;
    height:20px;
    clear:both;
}

div.datalist div{
    float:left;
    text-align:right;
    width:50%;
    font-weight:normal;
}
div.datalist div:first-child{
    text-align:left;
}
</style>

<script>

$( "#dragonispit-form" ).dialog({
			autoOpen: false,
			width: 680,
			modal: true
		});
 {/literal}       
 
{if isset($prikaziDragonTest)}	$( "#dragonispit-form" ).dialog( "open" );	{/if}
</script>
