<?php
include_once 'templates/header.php';
include_once 'includes/dbh.inc.php';



// $_SESSION['graveyard'] = $card_graveyard;

/*
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
*/
?>



<div class="container text-center">
        <h1>Kongratulaise din taper</h1>
        <img class="img-fluid" src="images/what.jpg" alt="celebrationtiiime">
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