{if isset($buduceTipKonsultacije) && $buduceTipKonsultacije|@count gt 0}
    <h2>{t}{$nazivTipa}{/t}</h2>
    <div class="upcomingConsultations text-start" style="margin-bottom:20px;">
        <h4 class="mb-2">{t}Upcoming consultations{/t}</h4>
        <ul class="list-unstyled mb-0">
        {foreach from=$buduceTipKonsultacije item=upcoming}
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
{elseif !isset($buduceTipKonsultacije) || $buduceTipKonsultacije|@count == 0}
    <h2>{t}{$nazivTipa}{/t}</h2>
   
    <p><img class="levo" src="https://coach.profesionalnaastrologija.com/upload/image/{$svesKonsultacije.slika}" alt="{$nazivTipa}"/> {$svesKonsultacije.opis}</p>
    <div style="clear:both;"><hr /></div>
    
    <form class="napomena">
    <input type="hidden" name="tip" id="tip" value="{$smarty.get.tip}"/>
    {if isset($termini) && $termini|count gt 100000000}
    <h3>{t}If you would like to schedule this consultation, please select an appointment below:{/t}</h3>
    <label>{t}Available appointments{/t}
        <select name="termin" class="form-control">
            {foreach from=$termini item=$termin}
                <option value="{$termin.id}">{$termin.datum|date_format:$date_format} {t}in{/t} {$termin.datum|date_format:"%H:%M"}</option>
            {/foreach}
        </select>
        </label>
        <button type="submit" class="btn btn-lg gradient-border">{t}Sign In{/t}</button>
        {else}
        <input type="hidden" name="inform" id="inform" value="1"/>
        <h3>{t}There is no available appointments defined at the moment{/t}</h3>
        <p>{t}If you want you may inform your Coach that you are interested in this consultation{/t}</p>
        <button type="submit" class="btn btn-lg gradient-border">{t}Inform Coach{/t}</button>
     {/if}
    </form>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('form.napomena').on('submit', function(evt){
                evt.preventDefault();
                
                var $form = $(this);
                var $submitBtn = $form.find('button[type="submit"]');
                var termin = $form.find('select[name="termin"]').val();
                var tip = $form.find('input[name="tip"]').val();
                var inform = $form.find('input[name="inform"]').val();
                
                $submitBtn.prop('disabled', true);
                
                // Ako je "Inform Coach" (nema termina)
                if(inform == '1'){
                    $.ajax({
                        url: '/appointment.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'inform',
                            tip: tip
                        },
                        success: function(resp){
                            if(resp && resp.status === 'ok'){
                                alert('{t}Coach has been notified{/t}');
                                window.location.reload();
                            } else {
                                var msg = (resp && resp.message) ? resp.message : '{t}An error occurred{/t}';
                                alert(msg);
                            }
                        },
                        error: function(){
                            alert('{t}An error occurred{/t}');
                        },
                        complete: function(){
                            $submitBtn.prop('disabled', false);
                        }
                    });
                }
                // Ako je "Sign In" (sa terminom)
                else if(termin) {
                    $.ajax({
                        url: '/appointment.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'reserve',
                            termin: termin,
                            tip: tip
                        },
                        success: function(resp){
                            if(resp && resp.status === 'ok'){
                                alert('{t}You have successfully scheduled your consultation{/t}');
                                window.location.reload();
                            } else {
                                var msg = (resp && resp.message) ? resp.message : '{t}An error occurred{/t}';
                                alert(msg);
                            }
                        },
                        error: function(){
                            alert('{t}An error occurred{/t}');
                        },
                        complete: function(){
                            $submitBtn.prop('disabled', false);
                        }
                    });
                }
            });
        });
    </script>
{/if}