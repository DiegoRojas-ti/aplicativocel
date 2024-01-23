<?php
session_start();
extract($_REQUEST);
require ("config.php");
?><!doctype html>
<html class="no-js" lang="es">
<title>Ideas Web</title>
<body bgcolor="white" background="blanco.gif" style="BACKGROUND: url(blanco.gif)">
<style>

  @media screen and (max-width: 600px) {

    table.tableM {
      border: 0;
    }

    table.tableM thead {
      display: none;
    }

    table.tableM tr {
      margin-bottom_: 10px;
      display: block;
      border-bottom: 2px solid #ddd;
    }

    table.tableM td {
      display: block;
      text-align: right;
      font-size: 13px;
      border-bottom: 1px dotted #ccc;
    }

    table.tableM td:last-child {
      border-bottom: 0;
    }

    table.tableM td:before {
      content: attr(data-label);
      float: left;
      text-transform: uppercase;
      font-weight: bold;
    }
    
    .ventanaPopUP{
      width:400px;
    }
    
    
        .anchoMedio  {
            width: 100%;    
        }   
    
  } 
     
table.thead.headings {
    background-color: #eee;
}


table.tableM {
    width: 100%;
    margin:0;
    padding:0;
    border-collapse: separate;
    padding-right: 5px;
  }
  
.tableM tr:nth-of-type(odd) { 
    background: #eee; 
}
.tableM th { 
    background: #276873;#333;   color: white;   font-weight: bold; 
}

  table.tableM tr {
    border: 1px solid #ddd;
    padding: 5px;
  }

  table.tableM th, table.tableM td {
    padding: 3px;
    text-align: center;
  }

  table.tableM th {
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 1px;
  }    
</style>
<center>
<?php
date_default_timezone_set('America/Bogota');
?>
<?php
if ($vvmone <> "") {
    $_SESSION['monedaf'] = $vvmone;
    $carroV = $_SESSION['carroV'];
    if ($carroV) {
        foreach ($carroV as $kq => $vq) {
            $ordenarq = $vq['codx'];
            unset($carroV[md5($ordenarq) ]);
        }
    }
    $_SESSION['carroV'] = $carroV;
}
$monedaf = $_SESSION['monedaf'];
//modificacion de item
/*if ($codartx <> "") {
    if (!$cantidax) {
        $cantidax = 1;
    }
    $subtox = $precioxx * $cantidax;
    if (!(db_query("insert into $_SESSION[tbl]pedido_detalle  values (0,'$idcot','$codartx','$nomartx','$cantidax','$tipunidad-$medida','$precioxx','$subtox','$nomartx','$ordenara','$tipcarga')"))) {
        echo "error :" . db_error();
        exit();
    }
}*/
require ("pedido_ver_lista_articulo..php");
?>
<div style="clear:both"></div>
<center>

 <hr>
<form name="find" method="post" id=fssss action=""> 
 <ol id="idimput" class="espacio texto"> 
    <li class="five"> <B>BUSCAR x</B><input type="radio" value="1"  style="width:15px" name="tipo" <?php if ($tipo == "") {
    echo "checked";
} ?> <?php if ($tipo == "1") {
    echo "checked";
} ?> >Nombre  / <input type="radio" value="2"  style="width:15px" name="tipo" <?php if ($tipo == "2") {
    echo "checked";
} ?> >Marca / <input type="radio" value="3"  style="width:15px" name="tipo" <?php if ($tipo == "3") {
    echo "checked";
} ?> >Linea /<input type="radio" value="4"  style="width:15px" name="tipo" <?php if ($tipo == "4") {
    echo "checked";
} ?> >Categoria / <input type="radio" value="5"  style="width:15px" name="tipo" <?php if ($tipo == "5") {
    echo "checked";
} ?> >Codigo 
	</li>	
	<li class="four"><input type="text" name="productos" id="productos"    value="<?php echo $productos; ?>"  ></li>	
	<li><button type="submit" class="botonNuevo" ><i class="icon-search" "icon-magnifier"  ></i>Buscar</button><font class="tce dedos icon-rotate icon-2x b" title='Nuevo busqueda' onClick="javascript:window.location.href='cotiza_articulos_buscar..php'"></font> 
		</li>
 </ol>
</form>
<div style="clear:both"></div>

