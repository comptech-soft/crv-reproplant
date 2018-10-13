<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">

	<head>
        <title>{{ config('app.name') }} | {{__('Login') }} </title>

		<meta charset="utf-8" />
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <meta name="locale" content="{{ app()->getLocale() }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="base-url" content="{{ config('app.url') }}" />
        <meta name="has-user" content="{{ Sentinel::check() ? 1 : 0}}" />

		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
				active: function() {sessionStorage.fonts = true;}
			});
		</script>

        <link href="{{ config('app.url') }}/css/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ config('app.url') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ config('app.url') }}/css/reproplant.bundle.css" rel="stylesheet" type="text/css" />
    </head>

	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<main id="app" role="main" v-if="$app.mounted">
			<app-login></app-login>
		</main>
		<script src="{{config('app.url')}}/js/login.bundle.js" type="text/javascript"></script>
	</body>
</html>