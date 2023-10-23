<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM produk WHERE id = $id";
$conn->query($query);

header("Location: update.php");
?>
