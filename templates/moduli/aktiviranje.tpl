{if isset($modulaktiviranje) && is_array($modulaktiviranje) && count($modulaktiviranje) > 0}
    <div class="aktiviranjeModul ikona" data-aktiviranje='{$modulaktiviranje|@json_encode}' title="{t}Click to view Activation schedule{/t}">
        <img src="/img/aktiviranje.png" alt="{t}Activation{/t}" />
        <span>{t}Activation{/t}</span>
    </div>
{/if}

{if isset($modulaktiviranjeTest) && is_array($modulaktiviranjeTest) && count($modulaktiviranjeTest) > 0}
    {foreach from=$modulaktiviranjeTest item=test}
        <div class="testModul ikona aktiviranjeTestModul" id="aktiviranjeTestDugme{$test.id}" title="{t}Click to take activation test{/t}">
            <img src="/img/test.png" alt="{t}Activation Test{/t}" />
            <span>{t}TAKE TEST{/t}</span>
        </div>
        <div id="aktiviranjeTestModal{$test.id}" class="aktiviranje-modal" style="display:none; background:#ffffff; color:#333333;">
            <div class="aktiviranje-inner" style="background:#ffffff; color:#333333; padding:10px;">
            <form id="aktiviranjeTestForm{$test.id}" method="POST">
                <input type="hidden" name="ispitID" value="{$test.id}" />
                <h4>{t}Activation test for{/t} {$test.planeta} {t}chakra{/t}, {t}intensity{/t} {$test.intenzitet}, {$test.datum|date_format:"%A, %d.%m.%Y"}</h4>

                {if $test.faza == 1}
                    {assign var=q1 value="{t}How did you feel during this time period?{/t}"}
                    {assign var=q2 value="{t}What was the objective nature of your behaviour or your reactions?{/t}"}
                    {assign var=q3 value="{t}What was the real nature of the circumstances today, regarding the events that happened or the people you encountered?{/t}"}
                {elseif $test.faza == 2}
                    {assign var=q1 value="{t}What is the degree of ease which you discovered within yourself today?{/t}"}
                    {assign var=q2 value="{t}What did you manage to achieve in your relationships? What new relationships did you manage to form today?{/t}"}
                    {assign var=q3 value="{t}Which things did you manage to materialize today with least effort?{/t}"}
                {elseif $test.faza == 3}
                    {assign var=q1 value="{t}List the activities you undertook today, which transcend your personal needs in a narrow sense and support the society or something of general importance!{/t}"}
                    {assign var=q2 value="{t}List a synchronicity which you recognized in relationships with other people or situations?{/t}"}
                    {assign var=q3 value="{t}Have you recognized that all people and circumstances work for your greatest good, and that they support you on your journey to your Purpose?{/t}"}
                {else}
                    {assign var=q1 value="{t}To what extent are you psychic today or able to download information from the Higher Self?{/t}"}
                    {assign var=q2 value="{t}Could you dance with your Soulmate today?{/t}"}
                    {assign var=q3 value="{t}To what extent does your presence help all things spontaneously transform from a certain state of entropy to a state of order or super order?{/t}"}
                {/if}

                <p class="activation-scale">{t}On a scale from 0 to 10, rate each answer.{/t}</p>

                <ol class="aktiviranje-questions">
                    <li>
                        <h5>1. {$q1}</h5>
                        <div class="aktiviranje-odgovori">
                            <div class="aktiviranje-range-row">
                                <input type="range" name="odgovor1" value="5" min="0" max="10" class="aktiviranje-range" />
                                <span class="aktiviranje-range-value" data-for="odgovor1">5</span>
                            </div>
                            <div class="aktiviranje-range-captions">
                                <span>{t}Poor{/t}</span>
                                <span>{t}Perfect{/t}</span>
                            </div>
                            <textarea name="odgovor1text"></textarea>
                        </div>
                    </li>
                    <li>
                        <h5>2. {$q2}</h5>
                        <div class="aktiviranje-odgovori">
                            <div class="aktiviranje-range-row">
                                <input type="range" name="odgovor2" value="5" min="0" max="10" class="aktiviranje-range" />
                                <span class="aktiviranje-range-value" data-for="odgovor2">5</span>
                            </div>
                            <div class="aktiviranje-range-captions">
                                <span>{t}Poor{/t}</span>
                                <span>{t}Perfect{/t}</span>
                            </div>
                            <textarea name="odgovor2text"></textarea>
                        </div>
                    </li>
                    <li>
                        <h5>3. {$q3}</h5>
                        <div class="aktiviranje-odgovori">
                            <div class="aktiviranje-range-row">
                                <input type="range" name="odgovor3" value="5" min="0" max="10" class="aktiviranje-range" />
                                <span class="aktiviranje-range-value" data-for="odgovor3">5</span>
                            </div>
                            <div class="aktiviranje-range-captions">
                                <span>{t}Poor{/t}</span>
                                <span>{t}Perfect{/t}</span>
                            </div>
                            <textarea name="odgovor3text"></textarea>
                        </div>
                    </li>
                </ol>

                <p class="clearfix" style="clear:both;">
                    <button class="btn btn-large aktiviranje-btn aktiviranje-btn-primary" type="submit">{t}Save{/t}</button>
                </p>
            </form>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#aktiviranjeTestDugme{$test.id}').on('click', function(){
                    $('#aktiviranjeTestModal{$test.id}').dialog({
                        modal: true,
                        width: 700,
                        height: 800,
                        title: '{t}Activation Test{/t}',
                        dialogClass: 'aktiviranje-dialog',
                        open: function(){
                            $(this).closest('.ui-dialog').css('background', '#ffffff');
                            $(this).closest('.ui-dialog').find('.ui-dialog-content').css('background', '#ffffff');
                        }
                    });
                });

                // Initialize slider value displays
                $('#aktiviranjeTestModal{$test.id} .aktiviranje-range').each(function(){
                    var name = $(this).attr('name');
                    $('#aktiviranjeTestModal{$test.id} .aktiviranje-range-value[data-for="' + name + '"]').text($(this).val());
                }).on('input change', function(){
                    var name = $(this).attr('name');
                    $('#aktiviranjeTestModal{$test.id} .aktiviranje-range-value[data-for="' + name + '"]').text($(this).val());
                });

                $('#aktiviranjeTestForm{$test.id}').on('submit', function(e){
                    e.preventDefault();
                    var $form = $(this);
                    $.ajax({
                        url: '/inc/ajax/save_aktiviranje_test.php',
                        method: 'POST',
                        data: $form.serialize(),
                        dataType: 'json'
                    }).done(function(resp){
                        if(resp && resp.success){
                            $('#aktiviranjeTestModal{$test.id}').dialog('close');
                            $('#aktiviranjeTestDugme{$test.id}').remove();
                            if (resp.uspehText !== undefined) {
                                $('.aktiviranje-uspeh[data-id="{$test.id}"]').html('<span style="color: #e2c197;">' + resp.uspehText + '</span>');
                            }
                        } else {
                            alert(resp && resp.error ? resp.error : '{t}Error saving test{/t}');
                        }
                    }).fail(function(){
                        alert('{t}Error saving test{/t}');
                    });
                });
            });
        </script>
    {/foreach}

    {literal}
    <style>
        .aktiviranje-modal{
            background: #ffffff;
        }
        .aktiviranje-dialog,
        .aktiviranje-dialog .ui-dialog-content,
        .aktiviranje-dialog .ui-widget-content{
            background: #ffffff !important;
        }
        .aktiviranje-dialog .ui-dialog-titlebar{
            background: #f5f5f5;
            border: 1px solid #ddd;
        }
        .aktiviranje-btn{
            min-width: 120px;
            margin-right: 10px;
        }
        .aktiviranje-questions{
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .aktiviranje-questions li{
            box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
            border: 1px solid #257C9E;
            margin: 20px 10px;
            padding: 10px 20px;
            background: #ffffff;
            color: #222;
        }
        .aktiviranje-questions h5{
            margin: 0 0 10px 0;
        }
        .activation-scale{
            text-align:center;
            font-weight:bold;
            font-size:1.05em;
        }
        .aktiviranje-range-row{
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .aktiviranje-range-captions{
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #666;
            margin-top: -4px;            margin-right: 35px;        }
        .aktiviranje-range-value{
            display: inline-block;
            min-width: 28px;
            text-align: center;
            background: #f7f0dc;
            color: #7a5a16;
            border: 1px solid #d3b26a;
            border-radius: 6px;
            padding: 2px 6px;
            font-weight: 700;
        }
        .aktiviranje-range{
            width: 100%;
            margin: 4px 0 10px 0;
            height: 10px;
            background: #f1e4c6;
            border-radius: 6px;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
        }
        .aktiviranje-range::-webkit-slider-thumb{
            -webkit-appearance: none;
            appearance: none;
            width: 22px;
            height: 22px;
            background: #caa74e;
            border: 2px solid #8a6a1a;
            border-radius: 50%;
            cursor: pointer;
        }
        .aktiviranje-range::-moz-range-thumb{
            width: 22px;
            height: 22px;
            background: #caa74e;
            border: 2px solid #8a6a1a;
            border-radius: 50%;
            cursor: pointer;
        }
        .aktiviranje-range::-moz-range-track{
            height: 10px;
            background: #f1e4c6;
            border-radius: 6px;
        }
        .aktiviranje-btn{
            min-width: 130px;
            margin-right: 10px;
            border-radius: 6px;
            color: #ffffff;
            border: 1px solid #257C9E;
        }
        .aktiviranje-btn-primary{
            background: #257C9E;
        }
        .aktiviranje-btn-secondary{
            background: #5f95c9;
        }
        .aktiviranje-odgovori textarea{
            width:100%;
            height:90px !important;
            margin-top:10px;
        }
    </style>
    {/literal}
{/if}
