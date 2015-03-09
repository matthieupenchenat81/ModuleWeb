@extends('app')

<link rel="stylesheet" href="/css/memory.css">
<div class="container">
<br>
<center><h1>{{ $game }}</h1></center>

<br><br>

<!-- script jeu memory -->
<!-- js -->
<script src="/js/classList.min.js"></script>
<script src="/js/memory.js"></script>


<!-- <center><img src="http://i.ytimg.com/vi/xiIO1zUXNVI/maxresdefault.jpg" width="60%"></center> -->


	<div class="wrapper">
	<div class="content">
			<div class="row">
				<div class="col-xs-12 col-sm-10 col-md-12">
					<div id="my-memory-game"></div>
				</div>
			</div>

		</div>
	</div><!-- /.content -->
</div>
