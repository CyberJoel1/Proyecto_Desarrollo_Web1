<?php
session_start();

if($_SESSION['nombreusuario'] != null){
    session_unset();
    session_destroy();
    header("location:index.html");
} else {
    header("location:index.html");
}

?>
