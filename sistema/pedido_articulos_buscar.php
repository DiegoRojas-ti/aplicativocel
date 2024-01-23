<?php session_start(); ?>
<html dir="LTR" lang="es"> 
<?php date_default_timezone_set('America/Bogota');
include "../charsetUTF.php"; ?>
<?php 
date_default_timezone_set('America/Bogota');
extract($_REQUEST); 
?>
<head>
<title>Ideas Web</title>
<script>
function sf(){document.find.productos.focus()}
onload="sf()"
</script>
</head>
<body topmargin=0 leftmargin=0 rightmargin=0  bgcolor=white background=blanco.gif style="BACKGROUND: url(blanco.gif)">
<center>
<?php
include "funcion.php";
require ("config.php");
if ($vvmone <> "") {
    $_SESSION['monedaf'] = $vvmone;
    $carroV = $_SESSION['carroV'];
    if ($carroV) {
        foreach ($carroV as $kq => $vq) {
            $ordenarid = $vq['codx'];
            //unset($carroV[md5($ordenarq)]);
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
            //$carroV[md5($ordenarid)]=array('identificador'=>md5($ordenarid),'codx'=>$ordenarid,'cantida'=>$vq['cantida'],'nomart'=>$vq['nomart'],'precio'=>$precioA,'moneda'=>$vvmone,'detall'=>$vq['detall'],'codart'=>$vq['codart'],'preciom'=>$preciomA,'compra'=>$compraA,'codigoo'=>$vq['codigoo']);
            $carroV[md5($ordenarid) ] = array('identificador' => md5($ordenarid), 'codx' => $ordenarid, 'cantida' => $vq['cantida'], 'nomart' => $vq['nomart'], 'precio' => $precioA, 'moneda' => $vvmone, 'detall' => $vq['detall'], 'ekivalente' => $vq['ekivalente'], 'medida' => $vq['medida'], 'medida1' => $vq['medida'], 'medida2' => $vq['medida2'], 'codart' => $vq['codart'], 'preciom' => $preciomA, 'compra' => $compraA, 'codigoo' => $vq['codigoo']);
        }
    }
    $_SESSION['carroV'] = $carroV;
}
$monedaf = $_SESSION['monedaf'];
$fechas = time();
$meses = date("m", $fechas);
$an = date("Y", $fechas);
?>


<div id="contenedor">
    <table width="100%" border="0" cellspacing="0" style="color:#000;" cellpadding="0" align="center"> 
    <tr height="20">  
      <th width="50%" colspan=6>ITEM DEL PRODUCTO</th> 
    </tr> 
    <tr class=headTitle height="20"> 
        <th >NOrd.</th> 
        <th >Codigo</th> 
        <th width="25%">Nombre del Articulo</th>
        <th width="25%">Tipo de Carga</th>
        <th >P.Minimo</th> 
        <th >Precio <b> </b></th> 
        <th colspan="2" align="center" width="13%">Cant.</th> 
          <th align="center" width="3%">Act.</th>
        <th align="center" width="3%">Eli.</th>
      </tr> 
      <?php
        $color = array("#ffffff", "#F0F0F0");
        $contador = 0;
        $suma = 0;
        foreach ($carroV as $k => $v) {
            $subto = $v['cantida'] * $v['precio'];
            $suma = $suma + $subto;
            $contador++;
            $ordenar = $v['codx'];
    ?> 
      <form name="a<?php echo $v['identificador'] ?>" method="post" action="pedido_agrega_lista.php?<?php echo SID ?>" identificador="<?php echo $v['identificador'] ?>"> 
        <tr bgcolor="<?php echo $color[$contador % 2]; ?>" class=texto onmouseover=style.backgroundColor="#CCFF66" onmouseout=style.backgroundColor=""> 
        <td width="43" align=center><?php echo $xxcod = $v['codx']; ?><input name="ordenar" type="hidden" id="ordenar" value="<?php echo $xxcod; ?>"></td>
          <td align=center><?php echo $v['codigoo'] ?></td>  
          <td align="center"><?php //echo $v['nomart']
            $ztipo = $v['xtipo'];
            $xxdet = $v['detall'];
            if ($ztipo == "Servicio.") {
                echo "<textarea rows='1' name='servicioDET' id='servicioDET' cols='40'>$xxdet</textarea>";
            } else {
                echo $v['nomart'];
            }
    ?></td> 
    <td align="center"><?php echo $v['tipocarga'] ?></td>
          <td width="20" align=center> 
        <?php $mone = $v['moneda'];
            if ($mone == "Soles") {
                echo $mones = "S/.";
            } else {
                echo $mones = "US$";
            }
            if ($v['preciom'] <> 0) {
                $xxpvm = number_format($v['preciom'], 2);
            } else {
                $xxpvm = "0";
            }
    ?>
        <input name=preciom id=preciom class=txtcurva size=2  type=hidden value='<?php echo $xxpvm; ?>'><?php echo $xxpvm; ?></td>  
      <td align=right> 
        <?php echo $mones; ?>
        <input name=precio class=cajaTexto size=5  type=text value="<?php echo $v['precio'] ?>">
        </td> 
          <td width="43" align=right><?php $v['cantida'] ?></td> 
          <td width="136" align="center" >  
            <input name="cantida" type="text" id="cantida" value="<?php echo $v['cantida'] ?>" class=inputt size="1"><input name="codart" type="hidden" id="codart" value="<?php echo $v['codart'] ?>"> 
            <?php echo $v['medida']; ?><input name="medida" type="hidden" id="medida" value="<?php echo $v['medida'] ?>"></td> 
           <td align="center"><button type='submit' class='botonimg dedos tce'  style='color:#0099FF'><i class='zmdi zmdi-plus-circle zmdi-hc-2x' title='Actualizar Item'></i></button> </td> 
          <td align="center"><a href="pedido_borrar_selecion.php?<?php echo SID ?>&codx=<?php echo $xxcod; ?>"><i class='zmdi zmdi-close zmdi-hc-2x trojo' ></i> </a></td>
      </tr></form> 
      <?php
        } ?> 
    </table> 
    <div align="center">
    </div> 
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="98%" >
      <tr>
        <td width="100%" bgcolor=666666 height="1"></td>
      </tr>
      <tr>
        <td width="100%" height="20" class=texto align=center><b>Total : <?php echo $mones; ?> </b> <?php echo number_format($suma, 2); ?></td>
        </tr>
      <tr>
        <td width="100%" bgcolor=666666 height="1"></td>
        </tr>
    </table>
</div>