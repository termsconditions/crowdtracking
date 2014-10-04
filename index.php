<?php
/*
* NAME : M. RIFQI THOMI F.H
* EMAIL : rifqithomi@gmail.com / rifqithomi@yahoo.co.id
* Linkedin : id.linkedin.com/in/rifqithomi/
*/
session_start();
if(isset($_SESSION['nik']))
{
  header("location:main.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Crowd Tracker</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style type="text/css">
      body{
        background: url("assets/images/bg.png") no-repeat;
        margin: 0;
        width: 100%;
        height: 100%;
        position: absolute;
      }
      #footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 30px;
        background-color: #f5f5f5;
      }
      #footer > .container {
        padding-right: 15px;
        padding-left: 15px;
      }
    </style>

  </head>

  <body onLoad="document.login.nik.focus()" onselectstart="return false" oncontextmenu="return false" ondragstart="return false">

    <div class="container">

      <form class="form-signin" name="login" action="login.php" autocomplete='off' role="form" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="username" id="nik" type="text" class="form-control" placeholder="NIK" required autofocus>
        <input name="pass" id="pass" type="password" class="form-control" placeholder="Password" required>
        <!--label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label-->
        <button id="subsub" style='background-color : #fabe28; border-color:grey' class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>

     <!--div id="footer">
      <div class="container">
        <p class="text-muted">website developed by RIFQI THOMI</p>
      </div>
    </div-->
  </body>
</html>
