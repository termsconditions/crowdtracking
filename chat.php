<?php
	session_start();
	include "dbcon.php";
	$isi = $_POST['isi'];
	$user1 = $_SESSION['id_tab_user'];
	$user2 = $_POST['ids'];
	$qrChat = "INSERT INTO chat (user1,user2,isi, tanggal)
				values (".$user1.",".$user2.",'".$isi."',NOW())
				";
	$resultChat = mysql_query($qrChat);
		if($resultChat)
		{
			?>
				<div style="margin-bottom:10px;">
					<span style='margin-top:-20px;'><?php echo $_POST['isi'];?></span>
				</div>
			<?php
		}
?>