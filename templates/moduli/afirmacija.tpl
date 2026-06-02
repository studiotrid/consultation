{if isset($modulafirmacija) && count($modulafirmacija)>0}
<div class="afirmacijaModul ikona" data-afirmacija="afirm_{$modulafirmacija.id}" data-afirmacije='{$modulafirmacija.afirmacija|@json_encode}' title="{t}Click to view affirmation{/t}"><span>{t}AFFIRMATIONS{/t}</span></div>
{/if}
