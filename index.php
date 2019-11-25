<?php
    require('config/config.php');

    //Create connection to database
    require('config/db.php');

?>

<?php include('inc/header.php'); ?>

<h1>Forside</h1>

<?php
    session_start();
    if(isset($_SESSION['adgang'])){
        echo "<center><a href='pages/profil.php'>Link til profil</a><center>";
    } else {
        echo "<center><p>Du er ikke logget på</p><center>";
    }
?>

<?php include('inc/footer.php'); ?>