<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Les Jeux du Musée</title>
    <link href="http://fonts.googleapis.com/css?family=Oswald:700,300" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('css/frontend.css') }}" rel="stylesheet" type="text/css"/>
    @yield('page-css')
</head>
<body>
	@yield('content')
    @yield('page-scripts')
</body>
</html>
