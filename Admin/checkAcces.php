<?php


function checkAccessLevel($requiredLevel) {
    ob_start();
    session_start();
  
  if (!isset($_SESSION['username']) || $_SESSION['username'] !== $requiredLevel) {
    return false;
    ob_end_flush();
           header('Location: ../login.html'); // Redirect to the access denied page
          

  }
else {
  return true;
}
}

?>