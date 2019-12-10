<?php
    require('../config/config.php');

    //Create connection to database
    require('../config/db.php');

    $flag = false;
    $msg = "";

    if(isset($_POST['submit'])){
        //Mysqli_real_escape_string... Renser for karakterer, som bruges til SQL angreb
        $user_name = mysqli_real_escape_string($conn, $_POST['username']);
        $pass_word = mysqli_real_escape_string($conn, $_POST['password']);
        $gentag_password = mysqli_real_escape_string($conn, $_POST['gentagPassword']);

        $for_navn = mysqli_real_escape_string($conn, $_POST['fornavn']);
        $efter_navn = mysqli_real_escape_string($conn, $_POST['efternavn']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $post_nr = mysqli_real_escape_string($conn, $_POST['postnr']);
        $by_navn = mysqli_real_escape_string($conn, $_POST['by']);

        //Tjekker hvis boksene er tomme
        if(empty($user_name) || empty($pass_word) || empty($gentag_password) || empty($for_navn) || empty($efter_navn)|| empty($email) || empty($post_nr) || empty($by_navn)){
            header("Location: registrer.php?error=emptyfields&username=".$user_name."&fornavn=".$fornavn."&efternavn=".$efternavn."&email=".$email."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $user_name)){
            header("Location: registrer.php?error=invalidUsername&fornavn=".$fornavn."&efternavn=".$efternavn."&email=".$email."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }elseif(!preg_match("/^[a-zA-Z]*$/", $for_navn)){
            header("Location: registrer.php?error=invalidFornavn&username=".$user_name."&efternavn=".$efternavn."&email=".$email."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }elseif(!preg_match("/^[a-zA-Z]*$/", $efter_navn)){
            header("Location: registrer.php?error=invalidEfternavn&username=".$user_name."&fornavn=".$fornavn."&email=".$email."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: registrer.php?error=invalidmail&username=".$user_name."&fornavn=".$fornavn."&efternavn=".$efternavn."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }elseif(!preg_match("/^[0-9]*$/", $post_nr)){
            header("Location: registrer.php?error=invalidPostnr&username=".$user_name."&fornavn=".$fornavn."&efternavn=".$efternavn."&email=".$email."&by=".$by_navn."&telenr=".$telenr);
            exit(); 
        }elseif(!preg_match("/^[a-zA-Z]*$/", $by_navn)){
            header("Location: registrer.php?error=invalidBy&username=".$user_name."&fornavn=".$fornavn."&efternavn=".$efternavn."&email=".$email."&postnr=".$postnr."&telenr=".$telenr);
            exit();
        }elseif ($pass_word !== $gentag_password){
            //Stemmer de to passwords overens med hinanden
            header("Location: registrer.php?error=PasswordPasserIkke&username=".$user_name."&fornavn=".$fornavn."&efternavn=".$efternavn."&email=".$email."&postnr=".$postnr."&by=".$by_navn."&telenr=".$telenr);
            exit();
        }else{
            //Checker om brugernavnet allerede findes
            $sql = "SELECT user_name FROM login WHERE user_name = ?";
            $statement = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($statement, $sql)){
                //Hvis den ikke kan finde database og/eller tabellen giver den fejlbesked
                header("Location: registrer.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($statement, "s", $user_name); //Sætter det indtastede username ind i statement variablen ("s" = fortæller at det er en string. Man kan også have f.eks "ss" eller "si" osv)
                mysqli_stmt_execute($statement); //Run though databasen, og tjekker om username'et findes i databasen
                mysqli_stmt_store_result($statement); //Fortæller om den fandt username'et
                $resultCheck = mysqli_stmt_num_rows($statement); //Fortæller hvor mange gange den fandt username'et i databasen (burde kun være 0 eller 1 i dette tilfælde)
                if($resultCheck > 0){
                    //Brugernavnet findes allerede i databasen
                    header("Location: registrer.php?error=usernameTaken&fornavn=".$for_navn."&efternavn=".$efter_navn."&email=".$email."&postnr=".$post_nr."&by=".$by_navn);
                    exit(); 
                } else {
                    //Alt er fint, og oplysningerne bliver sat ind i databasen
                    $salt = "ksdnfklgnhtiipo40" . $pass_word . "kjlhfdsgiofjg4ijgd";
                    $hashed = hash('sha512', $salt);
                    
                    $sql = "INSERT INTO login(user_name, pass) values('$user_name', '$hashed')";
                    $result = mysqli_query($conn, $sql) or die ("Query virker overhovedet ikke!");
                    $sqlOplysninger = "INSERT INTO user_oplysninger(user_name, for_navn, efter_navn, email, post_nr, by_navn, image) values('$user_name', '$for_navn', '$efter_navn', '$email', '$post_nr', '$by_navn', 'pr_koala.png')";
                    $resultOplysninger = mysqli_query($conn, $sqlOplysninger) or die ("Oplysnings query virker overhovedet ikke!");
                    header("location: login.php");
                }
            }
        }
    }

?>

<?php include('../inc/header.php'); ?>

<div class="container">
    <h1 class="site-header">Registrer</h1>
    <div class="form-group">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return checkform()" class="checkform">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <label for="username"><h4>Brugernavn</h4></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="eks. Hanne1234 (mindst 4 tegn)">
                        <p id="usernamefail"></p>
                    </div>
                </div>
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
            <br>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <h3>Dine oplysninger</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <label for="fornavn"><h4>Fornavn</h4></label>
                        <input type="text" class="form-control" name="fornavn" id="fornavn">
                        <p id="namefail"></p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="efternavn"><h4>Efternavn</h4></label>
                        <input type="text" class="form-control" name="efternavn" id="efternavn">
                        <p id="enamefail"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <label for="email"><h4>Email</h4></label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="eks. tester@test.dk">
                        <p id="emailfail"></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <label for="postnr"><h4>Post nr</h4></label>
                        <input type="text" class="form-control" name="postnr" id="postnr">
                        <p id="postfail"></p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="by"><h4>By</h4></label>
                        <input type="text" class="form-control" name="by" id="by">
                        <p id="byfail"></p>
                    </div>
                </div>
            </div>
            <button class="btn" name="submit"><h4>Opret</h4></button>
        </form>
    </div>
</div>

<?php include('../inc/footer.php'); ?>