<?php
if ($tipo == "1") {
    $xcampox = " and nomart like '%$productos%' ";
} elseif ($tipo == "2") {
    $xcampox = " and marca like '%$productos%' ";
} elseif ($tipo == "3") {
    $xcampox = " and linea like '%$productos%' ";
} elseif ($tipo == "4") {
    $xcampox = " and categoria like '%$productos%' ";
} elseif ($tipo == "5") {
    $xcampox = " and codigo like '%$productos%' ";
} else {
    $xcampox = " and nomart like '%$productos%' ";
}
if ($productos <> "") {
    $query = "SELECT *  FROM  $_SESSION[tbl]articulo   where  stdo='Activo' $xcampox   order by  nomart";
} else {
    $query = "SELECT *   FROM  $_SESSION[tbl]articulo   where tipox='Servicio' and stdo='Activo' order by  nomart";
    //codart,nomart,pvart ,codigo,medida,marca,tipox,pvmart,pvmart2,pvart2,moneda,ekivalente,medida2
    
}
$result = db_query($query);
if ($_SESSION[UNalmacen] == "") {
    $sucursaX = $_SESSION['sucursa'];
} else {
    $sucursaX = $_SESSION[UNalmacen];
}
echo '<table class="texto tableM"><thead><tr>
    <th ><b>Codigo</b></th>
    <th ><b>Articulos</b></th>
    <th ><b>Tipo Unidad</b></th>
    <th ><b>Tipo de Carga</b></th>
    <th width="4%"><b>Peso</b></th>
    <th ><b>Precio</b></th>
    <th ><b>Cantidad</b></th>
    <th width="2%" ><b>Seleccionar</b></th>

  </tr></thead><tbody>';
