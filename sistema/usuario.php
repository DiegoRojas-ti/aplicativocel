<?php include "head.php"; ?>
<font class="t7">USUARIOS</font>
<center>
<div class="no_imprimir t5">	
<form name="formbuscar" id="formbuscar" action="" method="Post" >
<b>BUSCAR X</b>
<input type="text" placeholder="Ingrese el texto a buscar" name="productos" id="productos" class=inp_an8 maxlength      value="<?php echo $productos; ?>"> 
<button type="submit" class="botonNuevo"  ><i class="icon-search"></i> Buscar</button>&nbsp;<?php if (($niveles == "Gerente") or ($niveles == "Director") or ($niveles == "Administrador")) { ?><button type="button" class="botonNuevo" onClick="javascript:window.location.href='usuario-nuevo.php'"><i class="icon-plus t4"></i> Agregar Nuevo</button>
<?php
} ?>
</form>
</div>	
</center>
<?php
$xADMINvende="";
if ($xsoloVEN == "Si") {
    echo '<script>document.location.href="tipodecambio.php";</script>';
}
if ($productos <> "") {
    $SQLsent = " and nombre like '%$productos%'";
}
if ($niveles == "Administrador") {
    $xADMINvende = " and  sucursal='$sucursa' and usuario='$usuario' ";
}
$_pagi_sql = "SELECT * FROM rus_6";
$_pagi_result = db_query($_pagi_sql);
$numero_registros = db_num_rows($_pagi_result);
$_pagi_cuantos = 30;
//include ("paginator.inc.php");
echo '<center>';
if (($niveles == "Gerente") or ($niveles == "Director") or ($niveles == "Administrador")) {
    echo ' ';
}
$contador=0;
$color="";
echo '
<br><br><b>LISTADO GENERAL DE USUARIO</b>';
echo '<table class="texto tableM "><thead><tr>
	<th width="3%" ><b>ACTUALIZAR</b></th> 
    <th width="35%"><b>Nombre</b></th>
    <th  width="8%" class="ocul"><b>Telfono</b></th> 
    <th  width="9%" ><b>TIENDA</b></th>
  </tr></thead><tbody>';
while ($rows = db_fetch_array($_pagi_result)) {
    $contador++;
    echo '<tr  class=texto bgcolor="' . $color[$contador % 2] . '" onmouseover=style.backgroundColor="#CCFF66" onmouseout=style.backgroundColor=""><td  align=center data-label="Op."><b>';
    //echo "<a href='usuario-modificar.php?ids=" . $rows['ncod'] . "'  ><font class='zmdi zmdi-more zmdi-hc-2x' title='Actualizar, Eliminar y Imprimir' ></font> </a>";
    echo "<a href='usuario-config.php?ids=" . $rows['ncod'] . "'  ><font class='zmdi zmdi-edit zmdi-hc-lg dedos' title='Configurar Usuario' ></font> </a>";
    echo "</b></td><td data-label='Nombew'>";
    echo $nombre = $rows['nom_acceso'];
    echo "</td><td class='ocul' data-label='Telefono'>";
    echo $rows['usuario'];
    echo "</td><td data-label='Sucursal'>";
    $queryXot = "SELECT * FROM XOUT.dbo.EMPRESA WHERE Empest='A' and EmpCod='4'";
    $resultXot = db_query($queryXot);
    $rowsXot = db_fetch_array($resultXot);
    echo $rowsXot['EmpRaz'];
    echo '</td></tr>';
}
echo '</tbody>
</table>';
echo "<p>" . $_pagi_navegacion . "</p>";
?>		
<?php $xidform = "formbuscar";
include "pie.php" ?>