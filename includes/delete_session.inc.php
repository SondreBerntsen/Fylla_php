<?php
session_start();
// unsets gamestate

unset ($_SESSION['gamestate']);
header("location: ../index.php");

?>