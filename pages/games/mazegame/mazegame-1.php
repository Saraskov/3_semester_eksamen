<?php
session_start();
    require('../../../config/config.php');

    //Create connection to database
    require('../../../config/db.php');    
    
    //End game
        if(isset($_GET['submit'])){
            $currentScore = mysqli_real_escape_string($conn, $_GET['currentScore']);
            $login_session = mysqli_real_escape_string($conn, $_GET['user_name']);

            if($currentScore != 0){
                $sql = "INSERT INTO mazescore(user_name, score) values('$login_session', '$currentScore')";
                $result = mysqli_query($conn, $sql) or die ("Query virker overhovedet ikke!");
                header("location:mazegame-2.php?currentScore=".$_GET['currentScore']);
            }
        }
?>

<?php include('../../../inc/header.php'); ?>

<div class="container <?php if(isset($_SESSION['adgang'])) echo 'hidden' ?>">
    <h3> Du skal være logget ind for at spille</h3>
</div>

<div class="container <?php if(!isset($_SESSION['adgang'])) echo ' hidden'; ?>">
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
                                <input id="scorePHP" type="hidden" name="currentScore" value="0">
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
    <script src="level1.js"></script>

    
<?php include('../../../inc/footer.php'); ?>