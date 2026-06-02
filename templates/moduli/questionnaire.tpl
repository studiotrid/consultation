{if isset($modulupitnik)}
	{assign var=cid value=$modulupitnik.consultation_id}

	<div class="questionnaireModul ikona" id="questionnaireTrigger{$cid}" title="{t}Questionnaire{/t}">
		<span>{t}Questionnaire{/t}</span>
	</div>

	<div id="questionnaireDialog{$cid}" class="dn questionnaire-dialog" title="{t}Questionnaire{/t}">
		<h2>{t}Questionnaire{/t}</h2>
		<p><strong>{t}Radujem se da zajedno uz pomoć intuicije dođemo do odgovora i rešenja.{/t}</strong></p>

		<form id="questionnaireForm{$cid}" class="questionnaire-form">
			<input type="hidden" name="consultation_id" value="{$cid}" />

			<label>
				1. {t}Šta te je inspirisalo za ovu konsultaciju? Šta želiš da rešiš, postigneš?{/t}
				<textarea name="q1" required>{$modulupitnik.q1|escape}</textarea>
			</label>
			<label>
				2. {t}Šta su do sada bili tvoji najveći izazovi?{/t}
				<textarea name="q2" required>{$modulupitnik.q2|escape}</textarea>
			</label>
			<label>
				3. {t}Šta bi bilo tvoje idealno rešenje? Šta bi ti najviše značilo?{/t}
				<textarea name="q3" required>{$modulupitnik.q3|escape}</textarea>
			</label>

			<div class="questionnaire-feedback dn"></div>

			<button type="submit" class="btn btn-primary w-100">{t}Pošalji{/t}</button>
		</form>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var $dialog = $('#questionnaireDialog{$cid}');
			var $trigger = $('#questionnaireTrigger{$cid}');
			var $form = $('#questionnaireForm{$cid}');
			var $feedback = $dialog.find('.questionnaire-feedback');

			$dialog.dialog({
				autoOpen: false,
				modal: true,
				width: 700
			});

			$trigger.on('click', function(){
				$dialog.dialog('open');
			});

			$form.on('submit', function(evt){
				evt.preventDefault();

				var $submitBtn = $form.find('button[type="submit"]');
				$submitBtn.prop('disabled', true);
				$feedback.addClass('dn').removeClass('error success').text('');

				$.ajax({
					url: '{$basepath}questionnaire.php',
					method: 'POST',
					data: $form.serialize(),
					dataType: 'json'
				}).done(function(resp){
					if (resp && resp.status === 'ok') {
						$dialog.dialog('close');
						$trigger.fadeOut(200, function(){ $(this).remove(); });
					} else {
						var message = (resp && resp.message) ? resp.message : '{t}Došlo je do greške. Pokušaj ponovo.{/t}';
						$feedback.removeClass('dn').text(message);
					}
				}).fail(function(xhr){
					var message = '{t}Došlo je do greške. Pokušaj ponovo.{/t}';
					if (xhr.responseJSON && xhr.responseJSON.message) {
						message = xhr.responseJSON.message;
					}
					$feedback.removeClass('dn').text(message);
				}).always(function(){
					$submitBtn.prop('disabled', false);
				});
			});
		});
	</script>
{/if}