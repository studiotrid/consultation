
{* Template for Meridijan Test icon - to take test *}
{if isset($meridijanTestIcon)}
<div class="testModul ikona meridijanTestModul" id="meridijanTestDugme{$meridijanTestIcon.id}" title="{t}Click to take Meridijan Test{/t}">
    <img src="/img/test.png" alt="{t}Meridijan Test{/t}" />
    <span>{t}TAKE TEST{/t}</span>
</div>
<div id="meridijanTestPolaganjeModal{$meridijanTestIcon.id}" style="display:none"></div>

<script type="text/javascript">
    $(document).ready(function(){ 
        $('#meridijanTestDugme{$meridijanTestIcon.id}').on('click', function(){
            var src = '{$basepath}meridijanTestPolaganje.php?test={$meridijanTestIcon.id}';
            console.log('Opening Meridijan test form:', src);
            
            var $modal = $('#meridijanTestPolaganjeModal{$meridijanTestIcon.id}');
            $modal.html('<iframe src="'+src+'" style="border:none;width:100%;height:100%;background:#fff;"></iframe>');
            $modal.dialog({
                modal: true,
                width: 900,
                height: $(window).height() - 100,
                minHeight: 600,
                dialogClass: 'meridijan-dialog',
                title: '{t}Meridijan Test{/t} - {$meridijanTestIcon.nazivMeridijana}',
                open: function() {
                    console.log('Meridijan test dialog opened successfully');
                    // Set white background and prevent outer scrollbars
                    $(this).css({
                        'background-color': '#ffffff',
                        'overflow': 'hidden',
                        'padding': 0
                    });
                    $(this).closest('.ui-dialog').css('overflow', 'hidden');
                    // Adjust iframe height to content
                    var $iframe = $(this).find('iframe');
                    $iframe.on('load', function(){
                        try {
                            var iframeHeight = $iframe.contents().find('body').height() + 50;
                            $modal.dialog('option', 'height', Math.min(iframeHeight, $(window).height() - 100));
                        } catch(e) {
                            console.log('Cannot access iframe content:', e);
                        }
                    });
                },
                close: function() {
                    // Reload page when modal closes to refresh test status
                    window.location.reload();
                }
            });
        });
    });
</script>
{/if}
