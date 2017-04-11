<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE">
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ mix('css/scss.css') }}">
    <link rel="stylesheet" href="{{ mix('css/less.css') }}">
    <script>
        window.Laravel = <?php echo json_encode( [
			'csrfToken' => csrf_token(),
		] ); ?>
    </script>
</head>
@yield('body')
</html>