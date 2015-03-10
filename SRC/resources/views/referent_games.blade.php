@extends('app')

<link href="css/referent.css" rel="stylesheet" type="text/css"/>
<center>
	<img src="/pictures/pic/Game.png" alt="Game" class="iconGame"/>
</center>

<div class="container">
  @foreach ($games as $game)
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkxLjc5Njg3NSIgeT0iMTAwIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjExcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MjQyeDIwMDwvdGV4dD48L2c+PC9zdmc+" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
        <div class="caption">
          <h3>{{$game->nom}}</h3>
          <p>{{$game->description}}</p>
          <p><a href="games/{{$game->nom}}" class="btn btn-default" role="button">Button</a></p>
        </div>
      </div>
    </div>
  @endforeach
 </div>