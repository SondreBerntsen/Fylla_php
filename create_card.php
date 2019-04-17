<?php
include_once 'templates/header.php';
include_once 'includes/dbh.inc.php';
if (!isset($_SESSION['u_id'])) {
  header("Location: index.php?state=notloggedin");
}
?>


    <!--Super Content-->

<div class="container">

    <!-- NEW CARD FORM MODAL -->

    <div class="modal fade" id="newCardModal" tabindex="-1" role="dialog" aria-labelledby="newCardModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newCardModalTitle">Card creation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="includes/newCard.inc.php" enctype="multipart/form-data" method="POST">
              <div class="form-group">
                <label for="card">Image</label>
                <input type="file" class="form-control" aria-describedby="usernameHelp" placeholder="Epic image" name="image" id="image">
                <label for="card">Name</label>
                <input type="text" class="form-control" aria-describedby="usernameHelp" placeholder="ex: 'Boenofylla'" name="card_name">
                <label for="card">Quote</label>
                <input type="text" class="form-control" aria-describedby="usernameHelp" placeholder="ex: 'Du e på fylla, boenofylla'" name="card_quote">
                <label for="card">Description</label>
                <textarea type="textarea" class="form-control" rows="5" aria-describedby="usernameHelp" placeholder="ex: 'Drekk 100 slurka'" name="card_description"></textarea>
                <small id="usernameHelp" class="form-text text-muted">Hope your new card is a hit!</small>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  <div class="container">
  

  <div class="col">
      
      <?php
        $sql = "SELECT * FROM cards WHERE user_id = $_SESSION[u_id]";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
            echo '<form action="includes/deleteCard.inc.php" method="POST">
                  <div class="card">
                    <div class="card-body">
                      <img src= "images/' . $row['img'] . '" class="img-fluid" alt="Responsive image">
          			      <h5 class="card-title">' . $row['card_name'] . '</h5>
                      <p class="card-text">' . $row['quote'] . '</p>
                      <p class="card-text">' . $row['description'] . '</p>
                      <input type="hidden" name="card_id_delete" value= ' . $row['card_id'] . '>
          			      <p class="card-text"><small class="text-muted">Created by you!</small></p>
                        <button type="submit" class="btn btn-danger">Delete card</button>
          			    </div>
                  </div>
                  </form>';
        }

      ?>
	</div>



  <div class="row">
    <div class="col-sm-3">
      <div class="list-group">


        <?php
        // New card modal trigger button, is only shown if user is logged in
        if (isset($_SESSION['u_type'])) {
          echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCardModal">
                  Create new card
                </button>';
        }
        ?>

      </div>
    </div>
  </div>
</div>





<?php
  include_once 'templates/footer.php';
 ?>