<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  } );
  </script>
  <h2>{t}Testovi{/t}</h2>
<div id="accordion" class="modulHolder">
{foreach from=$nevezaniTestovi item=jednaKonsultacija name=mdo}

        {foreach from=$jednaKonsultacija item=moduls name=mco}
            {if $smarty.foreach.mco.first}
                <h3>
                    {if isset($moduls.tipTekst) && isset($moduls.planeta)}
                        {$moduls.tipTekst} {$moduls.planeta} - 
                    {/if}
                    {$moduls.datum|date_format:$date_format}
                </h3>
                <div>
            {else}
                {$moduls}
            {/if}
        {/foreach}
        </div>

{/foreach}
</div>