<?php
    require('../../../config/config.php');

    //Create connection to database
    require('../../../config/db.php');
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
            <canvas width="600" height="600" id="canvas"></canvas>
        </div>
        <div class="col-xl-5 col-lg-4 col-md-12 col-12">
            <div class="row white highscore">
                <div class="col-12">
                    <h2>Highscore</h2>
                </div>
                <div class="card col-12">
                    <div class="row">
                        <div class="col-1">
                            <h2>1</h2>
                        </div>
                        <div class="col-4">
                        <img src="<?php echo ROOT_URL; ?>illustrationer/koala/pr_viking.png" class="avatar" alt="avatar image">
                        </div>
                        <div class="col-7">
                            <div class="text-left">
                                <h3>Tester</h3>
                                <h5>42 point</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-12">
                    <div class="row">
                        <div class="col-1">
                            <h2>2</h2>
                        </div>
                        <div class="col-4">
                        <img src="<?php echo ROOT_URL; ?>illustrationer/koala/pr_viking.png" class="avatar" alt="avatar image">
                        </div>
                        <div class="col-7">
                            <div class="text-left">
                                <h3>Tester</h3>
                                <h5>42 point</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-12">
                    <div class="row">
                        <div class="col-1">
                            <h2>3</h2>
                        </div>
                        <div class="col-4">
                        <img src="<?php echo ROOT_URL; ?>illustrationer/koala/pr_viking.png" class="avatar" alt="avatar image">
                        </div>
                        <div class="col-7">
                            <div class="text-left">
                                <h3>Tester</h3>
                                <h5>42 point</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row white">
                <h4>Spilleregler</h4>
                <p class="text-left">Flyt dragen med piletasterne. Den har brug for mere ild for at spise fåret. Men pas på skoven er tør, så der kan hurtigt begynde skovbrænd.</p>
            </div>
        </div>
    </div>
</div>

    <audio id="swoosh"></audio>
    <script  src="mazegame.js"></script>

    
<?php include('../../../inc/footer.php'); ?>