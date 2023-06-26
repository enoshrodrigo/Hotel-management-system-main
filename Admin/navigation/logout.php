<?php
if(isset($_GET['log'])){
    session_start();
    $_SESSION['username']='';
 
    
    if($_SESSION['username']===''){
        header('Location: ../../login.html');

    }

}
?>