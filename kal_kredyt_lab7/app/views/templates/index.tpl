<!doctype html>

<head>
	<meta charset="utf-8">
	<meta charset=utf-8>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title>{$page_title|default:"Kalkulator Kredytowy"}</title>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{$config->app_url}/assets/css/whhg.css" />
	<link rel="stylesheet" href="{$config->app_url}/assets/css/grid.css">
	<link rel="stylesheet" href="{$config->app_url}/assets/css/styles.css">
	<link rel="stylesheet" href="{$config->app_url}/styles/styles.css">

	<link rel="icon" type="image/png" href="assets/images/favicon.png">
	<link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-114x114.png">

</head>

<body>
	<div id="Head" class="container">
		<div class="row">
			<div class="col span_16">
				<h1 id="Domain">Kalkulator kredytowy<br>
			</div>
		</div>
	</div>
	{if isset($user)}
		<div id="Stats" class="container">
			<div class="row">
				{block name=nav}{/block}
				<div class="col span_12"></div>
				<div class="col span_4">
					<i class="info">
						Użytkownik: {$user->login}
					</i>
					<i class="info">
						Rola: {$user->role}
					</i>
				</div>
			</div>
		</div>
	{/if}
	<div id="Content" class="container">
		<div class="row padding main-block">
			<div class="col span_24">{block name=main}{/block}</div>
		</div>
	</div>
	<div id="Content-end" class="container"></div>
	<div id="Footer" class="container">
		<div class="row top">
			<div class="col span_16">Copyright &copy; 2023, Autor: Jakub Fudali</div>
			<div class="col span_8 align-right">Design: <a href="http://www.gettemplate.com/">GetTemplate</a></div>
		</div>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</body>

</html>