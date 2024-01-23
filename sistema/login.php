<?php
session_start();
extract($_REQUEST);
date_default_timezone_set('America/Bogota');
$fecha = date("Y/m/d");
include "config.php";
$pass = $password;
$_SESSION['tbl'] = $xtbl;
$sq = "select * from rus_6 where nom_acceso='$user' and clave='$pass'";
$resul = db_query($sq);
$ro = db_fetch_array($resul);
$codd = $ro['ncod'];
$nombree = $ro['usuario'];
$tipo = "Inventario";
$users = trim($ro['nom_acceso']);
$clave = trim($ro['clave']);
$sucursa = 4;
putenv("TZ=Etc/GMT+5");
$fechawh = time();
$fechahoy = date("Y-m-d", $fechawh);
$Horahoy = date("H:i", $fechawh);
//***************************TIPO DE CAMBIO SUNAT***************************************
echo '<body leftmargin=0 rigthmargin=0 topmargin=0 bottommargin=0> <center>';
if ($user == "") {
    $_SESSION['logged'] = NULL;
    session_destroy();
    echo '<script>document.location.href="../index.php?e=33";</script>';
} else {
    if ($user == $users) {
        if ($pass == $clave) {
            //$_SESSION['logged']="$nombree";
            $_SESSION['loggede']='yes';
            $_SESSION['logged'] = $users;
            $_SESSION['micodigo'] = $codd;
            $_SESSION['minombre'] = $nombree;
            $_SESSION['soportes'] = "$tipo";
            $_SESSION['sucursa'] = "$sucursa";
            $_SESSION['TIPOempresax'] = "";
            $_SESSION['urlweb'] = "";
            $querySucu = "SELECT * FROM XOUT.dbo.EMPRESA WHERE Empest='A' and EmpCod='4'";
            $resultSucu = db_query($querySucu);
            $rowsSucu = db_fetch_array($resultSucu);
            $_SESSION['estoyen'] = $rowsSucu['EmpRaz'];
            echo '<script>document.location.href="dashboard.php";</script>';
            }
    } else {
        $_SESSION['logged'] = NULL;
        session_destroy();
        echo '<script>
		document.location.href="../index.php?e=24";
		</script>';
    }
}
?>