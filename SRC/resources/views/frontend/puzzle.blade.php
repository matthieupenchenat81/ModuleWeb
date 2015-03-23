@extends('frontend/template')
@section('page-css')
<style>
@-webkit-keyframes whirly {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

#loader img {
 -webkit-animation: whirly 3s infinite linear;
}
</style>


@endsection
@section('content')
    <div id="loader" style="width:100%;text-align:center;padding-top:100px;">
        <img src="{{ URL::to('imgs/spinner.png') }}" alt="chargement">
    </div>
	<script src="{{ URL::to('js/phaser.min.js') }}"></script>
	<script src="{{ URL::to('js/responsivevoice.js') }}"></script>
    <script type="text/javascript">

        function getPieceWidth(w,h) {

            //cas où l'image rentre dans l'écran, on ne fais rien
            if(h<y && w<x) {
                return w * ratioImage;
            }

            //cas où l'image est plus large et haute, on prend le meilleur ratio pour pas redimensionner 2 fois

            if(h/y > w/x) { //il faut redimensionner en hauteur
                return w * y/h * ratioImage;
            } else { //on redimensionne en largeur
                return x * ratioImage;
            }
        }

        function getPieceHeight(w,h) {
            if(h<y && w<x) {
                return h * ratioImage;
            }

            if(h/y > w/x) { //il faut redimensionner en hauteur
                return y * ratioImage;
            } else {
                return h * x/w * ratioImage;
            }
        }






        /*function getPieceWidthOld(w,h) {
            //if(h>w) {
                return w * (y * ratioImage)/h;
            //} else return x * ratioImage;
        }
        function getPieceHeightOld(w,h) {
            //if(h>w) {
                return y * ratioImage;
            //} else return h * (x * ratioImage)/w;
        }*/
        function preload () {
            game.load.spritesheet('balls', '{{ URL::to('imgs/puzzle/balls.png') }}', 17, 17);
            game.load.image('trophy3', '{{ URL::to('imgs/trophees/or.png') }}');
            game.load.image('trophy2', '{{ URL::to('imgs/trophees/argent.png') }}');
            game.load.image('trophy1', '{{ URL::to('imgs/trophees/bronze.png') }}');
            game.load.image('previous', '{{ URL::to('imgs/previouspage.png') }}');
            for(i=1; i<=selection.length; i++) {
                game.load.spritesheet("tableau"+i, selection[i-1].src, selection[i-1].width/dimensions[0], selection[i-1].height/dimensions[1]);
            }
        }
        function create () {

            this.button3 = this.add.button(0, 0, 'previous', changePage);
            this.button3.width = 50;
            this.button3.height = 50;

            this.physics.startSystem(Phaser.Physics.ARCADE);
            createPiecesFor(1);
            dateDebut = new Date();
        }
        function nextPuzzle() {
            currentPlayed++;
            pieces.destroy(true);
            createPiecesFor(currentPlayed);
            
            //game.physics.collide = true;
            //create();
            
        }
        
        var currentPlayed = 1;
        
        function createPiecesFor(idTab) {
            pieces = game.add.group();
            var counter = 0;
            for(i=0; i<dimensions[0]; i++) {
				for(j=0; j<dimensions[1]; j++) {
                    var str = "tableau" + idTab;
                    //Phaser.GAMES[0].world.create(20, 340, "tableau3");
                    pieces.add(game.world.create(game.world.randomX, game.world.randomY, str));
                    var currentPiece = pieces.children[counter];
                    currentPiece.placed = false;
                    currentPiece.inputEnabled = true;
					currentPiece.input.enableDrag();
                    currentPiece.width = Math.floor(getPieceWidth(selection[idTab-1].width, selection[idTab-1].height) / dimensions[0]);
                    currentPiece.height = Math.floor(getPieceHeight(selection[idTab-1].width, selection[idTab-1].height) / dimensions[1]);
                    game.physics.arcade.enable(currentPiece);
                    currentPiece.body.collideWorldBounds = true;
                    currentPiece.events.onDragStart.add(startDrag, this);
                    currentPiece.events.onDragStop.add(stopDrag, this);
                    currentPiece.frame = counter;
                    counter++;

                }
            }  
        }
        function drawGrid(idTab) {

                var graphics = game.add.graphics();
                graphics.lineStyle(2, 0xff0000, 1);

                graphics.moveTo(10, 10);
                graphics.lineTo(Math.floor(getPieceWidth(selection[idTab-1].width, selection[idTab-1].height)) + 10,
                 10);

                 graphics.lineTo(Math.floor(getPieceWidth(selection[idTab-1].width, selection[idTab-1].height)) + 10,
                 Math.floor(getPieceHeight(selection[idTab-1].width, selection[idTab-1].height)) + 10);

                 graphics.lineTo(10,10);
        }

        function changePage() {
            if (confirm('Quitter le jeu ?')) {
                location.href = "{{URL::to('/')}}";
            } else {
                // Do nothing!
            }
        }
        function startDrag(elt) {
            elt.placed = false;
            elt.body.moves = false;
        }
        function stopDrag(elt) {
            elt.body.moves = true;
            
			pieces.forEach(function(piece) { // si jamais c'est une pièce adjacente
                
                var posPiece = null;
                //piece du haut
                if(elt.frame - piece.frame == dimensions[0]) posPiece = 'haut';
                //piece du bas
                if(elt.frame - piece.frame == - dimensions[0]) posPiece = 'bas';
                
                
                //left + right
                var eltNum = elt.frame;
                var pieceNum = piece.frame;
                
                while(eltNum >= dimensions[0]) {
                    eltNum -= dimensions[0];
                    pieceNum -= dimensions[0];
                }
                if(
                    (eltNum >= 0 && eltNum < dimensions[1])
                 && (pieceNum >= 0 && pieceNum < dimensions[1])
                ){
                    // piece de gauche
                    if(elt.frame - piece.frame == 1) posPiece = 'gauche';   
                    // piece de droite
                    if(elt.frame - piece.frame == -1) posPiece = 'droite';   
                }
                
                
                
                if(posPiece == 'gauche') {
                    if(Math.abs(elt.x - (piece.x + piece.width)) < piece.width/5
                    && Math.abs(elt.y - piece.y) < piece.height/5)
                    {
                        game.add.tween(elt.body).to( { x: piece.x + piece.width, y: piece.y }, 300, Phaser.Easing.Linear.None, true);
                        elt.placed = true;
                        piece.placed = true;
                    } else piece.placed = false;
                }
                if(posPiece == 'droite') {
                    if(Math.abs(elt.x + elt.width - piece.x) < piece.width/5
                    && Math.abs(elt.y - piece.y) < piece.height/5)
                    {
                        game.add.tween(elt.body).to( { x: piece.x - elt.width, y: piece.y }, 300, Phaser.Easing.Linear.None, true);
                        elt.placed = true;
                        piece.placed = true;
                    } else piece.placed = false;
                }                
                if(posPiece == 'haut') {
                    if(Math.abs(elt.x  - piece.x) < piece.width/5
                    && Math.abs(elt.y - piece.height - piece.y) < piece.height/5)
                    {
                        game.add.tween(elt.body).to( { x: piece.x, y: piece.y + piece.height }, 300, Phaser.Easing.Linear.None, true);
                        elt.placed = true;
                        piece.placed = true;
                    } else piece.placed = false;
                }                
                if(posPiece == 'bas') {
                    if(Math.abs(elt.x  - piece.x) < piece.width/5
                    && Math.abs(elt.y + elt.height - piece.y) < piece.height/5)
                    {
                        game.add.tween(elt.body).to( { x: piece.x, y: piece.y - elt.height }, 300, Phaser.Easing.Linear.None, true);
                        elt.placed = true;
                        piece.placed = true;
                    } else piece.placed = false;
                }    
                
            });
                   
                var cpt = 0;
                pieces.forEach(function(piece) {
                    if(piece.placed == true) cpt++
                });
                if(cpt==pieces.length) {
                    pieces.forEach(function(item){item.input.draggable = false;});
                    if(nbToPlay == currentPlayed)
                    {
                        var temps = Math.ceil(((new Date()) - dateDebut)/60000);
                        var texteADire = (temps <= 1) ? "Bravo, tu as mis moins d'une minute." :
                        "Bravo, tu as mis "+temps+" minutes. ";;
                        responsiveVoice.speak(texteADire, "French Female");
                        leftEmitter = game.add.emitter(50, 50);
                        leftEmitter.bounce.setTo(0.8, 0.8);
                        leftEmitter.setXSpeed(100, 200);
                        leftEmitter.setYSpeed(-50, 50);
                        leftEmitter.makeParticles('balls', 0, 10, 1, true);

                        rightEmitter = game.add.emitter(game.world.width - 50, 50);
                        rightEmitter.bounce.setTo(0.8, 0.8);
                        rightEmitter.setXSpeed(-100, -200);
                        rightEmitter.setYSpeed(-50, 50);
                        rightEmitter.makeParticles('balls', 1, 10, 1, true);

                        // explode, lifespan, frequency, quantity
                        leftEmitter.start(false, 10000, 20);
                        rightEmitter.start(false, 10000, 20);
                        
                        pieces.forEach(function(item){game.add.tween(item).to( { alpha: 0 }, 1000).start();});

                        var trophee = game.world.create(game.world.centerX,game.world.centerY, ("trophy"+trophy));
                        trophee.anchor.setTo(0.5,0.5);
                        trophee.width = 270;
                        trophee.height = 270;
                        trophee.alpha = 0;
                        tween = game.add.tween(trophee).to( { alpha: 1 }, 1000).start();
                        var r = new XMLHttpRequest();
                        r.open("GET", "{{URL::to('setRecords')}}" + "/" + trophy, true);
                        r.onreadystatechange = function () {
                          if (r.readyState != 4 || r.status != 200) return;
                          setTimeout(function(){
                              location.href = "{{URL::to('puzzle/jouer')}}" + "/" + trophy;
                          }, 6000);
                        };
                        r.send();

                        // TODO appel ajax
                        //var t1 = game.world.create(game.world.centerX,game.world.centerY, "tableau1");
                        //t1.anchor.setTo(0.5,0.5);
                    }
                    else {
                        setTimeout(function(){
                            nextPuzzle();
                        }, 1000);
                    }
                }
            
        }
        function update() {
            if(leftEmitter != undefined && rightEmitter != undefined)
                game.physics.arcade.collide(leftEmitter, rightEmitter, change, null, this);

        }
        function change(a, b) {

            a.frame = 3;
            b.frame = 3;

        }
            
        var leftEmitter, rightEmitter;
            var x = window.innerWidth;
            var y = window.innerHeight;
            var pieces = null;
            var dateDebut = null;
        
        
            var ratioImage = 0.8;       
            var dimensions = [{{$dimension}}, {{$dimension}}];
            var nbToPlay = {{$nbTab}};
            var trophy = {{ $niveau }};
            var images = [];
            @foreach ($oeuvres as $i => $oeuvre)
                images.push("http://www.augustins.org/documents/10180/156407/{{ $oeuvre -> image}}");
            @endforeach
            
            var selection = [];
        
            var game;
            var tmpImg;
            var loadedImg = 0;
            for(i=1; i<=nbToPlay;i++) {
                tmpImg = new Image();
                tmpImg.src = images[Math.floor(Math.random()*images.length)];
                selection.push(tmpImg);
                
                tmpImg.onload = function () {
                    loadedImg++;
                    if(loadedImg == nbToPlay) {
                        var element = document.getElementById("loader");
                        element.parentNode.removeChild(element);
                        game = new Phaser.Game(x, y, Phaser.CANVAS, '', { preload: preload, update: update, create: create }, true);
                    }
                }
            }
            
    </script>
@endsection