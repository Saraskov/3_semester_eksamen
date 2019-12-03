<?php
    //Fetch Mazegame scores
        //Find data
        $score_query = "SELECT mazescore.score, mazescore.user_name, user_oplysninger.image
                        FROM mazescore, user_oplysninger
                        WHERE mazescore.user_name = user_oplysninger.user_name
                        ORDER BY mazescore.score DESC";
        $score_result = mysqli_query($conn, $score_query);
        $scores = mysqli_fetch_all($score_result, MYSQLI_ASSOC);
?>

<div class="row white highscore">
    <div class="col-12">
        <h2>Highscore</h2>
    </div>
    <?php
        $i = 1;
        foreach($scores as $score) :
        if ($i == 4) { break; } ?>
    <div class="card col-12">
        <div class="row">
            <div class="col-1">
                <h2><?php echo $i ?></h2>
            </div>
            <div class="col-4">
                <img src="<?php echo ROOT_URL; ?>illustrationer/koala/<?php echo $score['image']; ?>" class="avatar" alt="avatar image">
            </div>
            <div class="col-7">
                <div class="text-left">
                    <h3><?php echo $score['user_name']; ?></h3>
                    <h5><?php echo $score['score']; ?> point</h5>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $i++;
        endforeach; ?> 
</div>