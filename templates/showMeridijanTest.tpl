<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<link href='https://fonts.googleapis.com/css?family=Bitter&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
html, body {
    background-color: #ffffff !important;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}
body{
    color: #000;
}
h3,h2,h1,h4{
    font-family:'Bitter', serif;
    color: #000;
}
h1{
    font-size:40px !important;
    color: #000;
    }
li h3{
    font-size:20px;
    color: #000;
}
li{
    box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	border: 1px solid #257C9E;
    margin:20px 10px;
    padding:10px 20px;
    background: white;
    
}
ul
{
    list-style-type: none;
    margin-left:0;
    padding-left:0;
    
}
</style>
</head>
<body style="background-color: #ffffff !important;">

<div data-role="page" style="background-color: #ffffff !important;">
  <div data-role="header" style="background-color: #f5f5f5 !important;">
    <h1 style="color: #333;">Test {if isset($test)}- {$test.ime}{/if}</h1>
  </div>
  {if isset($smarty.post.testID)}
      <div data-role="main" class="ui-content" style="background-color: #ffffff !important; padding: 20px;">
          <h2 style="color: #333;">Odgovori su snimljeni.</h2>
          <p style="color: #333;">Prozor će se automatski zatvoriti...</p>
          <script type="text/javascript">
              setTimeout(function(){
                  if(window.parent && window.parent.location){
                      window.parent.location.reload();
                  } else {
                      window.close();
                  }
              }, 2000);
          </script>
      </div>
  {else}
{if isset($pitanja)}
    <div data-role="main" class="ui-content" style="background-color: #ffffff !important; padding: 20px;">
        <form method="post" action="{$basepath}meridijanTestPolaganje.php" data-ajax="false">
    <input type="hidden" name="testID" value="{$test.id}"/>
    

      <p style="text-align:center;font-weight:bold;font-size:1.2em;color:#333;">Označite na skali od 0 do 10 one odgovore koji su za vas trenutno tačni ili su tačni u najvećem broju slučajeva.</p>
      
      
        <ul>
    {foreach from=$pitanja item=pitanje name=broj}
       
      <li>
        <h3>{$smarty.foreach.broj.iteration}. {$pitanje.tekst}</h3>
        <div class="meridijan-range-row">
            <input type="range" name="odgovori[{$pitanje.id}]" id="odgovor{$pitanje.id}" value="5" min="0" max="10" class="meridijan-range" data-pitanje-id="{$pitanje.id}" />
            <span class="meridijan-range-value" id="value_{$pitanje.id}">5</span>
        </div>
        <div class="meridijan-range-captions">
            <span>0</span>
            <span>10</span>
        </div>
      </li>
     {/foreach} 
    </ul>  
      <button type="submit" class="btn btn-large btn-primary meridijan-submit" data-inline="true">{t}Snimi{/t}</button>
    </form>
  </div>
  {else}
  <div data-role="main" class="ui-content">
      <div style="width:50%;margin:60px auto">
          <form method="post" action="korisnikMeridijanTest.php">
            <label>Unesite broj testa:<br />
            <input type="text" name="test"/>
            </label><br />
            <input type="submit" name="submit" value="Pokreni"/>
          </form>
      </div>
  </div>
  {/if}
  {/if}
</div>

<style>
.radiocheck{
   display:inline-block;
   width:20px;
   text-align:center;
    margin:0 16px;
}

.radiocheck input{
    width:22px;
    height:22px;
}

.meridijan-range-row {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 10px 0;
}

.meridijan-range {
    flex: 1;
    height: 8px;
    -webkit-appearance: none;
    appearance: none;
    background: linear-gradient(to right, #ddd 0%, #257C9E 100%);
    outline: none;
    border-radius: 5px;
}

.meridijan-range::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #257C9E;
    cursor: pointer;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.meridijan-range::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #257C9E;
    cursor: pointer;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    border: none;
}

.meridijan-range-value {
    min-width: 30px;
    text-align: center;
    font-weight: bold;
    font-size: 1.3em;
    color: #257C9E;
}

.meridijan-range-captions {
    display: flex;
    justify-content: space-between;
    font-size: 0.9em;
    color: #666;
    margin-top: 5px;
}

.btn.meridijan-submit {
    background-color: #f0ad4e;
    color: white;
    border: none;
    padding: 12px 30px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    margin: 20px auto;
    display: block;
    transition: background-color 0.3s;
}

.btn.meridijan-submit:hover {
    background-color: #ec971f;
}

.btn.meridijan-submit:active {
    background-color: #d58512;
}

</style>

<script type="text/javascript">
$(document).ready(function(){
    // Update range value display (works with jQuery Mobile)
    $(document).on('input change', '.meridijan-range', function(){
        var val = $(this).val();
        var pitanjeId = $(this).data('pitanje-id');
        $('#value_' + pitanjeId).text(val);
    });
});
</script>

</body>
</html>