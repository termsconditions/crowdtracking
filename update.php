<?php
include "dbcon.php";

$lt = $_POST['lat'];
$ln = $_POST['lng'];
$ids = $_POST['idUser'];

$qrUpdate = "UPDATE user SET lat = ".$lt.", lng = ".$ln." WHERE id_tab_user = ".$ids." ";
$resultUpdate =  mysql_query($qrUpdate);
echo json_encode(array('lat'=>$lt,'ln'=>$ln,'qr'=>$qrUpdate));


?>