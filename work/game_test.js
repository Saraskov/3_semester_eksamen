let canvas = document.querySelector('#canvas');
let ctx = canvas.getContext('2d');

let arrayCanvas = [
    [-1, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0],
    [0, 0, 3, 0, 0, 0],
    [0, 0, 0, 0, 0, 0],
    [0, 2, 0, 0, 4, 0],
    [0, 0, 0, 0, 0, 0]
];

let size = 100;

let j = 0; //y
let i = 0; //x

let warrior = 4;
let player = -1;

function createMaze() {
    for(j = 0; j<arrayCanvas.length; j++){
        for(i = 0; i<arrayCanvas[j].length; i++){
            if(arrayCanvas[j][i] == -1){
                ctx.fillStyle = "red";
                ctx.fillRect(i*size, j*size, size, size);
            }else if(arrayCanvas[j][i] == 4){
                ctx.fillStyle = "blue";
                ctx.fillRect(i*size, j*size, size, size);
            }else if(arrayCanvas[j][i] == 0){
                ctx.fillStyle = "yellow";
                ctx.fillRect(i*size, j*size, size, size);
            }
        }
    }
}

function warriorWalk(){
    console.log("Test");
    for(j = 0; j<arrayCanvas.length; j++){
        for(i = 0; i<arrayCanvas[j].length; i++){
            console.log("test2");
            if(arrayCanvas[j][i] == 4){
                arrayCanvas[warrior.j - 1][warrior.i = -1];
                arrayCanvas[warrior.j][warrior.i] = 0;
                createMaze();
            }
        }
    }
}

window.addEventListener("keydown", function(event){
    // playSound()
    //swoosh.play();
    // defaultScore();
    switch (event.keyCode) {
        case 38: //Key up
            if (arrayCanvas[player.j - 1][player.i] == 0) {
                arrayCanvas[player.j - 1][player.i] = -1;
                arrayCanvas[player.j][player.i] = 0; 

            } else if (arrayCanvas[player.j - 1][player.i] == 1){
                // forestFire();
            } else if (arrayCanvas[player.j - 1][player.i] == 2) {
                // bite.play();
                arrayCanvas[player.j - 1][player.i] = -1; 
                arrayCanvas[player.j][player.i] = 0; 
                // flameScore();
            } else if (arrayCanvas[player.j - 1][player.i] == 3) {
                // checkFlames();
                arrayCanvas[player.j - 1][player.i] = -1; 
                arrayCanvas[player.j][player.i] = 0;
            }
                createMaze();
        break;
        case 37: //key left
        if (arrayCanvas[player.j][player.i - 1] == 0) {

            arrayCanvas[player.j][player.i - 1] = -1;
            arrayCanvas[player.j][player.i] = 0;
        } else if (arrayCanvas[player.j][player.i - 1] == 1) {
            // forestFire();
        } else if (arrayCanvas[player.j][player.i - 1] == 2) {
            // bite.play();
            arrayCanvas[player.j][player.i - 1] = -1;
            arrayCanvas[player.j][player.i] = 0; 
            // flameScore();
        } else if (arrayCanvas[player.j][player.i - 1] == 3) {
            checkFlames();

            arrayCanvas[player.j][player.i - 1] = -1; 
            arrayCanvas[player.j][player.i] = 0;
        }
            createMaze();
        break;
        case 39: //key right
        if (arrayCanvas[player.j][player.i + 1] == 0) {
            arrayCanvas[player.j][player.i + 1] = -1;
            arrayCanvas[player.j][player.i] = 0;

        } else if (arrayCanvas[player.j][player.i + 1] == 1) {
            // forestFire();
        } else if (arrayCanvas[player.j][player.i + 1] == 2) {
            // bite.play();
            arrayCanvas[player.j][player.i + 1] = -1; 
            arrayCanvas[player.j][player.i] = 0; 
            // flameScore();
        } else if (arrayCanvas[player.j][player.i + 1] == 3) {
            // checkFlames();

            arrayCanvas[player.j][player.i + 1] = -1;
            arrayCanvas[player.j][player.i] = 0; 
        }
            createMaze();
        break;
        case 40: //key down
        if (arrayCanvas[player.j + 1][player.i] == 0) {
            arrayCanvas[player.j + 1][player.i] = -1; 
            arrayCanvas[player.j][player.i] = 0;

        } else if (arrayCanvas[player.j + 1][player.i] == 1) {
            // forestFire();
        } else if (arrayCanvas[player.j + 1][player.i] == 2) {
            bite.play();
            arrayCanvas[player.j + 1][player.i] = -1;
            arrayCanvas[player.j][player.i] = 0;
            // flameScore();
        } else if (arrayCanvas[player.j + 1][player.i] == 3) {
            // checkFlames();
            arrayCanvas[player.j + 1][player.i] = -1; 
            arrayCanvas[player.j][player.i] = 0; 
        }
            createMaze();
        break;
        default:
            console.log(event.keyCode);
    }
});

createMaze();
window.addEventListener("keydown", warriorWalk());