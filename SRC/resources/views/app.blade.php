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
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!-- css jeu memory -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab">
	<link rel="stylesheet" href="/css/memory.css">

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


	<!-- start memory! -->
	<script>
		(function(){
			var myMem = new Memory({
				wrapperID : "my-memory-game",
				cards : [
					{
						id : 1,
						img: "/pictures/default/monsters-01.png"
					},
					{
						id : 2,
						img: "/pictures/default/monsters-02.png"
					},
					{
						id : 3,
						img: "/pictures/default/monsters-03.png"
					},
					{
						id : 4,
						img: "/pictures/default/monsters-04.png"
					},
					{
						id : 5,
						img: "/pictures/default/monsters-05.png"
					},
					{
						id : 6,
						img: "/pictures/default/monsters-06.png"
					},
					{
						id : 7,
						img: "/pictures/default/monsters-07.png"
					},
					{
						id : 8,
						img: "/pictures/default/monsters-08.png"
					},
					{
						id : 9,
						img: "/pictures/default/monsters-09.png"
					},
					{
						id : 10,
						img: "/pictures/default/monsters-10.png"
					},
					{
						id : 11,
						img: "/pictures/default/monsters-11.png"
					},
					{
						id : 12,
						img: "/pictures/default/monsters-12.png"
					},
					{
						id : 13,
						img: "/pictures/default/monsters-13.png"
					},
					{
						id : 14,
						img: "/pictures/default/monsters-14.png"
					},
					{
						id : 15,
						img: "/pictures/default/monsters-15.png"
					},
					{
						id : 16,
						img: "/pictures/default/monsters-16.png"
					}
				],
				onGameStart : function() { return false; },
				onGameEnd : function() { return false; }
			});
		})();
	</script>


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
