<?php
echo '<font class=mensa>';
echo $mensa;
echo '</font>';
?> 

<hr>
<table width="100%" border="0" class="texto tableM" style="color:#000;" cellspacing="0" cellpadding="0" align="center"> 
<thead>
<tr bgcolor=cccccc class="b" >  
<th ><b>Item</b></th>
<th ><b>Partida</b></th>
<th ><b>Articulo</b></th>
<th ><b>Color</b></th>
<th ><b>Proceso</b></th>
<th ><b>Guia Cliente</b></th>
<th ><b>C. Barra</b></th>  
<th ><b>Peso </b></th>
</tr> 
</thead><tbody>
<?php
$color = array("#ffffff", "#F0F0F0");
$contador = 0;
$suma = 0;
$queryv = "select * from XOUT.des.PLIST_DET WHERE CodPL='$idcot'";
$resultv = db_query($queryv);
while ($vv = db_fetch_array($resultv)) {
    $subto = $vv['kneto'] * 1;
    $suma = $suma + $subto;
    $contador++;
    $bordenar = $contador;
?> 
    <tr bgcolor="<?php echo $color[$contador % 2]; ?>" class='prod'> 
    <td data-label="Item"><input name=ordenar class=cajaTexto size=2  type=text value="<?php echo $bordenar;?>"> </td>   
    <td data-label="Partia"><?php echo $vv['voucher'] ?></td>
    <td data-label="Articulo"><?php echo $vv['descrip'] ?></td>
    <td data-label="Color"><?php echo $vv['descolor'] ?></td>
    <td data-label="Proceso"><?php echo $vv['proceso'] ?></td>
    <td data-label="Guia"><?php echo $vv['guiarem1'] ?></td>
    <td data-label="C. Barra"><?php echo $vv['correl'] ?></td>
    <td data-label="Peso"><?php echo $vv['kneto'] ?></td>    
  </tr> 
  <?php
    //por cada item creamos un formulario que submite a agregar producto y un link que permite eliminarlos
    
} ?> 
</tbody></table> 


<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="98%" >
  <tr>
    <td width="100%" bgcolor=666666 height="1"></td>
  </tr>
  <tr>
    <td width="100%" height="20" class=texto align=center><b>Total :  </b> <?php echo $mones . number_format($suma, 2); ?></td>
    </tr>
  <tr>
    <td width="100%" bgcolor=666666 height="1"></td>
    </tr>
</table>
</p> 
</body> 
</html>