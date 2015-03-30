;(function( window ) {

  // code inspiré de https://github.com/callmenick/Memory
  /**
  * Extend object function
  *
  */

  var partieRealise = 0;
  function extend( a, b ) {
    for( var key in b ) {
      if( b.hasOwnProperty( key ) ) {
        a[key] = b[key];
      }
    }
    return a;
  }

  /**
  * fonction qui va permettre de mélanger les cartes dans une array
  */

  function shuffle(o) {
    for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
  };

  /**
  * Constructeur du Memory
  */

  function Memory( options, level, nbcase, nbPartie ) {
    this.options = extend( {}, this.options );
    extend( this.options, options );
    this._init(level, nbcase, nbPartie);
  }

  /**
  * Memory _init - initialise Memory
  *
  *Crée toutes les zones de contenu de jeu, ajoute les id et les classes, et se prépare pour la configuration de jeu.
  */

  Memory.prototype._init = function(level,nbcase, nbPartie) {

    this.game = document.createElement("div");
    this.game.id = "mg";
    this.game.className = "mg";
    document.getElementById(this.options.wrapperID).appendChild(this.game);



    this.gameWrapper = document.createElement("div");
    this.gameWrapper.id = "mg__wrapper";
    this.gameWrapper.className = "mg__wrapper";

    this.gameContents = document.createElement("div");
    this.gameContents.id = "mg__contents";

    this.gameWrapper.appendChild(this.gameContents);

    this.gameMessages = document.createElement("div");
    this.gameMessages.id = "mg__onend";
    this.gameMessages.className = "mg__onend";

    this._setupGame(level,nbcase, nbPartie);
  };

  /**
  * Memory _setupGame - on définit les paramètres du jeu
  *
  * Etats de la variable gameStates:
  *
  * 1 : par défaut,ça permet à l'utilisateur de choisir un niveau
  * 2 : changer le niveau pendant que le joueur joue
  * 3 : le jeu est fini
  */

  Memory.prototype._setupGame = function(level, nbcase, nbPartie) {
    var self = this;
    this.gameState = 1;
    this.cards = shuffle(this.options.cards);
    this.card1 = "";
    this.card2 = "";
    this.card1id = "";
    this.card2id = "";
    this.card1flipped = false;
    this.card2flipped = false;
    this.flippedTiles = 0;
    this.chosenLevel = "";
    this.numMoves = 0;
    this.dateDebut = new Date();
    this._setupGameWrapper(level, nbcase, nbPartie);
  }

  /**
  * Memory _setupGameWrapper
  *
  *Cette fonction définit l'espace du jeu.
  */

  Memory.prototype._setupGameWrapper = function(levelNode,nbcase,nbPartie) {
    this.nbcase = nbcase;
    this.level = levelNode;
    this.gameContents.className = "mg__contents mg__level-"+this.level;
    this.game.appendChild(this.gameWrapper);

    this.chosenLevel = this.level;

    this._renderTiles(nbPartie,nbcase);
  };


  /**
  * Memory _renderTiles
  *
  * Dans cette fonction nous définissons le niveau et le nombre de carte enregistré dans la base.
  * On y créer une array ou on y met les carte. Puis on utilise la fonction shuffle pour mélaner et donc ne pas avoir toutes les cartes à la suite.
  * Ensuite on affiche les cartes
  * Puis on déclenche le jeu.
  */

  Memory.prototype._renderTiles = function(nbPartie,nbcase) {
    if(this.level == 1) {this.gridX = 2; this.gridY= 2; }
    else if(this.level == 2) {this.gridX = 3; this.gridY= 2; }
    else { this.gridX = 2; this.gridY=4 ;  }
    this.numTiles = this.nbcase*2;
    this.halfNumTiles = this.numTiles/2;
    if (this.cards.length < this.halfNumTiles) { console.log("pas assez de carte"); document.getElementById("mg__contents").innerHTML="<img height='80px' src='/imgs/sad.png'><h1>Pas assez de cartes enregistrées par le référent </h1>";}
    else {

      this.newCards = [];
      for ( var i = 0; i < this.halfNumTiles; i++ ) {
        this.newCards.push(this.cards[i], this.cards[i]);
      }
      this.newCards = shuffle(this.newCards);

      this.tilesHTML = '';
      var n = 0;
      for ( var i = 0; i < this.numTiles; i++  ) {
        n = n + 1;
        if(this.level == 3 && n == 5 ){n = 9}
        if(this.level == 2 && n == 4 ){n = 7}
        this.tilesHTML += '<div class="mg__tile mg__tile-' + n + '">\
        <div class="mg__tile--inner" data-id="' + this.newCards[i]["id"] + '">\
        <span class="mg__tile--outside"></span>\
        <span class="mg__tile--inside" style="background-image:url(' + this.newCards[i]["img"] + ');"></span>';
        this.tilesHTML +='</div></div>';
      }

      this.gameContents.innerHTML = this.tilesHTML;
      this.gameState = 2;
      this.options.onGameStart();
      this._gamePlay(this.level, nbPartie, nbcase);
    }
  }

  /**
  * Memory _gamePlay
  *Maintenant que tout le HTML est mis en place, le jeu est prêt à être joué.
  *Dans cette fonction, avec une boucle on ajoute les "tiles" avec la fonction gamePlayEvents.
  */

  Memory.prototype._gamePlay = function(levelNode,nbPartie,nbcase) {
    var tiles = document.querySelectorAll(".mg__tile--inner");
    for (var i = 0, len = tiles.length; i < len; i++) {
      var tile = tiles[i];
      this._gamePlayEvents(tile,levelNode,nbPartie,nbcase);
    };
  };

  /**
  * Memory _gamePlayEvents
  *Cette fonction prend en charge les «événements», qui est essentiellement le clic sur les "tiles".
  *Les "titles" sont verifié, savoir si ils sont retourné ou non et vérifier si les deux cartes retourné sont identiques.
  */

  Memory.prototype._gamePlayEvents = function(tile,levelNode,nbPartie,nbcase) {
    var self = this;
    tile.addEventListener( "click", function(e) {
      if (!this.classList.contains("flipped")) {
        if (self.card1flipped === false && self.card2flipped === false) {
          this.classList.add("flipped");
          self.card1 = this;
          self.card1id = this.getAttribute("data-id");
          self.card1flipped = true;
        } else if( self.card1flipped === true && self.card2flipped === false ) {
          this.classList.add("flipped");
          self.card2 = this;
          self.card2id = this.getAttribute("data-id");
          self.card2flipped = true;
          if ( self.card1id == self.card2id ) {
            self._gameCardsMatch(levelNode,nbPartie,nbcase);
          } else {
            self._gameCardsMismatch();
          }
        }
      }
    });
  }

  /**
  * Memory _gameCardsMatch
  *
  * This function runs if the cards match. The "correct" class is added briefly
  * which fades in a background green colour. The times set on the two timeout
  * functions are chosen based on transition values in the CSS. The "flip" has
  * a 0.3s transition, so the "correct" class is added 0.3s later, shown for
  * 1.2s, then removed. The cards remain flipped due to the activated "flip"
  * class from the gamePlayEvents function.
  */

  "document"in self&&("classList"in document.createElement("_")?!function(){"use strict";var a=document.createElement("_");if(a.classList.add("c1","c2"),!a.classList.contains("c2")){var b=function(a){var b=DOMTokenList.prototype[a];DOMTokenList.prototype[a]=function(a){var c,d=arguments.length;for(c=0;d>c;c++)a=arguments[c],b.call(this,a)}};b("add"),b("remove")}if(a.classList.toggle("c3",!1),a.classList.contains("c3")){var c=DOMTokenList.prototype.toggle;DOMTokenList.prototype.toggle=function(a,b){return 1 in arguments&&!this.contains(a)==!b?b:c.call(this,a)}}a=null}():!function(a){"use strict";if("Element"in a){var b="classList",c="prototype",d=a.Element[c],e=Object,f=String[c].trim||function(){return this.replace(/^\s+|\s+$/g,"")},g=Array[c].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1},h=function(a,b){this.name=a,this.code=DOMException[a],this.message=b},i=function(a,b){if(""===b)throw new h("SYNTAX_ERR","An invalid or illegal string was specified");if(/\s/.test(b))throw new h("INVALID_CHARACTER_ERR","String contains an invalid character");return g.call(a,b)},j=function(a){for(var b=f.call(a.getAttribute("class")||""),c=b?b.split(/\s+/):[],d=0,e=c.length;e>d;d++)this.push(c[d]);this._updateClassName=function(){a.setAttribute("class",this.toString())}},k=j[c]=[],l=function(){return new j(this)};if(h[c]=Error[c],k.item=function(a){return this[a]||null},k.contains=function(a){return a+="",-1!==i(this,a)},k.add=function(){var a,b=arguments,c=0,d=b.length,e=!1;do a=b[c]+"",-1===i(this,a)&&(this.push(a),e=!0);while(++c<d);e&&this._updateClassName()},k.remove=function(){var a,b,c=arguments,d=0,e=c.length,f=!1;do for(a=c[d]+"",b=i(this,a);-1!==b;)this.splice(b,1),f=!0,b=i(this,a);while(++d<e);f&&this._updateClassName()},k.toggle=function(a,b){a+="";var c=this.contains(a),d=c?b!==!0&&"remove":b!==!1&&"add";return d&&this[d](a),b===!0||b===!1?b:!c},k.toString=function(){return this.join(" ")},e.defineProperty){var m={get:l,enumerable:!0,configurable:!0};try{e.defineProperty(d,b,m)}catch(n){-2146823252===n.number&&(m.enumerable=!1,e.defineProperty(d,b,m))}}else e[c].__defineGetter__&&d.__defineGetter__(b,l)}}(self));


  Memory.prototype._gameCardsMatch = function(levelNode, nbPartie,nbcase) {
    // cache this
    var self = this;

    // on ajoute la classe correct
    window.setTimeout( function(){
      self.card1.classList.add("correct");
      self.card2.classList.add("correct");
    }, 300 );

    // On supprime la classe correct et on réinitialiser les vars
    window.setTimeout( function(){
      self.card1.classList.remove("correct");
      self.card2.classList.remove("correct");
      self._gameResetVars();
      self.flippedTiles = self.flippedTiles + 2;
      if (self.flippedTiles == self.numTiles) {
        self._winGame(levelNode,nbPartie,nbcase);
      }
    }, 500 );

    // on incrémente les compteurs
    this._gameCounterPlusOne();
  };

  /**
  * Memory _gameCardsMismatch
  *
  * This function runs if the cards mismatch. If the cards mismatch, we leave
  * them flipped for a little while so the user can see and remember what cards
  * they actually are. Then after that slight delay, we removed the flipped
  * class so they flip back over, and reset the vars.
  */

  Memory.prototype._gameCardsMismatch = function() {
    // cache this
    var self = this;

    // remove "flipped" class and reset vars
    window.setTimeout( function(){
      self.card1.classList.remove("flipped");
      self.card2.classList.remove("flipped");
      self._gameResetVars();
    }, 500 );

    // plus one on the move counter
    this._gameCounterPlusOne();
  };

  /**
  * Memory _gameResetVars
  *
  * For each turn, some variables are updated for reference. After the turn is
  * over, we need to reset these variables and get ready for the next turn.
  * This function handles all of that.
  */

  Memory.prototype._gameResetVars = function() {
    this.card1 = "";
    this.card2 = "";
    this.card1id = "";
    this.card2id = "";
    this.card1flipped = false;
    this.card2flipped = false;
  }

  /**
  * Memory _gameCounterPlusOne
  *
  * Each turn, the user completes 1 "move". The obective of memory is to
  * complete the game in as few moves as possible. Users need to know how many
  * moves they've had so far, so this function updates that number and updates
  * the HTML also.
  */

  Memory.prototype._gameCounterPlusOne = function() {
    this.numMoves = this.numMoves + 1;
    //this.moveCounterUpdate = document.getElementById("mg__meta--moves").innerHTML = this.numMoves;
  };

  /**
  * Memory _clearGame
  *
  * This function clears the game wrapper, by removing it from the game div. It
  * allows us to rerun setupGame, and clears the air for other info like
  * victory messages etc.
  */

  Memory.prototype._clearGame = function() {
    if (this.gameWrapper.parentNode !== null) this.game.removeChild(this.gameWrapper);
    if (this.gameMessages.parentNode !== null) this.game.removeChild(this.gameMessages);
  }

  /**
  * Memoray _winGame
  * fonction lorsque l'utilisateur à gagné.
  */

  Memory.prototype._winGame = function(levelNode, nbPartie, nbcase) {
    var self = this;
    this.level = levelNode;
    partieRealise = partieRealise + 1 ;

    if (partieRealise != nbPartie){
      // Pour gagner une coupe il y a un certain nombre de partie à faire
      this._clearGame();
      this._init(this.level, nbcase, nbPartie);
    }

    else if (this.options.onGameEnd() === false) {
      // si il a fini le jeu on le félicite et on lui rajoute aussi des feu d'artifice.
      this._clearGame();
      firework();
      //firework2();
      // on affiche la bonne coupe en fonction du niveau choisi
      if(levelNode == 1){this.gameMessages.innerHTML = '<img style="height: 270px;" src="/imgs/trophees/bronze.png"><br>\
      <button id="mg__onend--restart" class="mg__button"><span class="icon-spinner11"></span></button>';}

      else if(levelNode  == 2){this.gameMessages.innerHTML = '<img style="height: 270px;" src="/imgs/trophees/argent.png"><br>\
      <button id="mg__onend--restart" class="mg__button"><span class="icon-spinner11"></span></button>';}

      else if(levelNode == 3){this.gameMessages.innerHTML = '<img style="height: 270px;" src="/imgs/trophees/or.png"><br>\
      <button id="mg__onend--restart" class="mg__button"><span class="icon-spinner11"></span></button>';}

      else
      {  this.gameMessages.innerHTML = '<h2 class="mg__onend--heading"><span class="icon-trophy"></span></h2>\
      <button id="mg__onend--restart" class="mg__button"><span class="icon-spinner11"></span></button>';}
      // en ajax on incrémente les coupes de l'utilisateur
      var r = new XMLHttpRequest();
      r.open("GET", "/setRecords" + "/" + levelNode, true);
      r.send();

      //http://translate.google.com/translate_tts?ie=UTF-8&q=bravo%2C%20tu%20as%20gagn%C3%A9&tl=fr
      //http://translate.google.com/translate_tts?ie=UTF-8&q=bravo%2C%20tu%20as%20gagn%C3%A9&tl=fr&total=1&idx=0&textlen=18&client=t&prev=input
      //une petite voix dit à l'utilisateur qu'il a gagné

      this.game.appendChild(this.gameMessages);
      document.getElementById("mg__onend--restart").addEventListener( "click", function(e) {
        document.location.href="/memo";
      });
               var temps = Math.ceil(((new Date()) - this.dateDebut)/60000);
                        var texteADire = (temps <= 1) ? "Bravo, tu as mis moins d'une minute." :
                        "Bravo, tu as mis "+temps+" minutes. ";;
                        responsiveVoice.speak(texteADire, "French Female");
    } else {
      // run callback
      this.options.onGameEnd();
    }
  }

  /**
  * Memory resetGame
  *
  * This function resets the game. It can run at the end of the game when the
  * user is presented the option to play again, or at any time like a reset
  * button. It is a public function, and can be used in whatever custom calls
  * in your markup.
  */

  Memory.prototype.resetGame = function() {
    this._clearGame();
    this._setupGame();
  };

  /**
  * Add Memory to global namespace
  */

  window.Memory = Memory;

})( window );
