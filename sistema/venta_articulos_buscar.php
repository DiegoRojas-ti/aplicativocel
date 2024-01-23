<?php
session_start();
extract($_REQUEST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//Es" >
<html dir="LTR" lang="es">
<link href="../css/ideasweb.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui.css" />
<link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<?php date_default_timezone_set('America/Bogota');
    include "../charsetUTF.php"; 
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ideas Web</title>
<script>
function sf(){document.find.productos.focus()}
</script>
</head>
<body topmargin=0 leftmargin=0 rightmargin=0 onload="sf()" style="BACKGROUND: url(blanco.gif)">
<center>
<?php
?>
<?php
$ssssx = 3;
include "funcion.php";
require ("cn.php");
db_query("SET NAMES 'UTF8'");
$queryM = "SELECT * FROM $_SESSION[tbl]tipocambio order by idtipo";
$resultM = db_query($queryM);
$rowM = db_fetch_array($resultM);
$cambi = $rowM[cambio];
if ($vvmone <> "") {
    $_SESSION['monedaf'] = $vvmone;
    $carroV = $_SESSION['carroV'];
    if ($carroV) {
        foreach ($carroV as $kq => $vq) {
            $ordenarid = $vq['codx'];
            if ($vvmone == "Soles") {
                $preciomA = $vq['preciom'] * $cambi;
                $compraA = $vq['compra'] * $cambi;
                $precioA = $vq['precio'] * $cambi;
            }
            if ($vvmone == "Dolares") {
                $preciomA = $vq['preciom'] / $cambi;
                $compraA = $vq['compra'] / $cambi;
                $precioA = $vq['precio'] / $cambi;
            }
            $carroV[md5($ordenarid) ] = array('identificador' => md5($ordenarid), 'codx' => $ordenarid, 'cantida' => $vq['cantida'], 'nomart' => $vq['nomart'], 'precio' => $precioA, 'moneda' => $vvmone, 'detall' => $vq['detall'], 'otrosd' => $vq['otrosd'], 'ekivalente' => $vq['ekivalente'], 'medida' => $vq['medida'], 'medida1' => $vq['medida'], 'medida2' => $vq['medida2'], 'codart' => $vq['codart'], 'preciom' => $preciomA, 'compra' => $compraA, 'iddcompra' => $vq['iddcompra'], 'xtipo' => $vq['xtipo'], 'xserie' => $vq['xserie'], 'xlote' => $vq['xlote'], 'tipoafectoigv' => $vq['tipoafectoigv']);
        }
    }
    $_SESSION['carroV'] = $carroV;
}
$monedaf = $_SESSION['monedaf'];
date_default_timezone_set('America/Bogota');
$fechas = time();
$meses = date("m", $fechas);
$an = date("Y", $fechas);
require ("venta_ver_lista_articulo.php");
echo '<center> 
<table border="1" cellpadding="0" class=texto cellspacing="0" style="border-collapse: collapse" bordercolor="#cccccc" width="100%" id="AutoNumber1">
  <tr>
    <td width="100%" class=titulo_form><B>BUSQUEDA DE ARTICULOS x</B> </td>
  </tr>
  <tr>
    <td width="100%">
<center>
<table  border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1" >
  <tr>
    <td width="100%"  class=texto align=center>
     <center>
    <form name="find" id="find" method="post" action="">'; ?>
     <input type="radio" value="1"  name="tipo" <?php if ($tipo == "") {
    echo "checked";
} ?> <?php if ($tipo == "1") {
    echo "checked";
} ?> >Nombre  / <input type="radio" value="2"  name="tipo" <?php if ($tipo == "2") {
    echo "checked";
} ?> >Marca / <input type="radio" value="3"  name="tipo" <?php if ($tipo == "3") {
    echo "checked";
} ?> >Linea /<input type="radio" value="4"  name="tipo" <?php if ($tipo == "4") {
    echo "checked";
} ?> >Cat. / <input type="radio" value="5"  name="tipo" <?php if ($tipo == "5") {
    echo "checked";
} ?> >Codigo  / <input type="radio" value="6"  name="tipo" <?php if ($tipo == "6") {
    echo "checked";
} ?> >C.Barra 
<input type="text" name="productos" id="productos" size="20" style="border-color:red;">
<button type="submit" class="botonNuevo"  ><i class="icon-search"></i> Buscar</button>&nbsp;
<font class="zmdi zmdi-transform zmdi-hc-2x" title='Nuevo busqueda' onClick="javascript:window.location.href='venta_articulos_buscar.php'"></font>
<?php echo '</form>
</td>
</tr>
</table>';
if ($tipo == "1") {
    $xcampox = "  nomart like '%$productos%' ";
} elseif ($tipo == "2") {
    $xcampox = "  marca like '%$productos%' ";
} elseif ($tipo == "3") {
    $xcampox = "  linea like '%$productos%' ";
} elseif ($tipo == "4") {
    $xcampox = "  categoria like '%$productos%' ";
} elseif ($tipo == "5") {
    $xcampox = "  codigo like '%$productos%' ";
} elseif ($tipo == "6") {
    $xcampox = "  codigob = '$productos' ";
} else {
    $xcampox = "  nomart like '%$productos%' ";
}
if ($productos <> "") {
    $query = "SELECT codart,nomart,pvart,pvart2,codigo,medida,medida2,marca,tipox,pvmart,pvmart2,moneda,pcart,pcart2,series,ekivalente,url,tipoimp FROM  $_SESSION[tbl]articulo where $xcampox and stdo='Activo'  order by  nomart";
} else {
    $query = "SELECT codart,nomart,pvart,pvart2,codigo,medida,medida2,marca,tipox,pvmart,pvmart2,moneda,pcart,pcart2,series,ekivalente,url,tipoimp FROM  $_SESSION[tbl]articulo   where stdo='Activo' and tipox='Servicio.'  order by  nomart";
}
$result = db_query($query);
if ($_SESSION[UNalmacen] == "") {
    $sucursaX = $_SESSION['sucursa'];
} else {
    $sucursaX = $_SESSION[UNalmacen];
}
echo '<table class="tableM"><thead><tr>
    <th ><b>Codigo</b></th>
    <th ><b>Articulos/Detalle</b></th>
    <th width="3%"><b>Stock</b></th>
    <th width="4%"><b>Med.</b></th>
    <th align=center><b>P-M/C</b></th>
    <th width="10%" ><b>P.Venta</b></th>
    <th width="3%"><b>cant.</b></th>
    <th width="3%"><b>Dto</b></th>
    <th width="3%"><b>T.A.IGV</b></th>
    <th width="2%" ><b>Agre</b></th>
    </tr></thead><tbody>';
while ($rows = db_fetch_array($result)) {
    $tipoxx = $rows[tipox];
    if ($tipoxx <> "Lista de Precio") {
        $tt = $tt + 1;
        echo "<form method=POST action=venta_agrega_lista.php name='formular$tt' id='formular$tt'>";
        echo '<tr  class=texto><td data-label="Codigo">';
        if ($tipoxx == "Servicio.") {
            echo "<input  name=code id=code type=text   size=1>";
        } else {
            echo $rows[codigo];
        }
        echo '<td  data-label="Detalle" style="text-align:left">';
        if ($tipoxx == "Servicio.") {
            echo "<textarea rows='1' name='servicioDET' id='servicioDET' cols='40'>$rows[nomart]</textarea>";
        } else {
            if ($TIPOempresa == "Soft") {
                if ($rows[url] == "") {
                    $uxrl = "Detalle-$rows[codart]/";
                } else {
                    $uxrl = "$rows[url]/";
                }
                echo "<a href='".$url_web."$uxrl' target='_blank'>";
            }
        }
        if ($tipoxx == "Articulo") {
            echo $rows[nomart];
        }
        echo "</a>";
        if ($tipoxx == "Servicio") {
            echo $rows[nomart];
            if ($TIPOempresa == "Lavanderia") {
                $qry1 = "SELECT * FROM $_SESSION[tbl]tablas where tabla='Color' ";
                $rslt1 = db_query($qry1);
                $rs1 = db_fetch_array($rslt1);
                echo '  <select name="colore" style="height:20px;padding:0px"><option value="">COLOR';
                $qry2 = "SELECT * FROM $_SESSION[tbl]tablas where hijo='" . $rs1[id] . "' order by tabla ";
                $rslt2 = db_query($qry2);
                while ($rs2 = db_fetch_array($rslt2)) {
                    echo "<option  value='" . $rs2["tabla"] . "' >" . $rs2["tabla"];
                }
                echo '</select>';
                $qry3 = "SELECT * FROM $_SESSION[tbl]tablas where tabla='Diseno' ";
                $rslt3 = db_query($qry3);
                $rs3 = db_fetch_array($rslt3);
                echo ' <select name="diseno"  class="t3" style="height:20px;padding:0px"><option value="">';
                if ($UTF8 == "ok") {
                    echo utf8_encode("DISEO");
                } else {
                    echo "DISEO";
                }
                $qry4 = "SELECT * FROM $_SESSION[tbl]tablas where hijo='" . $rs3[id] . "' order by tabla ";
                $rslt4 = db_query($qry4);
                while ($rs4 = db_fetch_array($rslt4)) {
                    echo "<option  value='" . $rs4["tabla"] . "' >" . $rs4["tabla"];
                }
                echo '</select>';
                $qry5 = "SELECT * FROM $_SESSION[tbl]tablas where tabla='Estado' ";
                $rslt5 = db_query($qry5);
                $rs5 = db_fetch_array($rslt5);
                echo '  <select name="esta"  class="t3" style="height:20px;padding:0px"><option value="">ESTADO';
                $qry6 = "SELECT * FROM $_SESSION[tbl]tablas where hijo='" . $rs5[id] . "' order by tabla ";
                $rslt6 = db_query($qry6);
                while ($rs6 = db_fetch_array($rslt6)) {
                    echo "<option  value='" . $rs6["tabla"] . "' >" . $rs6["tabla"];
                }
                echo '</select>';
            }
        }
        if ($Mayorista <> "Si") {
            if (($rows[series] == "Si") or ($rows[series] == "Serie")) {
                $querysl = "SELECT * FROM $_SESSION[tbl]articulo_serie where articulo='" . $rows[codart] . "' and estado='Compra' and sucursl='" . $_SESSION[sucursa] . "'  ";
                $resultEl = db_query($querysl);
                while ($rowsEl = db_fetch_array($resultEl)) {
                    $VarEstadol.= "<option>$rowsEl[serie]</option>";
                }
                echo "<select size='1' name='xserie'><option></option>$VarEstadol</select>";
            }
        }
        if ($rows[series] == "Lote") {
            $VarEstadol = "";
            $querysl = "SELECT * FROM $_SESSION[tbl]entrada_detalle e,$_SESSION[tbl]articulo a,$_SESSION[tbl]lote l where e.comen=l.nrolote and l.nrolote=e.comen and  a.codart=e.codart and e.codart=a.codart and a.codart='" . $rows[codart] . "' and l.esta='Activo'    ";
            $resultEl = db_query($querysl);
            while ($rowsEl = db_fetch_array($resultEl)) {
                $querysSAl = "SELECT sum(cantidad) as CANsal FROM $_SESSION[tbl]salida_detalle where detall='" . $rowsEl[nrolote] . "'";
                $resultSAl = db_query($querysSAl);
                $rowsSAl = db_fetch_array($resultSAl);
                $VarEstadol.= "<option value='$rowsEl[comen]==Lote==" . ($rowsEl[cantidad] - $rowsSAl[CANsal]) . "'>$rowsEl[comen](" . ($rowsEl[cantidad] - $rowsSAl[CANsal]) . ")$rowsEl[ff]</option>";
            }
            echo "<select size='1' name='xserie'  ><option></option>$VarEstadol</select>";
        }
        echo "</td><td data-label='Stock'><input  name=medidaa id=medidaa type=hidden value='$rows[medida]' size=1>
            <input  name=medidaa2 id=medida2 type=hidden value='$rows[medida2]' size=1>";
        $idPro = $rows[codart];


        $queryGa2 = "SELECT *,d.medida as medidda FROM $_SESSION[tbl]entrada e,$_SESSION[tbl]entrada_detalle d,$_SESSION[tbl]articulo a WHERE e.identrada=d.identrada AND d.identrada=e.identrada AND d.codart=a.codart AND a.codart=d.codart AND d.codart='$idPro' AND e.condicion='N' and e.sucursal='$sucursaX' ORDER BY e.fechaentrada";
        $resultGa2 = db_query($queryGa2);
        while ($rowsGa2 = db_fetch_array($resultGa2)) {
            if ($rowsGa2[medida2] == "") {
                $cantidUnica2 = $cantidUnica2+$rowsGa2[cantidad];
            } else {
                if ($rowsGa2[medida] == $rowsGa2[medidda]) {
                    $cantidUnica2 = $cantidUnica2+$rowsGa2[cantidad];
                } else {
                    $cantidUnica2 = $cantidUnica2+$rowsGa2[cantidad];
                }
            }
            }
        $query2 = "SELECT *,d.medida as medidda FROM  $_SESSION[tbl]salida s,$_SESSION[tbl]salida_detalle d,$_SESSION[tbl]articulo a  where  s.idsalida=d.idsalida and d.idsalida=s.idsalida and d.codart=a.codart and a.codart=d.codart and d.codart='$idPro' and s.condicion='N' and s.sucursal='$sucursaX' order by s.fechasalida";
        $result2 = db_query($query2);
        while ($rows2 = db_fetch_array($result2)) {
            if (round($rows2[totalgeneral]) == round($rows2[credito])) {
                $seanuloNC = "";
            }
            if ($seanuloNC == "") {
                if ($rows2[medida2] == "") {
                    $cantidUnica2 =$cantidUnica2-$rows2[cantidad];
                } else {
                    if ($rows2[medida] == $rows2[medidda]) {
                        $cantidUnica2 = $cantidUnica2-($rows2[cantidad] * $rows2[ekivalente]);
                    } else {
                        $cantidUnica2 = $cantidUnica2-$rows2[cantidad];
                    }
                }
            }
        }
        $totalStk = $cantidUnica2;
        $xxMIstock = "";
        $nxtock = $totalStk;
        $cantidUnica2=0;

        //$querySt = "SELECT stock FROM $_SESSION[tbl]sucursal_detalle where sucursal='$sucursaX' and articulo='$idPro' order by sucursal";
        //$resultSt = db_query($querySt);
        //$rowsSt = db_fetch_array($resultSt);
        //$xxMIstock = "";
        //$nxtock = $rowsSt[stock];

        if (round($rows['ekivalente']) > 0) {
            $stockEnte = $nxtock / $rows[ekivalente];
            $xcerox = ($stockEnte - intval($stockEnte)) * 100;
            if ($xcerox == 0) {
                if ($stockEnte == 0.00) {
                    $xxMIstock = "$stockEnte";
                } else {
                    $xxMIstock = "$stockEnte ";
                }
            } else {
                $xxUNIDAxx = ($stockEnte * $rows[ekivalente]);
                $xxENTEROxx = (intval($stockEnte) * $rows[ekivalente]);
                $XXunidadXX = $xxUNIDAxx - $xxENTEROxx;
                $xxMIstock = "" . intval($stockEnte) . "/$XXunidadXX";
            }
        } else {
            $xxMIstock = $nxtock;
        }
        echo $xxMIstock;

        $xxMIstock="";
        $stockEnte="0";
        $XXunidadXX="";
        $xxENTEROxx="";
        $cantidUnica2="";
        $cantidUnica2="";
        $seanuloNC="";

//        $xcerox = ($nxtock - intval($nxtock)) * 100;
//        if ($xcerox == 0) {
//            if ($nxtock == 0.00) {
//                $xxMIstock = "$nxtock";
//            } else {
//                $xxMIstock = "$nxtock";
//            }
//        } else {
//            $xxUNIDAxx = ($nxtock * $rows[ekivalente]);
//            $xxENTEROxx = (intval($nxtock) * $rows[ekivalente]);
//            $XXunidadXX = $xxUNIDAxx - $xxENTEROxx;
//            $xxMIstock = "" . intval($nxtock) . "/$XXunidadXX";
//        }
//        echo $xxMIstock;
        //--------Stock FIN--------------------
        if ($monedaf == "Soles") {
            if ($moneyArti == "D") {
                $pvm = $rows[pvmart] * $cambi;   //precio minimo
                $pv = $rows[pvart] * $cambi;     //precio normal
                $pc = $rows[pcart] * $cambi;     //precio compra
                $pvm2 = $rows[pvmart2] * $cambi;
                $pv2 = $rows[pvart2] * $cambi;
                $pc2 = $rows[pcart2] * $cambi;
            } else {
                $pvm = $rows[pvmart]; //precio minimo
                $pv = $rows[pvart]; //precio normal
                $pc = $rows[pcart]; //precio compra
                $pvm2 = $rows[pvmart2];
                $pv2 = $rows[pvart2];
                $pc2 = $rows[pcart2];
            }
        } else {
            if ($moneyArti == "D") {
                $pvm = $rows[pvmart]; //precio minimo
                $pv = $rows[pvart];   //precio normal
                $pc = $rows[pcart];   //precio compra
                $pvm2 = $rows[pvmart2];
                $pv2 = $rows[pvart2];
                $pc2 = $rows[pcart2];
            } else {
                $pvm = $rows[pvmart] / $cambi;  //precio minimo
                $pv = $rows[pvart] / $cambi;    //precio normal
                $pc = $rows[pcart] / $cambi;    //precio compra
                $pvm2 = $rows[pvmart2] / $cambi;
                $pv2 = $rows[pvart2] / $cambi;
                $pc2 = $rows[pcart2] / $cambi;
            }
        }            
?>
<script language="javascript" type="text/javascript"> 
    function ideasweb<?echo $tt;?>(){
    var xpre1=document.formular<?echo $tt;?>.precioo.value;
    var xpre2=document.formular<?echo $tt;?>.preciooo.value;
    var xpre3=document.formular<?echo $tt;?>.precim.value;
    var xpre4=document.formular<?echo $tt;?>.precimm.value;
    var xmed1=document.formular<?echo $tt;?>.medida.value;
    var xmed2=document.formular<?echo $tt;?>.medidaa.value;
    var xpre5=document.formular<?echo $tt;?>.precic.value;
    var xpre6=document.formular<?echo $tt;?>.precicc.value;
if(xmed1==xmed2){
    document.formular<?echo $tt;?>.precio.value=xpre1;
    document.formular<?echo $tt;?>.preciom.value=xpre3;
    document.formular<?echo $tt;?>.compra.value=xpre5;   
}else{
    document.formular<?echo $tt;?>.precio.value=xpre2;
    document.formular<?echo $tt;?>.preciom.value=xpre4;
    document.formular<?echo $tt;?>.compra.value=xpre6;
}    
}
</script>
<script language="JavaScript" type="text/javascript"> 
function cambio<?echo $tt;?>(){
var idcodart2 = document.formular<?echo $tt;?>.codart.value;
var idcant1  = document.formular<?echo $tt;?>.cantida.value;
var idum1  = document.formular<?echo $tt;?>.medida.value;
datos = {"idcodart":idcodart2,"idcant":idcant1,"idum":idum1};
$.ajax({
    url: "datos_precio.php",
    type: "POST",
    data: datos
}).done(function(respuesta){
    if (respuesta.estado=="ok") {
        console.log(JSON.stringify(respuesta));
        var precioso = respuesta.precio;
        document.formular<?echo $tt;?>.precio.value=precioso;
        document.formular<?echo $tt;?>.preciom.value=precioso;
    }else{
        console.log(JSON.stringify(respuesta));
        var xpre1=document.formular<?echo $tt;?>.precioo.value;
        var xpre2=document.formular<?echo $tt;?>.preciooo.value;
        var xpre3=document.formular<?echo $tt;?>.precim.value;
        var xpre4=document.formular<?echo $tt;?>.precimm.value;
        var xmed1=document.formular<?echo $tt;?>.medida.value;
        var xmed2=document.formular<?echo $tt;?>.medidaa.value;
        var xpre5=document.formular<?echo $tt;?>.precic.value;
        var xpre6=document.formular<?echo $tt;?>.precicc.value;
        if(xmed1==xmed2){
            document.formular<?echo $tt;?>.precio.value=xpre1;
            document.formular<?echo $tt;?>.preciom.value=xpre3;
            document.formular<?echo $tt;?>.compra.value=xpre5;   
        }else{
            document.formular<?echo $tt;?>.precio.value=xpre2;
            document.formular<?echo $tt;?>.preciom.value=xpre4;
            document.formular<?echo $tt;?>.compra.value=xpre6;
        }
    }
});
}
</script>
<?          
echo "<input name=precioo id=precioo type=hidden value='$pv' size=1><input name=preciooo id=preciooo type=hidden value='$pv2' size=1>   
    <input name=precim id=precim type=hidden value='$pvm' size=1><input name=precimm id=precimm type=hidden value='$pvm2' size=1>   
    <input name=precic id=precic type=hidden value='$pc' size=1><input name=precicc id=precicc type=hidden value='$pc2' size=1>             
    </td><td data-label='Medida'>
    <select size='1' name='medida' id='medida' onChange='ideasweb$tt();' onblur='ideasweb$tt();'>";
    $selS="SELECT * FROM $_SESSION[tbl]contable_tabla WHERE cod='$rows[medida]' and hijo='1974'";
    $resulQ=db_query($selS);
    $rowsx=db_fetch_array($resulQ);
    echo "<option value='$rows[medida]'>$rowsx[tabla]</option>";
    if($rows[medida2]<>""){ 
    $selS1="SELECT * FROM $_SESSION[tbl]contable_tabla WHERE cod='$rows[medida2]' and hijo='1974'";
    $resulQ1=db_query($selS1);
    $rowsx1=db_fetch_array($resulQ1);
    echo "<option value='$rows[medida2]'>$rowsx1[tabla]</option>"; } 
    echo " </select>";      
    echo "</td><td data-label='P-M/C'> ";
    if($tipoxx=="Servicio."){
        echo "<input name=compra id=compra  size=1  type=text value='$pc'>";            
        echo "<input name=preciom id=preciom  size=4  type=hidden value='$pvm'>";
    }else{
        echo "<input name=preciom id=preciom  size=4  type=hidden value='$pvm'>";
        echo $pvm;          
        echo "<input name=compra id=compra  size=1  type=hidden value='$pc'>";
    }
    echo "</td><td data-label='P.Venta'>";      
    $qry5 = "select precio from $_SESSION[tbl]salida s,$_SESSION[tbl]salida_detalle d  where d.idsalida=s.idsalida and s.idsalida=d.idsalida and d.codart='".$rows[codart]."' and s.idcliente='".$_SESSION[ventaIDcli]."' order by  codi desc";
    echo "<font style='font-size:10px'>";
    echo "<input name=precio id=precio  size=4  type=text value='".number_format($pv, 2, '.', '')."'>";
    echo "</a></b></td><td data-label='Cantidad'>
    <input name=productos id=productos type=hidden value='".$productos."'>
    <input name=codart id=codart type=hidden value='".$rows[codart]."' >
    <input name=nomart id=nomart type=hidden value='".$rows[nomart]."'>
    <input name=tipo id=tipo type=hidden value='".$tipo."'>
    <input name=cantida id=cantida type=text size=4 onChange='cambio$tt()' onblur='cambio$tt()' onkeyup='cambio$tt()'>";
    ?>
    <input name=ordenar id=ordenar type=hidden  size=2 value="<?php echo $ordenar + 1 ?>">       
    <?php
    echo "</b></td><td> <input name=descuento  type=text  size=1></b></td>";
    echo "<td data-label='Tipo Afecto IGV'>";
    combotipoafectoigv($rows[tipoimp]);
    echo "</td>";
    echo "<td data-label='Opciones'><button type='submit' class='botonimg dedos tce'  style='color:#0099FF'><i class='zmdi zmdi-plus-circle zmdi-hc-2x' title='Agregar Articulo'></i></button> </td>";
    echo '</tr></form>';
    }
}
if ($productos == "") {
    if ($TIPOempresa == "Cafeteria") {
    $queryOt = "SELECT * FROM $_SESSION[tbl]articulo WHERE categoria='Menu' AND stdo='Activo' ORDER BY nomart";
    $resultOt = db_query($queryOt);
    while ($rowsOt = db_fetch_array($resultOt)) {
        echo '<form method=POST action="venta_agrega_lista.php">';
        echo '<tr  class=texto><td  data-label="Codigo">';
        echo $rowsOt[codigo];
        echo '<td  data-label="Detalle">';
        echo $rowsOt[nomart];
        echo "</td><td data-label='Medida'>";
        $moneyArti = $rowsOt[moneda];
        if ($monedaf == "Soles") {
        if ($moneyArti == "D") {
            $pvm = $rows[pvmart] * $cambi;
            $pv = $rows[pvart] * $cambi;
            $pc = $rows[pcart] * $cambi;
            $pvm2 = $rows[pvmart2] * $cambi;
            $pv2 = $rows[pvart2] * $cambi;
            $pc2 = $rows[pcart2] * $cambi;
        } else {
            $pvm = $rows[pvmart];
            $pv = $rows[pvart];
            $pc = $rows[pcart];
            $pvm2 = $rows[pvmart2];
            $pv2 = $rows[pvart2];
            $pc2 = $rows[pcart2];
        }
        } else {
        if ($moneyArti == "D") {
            $pvm = $rows[pvmart];
            $pv = $rows[pvart];
            $pc = $rows[pcart];
            $pvm2 = $rows[pvmart2];
            $pv2 = $rows[pvart2];
            $pc2 = $rows[pcart2];
        } else {
            $pvm = $rows[pvmart] / $cambi;
            $pv = $rows[pvart] / $cambi;
            $pc = $rows[pcart] / $cambi;
            $pvm2 = $rows[pvmart2] / $cambi;
            $pv2 = $rows[pvart2] / $cambi;
            $pc2 = $rows[pcart2] / $cambi;
        }
        }
    echo "</td><td data-label='P-M/C'>";
    echo "<input name=preciom id=preciom  size=4  type=hidden value='$pvm'>";
    echo number_format($pvm, 2);
    echo "<input name=compra id=compra  size=1  type=hidden value='$pc'>";
    echo "</td><td data-label='P.Venta'>  <input name=precio id=precio  size=4  type=text value='" . number_format($pv, 2, '.', '') . "'>";
    echo "</a></b></td><td data-label='Cantidad'>
    <input name=productos id=productos type=hidden value='" . $productos . "'>
    <input name=codart id=codart type=hidden value='" . $rowsOt[codart] . "' >
    <input name=nomart id=nomart type=hidden value='" . $rowsOt[nomart] . "'>
    <input name=tipo id=tipo type=hidden value='" . $tipo . "'>         
    <input name=cantida id=cantida type=text  size=1>";
    ?>
    <input name=ordenar id=ordenar type=hidden  size=2 value="<?php echo $ordenar + 1 ?>">       
    <?php
    echo "</b></td><td data-label='Opciones'><button type='submit' class='botonimg dedos tce'  style='color:#0099FF'><i class='icon-checkbox-checked t7 dedos' title='Agregar Articulo'></i></button> ";
    echo '</td></tr></form>';
    }
    }
}
echo '</tbody>
</table>
</td>
  </tr>
</table>';
?>