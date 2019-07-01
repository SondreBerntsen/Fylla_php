<?php
include_once 'templates/header.php';
include_once 'includes/dbh.inc.php';
// Selects all card ids from database and puts them in an array to start the game.
?>



<!-- Nextcard -->

<?php

if (isset($_POST['resume'])) {
    $currentcard_id = $_SESSION['currentcard'];
    $sql = "SELECT * FROM cards WHERE card_id = $currentcard_id";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
    echo '
            <div class="col-sm-4 align-self-center">
                <div class="card fylla-card">
                    <div class="card-body fylla-card-body">
                        <div class="titlebanner">
                            <h5 class="card-title">' . $row['card_name'] . '</h5>
                        </div>
                        <div class="cropdiv">
                            <img src= "images/' . $row['img'] . '" class="img-fluid rounded-circle" alt="Responsive image">
                        </div>
                        <div class="descriptioncontainer">
                            <p class="card-text">' . $row['quote'] . '</p>
                            <p class="card-text">' . $row['description'] . '</p>
                        </div>                
                    </div>
                </div>
            </div>';
    }

// If user presses next card button
if (isset($_POST['nextcard'])) {
    if ($_SESSION['currentcard'] == 0) {
        print_r($_SESSION['deck']);
        shuffle($_SESSION['deck']);
        print_r($_SESSION['deck']);
    }
    if ($_SESSION['currentcard'] != 0) {
        array_push($_SESSION['graveyard'], $_SESSION['currentcard']);
        
    }
    if (!empty($_SESSION['deck'])) {
        $_SESSION['currentcard'] = array_shift($_SESSION['deck']);
        $currentcard_id = $_SESSION['currentcard'];
    } else {
        unset ($_SESSION['gamestate']);
        header("location: youmadeit.php");
    }

    $sql = "SELECT * FROM cards WHERE card_id = $currentcard_id";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
    echo '  <div class="col-sm-4 align-self-center">
                <div class="card fylla-card">
                    <div class="card-body fylla-card-body">
                        <div class="titlebanner">
                            <h5 class="card-title">' . $row['card_name'] . '</h5>
                        </div>
                        <div class="cropdiv">
                            <img src= "images/' . $row['img'] . '" class="img-fluid rounded-circle" alt="Responsive image">
                        </div>
                        <div class="descriptioncontainer">
                            <p class="card-text">' . $row['quote'] . '</p>
                            <p class="card-text">' . $row['description'] . '</p>
                        </div>                
                    </div>
                </div>
            </div>';
}
?>

<div class="container">



<div class="row">

<?php
if ($_SESSION['currentcard'] == 0) {
    $buttonlabel = "Start game! Pog";

} else {
    $buttonlabel = "Han next card";
}
    echo    '
            <div class="col-sm-4 align-self-center">
            <form method="POST">
                <button name="nextcard" class="btn btn-danger">' . $buttonlabel .'</button>                    
            </form>
            </div>';

?>

</div>
</div>









<?php
  include_once 'templates/footer.php';
 ?>