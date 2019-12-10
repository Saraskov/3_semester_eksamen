<?php
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');

?>
<?php include('../inc/header.php'); ?>

<div class="container <?php if(isset($_SESSION['adgang'])) echo 'hidden';?>">
    <h1 class="site-header">Spil</h1>
    <h3 class="text-center">Du skal være logget på for at spille</h3>
    <button class="btn"><a href="registrer.php"><h4>Opret en bruger</h4></a></button>
</div>

<div class="container <?php if(!isset($_SESSION['adgang'])) echo 'hidden'; ?>">
    <h1 class="site-header">Spil</h1>
    <div class="row">
        <a href="games/mazegame/mazegame-1.php" class="col-lg-4 col-md-6 col-12">
            <div class="card gutter">
                <img src="games/mazegame/illustrationer/sultneDrageHel.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">Den lille sultne drage</h3>
                </div>
            </div>
        </a>
        <a href="games/mazegame/mazegame.php" class="col-lg-4 col-md-6 col-12">
            <div class="card gutter">
                <img src="../illustrationer/koala/coverbillede.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">Spil ikke oprettet</h3>
                </div>
            </div>
        </a>
    </div> 
</div>

<?php include('../inc/footer.php'); ?>