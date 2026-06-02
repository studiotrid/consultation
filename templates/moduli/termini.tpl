{if isset($modultermini) && is_array($modultermini) && count($modultermini) > 0}
<div class="terminiModul ikona" data-termini='{$modultermini|@json_encode}' title="{t}Click to view Karmic Test Schedule{/t}">
    <img src="/img/ispitni-termini-icon-1024px-.png" alt="{t}Karmic Test Schedule{/t}" />
    <span>{t}Karmic Tests{/t}</span>
</div>
{/if}

{if isset($modulterminiTest) && is_array($modulterminiTest) && count($modulterminiTest) > 0}
    {foreach from=$modulterminiTest item=test}
        {assign var=testid value=$test.ID}
        <div class="testModul ikona terminiTestModul" id="terminiTestDugme{$testid}" title="Click to take karmic test">
            <img src="/img/ispitni-termini-icon-1024px-.png" alt="Karmic Test" />
            <span>TAKE TEST</span>
        </div>
    {/foreach}
    <div style="display: none;">
        {foreach from=$modulterminiTest item=test}
            <div id="terminiTestModal{$test.ID}" class="termini-modal" style="display:none; background:#ffffff; color:#333333;">
            <div class="termini-inner" style="background:#ffffff; color:#333333; padding:10px;">
            <form id="terminiTestForm{$test.ID}" method="POST">
                <input type="hidden" name="ispitID" value="{$test.ID}" />
                <h4>{t}Karmic test for{/t} {$test.planeta} {t}chakra{/t}, {t}intensity{/t} {$test.intenzitet}, {$test.datum|date_format:"%A, %d.%m.%Y"}</h4>

                {if $test.faza == 3}
                    {assign var=q1 value="{t}List the activities you undertook today, which transcend your personal needs in a narrow sense and support the society or something of general importance!{/t}"}
                    {assign var=q2 value="{t}List a synchronicity which you recognized in relationships with other people or situations?{/t}"}
                    {assign var=q3 value="{t}Have you recognized that all people and circumstances work for your greatest good, and that they support you on your journey to your Purpose?{/t}"}
                {elseif $test.faza == 2}
                    {assign var=q1 value="{t}Which talents did you discover today?{/t}"}
                    {assign var=q2 value="{t}What did you manage to achieve in your relationships? What new relationships did you manage to form today?{/t}"}
                    {assign var=q3 value="{t}Which things did you manage to materialize today with least effort?{/t}"}
                {elseif $test.faza == 4}
                    {assign var=q1 value="{t}To what extent are you psychic today or able to download information from the Higher Self?{/t}"}
                    {assign var=q2 value="{t}Could you dance with your Soulmate today?{/t}"}
                    {assign var=q3 value="{t}To what extent does your presence help all things spontaneously transform from a certain state of entropy to a state of order or super order?{/t}"}
                {else}
                    {assign var=q1 value="{t}How did you feel during this time period?{/t}"}
                    {assign var=q2 value="{t}What was the objective nature of your behaviour or your reactions?{/t}"}
                    {assign var=q3 value="{t}What was the real nature of the circumstances today, regarding the events that happened or the people you encountered?{/t}"}
                {/if}

                <p class="termini-scale">{t}On a scale from 0 to 10, rate each answer.{/t}</p>

                <ol class="termini-questions">
                    <li>
                        <h5>1. {$q1}</h5>
                        <div class="termini-odgovori">
                            <div class="termini-range-row">
                                <input type="range" name="odgovor1" value="5" min="0" max="10" class="termini-range" />
                                <span class="termini-range-value" data-for="odgovor1">5</span>
                            </div>
                            <div class="termini-range-captions">
                                <span>{t}Poor{/t}</span>
                                <span>{t}Perfect{/t}</span>
                            </div>
                            <textarea name="odgovor1text"></textarea>
                        </div>
                    </li>
                    <li>
                        <h5>2. {$q2}</h5>
                        <div class="termini-odgovori">
                            <div class="termini-range-row">
                                <input type="range" name="odgovor2" value="5" min="0" max="10" class="termini-range" />
                                <span class="termini-range-value" data-for="odgovor2">5</span>
                            </div>
                            <div class="termini-range-captions">
                                <span>{t}Poor{/t}</span>
                                <span>{t}Perfect{/t}</span>
                            </div>
                            <textarea name="odgovor2text"></textarea>
                        </div>
                    </li>
                    <li>
                        <h5>3. {$q3}</h5>
                        <div class="termini-odgovori">
                            <div class="termini-range-row">
                                <input type="range" name="odgovor3" value="5" min="0" max="10" class="termini-range" />
                                <span class="termini-range-value" data-for="odgovor3">5</span>
                            </div>
                            <div class="termini-range-captions">
                                <span>{t}Poor{/t}</span>
                                <span>{t}Perfect{/t}</span>
                            </div>
                            <textarea name="odgovor3text"></textarea>
                        </div>
                    </li>
                </ol>

                <p class="clearfix" style="clear:both;">
                    <button class="btn btn-large termini-btn termini-btn-primary" type="submit">{t}Save{/t}</button>
                </p>
            </form>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#terminiTestDugme{$test.ID}').on('click', function(){
                    $('#terminiTestModal{$test.ID}').dialog({
                        modal: true,
                        width: 700,
                        height: 800,
                        title: '{t}Karmic Test{/t}',
                        dialogClass: 'termini-dialog',
                        open: function(){
                            $(this).closest('.ui-dialog').css('background', '#ffffff');
                            $(this).closest('.ui-dialog').find('.ui-dialog-content').css('background', '#ffffff');
                        }
                    });
                });

                // Initialize slider value displays
                $('#terminiTestModal{$test.ID} .termini-range').each(function(){
                    var name = $(this).attr('name');
                    $('#terminiTestModal{$test.ID} .termini-range-value[data-for="' + name + '"]').text($(this).val());
                }).on('input change', function(){
                    var name = $(this).attr('name');
                    $('#terminiTestModal{$test.ID} .termini-range-value[data-for="' + name + '"]').text($(this).val());
                });

                $('#terminiTestForm{$test.ID}').on('submit', function(e){
                    e.preventDefault();
                    var $form = $(this);
                    $.ajax({
                        url: '/inc/ajax/save_termini_test.php',
                        method: 'POST',
                        data: $form.serialize(),
                        dataType: 'json'
                    }).done(function(resp){
                        if(resp && resp.success){
                            $('#terminiTestModal{$test.ID}').dialog('close');
                            $('#terminiTestDugme{$test.ID}').remove();
                            if (resp.uspehText !== undefined) {
                                $('.termini-uspeh[data-id="{$test.ID}"]').html('<span style="color: #e2c197;">' + resp.uspehText + '</span>');
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
    </div>
{/if}

{literal}
    <style>
        .termini-modal{
            background: #ffffff;
        }
        .termini-dialog,
        .termini-dialog .ui-dialog-content,
        .termini-dialog .ui-widget-content{
            background: #ffffff !important;
        }
        .termini-dialog .ui-dialog-titlebar{
            background: #f5f5f5;
            border: 1px solid #ddd;
        }
        .termini-btn{
            min-width: 120px;
            margin-right: 10px;
        }
        .termini-questions{
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .termini-questions li{
            box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
            border: 1px solid #257C9E;
            margin: 20px 10px;
            padding: 10px 20px;
            background: #ffffff;
            color: #222;
        }
        .termini-questions h5{
            margin: 0 0 10px 0;
        }
        .termini-scale{
            text-align:center;
            font-weight:bold;
            font-size:1.05em;
        }
        .termini-range-row{
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .termini-range-captions{
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #666;
            margin-top: -4px;
            margin-right: 35px;
        }
        .termini-range-value{
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
        .termini-range{
            width: 100%;
            margin: 4px 0 10px 0;
            height: 10px;
            background: #f1e4c6;
            border-radius: 6px;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
        }
        .termini-range::-webkit-slider-thumb{
            -webkit-appearance: none;
            appearance: none;
            width: 22px;
            height: 22px;
            background: #caa74e;
            border: 2px solid #8a6a1a;
            border-radius: 50%;
            cursor: pointer;
        }
        .termini-range::-moz-range-thumb{
            width: 22px;
            height: 22px;
            background: #caa74e;
            border: 2px solid #8a6a1a;
            border-radius: 50%;
            cursor: pointer;
        }
        .termini-range::-moz-range-track{
            height: 10px;
            background: #f1e4c6;
            border-radius: 6px;
        }
        .termini-btn{
            min-width: 130px;
            margin-right: 10px;
            border-radius: 6px;
            color: #ffffff;
            border: 1px solid #257C9E;
        }
        .termini-btn-primary{
            background: #257C9E;
        }
        .termini-btn-secondary{
            background: #5f95c9;
        }
        .termini-odgovori textarea{
            width:100%;
            height:90px !important;
            margin-top:10px;
        }
    </style>
    {/literal}

