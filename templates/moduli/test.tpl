{if isset($modultest) && $modultest neq ''}
<div class="testModul ikona" data-test="{$modultest}" title="{t}Click to make test{/t}"><span>{t}SHOW TEST{/t}</span></div>
{/if}

{if isset($modultestTest) && $modultestTest neq ''}
<div class="testModultest ikona" data-test="{$modultest}" title="{t}Click to view test{/t}"><span>{t}TEST RESULTS{/t}</span></div>
{/if}
