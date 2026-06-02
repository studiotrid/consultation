
{* Ovo je za prikaz dodeljenog testa *}

{if isset($modultest) && is_array($modultest)}

{if count($modultest)>0 }
    <!-- DEBUG: Entering foreach loop -->
    {foreach from=$modultest item=test}
        <!-- DEBUG: Test item - id={$test.id}, konsultacija={$test.konsultacija} -->
        <div class="testModul ikona" id="testDugme{$test.id}" title="{t}Click to take test{/t}"><span>{t}TAKE TEST{/t}</span></div>
        <div id="testPolaganjeModal{$test.id}" style="display:none"></div>

    <script type="text/javascript">
        $(document).ready(function(){ 
            $('#testDugme{$test.id}').on('click', function(){
                // Use absolute path so it resolves outside @CMS routing
                // For standalone tests (konsultacija=0), pass testID parameter
                var src = '{$basepath}testPolaganje.php?konsultacija={$test.konsultacija}';
                {if $test.konsultacija == 0}
                src += '&testID={$test.id}';
                {/if}
                console.log('Opening test form:', src);
                
                var $modal = $('#testPolaganjeModal{$test.id}');
                $modal.html('<iframe src="'+src+'" style="border:none;width:100%;height:100%"></iframe>');
                $modal.dialog({
                    modal: true,
                    width: 700,
                    height: 800,
                    title: '{t}Take Test{/t}',
                    open: function() {
                        console.log('Dialog opened successfully');
                    }
                });
            });

        });
    </script>
     {/foreach}
{/if}
{/if}


{* Ovo je za prikaz urađenih testova - samo ikonica, grafikoni su na dnu *}
{if isset($modultestTest) && count($modultestTest)>0}
<div class="testModultest ikona" title="{t}Click to view test results{/t}"><span>{t}TEST RESULTS{/t}</span></div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.testModultest').on('click', function(){
            $('.testGrafikoni').toggleClass('dn');
            $(this).toggleClass('active');
            
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

{* TS (Tehnologija svesti) testovi *}
{if isset($modultestTS) && count($modultestTS)>0}
<div class="testModultestTS ikona" title="{t}Click to view Consciousness Technology tests{/t}"><span>{t}CT TESTS{/t}</span></div>
<div class="tsTestGrafikoni dn">
    {foreach from=$modultestTS item=tsTest name=tsLoop}
        <div class="ts-test-container">
            <h3 class="ts-test-title">{t}Consciousness Technology{/t} - <span class="ts-planeta-naziv">{$tsTest.nazivPlanete}</span></h3>
            
            <div class="ts-grafikoni-wrapper">
                {* Pre-test grafikon *}
                <div class="ts-grafikon-item">
                    {include file="moduli/tsTestGraf.tpl"}
                </div>
                
                {* Post-test grafikon *}
                {if isset($tsTest.post.id) && $tsTest.post.id neq ''}
                <div class="ts-grafikon-item">
                    {include file="moduli/tsPostTestGraf.tpl"}
                </div>
                {/if}
            </div>
        </div>
        {if !$smarty.foreach.tsLoop.last}
        <hr class="ts-test-separator" />
        {/if}
    {/foreach}
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.testModultestTS').on('click', function(){
            $('.tsTestGrafikoni').toggleClass('dn');
        });
    });
</script>

<style>
.ts-test-container {
    margin-bottom: 30px;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
}

.ts-test-title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 30px;
    color: #333;
}

.ts-planeta-naziv {
    color: #5f95c9;
    font-weight: bold;
}

.ts-grafikoni-wrapper {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.ts-grafikon-item {
    width: 100%;
}

.ts-test-subtitle {
    font-size: 18px;
    color: #5f95c9;
    margin-bottom: 15px;
    text-align: center;
}

.ts-graph {
    width: 90%;
    height: 400px;
    margin-left: 10%;
    padding-left: 20px;
    border-left: 4px solid #5f95c9;
    border-bottom: 4px solid #5f95c9;
    position: relative;
    margin-bottom: 20px;
    box-shadow: -1px 1px 2px #DADADA;
}

.ts-stubic-holder {
    cursor: pointer;
    height: 30px;
    margin-top: 10px;
    left: -50px;
    position: relative;
}

.ts-stubic {
    height: 30px;
    position: absolute;
    left: 30px;
    top: 0;
    box-shadow: 0px 0px 2px #DADADA;
}

.ts-stubic-text {
    width: 40px;
    font-family: astroregular, serif;
    font-size: 30px;
    text-align: left;
    position: absolute;
    left: -10px;
}

.ts-stubic-procenat {
    height: 30px;
    font-size: 1.3em;
    text-align: left;
    position: absolute;
    right: -50px;
}

.ts-odmor-box {
    text-align: center;
    margin: 20px 0;
    padding: 15px;
    background: #fff;
    border-radius: 5px;
    border: 2px solid #5f95c9;
}

.ts-odmor-vrednost {
    font-size: 24px;
    color: #d9534f;
    font-weight: bold;
}

.ts-odgovori-box {
    margin-top: 30px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.ts-odgovori-box h5 {
    color: #d9534f;
    margin-bottom: 15px;
}

.ts-odgovori-box p {
    margin-bottom: 15px;
    line-height: 1.6;
}

.ts-test-separator {
    margin: 40px 0;
    border: 0;
    border-top: 3px solid #d9534f;
}

.linija2 {
    border-left: 1px dashed #DDD;
    background: transparent;
    height: 430px;
    width: 0%;
    position: absolute;
    text-indent: -15px;
    top: -20px;
}

.linija2.linija0 { left: calc(0% - 10px); }
.linija2.linija10 { left: calc(10% - 10px); }
.linija2.linija20 { left: calc(20% - 10px); }
.linija2.linija30 { left: calc(30% - 10px); }
.linija2.linija40 { left: calc(40% - 10px); }
.linija2.linija50 { left: calc(50% - 10px); }
.linija2.linija60 { left: calc(60% - 10px); }
.linija2.linija70 { left: calc(70% - 10px); }
.linija2.linija80 { left: calc(80% - 10px); }
.linija2.linija90 { left: calc(90% - 10px); }
.linija2.linija100 { left: calc(100% - 10px); }

.posto0, .posto1, .posto2, .posto3, .posto4, .posto5, .posto6, .posto7, .posto8, .posto9, .posto10 {
    position: relative;
    top: -10px;
    cursor: pointer;
}

/* Responsive design */
@media (max-width: 768px) {
    .ts-graph {
        width: 95%;
        margin-left: 5%;
    }
    
    .ts-test-title {
        font-size: 18px;
    }
}
</style>

{/if}
