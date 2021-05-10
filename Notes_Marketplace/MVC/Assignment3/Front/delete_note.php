<?php 
include "../includes/db.php";
include "../includes/functions.php";

$id = $_GET['id'];

$update_query = query("UPDATE seller_notes SET IsActive = 0 WHERE ID = '$id' ");
confirm($update_query);
redirect("Dashboard.php");

?>