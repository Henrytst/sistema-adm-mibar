<?php

if(!isset($_SESSION)) {
    session_start();
}

//echo 'olá mundo';

session_destroy();

header("Location: ../index.php");