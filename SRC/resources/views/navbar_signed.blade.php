<nav class="navbar navbar-default">
  <div class="container-fluid">
  	<a class="navbar-brand" href="#">Espace {{ $nameRoute }}</a>
 	<p class="navbar-text"><img height="25" weight="25" src="{{$me->image}}"></img> </p>
  	<p class="navbar-text">{{$me->firstname}}</p>
  	<p class="navbar-text">{{$me->lastname}}</p>
  	<p class="navbar-text">{{$me->email}}</p>
  	<ul class="nav navbar-nav navbar-right">
        <li>
        	<a href="logout">Se déconnecter</a>
        </li>
     </ul>
  	<ul class="nav navbar-nav navbar-right">
        <li>
     		<a href="">Mes paramètres</a>
        </li>
     </ul>
  </div>
</nav>