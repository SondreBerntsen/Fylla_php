<?php
  session_start();
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <title>Fylla Online</title>
  </head>

  <body>
    <!-- Navigation -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">Fylla Online</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create_card.php">Cards</a>
          </li>
        </ul>
      </div>





        <?php
        if (isset($_SESSION['u_id'])) {
          echo '<form class="form-inline my-2 my-lg-0" action="includes/logout.inc.php" method="POST">
                  <div class="form-group">
                    <button class=" headerbutton btn btn-outline-danger my-2 my-sm-0" name="submit">Logout</button>
                  </div>
                </form>';

        } else {
          echo '<form class="form-inline my-2 my-lg-0" action="includes/login.inc.php" method="POST">
                  <input name="username" class="form-control mr-sm-2" type="text" placeholder="username" aria-label="username">
                  <input name="password" class="form-control mr-sm-2" type="password" placeholder="password" aria-label="password">
                <button class="headerbutton btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Login</button>';
        }
        ?>


      </form>
    </nav>
    <?php
      if (isset($_SESSION['u_id'])) {
          echo'<p> You are logged in</p>';;
        } else {
          echo '<p> You are logged out</p>';
        }
    ?>