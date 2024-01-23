<?php
include "head.php"; ?>
<script language="javascript">
function funPasar()
{
    document.frmPasar.vvmone.value=document.formbuscar.moneda.value
	document.frmPasar.submit()
 
}
</script>
<?php
$idsalida="";
if ($idsalida <> "") {
    if ($cliente <> $clienteID) {
        $queryClix = "SELECT *  FROM  $_SESSION[tbl]clientes where cod='$clienteID'  ";
        $resultClix = db_query($queryClix);
        $rowsClix = db_fetch_array($resultClix);
        $sqlx = "update $_SESSION[tbl]pedido set cliente='$clienteID',nombre='" . $rowsClix[nombre] . "'   where idcot='$idsalida'  ";
        db_query($sqlx);
    }
    $sql = "update $_SESSION[tbl]pedido set valides='$valides',entrega='$entrega',igv='$igv',garantia='$garantia',fecha='$fecha',come='$come',atencion='$atencion' ,condicion='$condicion',diax='$diax',obs='$obse'  where idcot='$idsalida'";
    db_query($sql);
    echo '<script>
document.location.href="pedido.php?cotiza=' . $nrosalida . '";
</script>';
}
$queryw = "SELECT *,Convert(DATE,FechaReg) as FechaCrea  FROM XOUT.des.PLIST_CAB where CodPL='$idcot'";
$resultw = db_query($queryw);
$rowsw = db_fetch_array($resultw);
$fechas = time();
$meses = date("m", $fechas);
$an = date("Y", $fechas);
$fec = date("Y-m-d", $fechas);
?>
<div class="t7">PEDIDO : MODIFICAR</div>
<CENTER>
<?php
echo '
<form name="formbuscar" id="formbuscar" method="POST" action="">
<input type="hidden"  name="idsalida"  size="12"  value="' . $idcot . '">   
<ol id="idimput" class="espacio texto"> 
<li class="oness"><b>Nro Pedido. : </b>' . $req . '<br><input type="number"  required name="nrosalida"  size=12 maxlength="7" value="'.$rowsw['CodPL'].'" readonly>      
<li><b>Fecha :	</b>' . $req . '<br><input type="text" required name="fecha" size="8"    value="'.$rowsw['FechaCrea']->format('d/m/Y').'" >'; ?>
<li class="four"><b>Cliente :  </b><?php echo $req ?><br>
 
 				  <style>
				  .custom-combobox {position: relative;	display: inline-block;width: 80%;  }
				  .custom-combobox-toggle {	position: absolute;	top: 0;bottom: 0;
					margin-left: -1px;padding: 9px;
					/* support: IE7 */
					*height: 1.7em;
					*top: 0.1em;
				  }
				  .custom-combobox-input {margin: 0;padding: 9px;	width:100%  }
				  </style>
				  <script src="buscar_jquery-ui.js"></script>
				  <script>				 
				  $(function() {
					$( "#clienteID" ).combobox();
					$( "#toggle" ).click(function() {
					  $( "#clienteID" ).toggle();
					});
				  });
				  </script>					  
					<?php $clienteID = $rowsw['CodCli'];
$SQL2 = "SELECT * FROM XOUT.dbo.CLIENTE WHERE CliCod='".$clienteID."' order by CliRaz";
if (!($resultP2 = db_query($SQL2))) {
    echo "error :" . db_error();
    exit();
}
echo '<select required name="clienteID"  id="clienteID"   >';
echo "<option value=''>";
while ($row2 = db_fetch_array($resultP2)) {
    if ($row2["CliCod"] == $clienteID) {
        $Selec2 = "selected";
    } else {
        $Selec2 = "";
    }
    echo "<option  value='" . $row2["CliCod"] . "' $Selec2>" . $row2["CliRaz"];
}
echo '</select>';
?>	
</li>
<li class="one"><b>Tipo  </b><?php echo $req ?> : <br>
<?php
if($rowsw['Orden']=="S")
{
    echo "SERVICIO";
}
if($rowsw['Orden']=="V")
{
    echo "VENTA";
}
?> 
</li>
<li class="one"><b>Estado</b><br>
<?php 
if($rowsw['Estado']==1)
{
    echo "GENERADA";
}else{
    echo "PENDIENTE";
}
?>
</li>  
</ol> 
<div style="clear:both"></div>
<center>
<button type="submit" class="botonNuevo"><i class="icon-disk"></i> Guardar</button>&nbsp;
<button type="button" class="botonNuevo" onclick="pregunta()"><i class="icon-remove"></i> Eliminar</button>&nbsp; 
<button type="button" class="botonNuevo" onClick="javascript:window.location.href='packing.php'">Regresar</button>

<script type="text/javascript" src="../js/jquery.autoheight.js"></script>
<iframe id="idfrmBus" name="idfrmBus" width='100%' class="autoHeight" scrolling="auto" frameborder="0" src="pedido_articulos_buscar..php?idcot=<?php echo $idcot; ?>"></iframe>
<script language="JavaScript"> 
   function pregunta(){ 
       if (confirm('Esta seguro de eliminar?')){  <?php echo "document.location.href='pedido_modificar.php?idcot=$idcot&ids=$ids&donde=modificar&idss=$ids';"; ?> } 
   } 
</script>
</form>
<?php $xidform = "formbuscar";
include "pie.php" ?>
<form name="frmPasar"  id="frmPasar" method="post" action="pedido_modificar.php?idcot=<?php echo $idcot; ?>" >	
    <input type="hidden" name="k" id="k"   value="1" class=cajaTexto>
	<input type="hidden" name="vvmone" id="vvmone"   value="" class=cajaTexto>
</form>