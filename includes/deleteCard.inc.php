<?php
session_start();

// Check if user has actually clicked submit button or just went to the url for the signup file

    include_once 'dbh.inc.php';

    $card_id = $_POST['card_id_delete'];
    $image_path = "../images/";

    $sql = "SELECT * FROM cards WHERE card_id='$card_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $imagename = $row['img'];

    unlink("$image_path$imagename");

    $sql = "DELETE FROM cards WHERE card_id = '$card_id'";
              mysqli_query($conn, $sql);

    header("Location: ../create_card.php?itworked");
