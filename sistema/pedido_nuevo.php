<?php
include "head.php";
?>
<div class="t7">PACKING LIST</div> <br> 
<center>
<?php
echo '
<form name="formbuscar" id="formbuscar" method="POST" action="">
<input type="hidden"  name="idsalida"  size="12"  value="' . $idcot . '">   
<ol id="idimput" class="espacio texto"> 
<li class="oness"><b>Nro Pedido. : </b>' . $req . '<br><input type="number"  required name="nrosalida"  size=12 maxlength="7" value="" readonly>      
<li><b>Fecha :  </b>' . $req . '<br><input type="text" required name="fecha" size="8"    value="" class="dates">'; ?>
<li class="four"><b>Cliente :  </b><?php echo $req ?><br>
 
                  <style>
                  .custom-combobox {position: relative; display: inline-block;width: 80%;  }
                  .custom-combobox-toggle { position: absolute; top: 0;bottom: 0;
                    margin-left: -1px;padding: 9px;
                    /* support: IE7 */
                    *height: 1.7em;
                    *top: 0.1em;
                  }
                  .custom-combobox-input {margin: 0;padding: 9px;   width:100%  }
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
$SQL2 = "SELECT * FROM XOUT.dbo.CLIENTE order by CliRaz";
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
<li class="ones"><b>Tipo  </b><?php echo $req ?> : <br>
<select id="tipoop" name="tipoop">
    <option value="">Seleccionar</option>
    <option value="V">Venta</option>
    <option value="S">Servicio</option>
</select>
</li>
<li class="two"><b>C. Barra</b><br>
    <input type="text" name="correl" id="correl"> <button onclick="buscacorrel(event)">Buscar</button>
</li>
 
</ol> 
<script type="text/javascript">
    function buscacorrel(e){
        e.preventDefault();
        var rucxx=document.getElementById("correl").value;
        var toLoad= 'packing_correl.php?idcorrel=' + rucxx;
        $.post(toLoad,function (responseText){
        $('#contenedor').html(responseText);
        });
        document.getElementById("correl").value="";
    }
</script>


<div id="contenedor">
    <table width="100%" class="texto tableM" border="0" cellspacing="0" style="color:#000;" cellpadding="0" align="center"> 
    <thead>
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
  </thead><tbody>
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
    <tbody></table> 
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


<button type="submit" class="botonNuevo"><i class="icon-disk"></i> Guardar</button>&nbsp;
<button type="reset" class="botonNuevo"><i class="icon-file4"></i> Limpiar</button>&nbsp;
<button type="button" class="botonNuevo" onClick="javascript:window.location.href='packing.php'"><i class="icon-undo2"></i> Regresar</button>
</form>
</font>     
</fieldset>
<script type="text/javascript">
 function cliente()
{
    var rucxx=document.getElementById("nombre_ruc").value;
    var toLoad= 'cliente_contacto.php?namecli=' + rucxx;
    $.post(toLoad,function (responseText){
    $('#cargrespon').html(responseText);
    });
}
function cargaestado($valor)
{
    var idDocumento= document.getElementById('igv').value;
    var toLoad= 'venta_global.php?Documentoid='+ idDocumento ;
    $.post(toLoad,function (responseText){                          
    $('#txtNro2').html(responseText);
    })
}
</script>
    <script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("btcal1", "fecha", "%Y-%m-%d");
    //]]></script>  
<?php $xidform = "EntradaVentas";
include "pie.php" ?>