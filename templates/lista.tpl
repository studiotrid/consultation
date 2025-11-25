{if !isset($svesKonsultacije.opis)}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  } );
  </script>
  <h2>{t}{$nazivTipa}{/t}</h2>
<div id="accordion" class="modulHolder">
{foreach from=$svesKonsultacije item=jednaKonsultacija name=mdo}

        {foreach from=$jednaKonsultacija item=moduls name=mco}
            {if $smarty.foreach.mco.first}
                <h3><strong>{t}{$moduls.naziv}{/t}</strong> / {$moduls.startTime|date_format:$date_format}</h3>
                <div>
            {else}
                {$moduls}
            {/if}
        {/foreach}
        </div>

{/foreach}
</div>
{else}
    <h2>{t}{$nazivTipa}{/t}</h2>
   
    <p><img class="levo" src="/img/{$svesKonsultacije.slika}" alt="{$nazivTipa}"/> {$svesKonsultacije.opis}</p>
    <div style="clear:both;"><hr /></div>
    
    <form class="napomena">
    <input type="hidden" name="tip" id="tip" value="{$smarty.get.tip}"/>
    {if isset($termini) && $termini|count gt 0}
    <h3>{t}If you would like to schedule this consultation, please select an appointment below:{/t}</h3>
    <label>{t}Available appointments{/t}
        <select name="termin" class="form-control">
            {foreach from=$termini item=$termin}
                <option value="{$termin.id}">{$termin.datum|date_format:$date_format} {t}in{/t} {$termin.datum|date_format:"%H:%I"}</option>
            {/foreach}
        </select>
        </label>
        <button type="submit" class="btn btn-lg btn-danger">{t}Sign In{/t}</button>
        {else}
        <input type="hidden" name="inform" id="inform" value="1"/>
        <h3>{t}There is no available appointments defined at the moment{/t}</h3>
        <p>{t}If you want you may inform your Couch that you interested in this consultation{/t}</p>
        <button type="submit" class="btn btn-lg btn-danger">{t}Inform Coach{/t}</button>
     {/if}
    </form>
{/if}
