<?php
include_once 'templates/header.php';
include_once 'includes/dbh.inc.php';



// $_SESSION['graveyard'] = $card_graveyard;

/*
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
*/
?>



    <div class="row rownoscroll">

        <?php
        // Resume button
        if (isset($_SESSION['gamestate'])) {
        echo '  <div class="col-lg">
                <div class="jumbotron">
                    <h1 class="display-4">Resume Game</h1>
                    <p class="lead">I see you have a game running ;) do you want to resume?</p>
                    <hr class="my-4">
                    <form action="game.php" method="GET">
                            <button name="resume" type="submit" class="btn btn-info">
                            Resume game
                            </button>
                    </form>
                </div>
                </div>';
        } 
        ?>
        <!-- Play button -->
        <div class="col-lg">
                <div class="jumbotron">
                    <h1 class="display-4">New Game</h1>
                    <p class="lead">Start game get drunk</p>
                    <hr class="my-4">
                    <form method="GET">
                            <button name="startgame" type="submit" class="btn btn-success">
                            New game
                            </button>
                    </form>
                </div>
        </div>
    </div>

<?php
if (isset($_GET['startgame'])) {
    session_start();

    include_once 'includes/dbh.inc.php';
    // Selects all card ids from database and puts them in an array to start the game.
    // Additionally sets session gamestate to user.
    // Sets game_done session to false.

    $sql = "SELECT card_id FROM cards";
    $result = mysqli_query($conn, $sql);
    $card_id_array = array();

    while ($row = mysqli_fetch_array($result)) {
        $card_id_array[] = $row['card_id'];
    }
    
    $_SESSION['deck'] = $card_id_array;
    $_SESSION['gamestate'] = 1;
    $_SESSION['currentcard'] = 0;
    $_SESSION['graveyard'] = array();
    header("location: game.php");
}

?>




<?php
  include_once 'templates/footer.php';
 ?>







 
    <!--  
        To be done:
        - styling for cards, not sure if 1.0 2.0 or 3.0, depends on which design has best image quality or whichever fits the responsive design.
        - Actual gameplay, check what is going to be best practice, session, cookies or database storage of gamestate.
        - Doublecheck player and administrator rights, right now players can see the "create new card modal trigger."
        - Session check for administrator needs to be user_type not user_id, else everyone logged in has all rights lol.


    -->