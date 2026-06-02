
{* Template for displaying test results - shown after all module icons *}
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
            
            // Scroll to the test results
            if(!$('.testGrafikoni').hasClass('dn')) {
                $('html, body').animate({
                    scrollTop: $('.testGrafikoni').offset().top - 100
                }, 500);
            }
        });
    });
</script>

{/if}
