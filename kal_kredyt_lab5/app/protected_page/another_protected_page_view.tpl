{extends file="../../templates/index.tpl"}
{block name=nav}
    <div id="Stats" class="container">
        <div class="row">
            <div class="col span_4"><i class="info"><a href="{$config->action_url}calculate">Kalkulator kredytowy</a></i>
            </div>
            <div class="col span_4"><i class="info"><a href="{$config->action_url}logout">Wyloguj</a></i></div>
        </div>
    </div>
{/block}
{block name=main}
    <div class="row">
        <h2>Kolejna blokowana strona</h2>
        <p>Strona w trakcie budowy. Przepraszamy.</p>
    </div>
{/block}