<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ModuleWeb</title>

	<link href="/css/app.css" rel="stylesheet">
	<link href="/css/chosen.min.css" rel="stylesheet">
	<link href="/css/game.css" rel="stylesheet" type="text/css"/>
	<link href="/css/image-picker.css" rel="stylesheet" type="text/css"/>

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<!-- If Referent or admin route -->
	@if (isset($nameRoute))
	    @include('navbar_signed')
	@endif

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<!-- Choosen -->
	  <script src="/js/chosen.jquery.js" type="text/javascript"></script>

	<!-- Scripts Image Picker -->
	<script type="text/javascript" src="/js/image-picker.min.js"></script>
	  
	  <script type="text/javascript">
	    var config = {
	      '.chosen-select'           : {},
	      '.chosen-select-deselect'  : {allow_single_deselect:true},
	      '.chosen-select-no-single' : {disable_search_threshold:10},
	      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	      '.chosen-select-width'     : {width:"95%"}
	    }
	    for (var selector in config) {
	      $(selector).chosen(config[selector]);
	    }
	    $("select").imagepicker()
	  </script>


	<!-- Scripts Jquery -->
	<script type="text/javascript" src="/js/ListeOeuvre.js"></script>

</body>
</html>
