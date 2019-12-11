let canvas = document.querySelector('#canvas');
let ctx = canvas.getContext('2d');

let size = 40;

let j = 0; //y
let i = 0; //x

let player = -1;
let goal = 3;
let flames = 2;
let sPlayer = 4;

//Tomt array til test af flammer
let msg;
let indx = [];
let dragonWalk = true;
let sPlayerWalk = 0;
let sPlayerWalk2 = 0;

//Score
let scoreText = document.querySelector('#score');
let score = 26;
let point = 1;
let firePoint = 15;

//Tile images variabler
let dragon=new Image();
dragon.src='illustrationer/dragon.png';

let tree=new Image();
tree.src='illustrationer/tree.png';

let grass=new Image();
grass.src='illustrationer/grass.png';

let sheep=new Image();
sheep.src='illustrationer/sheep.png';

let fire=new Image();
fire.src='illustrationer/fire.png';

let treefire=new Image();
treefire.src='illustrationer/treefire.png';

let knight=new Image();
knight.src='illustrationer/knight.png';

//Audio variabler
let goalSound= new Audio('lyde/sheep.mp3');
let bite= new Audio('lyde/dragonBite.mp3');
let hungry = new Audio('lyde/stomachGrowling.mp3');
let fireSound = new Audio('lyde/fire.mp3');

//End game variables
let gameEnd = document.querySelector('#game-background');
let h3Text = document.querySelector('#win-loose');
let msgText = document.querySelector('#endscore');
let button = document.querySelector('#submit');
let scorePHP = document.querySelector('#scorePHP');

//Slår default med scroll fra, så siden ikke scroller mens man spiller
function keyDownTextField(e) {
    var keyCode = e.keyCode;
    if(keyCode==38 || 40) {
      event.preventDefault()
    }
  }