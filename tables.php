<?php

session_start();

include('config/commandes.php');

if(isset($_GET['id'])){
    $table = table($_GET['id']);
    if(!empty($table)){
        $_SESSION['table'] = $_GET['id'];
        header('location: se_connecter.php');
    }
}

?>