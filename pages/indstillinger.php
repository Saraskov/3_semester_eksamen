<?php
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');
?>

<?php include('../inc/header.php'); ?>

<?php
    if(!isset($_SESSION['adgang'])){
        echo "<center><h1>Du er ikke logget ind</h1><center>";
        echo "<a href='login.php>Login</a>";
    }



?>

<div class="container <?php if(!isset($_SESSION['adgang'])) echo ' hidden'; ?>">
    <h1>Indstillinger</h1>
    <?php foreach($oplysninger as $oplysning) : ?>
		<div class="">
			<h3><?php echo $oplysning['for_navn']; ?></h3>
			<small>Created on <?php echo $oplysning['efter_navn']; ?> by <?php echo $oplysning['email']; ?></small>
			<p><?php echo $oplysning['post_nr']; ?></p>
		</div>
	<?php endforeach; ?>
</div>

<?php include('../inc/footer.php'); ?>