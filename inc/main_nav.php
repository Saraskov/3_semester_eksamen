<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo ROOT_URL; ?>"><img src="<?php echo ROOT_URL; ?>illustrationer/koala/koala_logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>index.php"><h4>Home</h4></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>pages/games.php"><h4>Games</h4></a>
      </li>
    </ul>
    <ul class="navbar-nav justify-content-end">
      <?php 
        if(isset($_SESSION['adgang'])){
            echo "<li class='nav-item' id='avatar-item'><a class='nav-link' href='".ROOT_URL."pages/profil.php'><img class='avatar' src='".ROOT_URL."illustrationer/koala/".$avatar."' alt='avatar image'></a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='".ROOT_URL."pages/profil.php'><h4>".$login_session."</h4></a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='".ROOT_URL."pages/logout.php'><h4>Logout</h4></a></li>";
        } else {
            echo "<li class='nav-item'><a class='nav-link' href='".ROOT_URL."pages/registrer.php'><h4>Registrer</h4></a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='".ROOT_URL."pages/login.php'><h4>Login</h4></a></li>";
        }
      ?>
    </ul>
  </div>
</nav>