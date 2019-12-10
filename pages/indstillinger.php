<?php
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');

    $class="hidden";
    $msg="";

    if(isset($_POST['generel'])){
        $user_name = mysqli_real_escape_string($conn, $_POST['username']);
        $for_navn = mysqli_real_escape_string($conn, $_POST['fornavn']);
        $efter_navn = mysqli_real_escape_string($conn, $_POST['efternavn']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $post_nr = mysqli_real_escape_string($conn, $_POST['postnr']);
        $by_navn = mysqli_real_escape_string($conn, $_POST['by']);

        //Tjekker hvis boksene er tomme
        if(empty($for_navn) || empty($efter_navn)|| empty($email) || empty($post_nr) || empty($by_navn)){
            header("Location: indstillinger.php?error=emptyfields&fornavn=".$fornavn."&efternavn=".$efternavn."&email=".$email."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }elseif(!preg_match("/^[a-zA-Z]*$/", $for_navn)){
            header("Location: indstillinger.php?error=invalidFornavn&efternavn=".$efternavn."&email=".$email."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }elseif(!preg_match("/^[a-zA-Z]*$/", $efter_navn)){
            header("Location: indstillinger.php?error=invalidEfternavn&fornavn=".$fornavn."&email=".$email."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: indstillinger.php?error=invalidmail&fornavn=".$fornavn."&efternavn=".$efternavn."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }elseif(!preg_match("/^[0-9]*$/", $post_nr)){
            header("Location: indstillinger.php?error=invalidPostnr&fornavn=".$fornavn."&efternavn=".$efternavn."&email=".$email."&by=".$by_navn."&telenr=".$telenr);
            exit(); 
        }elseif(!preg_match("/^[a-zA-Z]*$/", $by_navn)){
            header("Location: indstillinger.php?error=invalidBy&fornavn=".$fornavn."&efternavn=".$efternavn."&email=".$email."&postnr=".$postnr."&telenr=".$telenr);
            exit();
        }else{                 
            $sql = "UPDATE user_oplysninger
                    SET for_navn='$for_navn',
                    efter_navn='$efter_navn',
                    email='$email',
                    post_nr='$post_nr',
                    by_navn='$by_navn'
                    WHERE user_name = '$user_name'";
            if(mysqli_query($conn, $sql)){
                $class = "alert-success alert";
                $msg = "Din profil er opdateret";
            }else{
                $class = "alert-danger alert";
                $msg = 'ERROR: '.mysqli_error($conn);
            }
        }
    }

    if(isset($_POST['kodeord'])){
        $user_name = mysqli_real_escape_string($conn, $_POST['username']);
        $pass_word = mysqli_real_escape_string($conn, $_POST['password']);
        $gentag_password = mysqli_real_escape_string($conn, $_POST['gentagPassword']);

        if(empty($pass_word) || empty($gentag_password)){
            header("Location: indstillinger.php?error=emptyfields&passwords");
        }elseif($pass_word !== $gentag_password){
            exit();
        }else{
            $salt = "ksdnfklgnhtiipo40" . $pass_word . "kjlhfdsgiofjg4ijgd";
            $hashed = hash('sha512', $salt);

            $sql = "UPDATE login
                    SET pass='$pass_word'
                    WHERE user_name = '$user_name'";
            if(mysqli_query($conn, $sql)){
                $class = "alert-success alert";
                $msg = "Dit kodeord er opdateret";
            }else{
                $class = "alert-danger alert";
                $msg = 'ERROR: '.mysqli_error($conn);
            }
        }
    }

    if(isset($_POST['billedeSubmit'])){
        $user_name = mysqli_real_escape_string($conn, $_POST['username']);
        $selected_img = mysqli_real_escape_string($conn, $_POST['billede']);
        
        if(empty($selected_img)){
            header("Location: indstillinger.php?error=emptyfields&profilbillede");
        }else{
            $sql = "UPDATE user_oplysninger
                    SET image='$selected_img'
                    WHERE user_name = '$user_name'";
            if(mysqli_query($conn, $sql)){
                $class = "alert-success alert";
                $msg = "Dit profilbillede er opdateret";
            }else{
                $class = "alert-danger alert";
                $msg = 'ERROR: '.mysqli_error($conn);
            }
        }
    }
?>

<?php include('../inc/header.php'); ?>

<?php
    if(!isset($_SESSION['adgang'])){
        echo "<center><h1>Du er ikke logget ind</h1><center>";
        echo "<a href='login.php>Login</a>";
    }

?>

<div class="container <?php if(!isset($_SESSION['adgang'])) echo ' hidden'; ?>">
    <h1 class="site-header">Indstillinger</h1>
    <div class="form-group">
        <?php foreach($oplysninger as $oplysning) : ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return checkNewForm()" id="checkNewForm">
            <div class="form-group">
                <h3>Generelle indstillinger</h3>
                <div id="msg" class="<?php echo $class; ?>"><?php echo $msg; ?></div>
                <input type="hidden" value="<?php echo $login_session; ?>" name="username">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <label for="fornavn"><h4>Fornavn</h4></label>
                        <input type="text" class="form-control" name="fornavn" id="fornavn" value="<?php echo $oplysning['for_navn']; ?>">
                        <p id="namefail"></p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="efternavn"><h4>Efternavn</h4></label>
                        <input type="text" class="form-control" name="efternavn" id="efternavn" value="<?php echo $oplysning['efter_navn']; ?>">
                        <p id="enamefail"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <label for="email"><h4>Email</h4></label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $oplysning['email']; ?>">
                        <p id="emailfail"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <label for="postnr"><h4>Post nr</h4></label>
                        <input type="text" class="form-control" name="postnr" id="postnr" value="<?php echo $oplysning['post_nr']; ?>">
                        <p id="postfail"></p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="by"><h4>By</h4></label>
                        <input type="text" class="form-control" name="by" id="by" value="<?php echo $oplysning['by_navn']; ?>">
                        <p id="byfail"></p>
                    </div>
                </div>
            </div>
            <button class="btn" name="generel"><h4>Opdater</h4></button>
        </form>
        <?php endforeach; ?>
    </div>
    <div class="form-group">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return checkNewPass()" id="checkNewPass">
            <div class="form-group">
                <h3>Nyt kodeord</h3>
                <input type="hidden" value="<?php echo $login_session; ?>" name="username">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <label for="password"><h4>Kodeord</h4></label>
                        <input type="text" class="form-control" name="password" placeholder="Mindst 8 tegn">
                        <p id="passwordfail"></p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="gentagPassword"><h4>Gentag kodeord</h4></label>
                        <input type="text" class="form-control" name="gentagPassword">
                        <p id="genpassfail"></p>
                    </div>
                </div>
            </div>
            <button class="btn" name="kodeord"><h4>Opdater</h4></button>
        </form>
    </div>
    <div class="form-group">   
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  onSubmit="return checkImage()"id="checkImage">
            <div class="form-group">
                <h3>Profil billede</h3>
                <input type="hidden" value="<?php echo $login_session; ?>" name="username">
                <div class="row">
                        <input type="radio" name="billede" id="koala" class="input-hidden" value="pr_koala.png"/>
                        <label for="koala" class="radio-billede col-lg-4 col-sm-12"><img src="../illustrationer/koala/pr_koala.png" alt="Koala ninja"></label>
                        <input type="radio" name="billede" id="ninja" class="input-hidden" value="pr_ninja.png"/>
                        <label for="ninja" class="radio-billede col-lg-4 col-sm-12"><img src="../illustrationer/koala/pr_ninja.png" alt="Koala ninja"></label>
                        <input type="radio" name="billede" id="viking" class="input-hidden" value="pr_viking.png"/>
                        <label for="viking" class="radio-billede col-lg-4 col-sm-12"><img src="../illustrationer/koala/pr_viking.png" alt="Koala viking"></label>
                        <p id="imagefail"></p>
                </div>
            </div>
            <button class="btn" name="billedeSubmit"><h4>Opdater billede</h4></button>
        </form>
    </div>
</div>

<?php include('../inc/footer.php'); ?>