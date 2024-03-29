let arrayCanvas = [
    [0, 1, 0, 0, 1, 1, 1, 4, 1, 2, 0, 1, 1, 1, 1], 
    [3, 0, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1],
    [0, 1, 0, 2, 0, 0, 1, 0, 1, 1, 0, 1, 1, 0, 1],
    [0, 1, 1, 0, 1, 1, 1, 0, 1, 0, 0, 0, 1, 0, 1],
    [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0],
    [0, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 0, 0],
    [0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 1, 1, 0],
    [0, 1, 0, 0, 1, 1, 1, 0, 1, 1, 0, 1, 0, 2, 0],
    [0, 1, 1, 0, 1, 0, 2, 0, 0, 1, 0, 0, 0, 1, 1],
    [1, 0, 0, 0, 1, 0, 1, 1, 0, 0, 1, 1, 0, 0, 0],
    [0, 1, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 1, 0], 
    [0, 1, 0, 1, 1, 0, 0, 0, 1, 1, 0, 1, 1, 1, 0],
    [0, 1, 0, 0, 0, 0, 1, 0, 1, 1, 0, 2, 0, 1, 1],
    [0, 1, 1, 2, 1, 1, 1, 0, 1, 1, 1, 1, 2, 1, 0],
    [0, 0, 0, 0, 1, 0, 0, 0, 1, -1, 0, 0, 0, 0, 0]
];


function createMaze() {
    for(j = 0; j<arrayCanvas.length; j++){
        for(i = 0; i<arrayCanvas[j].length; i++){
            if(arrayCanvas[j][i] == 1){
                ctx.drawImage(tree, i*size, j*size, size, size);
                //Istedet for nedstående måde at farve på, så har jeg brugt drawImage funktion
                // ctx.fillStyle = "red";
                // ctx.fillRect(i*size, j*size, size, size);
            }else if (arrayCanvas[j][i] == -1){
                player = { j, i };
                ctx.drawImage(dragon, i*size, j*size, size, size);
            }else if (arrayCanvas[j][i] == goal){
                ctx.drawImage(sheep, i*size, j*size, size, size);
            } else if (arrayCanvas[j][i] == 0){
                ctx.drawImage(grass, i*size, j*size, size, size);
            } else if (arrayCanvas[j][i] == flames){
                ctx.drawImage(fire, i*size, j*size, size, size);
            } else if (arrayCanvas[j][i] == sPlayer){
                ctx.drawImage(knight, i*size, j*size, size, size);
            }
        }
    }
}

window.addEventListener("keydown", function(event){
    if(dragonWalk == true){
        playSound()
        //swoosh.play();
        defaultScore();
        switch (event.keyCode) {
            case 38: //Key up
                if (arrayCanvas[player.j - 1][player.i] == 0) {
                    arrayCanvas[player.j - 1][player.i] = -1;
                    arrayCanvas[player.j][player.i] = 0; 

                } else if (arrayCanvas[player.j - 1][player.i] == 1){
                    forestFire();
                } else if (arrayCanvas[player.j - 1][player.i] == 2) {
                    bite.play();
                    arrayCanvas[player.j - 1][player.i] = -1; 
                    arrayCanvas[player.j][player.i] = 0; 
                    flameScore();
                } else if (arrayCanvas[player.j - 1][player.i] == 3) {
                    checkFlames();
                    arrayCanvas[player.j - 1][player.i] = -1; 
                    arrayCanvas[player.j][player.i] = 0;
                } else if (arrayCanvas[player.j - 1][player.i] == sPlayer) {
                    arrayCanvas[player.j - 1][player.i] = sPlayer; 
                    arrayCanvas[player.j][player.i] = 0; 
                    dead();
                }
                    createMaze();
            break;
            case 37: //key left
            if (arrayCanvas[player.j][player.i - 1] == 0) {

                arrayCanvas[player.j][player.i - 1] = -1;
                arrayCanvas[player.j][player.i] = 0;
            } else if (arrayCanvas[player.j][player.i - 1] == 1) {
                forestFire();
            } else if (arrayCanvas[player.j][player.i - 1] == 2) {
                bite.play();
                arrayCanvas[player.j][player.i - 1] = -1;
                arrayCanvas[player.j][player.i] = 0; 
                flameScore();
            } else if (arrayCanvas[player.j][player.i - 1] == 3) {
                checkFlames();

                arrayCanvas[player.j][player.i - 1] = -1; 
                arrayCanvas[player.j][player.i] = 0;
            } else if (arrayCanvas[player.j][player.i - 1] == sPlayer) {
                arrayCanvas[player.j][player.i - 1] = sPlayer; 
                arrayCanvas[player.j][player.i] = 0; 
                dead();
            }
                createMaze();
            break;
            case 39: //key right
            if (arrayCanvas[player.j][player.i + 1] == 0) {
                arrayCanvas[player.j][player.i + 1] = -1;
                arrayCanvas[player.j][player.i] = 0;

            } else if (arrayCanvas[player.j][player.i + 1] == 1) {
                forestFire();
            } else if (arrayCanvas[player.j][player.i + 1] == 2) {
                bite.play();
                arrayCanvas[player.j][player.i + 1] = -1; 
                arrayCanvas[player.j][player.i] = 0; 
                flameScore();
            } else if (arrayCanvas[player.j][player.i + 1] == 3) {
                arrayCanvas[player.j][player.i + 1] = -1;
                arrayCanvas[player.j][player.i] = 0;
                checkFlames();
            } else if (arrayCanvas[player.j][player.i + 1] == sPlayer){
                arrayCanvas[player.j][player.i + 1] = sPlayer; 
                arrayCanvas[player.j][player.i] = 0; 
                dead();
            }
                createMaze();
            break;
            case 40: //key down
            if (arrayCanvas[player.j + 1][player.i] == 0) {
                arrayCanvas[player.j + 1][player.i] = -1; 
                arrayCanvas[player.j][player.i] = 0;

            } else if (arrayCanvas[player.j + 1][player.i] == 1) {
                forestFire();
            } else if (arrayCanvas[player.j + 1][player.i] == 2) {
                bite.play();
                arrayCanvas[player.j + 1][player.i] = -1;
                arrayCanvas[player.j][player.i] = 0;
                flameScore();
            } else if (arrayCanvas[player.j + 1][player.i] == 3) {
                checkFlames();
                arrayCanvas[player.j + 1][player.i] = -1; 
                arrayCanvas[player.j][player.i] = 0; 
            } else if (arrayCanvas[player.j + 1][player.i] == sPlayer){
                arrayCanvas[player.j + 1][player.i] = sPlayer; 
                arrayCanvas[player.j][player.i] = 0; 
                dead();
            }
                createMaze();
            break;
            default:
                console.log(event.keyCode);
        }  
    }else{
        return false;
    }
})

