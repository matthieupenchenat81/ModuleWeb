@extends('frontend/template')

@section('content')
	<script src="{{ URL::to('js/phaser.min.js') }}"></script>
	<script src="{{ URL::to('js/responsivevoice.js') }}"></script>
    <script type="text/javascript">
		
        document.body.innerHTML = "<h1 id='Chargement'> Chargement... </h1>" + document.body.innerHTML; //on affiche le chargement 
        
        function getPieceWidth(w,h) {
            //if(h>w) {
                return w * (y * ratioImage)/h;
            //} else return x * ratioImage;
        }
        function getPieceHeight(w,h) {
            //if(h>w) {
                return y * ratioImage;
            //} else return h * (x * ratioImage)/w;
        }
        function preload () {
        	document.getElementById("Chargement").innerHTML = "";
            game.load.spritesheet('balls', '{{ URL::to('imgs/puzzle/balls.png') }}', 17, 17);
            game.load.image('trophy3', '{{ URL::to('imgs/trophees/or.png') }}');
            game.load.image('trophy2', '{{ URL::to('imgs/trophees/argent.png') }}');
            game.load.image('trophy1', '{{ URL::to('imgs/trophees/bronze.png') }}');

            for(i=1; i<=selection.length; i++) {
                game.load.spritesheet("tableau"+i, selection[i-1].src, selection[i-1].width/dimensions[0], selection[i-1].height/dimensions[1]);
            }
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
            dateDebut = new Date();
        }
        function create () {
            game.physics.startSystem(Phaser.Physics.ARCADE);
            createPiecesFor(1);
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
                    var temps = Math.ceil(((new Date()) - dateDebut)/60000);
                    var texteADire = (temps <= 1) ? "Bravo, tu as mis moins d'une minute." : 
                    "Bravo, tu as mis "+temps+" minutes. ";;
                    responsiveVoice.speak(texteADire, "French Female");
                    pieces.forEach(function(item){item.input.draggable = false;});
                    if(nbToPlay == currentPlayed)
                    {
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
                          }, 3000);
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
            var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
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
                    if(loadedImg == nbToPlay)
                        game = new Phaser.Game(x, y, Phaser.CANVAS, '', { preload: preload, update: update, create: create }, true);
                }
            }
            
    </script>
@endsection