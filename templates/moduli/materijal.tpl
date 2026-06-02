{if isset($modulmaterijal) && isset($modulmaterijal.items) && $modulmaterijal.items|@count > 0}
<div class="modul-wrapper materijal-module">
	<div class="ikona modul-icon materijal-icon" id="materijalIcon{$modulmaterijal.konsultacija_id}" title="Kliknite za materijale">
		<img src="/img/materijal.png" alt="Materijal" style="width:160px;height:auto" class="module-icon-img">
		<span>MATERIJAL</span>
	</div>
</div>

<div id="materijalList{$modulmaterijal.konsultacija_id}" class="materijal-content-section" style="display:none; width:100%; margin:30px 0;">
	<h5 style="margin-bottom:20px; font-size:18px; color:rgb(226, 193, 151);">Materijal</h5>
	
	<div style="width:100%;">
		{foreach from=$modulmaterijal.items item=item}
			{assign var="fileExt" value=$item.tip_datoteke|lower}
			{assign var="isImage" value=false}
			{assign var="isAudio" value=false}
			{assign var="isVideo" value=false}
			{if $fileExt == 'jpg' || $fileExt == 'jpeg' || $fileExt == 'png' || $fileExt == 'gif' || $fileExt == 'bmp' || $fileExt == 'webp' || $fileExt == 'svg'}
				{assign var="isImage" value=true}
			{elseif $fileExt == 'mp3' || $fileExt == 'wav' || $fileExt == 'ogg' || $fileExt == 'm4a' || $fileExt == 'flac' || $fileExt == 'aac'}
				{assign var="isAudio" value=true}
			{elseif $fileExt == 'mp4' || $fileExt == 'avi' || $fileExt == 'mov' || $fileExt == 'wmv' || $fileExt == 'flv' || $fileExt == 'webm' || $fileExt == 'mkv'}
				{assign var="isVideo" value=true}
			{/if}
			
			<div style="margin-bottom:25px; padding-bottom:20px; border-bottom:1px solid #eee;">
				{if $isImage}
					{* Za slike - direktan prikaz *}
					<div style="margin-bottom:10px;">
						<strong style="font-size:16px; color:rgb(226, 193, 151);">
							{if $item.naziv != ''}{$item.naziv}{else}{$item.datoteka}{/if}
						</strong>
					</div>
					{if $item.opis != ''}
						<div style="font-size:14px; color:#666; margin-bottom:10px;">{$item.opis}</div>
					{/if}
					<div style="margin-top:10px;">
						<img src="https://coach.profesionalnaastrologija.com/upload/materijal/{$item.datoteka}" 
							 alt="{if $item.naziv != ''}{$item.naziv}{else}{$item.datoteka}{/if}" 
							 style="max-width:100%; height:auto; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
					</div>
				{elseif $isAudio}
					{* Za audio - player *}
					<div style="margin-bottom:10px;">
						<strong style="font-size:16px; color:rgb(226, 193, 151);">
							{if $item.naziv != ''}{$item.naziv}{else}{$item.datoteka}{/if}
						</strong>
					</div>
					{if $item.opis != ''}
						<div style="font-size:14px; color:#666; margin-bottom:10px;">{$item.opis}</div>
					{/if}
					<div style="margin-top:10px;">
						<audio controls style="width:100%; max-width:600px;">
							<source src="https://coach.profesionalnaastrologija.com/upload/materijal/{$item.datoteka}" type="audio/{$fileExt}">
							Vaš browser ne podržava audio player.
						</audio>
					</div>
				{elseif $isVideo}
					{* Za video - player *}
					<div style="margin-bottom:10px;">
						<strong style="font-size:16px; color:rgb(226, 193, 151);">
							{if $item.naziv != ''}{$item.naziv}{else}{$item.datoteka}{/if}
						</strong>
					</div>
					{if $item.opis != ''}
						<div style="font-size:14px; color:#666; margin-bottom:10px;">{$item.opis}</div>
					{/if}
					<div style="margin-top:10px;">
						<video controls style="max-width:100%; height:auto; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
							<source src="https://coach.profesionalnaastrologija.com/upload/materijal/{$item.datoteka}" type="video/{$fileExt}">
							Vaš browser ne podržava video player.
						</video>
					</div>
				{else}
					{* Za ostale fajlove - download link *}
					<div>
						<a href="https://coach.profesionalnaastrologija.com/upload/materijal/{$item.datoteka}" 
						   target="_blank" 
						   download
						   style="font-size:16px; font-weight:600; color:rgb(226, 193, 151); text-decoration:none; display:inline-block; margin-bottom:8px;">
							<i class="fas fa-download" style="margin-right:8px;"></i>
							{if $item.naziv != ''}{$item.naziv}{else}{$item.datoteka}{/if}
						</a>
						{if $item.opis != ''}
							<div style="font-size:14px; color:#666; margin-top:5px;">{$item.opis}</div>
						{/if}
						<div style="font-size:12px; color:#999; margin-top:5px;">
							Tip: {$item.tip_datoteke|upper} | Veličina: {$item.velicina_formatted}
						</div>
					</div>
				{/if}
			</div>
		{/foreach}
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#materijalIcon{$modulmaterijal.konsultacija_id}').on('click', function(){
			var $icon = $(this);
			var $materijalList = $('#materijalList{$modulmaterijal.konsultacija_id}');
			
			if($materijalList.is(':visible')){
				$materijalList.slideUp(300);
				$icon.removeClass('active');
			} else {
				$materijalList.slideDown(300, function(){
					// Scroll to content after it's visible
					$('html, body').animate({
						scrollTop: $materijalList.offset().top - 20
					}, 500);
				});
				$icon.addClass('active');
			}
		});
	});
</script>
{/if}
