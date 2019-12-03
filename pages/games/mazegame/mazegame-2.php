<?php
    require('../../../config/config.php');

    //Create connection to database
    require('../../../config/db.php');

    if(isset($_GET['currentScore'])){
        $currentScore = (int)mysqli_real_escape_string($conn, $_GET['currentScore']);
    }
    

    //End game
        if(isset($_GET['submit'])){
            $level2Score = mysqli_real_escape_string($conn, $_GET['player-end-score']);
            $login_session = mysqli_real_escape_string($conn, $_GET['user_name']);
            $oldCurrentScore = mysqli_real_escape_string($conn, $_GET['currentScore']);
            if($currentScore != 0){
                $currentScore = $oldCurrentScore + $level2Score;
                $sql = "INSERT INTO mazescore(user_name, score) values('$login_session', '$currentScore')";
                $result = mysqli_query($conn, $sql) or die ("Query virker overhovedet ikke!");
                // header("location:mazegame-3.php?currentScore=".$_GET['currentScore2']);
            }
        }
?>

<?php include('../../../inc/header.php'); ?>

<div class="container <?php if(isset($_SESSION['adgang'])) echo 'hidden'; ?>"> <!-- jeg vil gerne tjekke om $currentScore er undefined -->
    <h1 class="site-header"> Du skal være logget ind for at spille</h1>
</div>

<div class="container <?php if(!isset($_SESSION['adgang']) || isset($_GET['currentScore'])) echo ' hidden'; ?>"> <!-- jeg vil gerne tjekke om $currentScore er undefined -->
    <h1 class="site-header">Beklager, men du skal starte forfra</h1>
    <button class="btn"><a href="mazegame-1.php"><h4>Start forfra</h4></a></button>
</div>

<div class="container <?php if(!isset($_SESSION['adgang']) || !isset($_GET['currentScore'])) echo ' hidden'; ?>">
    <h1 class="site-header">Den lille sultne drage</h1>
    <h3 class="mobile text-center">OBS<br>Dette spil er ikke lavet til mobil og tablet.<br>Beklager</h3>
    <div class="row gutter no_mobile">
        <div class="col-xl-7 col-lg-8 col-md-12 col-12">
            <h4>Din score er: <span id="score"></span></h4>
            <!-- Det er sådan man laver et canvas -->
            <div class="game">
                <canvas width="600" height="600" id="canvas"></canvas>
                <div id="game-background" class="hidden">
                    <div class="white gutter">
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                            <div class="form-group transparent">
                                <h3 id="win-loose"></h3>
                                <p id="endscore"></p>
                                <input type="hidden" name="user_name" value="<?php echo $login_session ?>">
                                <input type="hidden" name="currentScore" value="<?php echo $currentScore?>">
                                <input id="scorePHP" type="hidden" name="player-end-score" value="0">
                            </div>
                            <div class="row">
                                <button type="submit" class="btn" name="submit" id="submit"><a><h4></h4></a></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-4 col-md-12 col-12">
            <?php require('../../../inc/games/mazehighscore.php') ?>
            <div class="row white">
                <h4>Spilleregler</h4>
                <p class="text-left">Flyt dragen med piletasterne. Den har brug for mere ild for at spise fåret. Men pas på skoven er tør, så der kan hurtigt begynde skovbrænd.</p>
            </div>
        </div>
    </div>
</div>

    <audio id="swoosh"></audio>
    <script  src="mazegame_general.js"></script>
    <script src="level2.js"></script>

    
<?php include('../../../inc/footer.php'); ?>