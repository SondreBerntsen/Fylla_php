<?php
include_once 'templates/header.php';
include_once 'includes/dbh.inc.php';
?>
<div class="container containerMargin">
<?php

// Resume
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

// if 0 gamestate, send to index

if (!$_SESSION['gamestate']) {
    header("location: index.php");
}

// If user presses next card button
if (isset($_GET['nextcard']) && !$pageWasRefreshed) { 
    if ($_SESSION['currentcard'] == 0) {
        shuffle($_SESSION['deck']);
    }
    if ($_SESSION['currentcard']) {
        array_push($_SESSION['graveyard'], $_SESSION['currentcard']);
    }
    if (!empty($_SESSION['deck'])) {
        $_SESSION['currentcard'] = array_pop($_SESSION['deck']);
    } else {
        unset($_SESSION['gamestate']);
        header("location: youmadeit.php");
    }
}

// Previous Card Button
if (isset($_GET['previouscard']) && !empty($_SESSION['graveyard']) && !$pageWasRefreshed) {
    array_push($_SESSION['deck'], $_SESSION['currentcard']);
    $_SESSION['currentcard'] = array_pop($_SESSION['graveyard']);
}

$currentcard_id = $_SESSION['currentcard'];
$sql = "SELECT * FROM cards WHERE card_id = $currentcard_id";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);
echo '
            <div class="card fylla-card align-self-center">
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
            </div>';

?>

<!-- Super gamestate reactive buttons -->

   <div class="d-flex justify-content-center bd-highlight mb-3">

    <?php
    if ($_SESSION['currentcard'] == 0 && !isset($_GET['resume'])) {
        $buttonlabel = "Start game!";
        if (!$pageWasRefreshed) {
            array_shift($_SESSION['deck']);
        }

    } else {
        $buttonlabel = "Next card";

        echo    
        '
        <div class="p-2 bd-highlight">
        <form class="CardButton" method="GET">
            <button name="previouscard" class="btn btn-danger longButton">Previous card</button>                    
        </form>
        </div>';
    }
        echo    
        '
            <div class="p-2 bd-highlight">
            <form class="CardButton" method="GET">
                <button name="nextcard" class="btn btn-danger longButton">' . $buttonlabel .'</button>                    
            </form>
            </div>
        
        </div>';

        if (!empty($_SESSION['graveyard'])) {
            echo '
            <div class="col align-self-center buttonContainer graveyardButton">
            <button type="button" class="btn btn-primary longButton" data-toggle="modal" data-target="#graveyardModal">
              Graveyard
            </button>  
            </div>
            ';
        }
    ?>



<!-- Modal -->

        <div class="modal fade" id="graveyardModal" tabindex="-1" role="dialog" aria-labelledby="graveyardModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="graveyardModalLabel">Graveyard</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">


                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="0">
                    <div class="carousel-inner align-self-center">
                    
                    <?php
                    $active = "active";
                    $graveyardCard = $_SESSION['graveyard'][0];
                    $sql = "SELECT * FROM cards WHERE card_id = $graveyardCard";
                    $result = mysqli_query($conn, $sql);

                    for ($i=0; $i < sizeof($_SESSION['graveyard']); $i++) {
                        if ($i > 0) {
                            $active = "";
                        }
                        $graveyardCard = $_SESSION['graveyard'][$i];
                        $sql = "SELECT * FROM cards WHERE card_id = $graveyardCard";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result);

                        echo '
                        <div class="carousel-item ' . $active . '">
                            <div class="card fylla-card">
                                <div class="card-body fylla-card-body">
                                    <div class="titlebanner">
                                        <h5 class="card-title">' . $row['card_name'] . '</h5>
                                    </div>
                                    <div class="cropdiv">
                                        <img src=images/' . $row['img'] . ' class="img-fluid rounded-circle" alt="Responsive image">
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

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

    
</div>


<?php
  include_once 'templates/footer.php';
 ?>

 
<!-- Bug Fix
        echo 'Deck: ';
        print_r($_SESSION['deck']);
        echo '<br>';
        echo 'Current Card: ';
        print_r($_SESSION['currentcard']);
        echo '<br>';
        echo 'Graveyard: ';
        print_r($_SESSION['graveyard']);
*/ -->
