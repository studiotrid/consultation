{if isset($modulKosmickaPoruka)}
{assign var="kp" value=$modulKosmickaPoruka}
{assign var="kpBottomUp" value=($kp.faza == 3)}
{* Planet symbols for each group of 24 *}
{if $kpBottomUp}
{assign var="kpPlanete" value=["☿","♃","♄","♅"]}
{else}
{assign var="kpPlanete" value=["☉","♀","♂","♄"]}
{/if}

<div id="kosmicka-content-{$kp.konsultacija}" class="kosmicka-poruka-content{if $kp.is_faza_2} kosmicka-faza2-simple{/if}">

    <h3 class="kosmicka-naslov">{$kp.naslov}</h3>

    {* Scoring popup template (hidden) *}
    {if !$kp.is_faza_2}
    <div id="kosmicka-score-dialog" style="display:none;">
        <div class="kp-dialog-inner">
        <p style="margin-bottom:12px;font-size:13px;">Na skali od 0 do 10 ocenite svaki odgovor.</p>
        <ol style="padding-left:22px;">
            <li>
                <p>U kojoj meri ste danas došli do posebno značajnih Uvida?</p>
                <div class="karmicke-vertikale-range-row">
                    <input type="range" id="kp-q1" value="5" min="0" max="10" class="kp-score-range" />
                    <span class="kp-range-val">5</span>
                </div>
                <div class="karmicke-vertikale-range-captions"><span>jako loše</span><span>savršeno</span></div>
            </li>
            <li>
                <p>Koliko su današnje okolnosti podržavajuće za vas?</p>
                <div class="karmicke-vertikale-range-row">
                    <input type="range" id="kp-q2" value="5" min="0" max="10" class="kp-score-range" />
                    <span class="kp-range-val">5</span>
                </div>
                <div class="karmicke-vertikale-range-captions"><span>jako loše</span><span>savršeno</span></div>
            </li>
            <li>
                <p>U kojoj meri se Vašim prisustvom sve stvari spontano dovode u stanje reda?</p>
                <div class="karmicke-vertikale-range-row">
                    <input type="range" id="kp-q3" value="5" min="0" max="10" class="kp-score-range" />
                    <span class="kp-range-val">5</span>
                </div>
                <div class="karmicke-vertikale-range-captions"><span>jako loše</span><span>savršeno</span></div>
            </li>
        </ol>
        <div class="kp-komentar-wrap">
            <label for="kp-komentar">Komentar (opciono)</label>
            <textarea id="kp-komentar" rows="4" placeholder="Upišite komentar za današnji test..."></textarea>
        </div>
        <div style="text-align:center;margin-top:14px;">
            <button id="kp-score-submit" class="btn btn-large kp-submit-btn">Sačuvaj</button>
        </div>
        </div>
    </div>
    {/if}

    {* Card enlargement modal *}
    <div id="kosmicka-img-modal" style="display:none;">
        <img id="kosmicka-img-modal-img" src="" alt="" style="max-width:100%;max-height:80vh;" />
    </div>

    {* Main grid wrapper — all card groups *}
    <div class="kosmicka-grid-wrapper"
         data-konsultacija="{$kp.konsultacija}"
         data-kolona="{$kp.kolona}"
         data-bottom-up="{if $kpBottomUp}1{else}0{/if}"
            data-is-faza-2="{if $kp.is_faza_2}1{else}0{/if}"
         data-ukupan-broj="{$kp.ukupan_broj}"
         data-today="{$kp.today}"
         data-ukupni-prosek="{if $kp.ukupni_prosek !== null}{$kp.ukupni_prosek}{else}-1{/if}">

        {* Iterate over 4 planet groups of 24 cards each *}
        {for $gIter=0 to 3}
            {if $kpBottomUp}
                {assign var="gIdx" value=3-$gIter}
            {else}
                {assign var="gIdx" value=$gIter}
            {/if}
            {assign var="gStart" value=$gIdx*24}
            {assign var="gEnd"   value=$gStart+23}
            {* Only render the group if at least one card exists in it *}
            {if isset($kp.karte[$gStart])}
            <div class="kosmicka-planet-group">
                {* Planet symbol spanning 4 rows on the left *}
                {if !$kp.is_faza_2}
                <div class="kosmicka-planet-symbol">{$kpPlanete[$gIdx]}</div>
                {/if}

                <div class="kosmicka-rows-col">
                {* 4 rows of 6 cards per group *}
                {for $rIter=0 to 3}
                    {if $kpBottomUp}
                        {assign var="rLocal" value=3-$rIter}
                    {else}
                        {assign var="rLocal" value=$rIter}
                    {/if}
                    {assign var="rGlobal" value=$gIdx*4+$rLocal}
                    {assign var="rowStart" value=$gStart+$rLocal*6}
                    {if isset($kp.karte[$rowStart])}
                    <div class="kosmicka-cards-row" data-row="{$rGlobal}">
                        {* Row label: spiral + number + average *}
                        {if !$kp.is_faza_2}
                        <div class="kosmicka-row-label">
                            <img src="/img/spirala.png" class="kosmicka-spirala" alt="" />
                            <span class="kosmicka-row-num">{$rGlobal+1}.</span>
                            <span class="kosmicka-row-avg" data-row="{$rGlobal}">
                                {if isset($kp.red_proseci[$rGlobal]) && $kp.red_proseci[$rGlobal] !== null}
                                    {$kp.red_proseci[$rGlobal]}%
                                {/if}
                            </span>
                        </div>
                        {/if}

                        {* 6 card slots per row *}
                        {for $cLocal=0 to 5}
                            {assign var="cGlobal" value=$rowStart+$cLocal}
                            {if isset($kp.karte[$cGlobal])}
                            {assign var="kar" value=$kp.karte[$cGlobal]}
                                                             <div class="kosmicka-card-slot{if !$kp.is_faza_2 && $kar.crveni_okvir} kosmicka-red-border{/if}{if $kar.key_uverenje_okvir} kosmicka-key-belief-border{/if}"
                                 data-datum="{$kar.datum}"
                                 data-idx="{$cGlobal}">

                                {* Date label above the card *}
                                <div class="kosmicka-card-date">{$kar.datum_prikaz}</div>

                                {* Constellation name above card if drawn *}
                                <div class="kosmicka-card-name">
                                    {if $kar.karta && $kar.karta != ''}{$kar.naziv|default:''}{/if}
                                </div>

                                {* Card image *}
                                {if $kar.karta && $kar.karta != ''}
                                    {* Card drawn — show constellation, clickable to enlarge *}
                                    <div class="kosmicka-card-img-wrap">
                                        <img src="{$kp.img_base}/{$kar.karta}.jpg"
                                             alt="{$kar.naziv|default:''|escape:'html'}"
                                             class="kosmicka-card-img clickable-kosmicka"
                                            data-img="{$kp.img_base}/{$kar.karta}.jpg"
                                             data-naziv="{$kar.naziv|default:''|escape:'html'}" />
                                        {* Card number top-right *}
                                        {if !$kp.is_faza_2}
                                        <span class="kosmicka-num kosmicka-num-drawn">{if $kpBottomUp}+{else}-{/if}{$cGlobal+1}</span>
                                        {/if}
                                    </div>
                                {elseif $kar.je_danas}
                                    {* Today's undrawn card *}
                                    {if $kp.digitalno}
                                        {* Digital drawing mode *}
                                        <div class="kosmicka-card-img-wrap kosmicka-draw-digital"
                                             data-konsultacija="{$kp.konsultacija}"
                                             data-datum="{$kar.datum}"
                                            data-idx="{$cGlobal}"
                                            data-back-img="{$kp.back_img}">
                                            <img src="{$kp.back_img}"
                                                 alt="Izvuci kartu"
                                                 class="kosmicka-card-img" />
                                                {if !$kp.is_faza_2}
                                            <span class="kosmicka-num kosmicka-num-center">{if $kpBottomUp}+{else}-{/if}{$cGlobal+1}</span>
                                                {/if}
                                        </div>
                                    {else}
                                        {* Physical mode — dropdown select *}
                                        <div class="kosmicka-card-img-wrap">
                                            <img src="{$kp.back_img}"
                                                 alt="Fizička karta"
                                                 class="kosmicka-card-img" />
                                                {if !$kp.is_faza_2}
                                            <span class="kosmicka-num kosmicka-num-center">{if $kpBottomUp}+{else}-{/if}{$cGlobal+1}</span>
                                                {/if}
                                        </div>
                                        <select class="kosmicka-select"
                                                data-konsultacija="{$kp.konsultacija}"
                                                data-datum="{$kar.datum}"
                                                data-idx="{$cGlobal}">
                                            <option value="">— izaberite —</option>
                                            {foreach from=$kp.kontalacije item=kon}
                                            <option value="{$kon.id}">{$kon.naziv}</option>
                                            {/foreach}
                                        </select>
                                    {/if}
                                {elseif $kar.je_proslo && !$kar.karta}
                                    {* Past undrawn — show closed card, no interaction *}
                                    <div class="kosmicka-card-img-wrap">
                                        <img src="{$kp.back_img}"
                                             alt="Zatvorena karta"
                                             class="kosmicka-card-img" />
                                        {if !$kp.is_faza_2}
                                        <span class="kosmicka-num kosmicka-num-center">{if $kpBottomUp}+{else}-{/if}{$cGlobal+1}</span>
                                        {/if}
                                    </div>
                                {else}
                                    {* Future card — closed, no interaction *}
                                    <div class="kosmicka-card-img-wrap">
                                        <img src="{$kp.back_img}"
                                             alt="Buduća karta"
                                             class="kosmicka-card-img" />
                                        {if !$kp.is_faza_2}
                                        <span class="kosmicka-num kosmicka-num-center">{if $kpBottomUp}+{else}-{/if}{$cGlobal+1}</span>
                                        {/if}
                                    </div>
                                {/if}

                                {* Procenat below card *}
                                {if !$kp.is_faza_2}
                                {assign var="kpHasVal" value=($kar.procenat !== null && $kar.procenat !== '') || ($kar.je_proslo && !$kar.karta)}
                                <div class="kosmicka-card-procenat{if $kpHasVal} kp-has-val{/if}" data-idx="{$cGlobal}">
                                    {if $kar.procenat !== null && $kar.procenat !== ''}
                                        {$kar.procenat}%
                                    {elseif $kar.je_proslo && !$kar.karta}
                                        0%
                                    {/if}
                                </div>
                                {/if}

                            </div>{* .kosmicka-card-slot *}
                            {/if}
                        {/for}{* cLocal *}
                    </div>{* .kosmicka-cards-row *}
                    {/if}
                {/for}{* rLocal *}
                </div>{* .kosmicka-rows-col *}
            </div>{* .kosmicka-planet-group *}
            {/if}
        {/for}{* gIdx *}

    </div>{* .kosmicka-grid-wrapper *}

    {* Summary sentence when all done *}
    {if !$kp.is_faza_2 && $kp.zavrseno}
    <div class="kosmicka-summary">
        {if $kpBottomUp}
        Snaga Dharmičke Vertikale za uverenje '{$kp.ukupan_broj}.' narednog života je '{$kp.ukupni_prosek}%'
        {else}
        Snaga Karmičke Vertikale za uverenje '{$kp.ukupan_broj}.' prethodnog života je '{$kp.ukupni_prosek}%'
        {/if}
    </div>
    {/if}

</div>{* #kosmicka-content *}

{literal}
<style>
    :root {
        --kp-card-w: clamp(78px, 7vw, 112px);
        --kp-card-h: calc(var(--kp-card-w) * 1.5);
        --kp-gap: 8px;
    }
    .kosmicka-poruka-content {
        overflow-x: hidden;
        padding-bottom: 10px;
    }
    .kosmicka-grid-wrapper {
        min-width: 0;
        width: 100%;
    }
    .kosmicka-planet-group {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
        padding-bottom: 14px;
    }
    .kosmicka-planet-group::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 2px;
        background: linear-gradient(to right, transparent, #ffd700 15%, #b8860b 50%, #ffd700 85%, transparent);
        opacity: 0.85;
    }
    .kosmicka-planet-group:last-child {
        margin-bottom: 10px;
        padding-bottom: 0;
    }
    .kosmicka-planet-group:last-child::after {
        display: none;
    }
    .kosmicka-faza2-simple .kosmicka-planet-group {
        margin-bottom: 12px;
        padding-bottom: 0;
    }
    .kosmicka-faza2-simple .kosmicka-planet-group::after,
    .kosmicka-faza2-simple .kosmicka-planet-symbol,
    .kosmicka-faza2-simple .kosmicka-row-label,
    .kosmicka-faza2-simple .kosmicka-card-procenat,
    .kosmicka-faza2-simple .kosmicka-num {
        display: none;
    }
    .kosmicka-planet-symbol {
        width: 40px;
        font-size: 48px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        align-self: center;
        text-align: center;
        color: #e2c197;
        padding-top: 0;
        flex: 0 0 40px;
    }
    .kosmicka-rows-col {
        flex: 1;
    }
    .kosmicka-cards-row {
        display: flex;
        align-items: center;
        gap: var(--kp-gap);
        margin-bottom: 18px;
    }
    .kosmicka-rows-col .kosmicka-cards-row:last-child {
        margin-bottom: 24px;
    }
    .kosmicka-row-label {
        width: 64px;
        min-width: 64px;
        min-height: 244px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #f0e3c0;
        padding-top: 0;
    }
    .kosmicka-spirala {
        width: 42px;
        height: auto;
        margin: 0 auto 6px auto;
        display: block;
    }
    .kosmicka-row-num,
    .kosmicka-row-avg {
        display: block;
        font-size: 18px;
        line-height: 1.2;
    }
    .kosmicka-row-avg {
        font-weight: 700;
        color: #e2c197;
        margin-top: 4px;
    }
    .kosmicka-card-slot {
        position: relative;
        width: var(--kp-card-w);
        min-width: var(--kp-card-w);
    }
    .kosmicka-card-date,
    .kosmicka-card-name,
    .kosmicka-card-procenat {
        position: relative;
        z-index: 7;
        text-align: center;
        font-size: 12px;
        line-height: 1.2;
    }
    .kosmicka-card-date {
        min-height: 14px;
        margin-bottom: 2px;
        color: #f0e3c0;
    }
    .kosmicka-card-name {
        min-height: 20px;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
    }
    .kosmicka-card-img-wrap {
        position: relative;
        z-index: 2;
        width: var(--kp-card-w);
        height: var(--kp-card-h);
        border-radius: 8px;
        overflow: hidden;
        background: rgba(0, 0, 0, 0.15);
    }
    .kosmicka-card-img {
        display: block;
        width: var(--kp-card-w);
        height: var(--kp-card-h);
        max-width: var(--kp-card-w);
        max-height: var(--kp-card-h);
        object-fit: cover;
    }
    .kosmicka-card-img-wrap.kosmicka-draw-digital,
    .kosmicka-card-img-wrap.kosmicka-draw-digital .kosmicka-card-img {
        cursor: pointer;
    }
    .clickable-kosmicka {
        cursor: pointer;
    }
    .kosmicka-num {
        position: absolute;
        z-index: 12;
        top: 6px;
        right: 6px;
        font-size: 12px;
        line-height: 1;
        padding: 3px 5px;
        border-radius: 6px;
        background: rgba(0, 0, 0, 0.55);
        color: #ffffff;
        font-weight: 700;
    }
    .kosmicka-num-center {
        top: 50%;
        left: 50%;
        right: auto;
        transform: translate(-50%, -50%);
    }
    .kosmicka-card-procenat {
        min-height: 20px;
        margin-top: 4px;
        color: #c7c7c7;
    }
    .kosmicka-card-procenat.kp-has-val {
        color: #e2c197;
        font-weight: 700;
    }
    .kosmicka-select {
        width: 100%;
        margin-top: 6px;
        box-sizing: border-box;
    }
    .kosmicka-red-border .kosmicka-card-img-wrap {
        box-shadow: 0 0 0 2px #c54242 inset;
    }
    .kosmicka-key-belief-border .kosmicka-card-img-wrap {
        box-shadow: 0 0 0 5px #6f2dbd inset;
    }
    .kosmicka-summary {
        margin-top: 14px;
        color: #f0e3c0;
        font-weight: 700;
    }
    .kosmicka-score-dialog,
    .kosmicka-score-dialog .ui-dialog-content,
    .kosmicka-score-dialog .ui-widget-content {
        background: #ffffff !important;
        color: #333333 !important;
    }
    .kosmicka-score-dialog .ui-dialog-titlebar {
        background: #f5f5f5;
        border: 1px solid #ddd;
    }
    .kp-dialog-inner {
        background: #ffffff;
        color: #333333;
        padding: 8px 6px;
    }
    .kp-komentar-wrap {
        margin-top: 10px;
    }
    .kp-komentar-wrap label {
        display: block;
        margin-bottom: 6px;
        font-weight: 700;
        color: #000000;
    }
    .kp-komentar-wrap textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #d3b26a;
        border-radius: 6px;
        padding: 10px;
        resize: vertical;
        min-height: 88px;
    }
    .kp-dialog-inner .karmicke-vertikale-range-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 2px;
    }
    .kp-dialog-inner .kp-score-range {
        width: 100%;
        margin: 0;
    }
    .kp-dialog-inner .karmicke-vertikale-range-captions {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        line-height: 1.15;
        color: #555555;
        margin-top: 0;
        margin-right: 34px;
    }

    @media (max-width: 1024px) {
        :root {
            --kp-card-w: 110px;
            --kp-gap: 10px;
        }
        .kosmicka-poruka-content {
            overflow-x: auto;
        }
        .kosmicka-grid-wrapper {
            min-width: 980px;
        }
    }
</style>
{/literal}

{/if}
