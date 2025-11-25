{if isset($logged)}
    <div class="logo">
    {if isset($logo)}
        <img src="/img/{$logo}" alt="{$potpis}" class="img-responsive"/>
        {else}
        {$potpis}
    {/if}
    </div>
{/if}