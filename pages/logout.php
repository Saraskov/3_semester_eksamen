<?php
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');

?>

<?php include('../inc/header.php'); ?>

<?php
    session_start();
    session_destroy();
    header("location:". ROOT_URL . "index.php");
?>

<?php include('../inc/footer.php'); ?>