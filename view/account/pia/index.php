<?php
// on mettra l'entonnoir pour définir le pia spécifique, mais en attendant, on pinte vers 'défaut'
$id = $_GET['id'];
header('Location: pia.php?id='.$id.'&pia=defaut');
?>