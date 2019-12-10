<?php
    require('config/config.php');

    //Create connection to database
    require('config/db.php');

    //POSTS AND USERS CURRENT AVATAR
    //Find data
    $posts_query = 'SELECT user_oplysninger.image, posts.body, posts.author, posts.created_at
                    FROM posts
                    INNER JOIN user_oplysninger
                    ON posts.author = user_oplysninger.user_name
                    ORDER BY posts.created_at DESC';
    $posts_result = mysqli_query($conn, $posts_query);

    //Fetch data
    $posts = mysqli_fetch_all($posts_result, MYSQLI_ASSOC);
    //Free Result
    mysqli_free_result($posts_result); 
    

?>

<?php include('inc/header.php'); ?>

<div class="container">
    <div class="row">
        <img src="<?php echo ROOT_URL; ?>illustrationer/koala/coverbillede.png" class="img-fluid">
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <?php
                    if(isset($_SESSION['adgang'])){
                        echo "<div class='white gutter'>
                                <div class='row'>
                                    <img src='illustrationer/koala/banner.png' alt='banner med de forskellige koalaer' class='img-fluid'>
                                </div>
                                <div class='row'>
                                    <h2 class='center'>Hej ".$login_session."<br>Lad os forsætte eventyrene</h2>
                                </div>
                                <div class='row'>
                                    <button class='btn'><a href='pages/games.php'><h4>Spil</h4></a></button>
                                </div>
                            </div>";
                    } else {
                        echo "<div class='white gutter'>
                                <div class='row'>
                                    <img src='illustrationer/koala/banner.png' alt='banner med de forskellige koalaer' class='img-fluid'>
                                </div>
                                <div class='row'>
                                    <h2 class='center'>Kom med og mød nye eventyrer hos koala-vers</h2>
                                </div>
                                <div class='row'>
                                    <button class='btn'><a href='pages/registrer.php'><h4>Tilmeld</h4></a></button>
                                </div>
                            </div>";
                    }
                ?>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="white comments">
                <h3>Nyeste kommentarer</h3>
                <?php
                    $i = 0;
                    foreach($posts as $post) :
                    if ($i == 3) { break; } ?>
                <div class="card" style="max-width: 540px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row center">
                                <img class="img-comment" src="illustrationer/koala/<?php echo $post['image']; ?>" class="card-img" alt="avatar image">
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
                <button class="btn" onclick="ikkeKlar('Meningen er at javascriptet skal udvide til flere kommentarer')"><h4>Se flere</h4></button>
            </div>
        </div>
    </div>
</div>


<?php include('inc/footer.php'); ?>