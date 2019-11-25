<?php
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');

?>
<?php include('../inc/header.php'); ?>

<h1>Games</h1>
<?php
    session_start();
    if(isset($_SESSION['adgang'])){
        echo "<center><h1>Så er det spille tid!</h1><center>";
    } else {
        echo "<center><h1>Fuck af</h1><center>";
    }
?>

<?php include('../inc/footer.php'); ?>