<?php
include_once 'templates/header.php';
include_once 'includes/dbh.inc.php';



// $_SESSION['graveyard'] = $card_graveyard;

/*
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
*/
?>



<div class="container">
    <div class="row">

        <?php
        if (isset($_SESSION['gamestate'])) {
        echo '  <div class="col-sm">
                    <form action="game.php" method="POST">
                            <butto name="resume" type="submit" class="btn btn-success">
                            Resume game
                            </button>
                    </form>
                </div>';
        } 
        ?>
        <!-- Play button -->
        <div class="col-sm">
            <form method="POST">
                    <button name="startgame" class="btn btn-danger">
                    New game
                    </button>                    
            </form>
        </div>

        <div class="col-sm">
            <form action="includes/delete_session.inc.php" method="POST">
                    <button type="submit" class="btn btn-info">
                    slett heile verdn
                    </button>                    
            </form>
        </div>
    </div>

<?php
if (isset($_POST['startgame'])) {
    session_start();

    include_once 'includes/dbh.inc.php';
    // Selects all card ids from database and puts them in an array to start the game.
    // Additionally sets session gamestate to user.

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


</div>





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