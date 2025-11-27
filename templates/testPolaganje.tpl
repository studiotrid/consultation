<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<link href='https://fonts.googleapis.com/css?family=Bitter&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
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
</style>
</head>
<body>

<div data-role="page">
  <div data-role="header">
    <h1>Test {if isset($test)}- {$test.ime}{/if}</h1>
  </div>
  {if isset($smarty.post.testID)}
      <h2>{t}The answers are saved.{/t}</h2>
  {else}
{if isset($pitanja)}
  <div data-role="main" class="ui-content">
    <form method="post" action="#">
    <input type="hidden" name="testID" value="{$test.ID}"/>
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
  {/if}
</div>

</body>
</html>