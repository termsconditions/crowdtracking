<?php
	session_start();
	include "dbcon.php";
	$ids =  $_SESSION['id_tab_user'];
	$req = $_POST['req'];

	if ($req=='1') {
		$qrGetUserData = "SELECT * 
							FROM user
							WHERE id_tab_user = ".$ids."
							";
							
		$getUser = mysql_query($qrGetUserData);
		$resultUserData=mysql_fetch_array($getUser);
		$type = "Feature";
		$hasilss = array();
		$hasil = array(
				   'type' => 'Feature'
				);

		$geometry = array(
								'type' => 'Point',
								'coordinates' => array($resultUserData['lng'],$resultUserData['lat'])
							);
			$icon = array(
							'iconUrl' => 'assets/user/'.$resultUserData['photo'].'.png',
							'iconSize' => array(32,43),
							'iconAnchor' => array(16,42),
							'popupAnchor' => array(0,-40),
							'className' => 'dot'
						);
			$propertiess = array(
							'username' => $resultUserData['nama'],
							'live' => $resultUserData['live_status'],
							'status' => $resultUserData['status'],
							'nama' => $resultUserData['nama'],
							'icon' => $icon,
						);

			$hasil['geometry'] =  $geometry;
			$hasil['id'] = $resultUserData['id_tab_user'];
			$hasil['properties'] = $propertiess;
			$hasilss[] = $hasil;

		
		echo json_encode($hasilss);//, JSON_NUMERIC_CHECK);	


	}
	elseif ($req == '2') {
		$qrFollower = "SELECT u.*
				FROM user u, relations r
				WHERE r.me = ".$ids." and u.id_tab_user = r.following
				";
				
		$getFollower = mysql_query($qrFollower);
		$type = "Feature";
			$hasilss = array();
			$hasil = array(
					   'type' => 'Feature'
					);
		while ($resultFollower = mysql_fetch_assoc($getFollower)) {
			$geometry = array(
								'type' => 'Point',
								'coordinates' => array($resultFollower['lng'],$resultFollower['lat'])
							);
			$icon = array(
							'iconUrl' => 'assets/user/'.$resultFollower['photo'].'.png',
							'iconSize' => array(32,43),
							'iconAnchor' => array(16,42),
							'popupAnchor' => array(0,-40),
							'className' => 'dot'
						);
			$propertiess = array(
							'username' => $resultFollower['nama'],
							'live' => $resultFollower['live_status'],
							'status' => $resultFollower['status'],
							'nama' => $resultFollower['nama'],
							'icon' => $icon,
						);

			$hasil['geometry'] =  $geometry;
			$hasil['id'] = $resultFollower['id_tab_user'];
			$hasil['properties'] = $propertiess;
			$hasilss[] = $hasil;

		}
		echo json_encode($hasilss);//, JSON_NUMERIC_CHECK);	
	}
	elseif ($req=='3') {
		$qrGetChat = "SELECT isi, tanggal
						FROM chat
						WHERE user1 = ".$ids." AND user2 = ".$_POST['ids']."
							";
		$getChat = mysql_query($qrGetChat);
		while ($resultComment = mysql_fetch_assoc($getChat)) {
			?>
				<div style="margin-bottom:10px;">
					<span style='margin-top:-20px;'><?php echo $resultComment['isi'];?></span>
				</div>
			<?php
		}
	}

	
?>