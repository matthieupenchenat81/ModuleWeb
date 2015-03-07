;(function( window ) {

  'use strict';

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

  function Memory( options ) {
    this.options = extend( {}, this.options );
    extend( this.options, options );
    this._init();
  }

  /**
   * Memory options
   *
   * Memory default options. Available options are:
   *
   * wrapperID: the element in which Memory gets built
   * cards: the array of cards
   * onGameStart: callback for when game starts
   * onGameEnd: callback for when game ends
   */
/*
  Memory.prototype.options = {
    wrapperID : "container",
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
  }
*/
  /**
   * Memory _init - initialise Memory
   *
   * Creates all the game content areas, adds the id's and classes, and gets
   * ready for game setup.
   */

  Memory.prototype._init = function() {
    this.game = document.createElement("div");
    this.game.id = "mg";
    this.game.className = "mg";
    document.getElementById(this.options.wrapperID).appendChild(this.game);

    this.gameMeta = document.createElement("div");
    this.gameMeta.className = "mg__meta clearfix";

    this.gameStartScreen = document.createElement("div");
    this.gameStartScreen.id = "mg__start-screen";
    this.gameStartScreen.className = "mg__start-screen";

    this.gameWrapper = document.createElement("div");
    this.gameWrapper.id = "mg__wrapper";
    this.gameWrapper.className = "mg__wrapper";
    this.gameContents = document.createElement("div");
    this.gameContents.id = "mg__contents";
    this.gameWrapper.appendChild(this.gameContents);

    this.gameMessages = document.createElement("div");
    this.gameMessages.id = "mg__onend";
    this.gameMessages.className = "mg__onend";

    this._setupGame();
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

  Memory.prototype._setupGame = function() {
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
  //  var niveauChoisi = 0;
  //  if (this.chosenLevel) == "1" {niveauChoisi = '<i class="fa fa-star-o"></i>';} if(this.chosenLevel) == "2" {niveauChoisi = '<i class="fa fa-star-half-o"></i>';} else {niveauChoisi = '<i class="fa fa-star"></i>';}

    this.gameMetaHTML = '<div class="mg__meta--left">\
      <span class="mg__meta--level">Niveau: \
      <span id="mg__meta--level">' + this.chosenLevel + '</span>\
      </span>\
      <span class="mg__meta--moves">Coups: \
      <span id="mg__meta--moves">' + this.numMoves + '</span>\
      </span>\
      </div>\
      <div class="mg__meta--right">\
      <button id="mg__button--restart" class="mg__button"><span class="glyphicon glyphicon-repeat"></span></button>\
      </div>';
    this.gameMeta.innerHTML = this.gameMetaHTML;
    this.game.appendChild(this.gameMeta);



//  <button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-star-empty"></span> </button>

    this.gameStartScreenHTML = '<h2 class="mg__start-screen--heading">Welcome to the Memory Game!</h2>\
      <h3 class="mg__start-screen--sub-heading">Choisir niveau</h3>\
      <ul class="mg__start-screen--level-select">\
      <span data-level="1"><button class="btn btn-success fa fa-star-o"></button></span>\
      <span data-level="2"><button  class="btn btn-warning fa fa-star-half-o"></button></span>\
      <span data-level="3"><button  class="btn btn-danger fa fa-star"></button></span>\
      </ul>';
    //Memory.prototype._setupGameWrapper(1);
    //this._gamePlay();
    //this._setupGame();
    this.gameStartScreen.innerHTML = this.gameStartScreenHTML;
    this.game.appendChild(this.gameStartScreen);

    document.getElementById("mg__button--restart").addEventListener( "click", function(e) {
      self.resetGame();
    });

    this._startScreenEvents();
  }

  /**
   * Memory _startScreenEvents
   *
   * We're now listening for events on the start screen. That is, we're waiting
   * for when a user chooses a level.
   */

  Memory.prototype._startScreenEvents = function() {
    var levelsNodes = this.gameStartScreen.querySelectorAll("ul.mg__start-screen--level-select span");
    for ( var i = 0, len = levelsNodes.length; i < len; i++ ) {
      var levelNode = levelsNodes[i];
      this._startScreenEventsHandler(levelNode);
    }
  };

  /**
   * Memoery _startScreenEventsHandler
   *
   * A helper function to handle the click of the level inside the events
   * function.
   */

  Memory.prototype._startScreenEventsHandler = function(levelNode) {
    var self = this;
    levelNode.addEventListener( "click", function(e) {
      if (self.gameState === 1) {
        self._setupGameWrapper(this);
      }
    });
  }

  /**
   * Memory _setupGameWrapper
   *
   * This function sets up the game wrapper, which is where the actual memory
   * tiles will reside and where all the game play happens.
   */

  Memory.prototype._setupGameWrapper = function(levelNode) {
    this.level = levelNode.getAttribute("data-level");
    this.gameStartScreen.parentNode.removeChild(this.gameStartScreen);
    this.gameContents.className = "mg__contents mg__level-"+this.level;
    this.game.appendChild(this.gameWrapper);

    this.chosenLevel = this.level;
    document.getElementById("mg__meta--level").innerHTML = this.chosenLevel;

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
     else { this.gridX = 4; this.gridY=2 ;  }
  //  this.gridY = this.gridX ;
    this.numTiles = this.gridX * this.gridY;
    //this.halfNumTiles = this.gridX;
    this.halfNumTiles = this.numTiles/2;
    this.newCards = [];
    for ( var i = 0; i < this.halfNumTiles; i++ ) {
      this.newCards.push(this.cards[i], this.cards[i]);
    }
    this.newCards = shuffle(this.newCards);
    this.tilesHTML = '<div class="col-xs-11 col-sm-10 col-lg-12">';
    for ( var i = 0; i < this.numTiles; i++  ) {
      var n = i + 1;
      this.tilesHTML += '<div class="mg__tile mg__tile-' + n + '">\
        <div class="mg__tile--inner" data-id="' + this.newCards[i]["id"] + '">\
        <span class="mg__tile--outside"></span>\
        <span class="mg__tile--inside"><img src="' + this.newCards[i]["img"] + '"></span>';
        this.tilesHTML +='</div>';
        this.tilesHTML +='</div>';
      /*  if(this.level == 1 && n == 2){
          this.tilesHTML +="</tr></pre><tr>";
        }*/

    }
    this.tilesHTML +="</div>";
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
    }, 900 );

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
    this.moveCounterUpdate = document.getElementById("mg__meta--moves").innerHTML = this.numMoves;
  };

  /**
   * Memory _clearGame
   *
   * This function clears the game wrapper, by removing it from the game div. It
   * allows us to rerun setupGame, and clears the air for other info like
   * victory messages etc.
   */

  Memory.prototype._clearGame = function() {
    if (this.gameMeta.parentNode !== null) this.game.removeChild(this.gameMeta);
    if (this.gameStartScreen.parentNode !== null) this.game.removeChild(this.gameStartScreen);
    if (this.gameWrapper.parentNode !== null) this.game.removeChild(this.gameWrapper);
    if (this.gameMessages.parentNode !== null) this.game.removeChild(this.gameMessages);
  }

  /**
   * Memoray _winGame
   *
   * You won the game! This function runs the "onGameEnd" callback, which by
   * default clears the game div entirely and shows a "play again" button.
   */

  Memory.prototype._winGame = function() {
    var self = this;
    if (this.options.onGameEnd() === false) {
      this._clearGame();
      this.gameMessages.innerHTML = '<h2 class="mg__onend--heading"><i class="fa fa-trophy"></i></h2>\
        <p class="mg__onend--message">Vous avez gagné votre partie en ' + this.numMoves + ' coups.</p>\
        <button id="mg__onend--restart" class="mg__button"><i class="fa fa-refresh"></i></button>';
      this.game.appendChild(this.gameMessages);
      document.getElementById("mg__onend--restart").addEventListener( "click", function(e) {
        self.resetGame();
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
