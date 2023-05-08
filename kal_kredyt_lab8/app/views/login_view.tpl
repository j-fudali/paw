{extends file="index.tpl"}
{block name=main}
    <div class="col span_12">
        <h2>Zaloguj się</h2>
        <p>Skorzystaj z tego prostego kalkulatora kredytowego, aby obliczyć swoją miesięczną rate.</p>
    </div>
    <div class="col span_12">
        <h2>Formularz logowania</h2>
        <form method="POST" action="{$config->action_url}login">
            <div class="row">
                <div class="col span_24">
                    <input type="text" placeholder="Login..." id="login" name="login">
                </div>
                <div class="span_24">
                    <input type="password" placeholder="Hasło..." id="password" name="password">
                </div>
            </div>
            <div class="row">
                <div class="col span_24 align-right">
                    <button class="btn btn-large" type="submit">Wyślij</button>
                </div>
            </div>
        </form>
    </div>
    {if !$errors->isEmpty()}

        <div class="row">
            <div class="col span_24 align-right">
                <b class="row">Przepraszamy, ale pojawiły się pewne problemy</b>
                {foreach $errors->getErrors() as $err}
                    {strip}
                        <b><i class="row">{$err}</i></b>
                    {/strip}
                {/foreach}
            </div>
        </div>
    {/if}
{/block}