<?php 

$id=$_GET['stateid'];

$select="select * from admin where id_admin=$id";
$query = $conn->prepare($select);
$query->execute();



?>