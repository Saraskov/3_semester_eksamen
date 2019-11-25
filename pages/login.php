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
    <div class="form-group">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <fieldset>
                <legend><h1>Login</h1></legend>
                <label for="username"><h3>Username</h3></label>
                <input type="text" class="form-control" name="username">
                <label for="password"><h3>Password</h3></label>
                <input type="text" class="form-control" name="password">
            </fieldset>
            <br>
            <button type="submit" class="btn btn-primary" name="submit"><h5>Login</h5></button>
        </form>
        <h3><?= $output ?></h3>
    </div>
</div>

<?php include('../inc/footer.php'); ?>