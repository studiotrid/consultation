
{* Ovo je za prikaz dodeljenog testa *}
{if isset($modultest) && is_array($modultest)}

{if count($modultest)>0 }
    {foreach from=$modultest item=test}
        <div class="testModul ikona" id="testDugme{$test.id}" title="{t}Click to make test{/t}"><span>{t}SHOW TEST{/t}</span></div>
        {include file="testForm.tpl"}
    
    <script type="text/javascript">
        $(document).ready(function(){ 
            $('#testDugme{$test.id}').on('click', function(){
                $('#ispit-form{$test.id}').dialog({
                    modal: true,
                    width: 600,
                    height: 700
                });
            });

        });
    </script>
     {/foreach}
{/if}
{/if}


{* Ovo je za prikaz urađenih testova *}
{if isset($modultestTest) && count($modultestTest)>0}
<div class="testModultest ikona" title="{t}Click to view test results{/t}"><span>{t}TEST RESULTS{/t}</span></div>
{if count($modultestTest)>0 }
    {foreach from=$modultestTest item=graf}
        <div class="testGrafikoni dn">
            <h3>{t}Test taken on{/t} {$graf.datum|date_format:"%d.%m.%Y"} {t}at{/t} {$graf.vreme|date_format:"%H:%M"}</h3>
            <div class="testGrafikonContainer " id="testGrafikonContainer{$graf.broj}">
                {include file="testGraf-full.tpl"} 
            </div>
        </div>
    {/foreach}
{/if}
<script type="text/javascript">
    $(document).ready(function(){
        $('.testModultest').on('click', function(){
            $('.testGrafikoni').toggleClass('dn');
            });

    });
</script>

{/if}