//while($rows=db_fetch_array($result)){
$num_rows = db_num_rows($result);
for ($Myval = 1;$Myval <= $num_rows;$Myval++) {
    $tt = $tt + 1;
    echo "<form method=POST action='' name='formular$tt' id='formular$tt'>";
    $rows = db_fetch_array($result);
    echo '<tr  class=texto onmouseover=style.backgroundColor="#CCFF66" onmouseout=style.backgroundColor=""><td  align=left data-label="Codigo">';
    $tipoxx = $rows[tipox];
    echo $rows[codigo];
    echo "</td><td align=left data-label='Articulos'>";
    //echo $rows[nomart];
    if ($tipoxx == "Servicio.") {
        echo "<textarea rows='1' name='detall' id='detall' cols='20'>$rows[nomart]</textarea>";
    } else {
        if ($TIPOempresa == "Soft") {
            if ($rows[url] == "") {
                $uxrl = "Detalle-$rows[codart]/";
            } else {
                $uxrl = "$rows[url]/";
            }
            echo "<a href='" . $url_web . "$uxrl' target='_blank'>";
        }
    }
    if ($tipoxx == "Articulo") {
        echo $rows[nomart];
    }
    if ($tipoxx == "Servicio") {
        echo $rows[nomart];
    }
    echo "</a></td><input  name=medidaa id=medidaa type=hidden value='$rows[medida]' size=1><input  name=medidaa2 id=medida2 type=hidden value='$rows[medida2]' size=1>";
    $idPro = $rows[codart];
    $querySt = "SELECT stock  FROM  $_SESSION[tbl]sucursal_detalle   where sucursal='$sucursaU' and articulo='$idPro'  order by  sucursal";
        
    $resultSt = db_query($querySt);
    $rowsSt = db_fetch_array($resultSt);
    //echo $rowsSt[stock];
    //--------Stock INICIO--------------------
    $xxMIstock = "";
    $nxtock = $rowsSt[stock];
    $xcerox = ($nxtock - intval($nxtock)) * 100;
    if ($xcerox == 0) {
        if ($nxtock == 0.00) {
            $xxMIstock = "$nxtock";
        } else {
            $xxMIstock = "$nxtock$rows[medida]";
        }
    } else {
        $xxUNIDAxx = ($nxtock * $rows[ekivalente]);
        $xxENTEROxx = (intval($nxtock) * $rows[ekivalente]);
        $XXunidadXX = $xxUNIDAxx - $xxENTEROxx;
        //$xxMIstock="".intval($nxtock)."$rows[medida] $XXunidadXX$rows[medida2]";
        $xxMIstock = "" . intval($nxtock) . "/$XXunidadXX";
    }
    //echo $xxMIstock;
    //--------Stock FIN--------------------
    $moneyArti = $rows[moneda];
    //if($monedaf=="Soles"){$pvm=$rows[pvmart]*$cambi; $pv=$rows[pvart]*$cambi; }else{$pvm=$rows[pvmart]; $pv=$rows[pvart];}
    if ($monedaf == "Soles") {
        if ($moneyArti == "D") {
            $pvm = $rows[pvmart] * $cambi;
            $pv = $rows[pvart] * $cambi;
            $pvm2 = $rows[pvmart2] * $cambi;
            $pv2 = $rows[pvart2] * $cambi;
        } else {
            $pvm = $rows[pvmart];
            $pv = $rows[pvart];
            $pvm2 = $rows[pvmart2];
            $pv2 = $rows[pvart2];
        }
    } else {
        if ($moneyArti == "D") {
            $pvm = $rows[pvmart];
            $pv = $rows[pvart];
            $pvm2 = $rows[pvmart2];
            $pv2 = $rows[pvart2];
        } else {
            $pvm = $rows[pvmart] / $cambi;
            $pv = $rows[pvart] / $cambi;
            $pvm2 = $rows[pvmart2] / $cambi;
            $pv2 = $rows[pvart2] / $cambi;
        }
    }
?>    
<script language="JavaScript" type="text/javascript"> 
    function inteligente<?php echo $tt;?>(){
var xpre1=document.formular<?php echo $tt;?>.precioo.value;
var xpre2=document.formular<?php echo $tt;?>.preciooo.value;
    var xpre3=document.formular<?php echo $tt;?>.precim.value;
    var xpre4=document.formular<?php echo $tt;?>.precimm.value;
var xmed1=document.formular<?php echo $tt;?>.medida.value;
var xmed2=document.formular<?php echo $tt;?>.medidaa.value;
    //var xpre5=document.formular<?echo $tt;?>.precic.value;
    //var xpre6=document.formular<?echo $tt;?>.precicc.value;

if(xmed1==xmed2){
 document.formular<?php echo $tt;?>.precio.value=xpre1;
 document.formular<?php echo $tt;?>.preciom.value=xpre3;
    //document.formular<?echo $tt;?>.compra.value=xpre5;   
}else{
 document.formular<?php echo $tt;?>.precio.value=xpre2;
 document.formular<?php echo $tt;?>.preciom.value=xpre4;
    //document.formular<?echo $tt;?>.compra.value=xpre6;
}    
}
    </script> 
    <?php
   echo "<input name=precioo id=precioo type=hidden value='$pv' size=1><input name=preciooo id=preciooo type=hidden value='$pv2' size=1>    
          <input name=precim id=precim type=hidden value='$pvm' size=1><input name=precimm id=precimm type=hidden value='$pvm2' size=1>"?>
         <?php $query8 = "SELECT * FROM  $_SESSION[tbl]tablas where tabla='Tipo Unidad' ";
$result8 = db_query($query8);
$rows8 = db_fetch_array($result8);
$SQLl = "Select * From $_SESSION[tbl]tablas where hijo='" . $rows8[id] . "' order by tabla";
if (!($resultl = db_query($SQLl))) {
    echo "error :" . db_error();
    exit();
}
echo "</td><td>";
echo '<select name="tipunidad" id="tipunidad">';
while ($rowl = db_fetch_array($resultl)) {
    if ($rows[marca] == $rowl[tabla]) {
        $xsel0 = "selected";
    } else {
        $xsel0 = "";
    }
    echo "<option  value='" . $rowl["tabla"] . "' $xsel0>" . $rowl["tabla"];
}
echo '</select>'?> 


<?php $query8 = "SELECT * FROM  $_SESSION[tbl]tablas where tabla='Peso' ";
$result8 = db_query($query8);
$rows8 = db_fetch_array($result8);
$SQLl = "Select * From $_SESSION[tbl]tablas where hijo='" . $rows8[id] . "' order by tabla";
if (!($resultl = db_query($SQLl))) {
    echo "error :" . db_error();
    exit();
}
echo '<select name="medida" id="medida">';
while ($rowl = db_fetch_array($resultl)) {
    if ($rows[marca] == $rowl[tabla]) {
        $xsel0 = "selected";
    } else {
        $xsel0 = "";
    }
    echo "<option  value='" . $rowl["tabla"] . "' $xsel0>" . $rowl["tabla"];
}
echo '</select></td>';
echo "<td> <textarea rows='1' name='tipcarga' id='tipcarga' cols='20'></textarea></td>";
        echo "<td align=center data-label='PrecioM'>  <input name=preciom id=preciom  size=4  type=hidden value='$pvm'>";
 
        $qry5 = "select precio from $_SESSION[tbl]salida s,$_SESSION[tbl]salida_detalle d  where d.idsalida=s.idsalida and s.idsalida=d.idsalida and d.codart='$idPro' and s.idcliente='".$_SESSION[cotizaIDcli]."' order by  codi desc";
        $result5 = db_query($qry5);$row5=db_fetch_array($result5);if($row5[precio]<>""){ if($row5[moneda]=="Soles"){ echo "S";}else{ echo "D";}  echo "($row5[precio])";}

            if($pvm<>0){ $xxpvm=number_format($pvm,2);}else{$xxpvm="0"; }
            
        echo "<font class='dedos tce' onClick='document.formular$tt.precio$tt.value=".$xxpvm."'>".$xxpvm."</font>";
        
        
        
        

    echo "</td><td data-label='P.Venta'><input name=precioxx id=precio$tt  size=4  type=text value='".number_format($pv,2, '.', '')."'>";
    //echo $rows[pvart];




    echo "</a></b></td><td data-label='cant.'>
        
        <input name=productos id=productos type=hidden value='".$productos."'>
        <input name=codartx id=codartx type=hidden value='".$rows[codart]."' >
        <input name=nomartx id=nomartx type=hidden value='".$rows[nomart]."'>
        <input name=tipox id=tipox type=hidden value='".$tipo."'>     
        <input name=cantidax id=cantidax type=text  size=1>       
        ";
        
     echo "</b>"; ?>
     <input name=ordenar id=ordenar type=hidden  size=2 value="<?php echo $ordenar + 1 ?>">
     
     <?php
    echo "</b></td><td data-label='Agregar'>
    
    
    <button type='submit'   class='botonimg dedos tce'   style='color:#0099FF'><i class='icon-checkbox-checked icon-2x dedos' title='Agregar Articulo'></i></button>";
    echo '</td></tr></form>';
}
echo '/<tbody>
</table>
</td>
  </tr>
</table>';
?>