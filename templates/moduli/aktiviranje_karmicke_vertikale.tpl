{if isset($modulaktiviranje_karmicke_vertikale) && isset($modulaktiviranje_karmicke_vertikale.termini) && is_array($modulaktiviranje_karmicke_vertikale.termini) && count($modulaktiviranje_karmicke_vertikale.termini) > 0}
	<div class="aktiviranjeKarmickeVertikaleModul ikona" data-karmicke-vertikale='{$modulaktiviranje_karmicke_vertikale.termini|@json_encode}' data-karmicke-vertikale-naslov="{$modulaktiviranje_karmicke_vertikale.naslov|escape:'html'}" title="{t}Kliknite za prikaz termina{/t}">
		<img src="/img/uverenja.png" alt="{$modulaktiviranje_karmicke_vertikale.naslov|escape:'html'}" />
		<span>{$modulaktiviranje_karmicke_vertikale.naslov}</span>
	</div>
{/if}

{if isset($modulaktiviranje_karmicke_vertikale.tests) && is_array($modulaktiviranje_karmicke_vertikale.tests) && count($modulaktiviranje_karmicke_vertikale.tests) > 0}
	{foreach from=$modulaktiviranje_karmicke_vertikale.tests item=test}
		<div class="testModul ikona karmickeVertikaleTestModul" id="karmickeVertikaleTestDugme{$test.id}" title="Kliknite da uradite test karmicke vertikale">
			<img src="/img/test.png" alt="Test karmicke vertikale" />
			<span>URADI TEST</span>
		</div>

		<div id="karmickeVertikaleTestModal{$test.id}" class="karmicke-vertikale-modal" style="display:none; background:#ffffff; color:#333333;">
			<div class="karmicke-vertikale-inner" style="background:#ffffff; color:#333333; padding:10px;">
				<form id="karmickeVertikaleTestForm{$test.id}" method="POST">
					<input type="hidden" name="ispitID" value="{$test.id}" />

					<h4>Kvalitet Karmičke Vertikale za aktiviranje<br />{$test.planeta} čakre, {$test.datumLocale|default:$test.datum}.</h4>

					<p class="karmicke-vertikale-scale">Na skali od 0 do 10 ocenite svaki odgovor.</p>

					<ol class="karmicke-vertikale-questions">
						<li>
							<h5>1. U kojoj meri ste danas došli do posebno značajnih Uvida?</h5>
							<div class="karmicke-vertikale-odgovori">
								<div class="karmicke-vertikale-range-row">
									<input type="range" name="odgovor1" value="5" min="0" max="10" class="karmicke-vertikale-range" />
									<span class="karmicke-vertikale-range-value" data-for="odgovor1">5</span>
								</div>
								<div class="karmicke-vertikale-range-captions">
									<span>jako loše</span>
									<span>savršeno</span>
								</div>
							</div>
						</li>
						<li>
							<h5>2. Koliko su današnje okolnosti podržavajuće za vas?</h5>
							<div class="karmicke-vertikale-odgovori">
								<div class="karmicke-vertikale-range-row">
									<input type="range" name="odgovor2" value="5" min="0" max="10" class="karmicke-vertikale-range" />
									<span class="karmicke-vertikale-range-value" data-for="odgovor2">5</span>
								</div>
								<div class="karmicke-vertikale-range-captions">
									<span>jako loše</span>
									<span>savršeno</span>
								</div>
							</div>
						</li>
						<li>
							<h5>3. U kojoj meri se Vašim prisustvom sve stvari iz određenog stanja entropije spontano dovode u stanje reda?</h5>
							<div class="karmicke-vertikale-odgovori">
								<div class="karmicke-vertikale-range-row">
									<input type="range" name="odgovor3" value="5" min="0" max="10" class="karmicke-vertikale-range" />
									<span class="karmicke-vertikale-range-value" data-for="odgovor3">5</span>
								</div>
								<div class="karmicke-vertikale-range-captions">
									<span>jako loše</span>
									<span>savršeno</span>
								</div>
							</div>
						</li>
					</ol>

					<div class="karmicke-vertikale-komentar-wrap">
						<label for="karmickeVertikaleKomentar{$test.id}">Komentar (opciono)</label>
						<textarea id="karmickeVertikaleKomentar{$test.id}" name="komentar" rows="4" placeholder="Upišite komentar za današnji test..."></textarea>
					</div>

					<p class="clearfix" style="clear:both;">
						<button class="btn btn-large karmicke-vertikale-btn karmicke-vertikale-btn-primary" type="submit">Sačuvaj</button>
					</p>
				</form>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
				$('#karmickeVertikaleTestDugme{$test.id}').on('click', function(){
					$('#karmickeVertikaleTestModal{$test.id}').dialog({
						modal: true,
						width: 700,
						height: 820,
						title: 'Test Karmičke Vertikale',
						dialogClass: 'karmicke-vertikale-dialog',
						open: function(){
							$(this).closest('.ui-dialog').css('background', '#ffffff');
							$(this).closest('.ui-dialog').find('.ui-dialog-content').css('background', '#ffffff');
						}
					});
				});

				$('#karmickeVertikaleTestModal{$test.id} .karmicke-vertikale-range').each(function(){
					var name = $(this).attr('name');
					$('#karmickeVertikaleTestModal{$test.id} .karmicke-vertikale-range-value[data-for="' + name + '"]').text($(this).val());
				}).on('input change', function(){
					var name = $(this).attr('name');
					$('#karmickeVertikaleTestModal{$test.id} .karmicke-vertikale-range-value[data-for="' + name + '"]').text($(this).val());
				});

				$('#karmickeVertikaleTestForm{$test.id}').on('submit', function(e){
					e.preventDefault();
					var $form = $(this);
					$.ajax({
						url: '/inc/ajax/save_karmicke_vertikale_test.php',
						method: 'POST',
						data: $form.serialize(),
						dataType: 'json'
					}).done(function(resp){
						if(resp && resp.success){
							$('#karmickeVertikaleTestModal{$test.id}').dialog('close');
							$('#karmickeVertikaleTestDugme{$test.id}').remove();
							if (resp.uspehText !== undefined) {
								$('.karmicke-vertikale-uspeh[data-id="{$test.id}"]').html('<span style="color: #e2c197;">' + resp.uspehText + '</span>');
							}
						} else {
							alert(resp && resp.error ? resp.error : 'Greška prilikom čuvanja testa');
						}
					}).fail(function(){
						alert('Greška prilikom čuvanja testa');
					});
				});
			});
		</script>
	{/foreach}

	{literal}
	<style>
		.aktiviranjeKarmickeVertikaleModul.ikona,
		.karmickeVertikaleTestModul.ikona{
			margin-left: auto;
			margin-right: auto;
		}
		.aktiviranjeKarmickeVertikaleModul.ikona img,
		.karmickeVertikaleTestModul.ikona img{
			margin: 0 auto;
		}
		.karmicke-vertikale-modal{
			background: #ffffff;
		}
		.karmicke-vertikale-dialog,
		.karmicke-vertikale-dialog .ui-dialog-content,
		.karmicke-vertikale-dialog .ui-widget-content{
			background: #ffffff !important;
		}
		.karmicke-vertikale-dialog .ui-dialog-titlebar{
			background: #f5f5f5;
			border: 1px solid #ddd;
		}
		.karmicke-vertikale-btn{
			min-width: 130px;
			margin-right: 10px;
			border-radius: 6px;
			color: #ffffff;
			border: 1px solid #257C9E;
		}
		.karmicke-vertikale-btn-primary{
			background: #257C9E;
		}
		.karmicke-vertikale-questions{
			list-style: none;
			margin: 0;
			padding: 0;
		}
		.karmicke-vertikale-questions li{
			box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
			border: 1px solid #257C9E;
			margin: 20px 10px;
			padding: 10px 20px;
			background: #ffffff;
			color: #222;
		}
		.karmicke-vertikale-questions h5{
			margin: 0 0 10px 0;
		}
		.karmicke-vertikale-scale{
			text-align:center;
			font-weight:bold;
			font-size:1.05em;
		}
		.karmicke-vertikale-range-row{
			display: flex;
			align-items: center;
			gap: 12px;
		}
		.karmicke-vertikale-range-captions{
			display: flex;
			justify-content: space-between;
			font-size: 12px;
			color: #666;
			margin-top: -4px;
			margin-right: 35px;
		}
		.karmicke-vertikale-range-value{
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
		.karmicke-vertikale-range{
			width: 100%;
			margin: 4px 0 10px 0;
			height: 10px;
			background: #f1e4c6;
			border-radius: 6px;
			appearance: none;
			-webkit-appearance: none;
			outline: none;
		}
		.karmicke-vertikale-range::-webkit-slider-thumb{
			-webkit-appearance: none;
			appearance: none;
			width: 22px;
			height: 22px;
			background: #caa74e;
			border: 2px solid #8a6a1a;
			border-radius: 50%;
			cursor: pointer;
		}
		.karmicke-vertikale-range::-moz-range-thumb{
			width: 22px;
			height: 22px;
			background: #caa74e;
			border: 2px solid #8a6a1a;
			border-radius: 50%;
			cursor: pointer;
		}
		.karmicke-vertikale-range::-moz-range-track{
			height: 10px;
			background: #f1e4c6;
			border-radius: 6px;
		}
		.karmicke-vertikale-komentar-wrap{
			margin: 10px 10px 20px 10px;
		}
		.karmicke-vertikale-komentar-wrap label{
			display: block;
			margin-bottom: 6px;
			font-weight: 700;
			color: #333;
		}
		.karmicke-vertikale-komentar-wrap textarea{
			width: 100%;
			box-sizing: border-box;
			padding: 10px;
			border: 1px solid #d3b26a;
			border-radius: 6px;
			resize: vertical;
			min-height: 90px;
			font-family: inherit;
			font-size: 14px;
		}
	</style>
	{/literal}
{/if}
