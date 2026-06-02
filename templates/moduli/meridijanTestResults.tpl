
{* Template for Meridijan Test Results - view completed test *}
{if isset($meridijanTest)}
<div class="testModultest ikona meridijanTestModulResults" id="meridijanTestResults{$meridijanTest.id}" title="{t}Click to view Meridijan Test results{/t}">
    <img src="/img/test.png" alt="{t}Meridijan Test Results{/t}" />
    <span>{t}VIEW RESULTS{/t}</span>
</div>
<div id="meridijanTestResultsModal{$meridijanTest.id}" style="display:none"></div>

<script type="text/javascript">
    $(document).ready(function(){ 
        $('#meridijanTestResults{$meridijanTest.id}').on('click', function(){
            var $modal = $('#meridijanTestResultsModal{$meridijanTest.id}');
            
            // Load results via AJAX
            $.ajax({
                url: '{$basepath}inc/getMeridijanResults.php',
                method: 'GET',
                data: { test: '{$meridijanTest.id}' },
                success: function(response) {
                    $modal.html(response);
                    $modal.dialog({
                        modal: true,
                        width: 900,
                        height: 600,
                        dialogClass: 'meridijan-dialog',
                        title: '{t}Meridijan Test Results{/t} - {$meridijanTest.nazivMeridijana}',
                        open: function() {
                            console.log('Meridijan test results dialog opened successfully');
                            $(this).css('background-color', '#ffffff');
                            $(this).closest('.ui-dialog').css('background-color', '#ffffff');
                        }
                    });
                },
                error: function() {
                    alert('Error loading test results');
                }
            });
        });
    });
</script>
{/if}
