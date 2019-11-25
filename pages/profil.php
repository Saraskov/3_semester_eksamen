<?php
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');

    require('../inc/session.php');
?>

<?php include('../inc/header.php'); ?>

<?php
    if(!isset($_SESSION['adgang'])){
        echo "<center><h1>Du er ikke logget ind</h1><center>";
        echo "<a href='login.php>Login</a>";
    }else{
        echo "<h1>Profil</h1>";
        echo "<p>Welcome: <i>".$login_session."</i></p>";
    }
?>

<?php include('../inc/footer.php'); ?>