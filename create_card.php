<?php
 require "templates/header.php";
 include_once "includes/dbh.inc.php";

        // New topic modal trigger button, is only shown if user is logged in
        if (isset($_SESSION['u_type'])) {
          echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCardModal">
                  Create new card
                </button>';
        }



          //Showing all topics created by user
          $session_id = $_SESSION['u_id'];
          $sql = "SELECT * FROM topics WHERE user_id = $session_id  ORDER BY topic_id DESC LIMIT 0,6";
          $result = mysqli_query($conn, $sql);

          //Shows edit topic button, allowing user to delete topics they have created.
          if (isset($_SESSION['u_type'])) {
            echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetopicmodal">
                    Edit topics
                  </button>';
          }


        ?>
  
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
            <form action="includes/newCard.inc.php" method="POST">
              <div class="form-group">
                <label for="topic">New topic</label>
                <input type="text" class="form-control" aria-describedby="usernameHelp" placeholder="Enter topic name" name="topic_name">
                <small id="usernameHelp" class="form-text text-muted">Hope your new topic is a hit!</small>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

<?php
  require "templates/footer.php";
?>