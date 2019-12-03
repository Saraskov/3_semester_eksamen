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

        $query = "INSERT INTO posts(body, author, avatar) VALUES ('$body', '$login_session', '$avatar')";

        if(!mysqli_query($conn, $query)){
			echo 'ERROR: '. mysqli_error($conn);
		}
    }

    //POSTS AND USERS CURRENT AVATAR
    //Find data
    $posts_query = "SELECT *
                    FROM posts
                    WHERE author = '$login_session'
                    ORDER BY created_at DESC";
    $posts_result = mysqli_query($conn, $posts_query);

    //Fetch data
    $posts = mysqli_fetch_all($posts_result, MYSQLI_ASSOC);
    //Free Result
    mysqli_free_result($posts_result);

    //USERS HIGHSCORE
    $mazehighscore_query = "SELECT * FROM mazescore WHERE user_name = '$login_session' ORDER BY score DESC";
    $mazehighscore_result = mysqli_query($conn, $mazehighscore_query);
    $mazehighscores = mysqli_fetch_all($mazehighscore_result, MYSQLI_ASSOC);
    mysqli_free_result($mazehighscore_result);
?>

<?php
    if(!isset($_SESSION['adgang'])){
        echo "<center><h1>Du er ikke logget ind</h1><center>";
        echo "<a href='login.php>Login</a>";
    }
?>

<div class="container <?php if(!isset($_SESSION['adgang'])) echo 'hidden'; ?>">
    <h1 class="site-header">Profil</h1>
    
    <div class="comments">
        <div class="card">
            <div class="row">
                <div class="col-md-4">
                    <img class="transparent" src="<?php echo ROOT_URL;?>illustrationer/koala/<?php echo $avatar; ?>" alt='avatar image'>
                </div>
                <div class="col-md-8 white text-left">
                    <?php foreach($oplysninger as $oplysning) : ?>
                        <h3><?php echo $login_session; ?></h3>
                        <p><?php echo "Navn: ".$oplysning['for_navn']." ".$oplysning['efter_navn']; ?> </p>
                        <p><?php echo "Email: ".$oplysning['email']; ?></p>
                        <p><?php echo "Hjemby: ".$oplysning['post_nr']." ".$oplysning['by_navn']; ?></p>
                        <a href="indstillinger.php"><small>Rediger profil</small></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="white highscore col-6">
            <h3>Dine Highscores</h3>
            <div class="white">
                <div class="row">
                    <div class="col-3">
                        <img src="games/mazegame/illustrationer/dragon.png">
                    </div>
                    <div class="col-6">
                        <h4>Den lille sultne drage</h4>
                    </div>
                    <div class="col-3">
                    <img src="games/mazegame/illustrationer/knight.png">
                    </div>
                </div>
                <?php
                    $i = 1;
                    foreach($mazehighscores as $mazehighscore) :
                    if ($i == 4) { break; } ?>
                    <div class="card">
                        <div class="row">
                            <div class="col-1">
                                <h2><?php echo $i ?></h2>
                            </div>
                            <div class="col-4">
                                <img src="<?php echo ROOT_URL; ?>illustrationer/koala/<?php echo $avatar; ?>" class="avatar" alt="avatar image">
                            </div>
                            <div class="col-7">
                                <div class="text-left">
                                    <h3><?php echo $mazehighscore['user_name']; ?></h3>
                                    <h5><?php echo $mazehighscore['score']; ?> point</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <div class="col-6">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="form-group transparent">
                    <label><h3>Nyt oplæg</h3></label>
                    <textarea type="text" name="body" class="form-control" placeholder="Del et tip med resten af spillerne"></textarea>
                </div>
                <button name="submit" class="btn"><h4>Send</h4></button>
            </form>
            <div class="white comments">
            <h3>Dine oplæg</h3>
            <?php
                $i = 0;
                foreach($posts as $post) :
                if ($i == 3) { break; } ?>
            <div class="card" style="max-width: 540px;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row center">
                            <img class="img-comment" src="../illustrationer/koala/<?php echo $post['avatar']; ?>" class="card-img" alt="avatar image">
                        </div>
                        <div class="row center">
                            <small class="text-muted">Created on <?php echo $post['created_at']; ?></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4><?php echo $post['author']; ?></h4>
                            <p><?php echo $post['body']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                $i++;
                endforeach; ?>
            <button class="btn"><a href='#'><h4>Se flere</h4></a></button>
            </div>
        </div>
    </div>
</div>

<?php include('../inc/footer.php'); ?>