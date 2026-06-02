
{* Template for TS Test icon - to take test *}
{if isset($tsTestIcon)}
<div class="tsTestModul ikona" id="tsTestDugme{$tsTestIcon.id}" title="{if $tsTestIcon.tip eq 'predtest'}{t}Click to take Consciousness Technology Pre-Test{/t}{else}{t}Click to take Consciousness Technology Post-Test{/t}{/if}">
    <span>{if $tsTestIcon.tip eq 'predtest'}{t}TAKE PRE-TEST{/t}{else}{t}TAKE POST-TEST{/t}{/if}<br>
    <small style="font-size:0.8em;">{$tsTestIcon.planeta}</small></span>
</div>
<div id="tsTestPolaganjeModal{$tsTestIcon.id}" style="display:none"></div>

<script type="text/javascript">
    $(document).ready(function(){ 
        $('#tsTestDugme{$tsTestIcon.id}').on('click', function(){
            var src = '{$basepath}tsTestPolaganje.php?test={$tsTestIcon.id}';
            console.log('Opening TS test form:', src);
            
            var $modal = $('#tsTestPolaganjeModal{$tsTestIcon.id}');
            $modal.html('<iframe src="'+src+'" style="border:none;width:100%;height:100%"></iframe>');
            $modal.dialog({
                modal: true,
                width: 900,
                height: $(window).height() - 100,
                minHeight: 600,
                dialogClass: 'ts-test-dialog',
                title: '{if $tsTestIcon.tip eq "predtest"}Pre-Test{else}Post-Test{/if} - {$tsTestIcon.planeta}',
                open: function() {
                    console.log('TS test dialog opened successfully');
                    $(this).css({
                        'background-color': '#ffffff',
                        'overflow': 'hidden',
                        'padding': 0
                    });
                    $(this).closest('.ui-dialog').css('overflow', 'hidden');
                }
            });
        });
    });
</script>
{/if}
