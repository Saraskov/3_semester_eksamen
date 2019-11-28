<?php
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');
?>

<?php include('../inc/header.php'); ?>

<?php
    //Check for submit
	if(isset($_POST['submit'])){
        $body = mysqli_real_escape_string($conn, $_POST['body']);

        $query = "INSERT INTO posts(body, author) VALUES ('$body', '$login_session')";

        if(!mysqli_query($conn, $query)){
			echo 'ERROR: '. mysqli_error($conn);
		}
    }
?>

<?php
    if(!isset($_SESSION['adgang'])){
        echo "<center><h1>Du er ikke logget ind</h1><center>";
        echo "<a href='login.php>Login</a>";
    }
?>

<div class="container <?php if(!isset($_SESSION['adgang'])) echo 'hidden'; ?>">
    <h1>Profil</h1>
    <div class="card">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img class='avatar' src="<?php echo ROOT_URL;?>illustrationer/koala/<?php echo $avatar; ?>" alt='avatar image'>
            </div>
            <div class="col-md-8">
            <?php foreach($oplysninger as $oplysning) : ?>
                    <h3><?php echo $login_session; ?></h3>
                    <p><?php echo "Navn: ".$oplysning['for_navn']." ".$oplysning['efter_navn']; ?> </p>
                    <p><?php echo "Email: ".$oplysning['email']; ?></p>
                    <p><?php echo "Hjemby: ".$oplysning['post_nr']." ".$oplysning['by_navn']; ?></p>
                    <a href="indstillinger.php"><p>Rediger profil</p></a>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="card col-6">
            <h1>Noget indholde her</h1>
        </div>
        <div class="col-6">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label>Body</label>
                    <textarea type="text" name="body" class="form-control" placeholder="Del et tip med resten af spillerne"></textarea>
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    
    </div>
</div>

<?php include('../inc/footer.php'); ?>