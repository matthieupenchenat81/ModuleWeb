<nav class="navbar navbar-default">
  <div class="container-fluid">
  	<a class="navbar-brand" href="#">Espace {{ $nameRoute }}</a>
 	<!-- <span class="glyphicon glyphicon-user" aria-hidden="true"></span> -->
 	<p class="navbar-text"><img height="50" weight="50" src="{{$me->image}}"></img> </p>
  	<p class="navbar-text">{{$me->name}}</p>
  	<p class="navbar-text">{{$me->email}}</p>
  	<ul class="nav navbar-nav navbar-right">
        <li><a href="logout">Se déconnecter</a></li>
     </ul>
  </div>
</nav>