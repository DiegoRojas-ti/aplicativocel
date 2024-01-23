<?php include "head.php";
unset($_SESSION['carroV']);
$_SESSION['igvnum1_'] = $igvnum1;?>
<h3> PACKING LIST</h3>
<?php
if ($nr <> "") { ?>
	<center><div class="t9 c bgazu0 border pd5" style="width:400px">
		Se Genero Cotizacion Nro :<?php $queryNro = "SELECT * FROM $_SESSION[tbl]pedido where idcot='$nr'";
    $resultNro = db_query($queryNro);
    $rowsNro = db_fetch_array($resultNro);
    echo $rowsNro[nrodoc]; ?>
	</div></center>
	<?php
    $COTIZmailAut='Si';
    if ($COTIZmailAut == "Si") {
        $rowsNro[cliente];
        $queryCcli = "SELECT *  FROM  $_SESSION[tbl]clientes where cod='" . $rowsNro[cliente] . "' order by cod";
        $resultCcli = db_query($queryCcli);
        $rowsCcli = db_fetch_array($resultCcli);
        $SqlSuc = "select *  FROM  $_SESSION[tbl]sucursal where  id='" . $rowsNro[sucursal] . "'  ";        
        $resultSuc = db_query($SqlSuc);
        $rowsSuc = db_fetch_array($resultSuc);
        $descargar = "$url_web" . "cweb.php?u=$nr-" . md5($nr);
        $from = $rowsSuc[email];
        $empresa = $rowsSuc[empresa];
        $destinos = $rowsCcli[vendedor];
        if ($destinos =='') {
            echo msj("eror", "No se envio la cotizacion por no indico E-mail");
        } else {
            //$to  = 'aidan@example.com' . ', '; // note the comma
            //$to .= 'wez@example.com';
            // subject
            $subject = "Cotizacion Nro $rowsNro[nrodoc]";
            // message
            //echo $descargar;
            $message = "

<html><head><title>$subject</title></head>
<body><Descarga su Cotizacion en el siguiente URL<br>
	 <a href='$descargar'>$descargar</a>	
  <br>--------------------------------------------------<br>
Mensaje Enviado por <br><br>
 $empresa - <a href='$rowsSuc[web]'>$rowsSuc[web]</a>  
</body>
</html>
";
            $headers = 'MIME-Version: 1.0' . "
";
            $headers.= 'Content-type: text/html; charset=iso-8859-1' . "
";
            $headers.= 'To: ' . $rowsCcli[nombre] . '<'.$destinos.'>' . "
";
            $headers.= 'From: ' . $empresa . ' <' . $from . '>' . "
";

            mail($destinos, $subject, $message, $headers);
            /*
            mail("$destinos", "Cotizacion Nro $rowsNro[nrodoc]", "
            
            Descarga su Cotizacion en el siguiente URL
            $descargar
            
            --------------------------------------------------
            Mensaje Enviado por Message Form X
            
            $empresa - $rowsSuc[web]
            --------------------------------------------------", "From: $empresa <$from>");	*/
            echo msj("save", "Se envio con exito al email $rowsCcli[vendedor]");
            $COTIZmailAut=='No';
        }
    }
}
$_SESSION['idxcot'] = "";
?>


<form name="formbuscar" id="formbuscar" action="" method="Post">


