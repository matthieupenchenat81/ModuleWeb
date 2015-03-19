<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Espace Référent | Les Jeux du Musée</title>
    <link rel="stylesheet" href="{{URL::to('css/bootstrap-sandstone.min.css')}}">
    <link rel="icon" type="image/ico" href="{{ URL::to('imgs/favicon.ico') }}">
    @yield('page-css')
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body style="padding-top:90px">

	@yield('content')
    
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    @yield('page-scripts')

</body>
</html>