//Funktion der tjekker om der findes et 2 tal (flamme) i arrayet
//Hvis der er, så taber man
function checkFlames(){
    for(j = 0; j<arrayCanvas.length; j++){
        for(i = 0; i<arrayCanvas[j].length; i++){
            if (arrayCanvas[j][i] === flames){
            indx = [j,i];
            break;
            }
        }
    }
    if(typeof indx[0] == "undefined" || typeof indx[1] == "undefined"){
        goalSound.play();
        score += point;
        msg = "Din drage er mæt!";
        endGame(msg, 1);
    } else {
        hungry.play();
        msg="Du skal bruge mere ild, for at spise fåret!";
        setTimeout(function(){
            endGame(msg, 0);
        },500);
    }
}

//Skovbrand
function forestFire() {
    fireSound.play();
    tree.src = treefire.src;
    createMaze();
    
    msg = "Du startede en skovbrænd!"
    setTimeout(function(){
        endGame(msg, 0);
    },500);
}

//funktion der siger -1 hver gang man trykker på en keyboard tast
function defaultScore(){
    if (score <= 0) {
        msg = "Du har ikke flere træk tilbage";
        setTimeout(function(){
            endGame(msg, 0);
        },500);
    } else {
        score -= point;
        scoreText.innerHTML = score;
    }
}

//funktion der siger +15 når man går ind i en flamme
function flameScore() {
    score += firePoint;
    scoreText.innerHTML = score;
}

//Swoosh lyd når dragen går
function playSound(){
    let soundPlace = document.querySelector('#swoosh');
    soundPlace.setAttribute("src", "lyde/swoosh.mp3");
    soundPlace.play();
}

//sPlayer/Knight funktioner
var startKnight = setInterval(knightWalk, 1500);


function knightWalk(){
    sPlayerWalk++;
    if (sPlayerWalk < 5){
        for(j = 0; j<arrayCanvas.length; j++){
            for(i = 0; i<arrayCanvas[j].length; i++){
                if (arrayCanvas[j][i] == sPlayer){
                    if(arrayCanvas[j + 1][i] == 0){
                        arrayCanvas[j + 1][i] = 4;
                        arrayCanvas[j][i] = 0;
                    } else if (arrayCanvas[j + 1][i] == -1){
                        arrayCanvas[j + 1][i] = 4;
                        arrayCanvas[j][i] = 0;
                        dead();
                    }
                    
                    createMaze();
                }
            }
        }
    } else if (sPlayerWalk < 9){
        for(j = 0; j<arrayCanvas.length; j++){
            for(i = 0; i<arrayCanvas[j].length; i++){
                if (arrayCanvas[j][i] == 4){
                    if(arrayCanvas[j - 1][i] == 0){
                        arrayCanvas[j - 1][i] = 4;
                        arrayCanvas[j][i] = 0; 
                    } else if (arrayCanvas[j - 1][i] == -1){
                        arrayCanvas[j - 1][i] = 4;
                        arrayCanvas[j][i] = 0;
                    }
                    createMaze();
                }
            }
        }
    } else if (sPlayerWalk > 8) {
        sPlayerWalk = 0;
    }
}

function dead(){
    goalSound.play(); //Lyden skal ændres!
    msg = "Du blev dræbt af ridderen";
    clearInterval(startKnight);
    endGame(msg, 0);
}

//End game
function endGame(msg, result){
    gameEnd.classList.remove('hidden');
    h3Text.innerHTML = msg;
    dragonWalk = false;

    if(result == 0){
        msgText.innerHTML = "Bedre held næste gang";
        button.innerHTML = "<h4>Prøv igen</h4>";
        button.value = "0";
    }else if(result == 1){
        button.innerHTML = "<h4>Næste bane</h4>";
        scorePHP.value = score;
        msgText.innerHTML = "Din score er: " + score;
        button.value = "1";
    }
}


window.addEventListener("load", createMaze);
window.addEventListener("load", defaultScore);
window.addEventListener("keydown", keyDownTextField, false);