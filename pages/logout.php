<?php
    session_start();
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');

?>

<?php include('../inc/header.php'); ?>

<?php
    session_destroy();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-sm-0"></div>
        <div class="col-lg-6 col-sm-12 center">
            <div class="white gutter">
                <h3 class="center">Du er ved at logge ud</h3>
                <button class="btn"><a href="../index.php"><h4>Logout</h4></a></button>
            </div>
        </div>
        <div class="col-lg-3 col-sm-0"></div>
    </div>
</div>

<?php include('../inc/footer.php'); ?>