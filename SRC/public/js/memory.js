;(function( window ) {

  //'use strict';

  /**
   * Extend object function
   *
   */


  function extend( a, b ) {
    for( var key in b ) {
      if( b.hasOwnProperty( key ) ) {
        a[key] = b[key];
      }
    }
    return a;
  }

  /**
   * Shuffle array function
   *
   */

  function shuffle(o) {
    for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
  };

  /**
   * Memory constructor
   *
   */

  function Memory( options, level, nbcase ) {
    //console.log(nbcase);
    //console.log("bob");
    this.options = extend( {}, this.options );
    extend( this.options, options );
    this._init(level, nbcase);
  }

  /**
   * Memory _init - initialise Memory
   *
   * Creates all the game content areas, adds the id's and classes, and gets
   * ready for game setup.
   */

  Memory.prototype._init = function(level,nbcase) {
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

    this._setupGame(level,nbcase);
  };

  /**
   * Memory _setupGame - Sets up the game
   *
   * We're caching all game related variables, and by default, displaying the
   * meta info bar and start screen HTML.
   *
   * A NOTE ABOUT GAME STATES:
   *
   * There are 4 game states in total, governed by the variable this.gameState.
   * Each game state allows for a certain series of functions to be performed.
   * The gameStates are as follows:
   *
   * 1 : default, allows user to choose level
   * 2 : set when user chooses level, and game is in play
   * 3 : game is finished
   */

  Memory.prototype._setupGame = function(level, nbcase) {
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
    this._setupGameWrapper(level, nbcase);
  }

  /**
   * Memory _setupGameWrapper
   *
   * This function sets up the game wrapper, which is where the actual memory
   * tiles will reside and where all the game play happens.
   */

  Memory.prototype._setupGameWrapper = function(levelNode,nbcase) {
    this.nbcase = nbcase;
    this.level = levelNode;
    this.gameContents.className = "mg__contents mg__level-"+this.level;
    this.game.appendChild(this.gameWrapper);

    this.chosenLevel = this.level;

    this._renderTiles();
  };


  /**
   * Memory _renderTiles
   *
   * This renders the actual tiles with content. A few thing happen here:
   *
   * 1. Calculate grid X and Y based on user level selection
   * 2. Calculate num tiles
   * 3. Create new cards array based on level, and draw cards from original array
   * 4. Shuffle the new cards array
   * 5. Cards get distributed into tiles
   * 6. gamePlay function gets triggered, taking care of all the game play action.
   */

  Memory.prototype._renderTiles = function() {
     if(this.level == 1) {this.gridX = 2; this.gridY= 2; }
     else if(this.level == 2) {this.gridX = 3; this.gridY= 2; }
     else { this.gridX = 2; this.gridY=4 ;  }
  //  this.gridY = this.gridX ;
    this.numTiles = this.nbcase*2;
    //this.halfNumTiles = this.gridX;
    this.halfNumTiles = this.numTiles/2;
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
        this.tilesHTML +='</div>';


      /*  if(this.level == 1 && n == 2){
          this.tilesHTML +="</tr><tr>";
        }*/
        this.tilesHTML +="</div>";
    }

    this.gameContents.innerHTML = this.tilesHTML;
    this.gameState = 2;
    this.options.onGameStart();
    this._gamePlay();
  }

  /**
   * Memory _gamePlay
   *
   * Now that all the HTML is set up, the game is ready to be played. In this
   * function, we loop through all the tiles (goverend by the .mg__tile--inner)
   * class, and for each tile, we run the _gamePlayEvents function.
   */

  Memory.prototype._gamePlay = function() {
    var tiles = document.querySelectorAll(".mg__tile--inner");
    for (var i = 0, len = tiles.length; i < len; i++) {
      var tile = tiles[i];
      this._gamePlayEvents(tile);
    };
  };

  /**
   * Memory _gamePlayEvents
   *
   * This function takes care of the "events", which is basically the clicking
   * of tiles. Tiles need to be checked if flipped or not, flipped if possible,
   * and if zero, one, or two cards are flipped. When two cards are flipped, we
   * have to check for matches and mismatches. The _gameCardsMatch and
   * _gameCardsMismatch functions perform two separate sets of functions, and are
   * thus separated below.
   */

  Memory.prototype._gamePlayEvents = function(tile) {
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
            self._gameCardsMatch();
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


    Memory.prototype._gameCardsMatch = function() {
    // cache this
    var self = this;

    // add correct class
    window.setTimeout( function(){
      self.card1.classList.add("correct");
      self.card2.classList.add("correct");
    }, 300 );

    // remove correct class and reset vars
    window.setTimeout( function(){
      self.card1.classList.remove("correct");
      self.card2.classList.remove("correct");
      self._gameResetVars();
      self.flippedTiles = self.flippedTiles + 2;
      if (self.flippedTiles == self.numTiles) {
        self._winGame();
      }
    }, 1500 );

    // plus one on the move counter
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
   *
   * You won the game! This function runs the "onGameEnd" callback, which by
   * default clears the game div entirely and shows a "play again" button.
   */
/*
  Memory.prototype._winGame = function() {
    var self = this;
    if (this.options.onGameEnd() === false) {
      this._clearGame();

      alert("zoro 2");
      document.location.href="/memo";
        self.resetGame();

    } else {
      // run callback
      this.options.onGameEnd();
      //alert("coucou");
    }
  }
*/
Memory.prototype._winGame = function() {
  var self = this;

  if (this.options.onGameEnd() === false) {
    this._clearGame();
    firework();

    this.gameMessages.innerHTML = '<h2 class="mg__onend--heading"><span class="icon-trophy"></span></h2>\
      <p class="mg__onend--message">Vous avez gagné votre partie en ' + this.numMoves + ' coups !</p>\
      <button id="mg__onend--restart" class="mg__button"><span class="icon-spinner11"></span></button>';

      //var texteADire =  "Bravo, tu as gagné en "+this.numMoves+" coups ! ";
      //responsiveVoice.speak(texteADire, "French Female");
            var audio = new Audio();
            var texte = "http://translate.google.com/translate_tts?ie=utf-8&tl=fr&q=Bravo%20tu%20as%20gagn%C3%A9%20en%20"+this.numMoves+"%20coups%20!";
      audio.src =texte;
      audio.play();
    this.game.appendChild(this.gameMessages);
    document.getElementById("mg__onend--restart").addEventListener( "click", function(e) {
      document.location.href="/memo";
    });
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
