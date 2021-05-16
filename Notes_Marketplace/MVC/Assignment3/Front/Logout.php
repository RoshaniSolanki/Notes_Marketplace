<?php
include "../includes/db.php";
include "../includes/functions.php";

    session_start();
    session_destroy();
    redirect("Login.php");
?>