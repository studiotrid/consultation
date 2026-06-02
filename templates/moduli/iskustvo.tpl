{if isset($moduliskustvo)}
<div class="iskustvoModul napomena" data-konsultacija="{$moduliskustvo.konsultacija_id}" data-tekst="{$moduliskustvo.tekst|escape:'html'}" style="width: 100%; margin-top: 20px; padding: 20px; background: rgba(15, 36, 65, 0.6); border-radius: 5px;">
    <label style="display: block; margin-bottom: 10px; font-weight: bold; color: #fff;">{t}Your experience{/t}:</label>
    <textarea class="iskustvoContent" name="iskustvo" style="width: 100%; min-height: 150px; padding: 10px; background: transparent; border: none; border-bottom: 1px solid rgba(255, 255, 255, 0.3); font-family: inherit; font-size: 14px; color: #fff; resize: vertical;">{$moduliskustvo.tekst}</textarea>
    <button class="saveIskustvo" style="margin-top: 15px; padding: 8px 20px; cursor: pointer;background:none;color:#d49d55" class="gradient-border">
        {t}Save Experience{/t}
    </button>
    <span class="iskustvoStatus" style="margin-left: 10px; color: #d49d55; display: none;">{t}Saved successfully{/t}</span>
</div>
{/if}


