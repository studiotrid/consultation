{if isset($modulsenka) && isset($modulsenka.naslov)}
<div class="senkaModul ikona"
	 data-faza="{$modulsenka.faza}"
	 data-naslov="{$modulsenka.naslov|escape:'html'}"
	 data-zivotinja="{$modulsenka.zivotinja|escape:'html'}"
	 data-ritual="{$modulsenka.ritual|escape:'html'}"
	 data-prikazi-ritual="{$modulsenka.prikazi_ritual}"
	 title="{$modulsenka.title|escape:'html'}">
	<img src="/img/senka-.png" alt="Senka" />
	<span>SENKA</span>
</div>
{/if}
