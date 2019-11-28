<?php
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');

    $output = "";

    if(isset($_POST['submit'])){
        $user_name = mysqli_real_escape_string($conn, $_POST['username']);
        $pass_word = mysqli_real_escape_string($conn, $_POST['password']);

        $salt = "ksdnfklgnhtiipo40" . $pass_word . "kjlhfdsgiofjg4ijgd";
        $hashed = hash('sha512', $salt);

        $sql = "SELECT * FROM login WHERE user_name = '$user_name' AND pass = '$hashed'";
        $result = mysqli_query($conn, $sql) or die("Query virker ikke!: " . $sql);

        if (mysqli_num_rows($result) == 1){
            session_start();
            $_SESSION['adgang'] = "$user_name";

            header("location:games.php");
        } else {
            $output = "Forkert login!";
        }

    }



?>
<?php include('../inc/header.php'); ?>

<div class="container">
    <h1 class="site-header">Login</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="username"><h4>Brugernavn</h4></label>
                        <input type="text" class="form-control" name="username">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="password"><h4>Kodeord</h4></label>
                        <input type="text" class="form-control" name="password">
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn" name="submit"><h4>Login</h4></button>
        </form>
        <h4><?= $output ?></h4>
</div>

<?php include('../inc/footer.php'); ?>