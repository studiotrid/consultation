{* Cards Module Template *}
<div class="modul-wrapper cards-module">
    <div class="ikona modul-icon" data-module="cards" data-consultation="{$modulcards.consultation_id}">
        <img src="/img/vodica.png" style="width:160px;height:auto" alt="Karte" class="module-icon-img">
        <span >CARDS</span>
    </div>
</div>

{* Cards Content - Hidden by default, shown when icon is clicked *}
<div id="cards-content-{$modulcards.consultation_id}" class="cards-content" style="display:none;">
    
    {* Experience section for today's card - shown above the grid *}
    {assign var="todayCard" value=null}
    {foreach from=$modulcards.cards item=card}
        {if $card.card_date == $modulcards.today && $card.card_number != '' && $card.card_number != null}
            {assign var="todayCard" value=$card}
        {/if}
    {/foreach}
    
    {if $todayCard != null}
        <div class="today-experience-section ">
            <h3 class="experience-title">Vaše iskustvo za danas - {$todayCard.card_date|date_format:"%d.%m.%Y"}</h3>
            <textarea 
                class="card-experience-input today-experience gradient-border" 
                style="padding:20px"
                data-card-id="{$todayCard.id}"
                placeholder="Unesite vaše iskustvo za danas..."
                rows="5"
            >{if $todayCard.experience}{$todayCard.experience}{/if}</textarea>
            <button class="save-experience-btn gradient-border" data-card-id="{$todayCard.id}">Sačuvaj iskustvo</button>
        </div>
    {/if}
    
    <div class="cards-grid">
        {assign var="card_index" value=0}
        {for $row=0 to 6}
            <div class="cards-row">
                {for $col=0 to 3}
                    {assign var="card_index" value=$row*4+$col}
                    {if $card_index < 28 && isset($modulcards.cards[$card_index])}
                        {assign var="card" value=$modulcards.cards[$card_index]}
                        <div class="card-item" data-card-id="{$card.id}" data-day="{$card.day_number}" data-date="{$card.card_date}">
                            <div class="card-image-wrapper">
                                {if $card.card_number != '' && $card.card_number != null}
                                    {* Card has been drawn - clickable to enlarge *}
                                    <img src="/img/karte/{$card.card_number}.jpg" 
                                         alt="Karta {$card.card_number}" 
                                         class="card-image revealed clickable-card" 
                                         data-card-number="{$card.card_number}"
                                         data-card-date="{$card.card_date|date_format:"%d.%m.%Y"}">
                                {else}
                                    {* Card not yet drawn *}
                                    {if $card.card_date == $modulcards.today}
                                        {* Only today's card can be opened *}
                                        <img src="/img/karte/0.jpg" alt="Izvlačenje karte" class="card-image flipping" data-card-id="{$card.id}">
                                    {else}
                                        {* Past or future card - remain closed *}
                                        <img src="/img/karte/0.jpg" alt="Neotvorena karta" class="card-image unopened">
                                    {/if}
                                {/if}
                            </div>
                            <div class="card-date">
                                {$card.card_date|date_format:"%d.%m.%Y"}
                            </div>
                        </div>
                    {/if}
                {/for}
            </div>
        {/for}
    </div>
</div>
