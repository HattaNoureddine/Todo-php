<?php
if(isset($_POST['supprimer'])){
    require_once 'include/database.php';
    $id = $_POST['id'];
    $sqlState = $pdo->prepare('DELETE FROM items WHERE id=?');
    $resultat = $sqlState->execute([$id]);
    header('Location: index.php');
}
?>