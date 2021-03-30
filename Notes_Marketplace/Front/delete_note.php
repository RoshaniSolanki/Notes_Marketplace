<?php 
include "../includes/db.php";
include "../includes/functions.php";

$id = $_GET['id'];

$delete_query = query("DELETE FROM seller_notes WHERE ID = '$id' ");
confirm($delete_query);
redirect("Dashboard.php");
?>