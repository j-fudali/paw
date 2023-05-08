{extends file="index.tpl"}
{block name=main}
    <h1>Zapisane wyniki</h1>
    {if $results}
        <div class="row">
            {counter start=0 print=false}
            {foreach from=$results item=result}
                <div class="span_24">{counter}. Wynik: <b>{$result['result']}</b>, dnia
                    {$result['created_at']|date_format:"%d.%m.%y %H:%M"}
                </div>
            {/foreach}
        </div>
    {else}
        <h2>Brak wyników</h2>
    {/if}
{/block}