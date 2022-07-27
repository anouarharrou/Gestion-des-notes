<?php
session_start();
require_once "connection.php";
$conn=cnxBD();
$id = $_GET["id"];
// sql to delete a record
$sql = $conn->prepare("DELETE FROM marks WHERE id =".$id);
$success = $sql->execute();

if ($success){
   echo "<strong>Suppression OK</strong><br>";
    header("Location: admin.php");
}
else
{
    echo "<strong>Erreur lors de la suppresion</strong>";
}

?>