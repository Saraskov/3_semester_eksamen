<?php
    session_start();
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');

?>

<?php include('../inc/header.php'); ?>

<?php
    session_destroy();
    alert("du er logget ud");
?>

<?php include('../inc/footer.php'); ?>