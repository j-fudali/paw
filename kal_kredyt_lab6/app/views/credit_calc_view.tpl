{extends file="index.tpl"}
{block name=nav}
    <div id="Stats" class="container">
        <div class="row">
            <div class="col span_4"><i class="info"><a href="{$config->action_url}protected_page">Blokowana
                        strona</a></i></div>
            <div class="col span_4"><i class="info"><a href="{$config->action_url}logout">Wyloguj</a></i></div>
        </div>
    </div>
{/block}
{block name=main}
    <div class="col span_24">
        <h2>Kalkulator Kredytowy</h2>
        <form method="POST" class="row" action="{$config->action_url}calculate">
            <div class="row">
                <div class="col span_16">
                    <input placeholder="Kwota pożyczki: " type="text" name="kwota" id="kwota"
                        value="{$calc_form->kwota|default: null}">
                </div>
                <div class="span_16">
                    <input placeholder="Lata: " type="text" name="lata" id="lata" value="{$calc_form->lata|default: null}">
                </div>
                <div class="span_16">
                    <input placeholder="Oprocentowanie: " type="text" name="procent" id="procent"
                        value="{$calc_form->procent|default: null}">
                </div>
            </div>
            <div class="row">
                <div class="col span_24 align-left">
                    <button class="btn btn-large" type="submit">Wyślij</button>
                </div>
            </div>
        </form>
        {if $result}
            <div style="margin-top: 10px;" class="row">
                <h2>Miesięczna rata: {$result}</h2>
            </div>
        {/if}
        {if $errors && !$errors->isEmpty()}
            <div class="row">
                <div class="col span_24">
                    <b class="row">Przepraszamy, ale pojawiły się pewne problemy:</b>
                    {foreach $errors->getErrors() as $err}
                        {strip}
                            <b><i class="row">{$err}</i></b>
                        {/strip}
                    {/foreach}
                </div>
            </div>

        {/if}
    </div>
{/block}