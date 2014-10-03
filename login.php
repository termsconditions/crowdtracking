<?php
	session_start();
	include 'dbcon.php';

	$username = $_POST['username'];
	$pass = ($_POST['pass']);

	$qrlogin = "SELECT 
						id_tab_user,
						username, 
						lat, 
						lng,
						nama, 
						status,
						photo 
					FROM user 
					where username = '".$username."' AND password = '".$pass."'";
	$getUser = mysql_query($qrlogin);
	$result=mysql_fetch_array($getUser);
	$count=mysql_num_rows($getUser);
	if($count == 1)
	{
		$_SESSION['username']=$result['username'];
		$_SESSION['lat']=$result['lat'];
		$_SESSION['lng']=$result['lng'];
		$_SESSION['nama']=$result['nama'];
		$_SESSION['status']=$result['status'];
		$_SESSION['id_tab_user']=$result['id_tab_user'];
		$_SESSION['photo']=$result['photo'];
		
		
			header("location:main.php");	
		
		
	}
	else
	{
		?>
		<script type="text/javascript">
			alert("Username atau Password salah");
			parent.location = 'index.php';
		</script>
		<?php
	}
?>