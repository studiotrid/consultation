<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<link href='https://fonts.googleapis.com/css?family=Bitter&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<style>
h3,h2,h1,h4{
    font-family:'Bitter', serif;
}
h1{
    font-size:40px !important
    }
li h3{
    font-size:20px;
}
li{
    box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	border: 1px solid #257C9E;
    margin:20px 10px;
    padding:10px 20px;
    
}
ul
{
    list-style-type: none;
    margin-left:0;
    padding-left:0;
    
}
.cilj-block{
  border: 1px solid #257C9E;
  margin:20px 10px;
  padding:15px;
  background:#f8f8f8;
}
.cilj-block textarea{
  width:100%;
  min-height:160px;
  box-sizing:border-box;
}
/* White background for dialog content */
.ui-dialog .ui-dialog-content,
.ui-dialog .ui-dialog-content.ui-widget-content {
  background-color: #ffffff !important;
  background-image: none !important;
}
.ui-dialog-content,
.ui-dialog-content.ui-widget-content {
  background-color: #ffffff !important;
  background-image: none !important;
}
</style>
</head>
<body>

<div data-role="page">
  <div data-role="header">
    <h1>Test {if isset($test.ime)}- {$test.ime}{/if}</h1>
  </div>
  {if isset($savedCount) || isset($smarty.post.testID)}
      <div data-role="main" class="ui-content">
          <h2>{t}The answers are saved.{/t}</h2>
          {if isset($savedCount)}<p>{t}Saved answers:{/t} {$savedCount}</p>{/if}
          <p><button onclick="parent.$('.ui-dialog-content').dialog('close');">{t}Close{/t}</button></p>
          <script>
            try {
              if (parent && parent.$) {
                parent.$('.ui-dialog-content').dialog('close');
              }
              if (parent && parent.location) {
                parent.location.reload();
              }
            } catch (e) {
              console && console.warn && console.warn('Close/reload failed', e);
            }
          </script>
      </div>
  {elseif isset($test.noPlantesOnlyGoal) && $test.noPlantesOnlyGoal}
      {* Only goal form - no planets *}
      <div data-role="main" class="ui-content">
        <form method="post" action="testPolaganje.php?konsultacija={$test.konsultacija}" data-ajax="false">
        <input type="hidden" name="testID" value="{$test.ID}"/>
        <input type="hidden" name="konsultacija" value="{$test.konsultacija}"/>
        <div class="cilj-block">
            <h3>{t}Test cilja{/t}</h3>
            <p>{t}Ovde možete napisati 3 do 5 primarnih problema na kojima bi ste želeli da radite.{/t}</p>
            <p>{t}Objasnite ih u par rečenica i poređajte ih po prioritetu tako da na prvom mestu bude najakutniji problem (bez obzira da li je na mentalnom, emotivnom, fizičkom ili spiritualnom planu).{/t}</p>
            <p>{t}Možete objasniti šta bi za vas bilo rešenje toga, ukoliko ga vidite, ili šta je to što Vam onemogućava rešenje.{/t}</p>
            <textarea name="cilj_odgovor" id="cilj_odgovor">{$testCilj.answer|escape}</textarea>
        </div>
        <input type="submit" data-inline="true" value="{t}Submit{/t}">
        </form>
      </div>
  {else}
      {if isset($pitanja) && count($pitanja) > 0}
      <div data-role="main" class="ui-content">
        <form method="post" action="testPolaganje.php?konsultacija={$test.konsultacija}" data-ajax="false">
        <input type="hidden" name="testID" value="{$test.ID}"/>
        <input type="hidden" name="konsultacija" value="{$test.konsultacija}"/>
        {if isset($test.cilj) && $test.cilj > 0}
          <div class="cilj-block">
            <h3>Test cilja</h3>
            <p>Ovde možete napisati 3 do 5 primarnih problema na kojima bi ste želeli da radite.</p>
            <p>Objasnite ih u par rečenica i poređajte ih po prioritetu tako da na prvom mestu bude najakutniji problem (bez obzira da li je na mentalnom, emotivnom, fizičkom ili spiritualnom planu).</p>
            <p>Možete objasniti šta bi za vas bilo rešenje toga, ukoliko ga vidite, ili šta je to što Vam onemogućava rešenje.</p>
            <textarea name="cilj_odgovor" id="cilj_odgovor">{$testCilj.answer|escape}</textarea>
          </div>
        {/if}
          <p style="text-align:center;font-weight:bold;font-size:1.2em">{if $test.tip eq 'yin'}{t}On a scale from 0 to 10 highlight those answers which now represent your needs and desires.{/t}{else}{t}On a scale from 0 to 10 highlight those answers that are for you now correct or accurate in most cases.{/t}{/if}</p>
        <ul>
        {foreach from=$pitanja item=pitanje name=broj}
           
          <li><h3> {$smarty.foreach.broj.iteration}. {t}{$pitanje.pitanje}{/t}</h3>
          <label for="odgovor{$pitanje.ID}">{t}Points:{/t}</label>
          <input type="range" name="odgovori[{$pitanje.ID}]" id="odgovor{$pitanje.ID}" value="5" min="0" max="10" data-highlight="true" data-popup-enabled="true">
          </li>
         {/foreach} 
        </ul>  
          <input type="submit" data-inline="true" value="{t}Submit{/t}">

        </form>
      </div>
      {else}
      <div data-role="main" class="ui-content">
          <h2>No questions available</h2>
          <p>Debug: pitanja variable is {if isset($pitanja)}set{else}NOT set{/if}</p>
      </div>
      {/if}
  {/if}
</div>

</body>
</html>