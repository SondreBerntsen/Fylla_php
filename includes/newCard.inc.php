<?php
session_start();

// Check if user has actually clicked submit button or just went to the url for the signup file
if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';


    $user_id = $_SESSION['u_id'];

    $card_name = mysqli_real_escape_string($conn, $_POST['card_name']);
    $card_quote = mysqli_real_escape_string($conn, $_POST['card_quote']);
    $card_description = mysqli_real_escape_string($conn, $_POST['card_description']);
 


    //upload file variables
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;

    //Error handlers
    // Check for empty fields
    if (empty($card_name) || empty($card_description)) {
      header("Location: ../index.php?card=emptyfields");
      exit();
    } else {
      //Check if input characters are valid
      if (!preg_match("/^[a-zA-Z0-9 ]*$/", $card_name)) {
        header("Location: ../index.php?entryname=invalid");
        exit();
      } else {
        // Check if entry exists
          $sql = "SELECT * FROM cards WHERE card_name='$card_name'";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          $filename = $_FILES["image"]["name"];

          if ($resultCheck > 0) {
            header("Location: ../index.php?entry=entry_exists");
            exit();
            // Insert the entry into the database
            } else {
              $sql = "INSERT INTO cards (card_name, quote, description, user_id, img) VALUES ('$card_name', '$card_quote', '$card_description', '$user_id', '$filename')";
              mysqli_query($conn, $sql);


              $check = getimagesize($_FILES["image"]["tmp_name"]);
              if($check !== false) {
                  echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  echo "File is not an image.";
                  $uploadOk = 0;
              }

              if ($uploadOk == 0) {
                  echo "Sorry, your file was not uploaded.";
              // if everything is ok, try to upload file
              } else {
                  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                      echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                  } else {
                      echo "Sorry, there was an error uploading your file.";
                  }
              }
              header("Location: ../create_card.php?youdidit");
              exit();
          }
        }
      }

} else {
    // send user to cardpage and gives errormessage
    header("Location: ../index.php?somethinghappenedcreation");
    exit();
}
   header("Location: ../index.php?i_see_you_trying_to_access_this_file");
    exit();
