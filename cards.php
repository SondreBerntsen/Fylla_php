<?php
include_once 'templates/header.php';
include_once 'includes/dbh.inc.php';
?>

    <!--  
        To be done:
        - styling for cards, not sure if 1.0 2.0 or 3.0, depends on which design has best image quality or whichever fits the responsive design.
        - Actual gameplay, check what is going to be best practice, session, cookies or database storage of gamestate.
        - Doublecheck player and administrator rights, right now players can see the "create new card modal trigger."
        - Session check for administrator needs to be user_type not user_id, else everyone logged in has all rights lol.


    -->


<div class="container">

    <!-- queries database and fetches all cards including delete button, this element is multiple forms -->

    <div class="row">
      <?php
        $sql = "SELECT * FROM cards";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
            echo '<div class="col-sm-4 align-self-center">
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
    </div> 
</div>





<?php
  include_once 'templates/footer.php';
 ?>