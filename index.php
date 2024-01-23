<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Iniciar Sesion</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="js/main.js" ></script>
</head>
<body class="cover">
	<div class="container-login">
		<br>
        <center>
        <a href="#"><img style="auto; width:auto;" src="logo4.png"></img></a>
        </center>
		<form action="sistema/login.php" method="post">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <p style="color: #009BDC; font-size: 16px;">Usuario</p>
                <center>
                <input style="background-color: rgba(220,220,220); font-family:'Segoe UI'; color:black; width:95%;" class="mdl-textfield__input" type="text" id="user" name="user">
                </center>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <p style="color: #009BDC; font-size: 16px;">Contraseña</p>
                <center>
                <input style="background-color: rgba(220,220,220); font-family:'Segoe UI'; color:black; width:95%;" class="mdl-textfield__input" type="password" id="password" name="password">
                </center>
			</div>
			<center>
            <input type="submit" value="INICIAR SESIÓN" class="btnlogin">
            <br>
            <br>
			</center>
    	</form>
	</div>
</body>
</html>