<ol id="idimput" class="espacio texto"> 
    <li class="five"><b>BUSCAR X </b>
		<input type="radio" value="1"  style="width:15px" name="tipo" <?php if ($tipo == "1") {
    echo "checked";
} ?> >Nro Pedido / <input type="radio" value="2" style="width:15px" name="tipo" <?php if ($tipo == "2") {
    echo "checked";
} ?> >clientes 
		<?php if (($niveles == "Gerente") or ($niveles == "Director") or ($niveles == "Administrador")) { ?>
			/ <input type="radio" value="3"  style="width:15px" name="tipo" <?php if ($tipo == "3") {
        echo "checked";
    } ?> >Vendedor
		<?php
} ?>	<br>	
        <input type="text" name="cotiza" id="cotiza" style="width:90%" maxlength      value="<?php echo $cotiza; ?>"> <B>y/o</B>
         <li  class="two">Fecha Inicio<br><input type="text"   name="fei" id="fei"  value="<?php echo $fei; ?>" class="dates">
		<li  class="two">Fecha Fin<br><input type="text"   name="fef" id="fef"   value="<?php echo $fef; ?>" class="dates">
		
		<li ><br> 
 		<button type="submit" class="botonNuevo"  ><i class="icon-search"></i>Buscar</button>&nbsp;
		<?php if ($niveles <> "Cobranza") { ?>	
			<button type="button" class="botonNuevo" onClick="javascript:window.location.href='pedido_nuevo.php?documento=Cotizacion'"><i class="icon-plus"  "fa-plus"></i> Agregar Nuevo</button> 
		<?php
} ?>
</ol>
<div style="clear:both"></div>
</form>
<?php
$_SESSION['nguias'] = "";
$_SESSION['tguias'] = "";
$monedaf = "S";
if ($monedaf == "") {
    $carroV = $_SESSION['carroV'];
    if ($carroV) {
        foreach ($carroV as $kq => $vq) {
            $ordenarq = $vq['codx'];
            unset($carroV[md5($ordenarq) ]);
        }
    }
    $_SESSION['carroV'] = $carroV;
}
echo '<center> <br>';
if ($cotiza <> "" and $fei == "" and $fef == "") {
    $query = "set dateformat ymd select a.*,b.CliRaz from des.PLIST_CAB a left join CLIENTE b on a.CodCli=b.CliCod where and LEFT(convert(varchar,cOrd.FecReg,103),12) between '".$fechahoy."' and '".$fechahoy."' ";
} elseif ($cotiza <> "" and $fei <> "" and $fef <> "") {
    $query = "set dateformat ymd select a.*,b.CliRaz from des.PLIST_CAB a left join CLIENTE b on a.CodCli=b.CliCod where Convert(DATE,a.FechaReg)>='$fei' and Convert(DATE,a.FechaReg)<='$fef'";
} elseif ($cotiza == "" and $fei <> "" and $fef <> "") {
    $query = "set dateformat ymd select a.*,b.CliRaz from des.PLIST_CAB a left join CLIENTE b on a.CodCli=b.CliCod where Convert(DATE,a.FechaReg)>='$fei' and Convert(DATE,a.FechaReg)<='$fef'";
} else {
    $query = "select a.*,b.CliRaz,Convert(DATE,a.FechaReg) as FechaCrea from XOUT.des.PLIST_CAB a left join XOUT.dbo.CLIENTE b on a.CodCli=b.CliCod where a.FechaReg>='".$fechahoy."T00:00:00' and a.FechaReg<='".$fechahoy."T23:59:59'";
}
$contador=0;
$result = db_query($query);
echo '<center>
<b>LISTADO GENERAL DE PEDIDOS</b><br>
<font class=text>
 <br> <table class="texto tableM "><thead><tr>
    <th width="0%" ><b>Item</b></th>
    <th ><b>Nro Packing</b></th>
    <th ><b>Fecha</b></th>    
    <th ><b>Cliente</b></th>
    <th ><b>Tipo</b></th>
    <th ><b>Total</b></th>
    <th width="17%"><b>Opcion</b></th>
  </tr></thead><tbody>';
$num_rows = db_num_rows($result);
while($rows = db_fetch_array($result)){    
    $contador++;
    echo '<tr  class=texto bgcolor="' . $color[$contador % 2] . '" onmouseover=style.backgroundColor="#CCFF66" onmouseout=style.backgroundColor=""><td  align=left data-label="Item"><b>';
    echo $contador;
    echo "</td><td data-label='Num. Packing'>";
    echo $rows['CodPL'];
    echo "</td><td data-label='Fecha'>";
    echo $rows['FechaCrea']->format('d/m/Y');
    echo "</td><td data-label='Cliente'>";
    echo $rows['CliRaz'];
    echo "</td><td data-label='Tipo'>";
    echo $rows['Orden'];
    echo "</td><td data-label='Total KG'>";
    echo $rows['Total'];
    echo "</td><td align=center data-label='Opciones'>";
    echo "<a href='pedido_modificar.php?idcot=".$rows['CodPL']."&donde=modificar'  title='Modificar y Agregar'><i class='zmdi zmdi-more zmdi-hc-2x' title='Ver + detalle y Modificar'></i></a>&nbsp;";
    echo '</td></tr>';
}
echo '
</tbody></table>';
?>
<hr>
<div class="t3">
<b>Leyenda de OPCIONES   : 	</b>
	<i class='icon-file-pdf trojo t6' alt='Generar a PDF'></i>
	<i class='icon-file-word t6' style='color:#3333CC'></i>Exportar&nbsp;&nbsp; 
	<i class='icon-edit t7' title='Actualizar, Eliminar y Imprimir'></i> Actualizar, Eliminar &nbsp;&nbsp;	
	<i class='icon-mail2 t5 dedos' style='color:#000' title='Enviar al E-mail'></i> Enviar al E-mail &nbsp;&nbsp;	
	<i class='icon-clipboard2 _icon-sale t5 '  style='color:#669900' title='Generar venta'></i> Confirma venta &nbsp;&nbsp;
	<i class='icon-clipboard3   t5 '   style='color:#CC3300'   title='Generar Guia de Remision'></i> Generar Guia de Remision &nbsp;&nbsp	
	<i class='icon-credit-card t5 '   style='color:#000'   title='Credito - Post Ingreson'></i> Credito - Post Ingreso &nbsp;&nbsp
</div>
</font>	
<?php $xidform = "formbuscar";
include "pie.php" ?>