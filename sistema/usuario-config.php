<?php include "head.php"; 


if($modo=='ya')
{

$insac2="DELETE FROM master WHERE idcliente='$ids'";
db_query($insac2);
$provincia=$_POST["menus"];
for ($i=0;$i<count($provincia);$i++)    
{
	$insac="INSERT INTO master VALUES ('0','$ids','$provincia[$i]')";
	db_query($insac);
}
	echo msj("save","Informacion Actualizada satisfactoriamente");
}
?>
<font class="t7"><b>CONFIGURAR USUARIOS</b></font>
<form name="formbuscar" id="formbuscar" method="post" action="">
	<input type="hidden" name="modo" value="ya">
<ul style="list-style: none;">
<?php
$sql2="SELECT * FROM login WHERE idt='0' order by orden";
    $sq0=db_query($sql2);
    while($rows=db_fetch_array($sq0))
    {
	    echo "<div style='float:left;border-style: solid'>";
	    $sl="SELECT * FROM login WHERE idt='".$rows['Id']."'";
	    $sq=db_query($sl);
	    $sq_count=db_num_rows($sq);
	    $selcli="SELECT * FROM master WHERE idcliente='$ids' and idmenu='$rows[Id]'";
	    $resx=db_query($selcli);
	    $cotm2=db_num_rows($resx);
    if($cotm2=='0')
    {
    	$tive1="";
    }else{
		$tive1="checked";
    }
	echo $tive1;
	echo "<label><li class='menu-item'><input type=checkbox value='$rows[Id]' name='menus[]' $tive1>$rows[nombre1]</li></label>";
    while($row1s=db_fetch_array($sq))
    {
    	$selcli="SELECT * FROM master WHERE idcliente='$ids' and idmenu='$row1s[Id]'";
    	$resx=db_query($selcli);
    	$cotm=db_num_rows($resx);
    	if($cotm=='0')
    	{
    		$tive="";
    	}else{
			$tive="checked";
    	}
        echo "<label><p style='margin-left: 1em'><input type=checkbox value='$row1s[Id]' name='menus[]' $tive>$row1s[nombre1]</p></label>";
    }
    echo "</div>"
    ?>
	<?php
   }

    ?>
</ul>  
<center>
<div style="clear: both;"></div>
<button type="submit" class="botonNuevo"><i class="icon-disk"></i> Guardar</button>&nbsp; 
<button type="button" class="botonNuevo" onClick="javascript:window.location.href='usuario.php'"><i class="icon-undo2"></i> Regresar</button>
</center>
</form>
<?
include "pie.php";
?>