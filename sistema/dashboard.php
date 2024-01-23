<?php
include "head.php";
$anio=date("Y");
?>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
		<section class="full-width text-center">
			<h3 class="text-center tittles">DASHBOARD</h3>
			<!-- Tiles -->
			<a href="venta_nuevo.php">
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
				
						S/ <?php echo 0; ?><br>
						$ <?php echo 0; ?><br>
						<small>PACKING</small>
					</span>
				</div>
				<i class="zmdi zmdi-shopping-cart tile-icon"></i>
			</article>
			</a>
		</section>

<section>
	
                <h2 class="container-fluid bg-primary text-white text-center mh-50">
        
             RESUMEN DE PACKING POR AÑO <?php echo date("Y");?>
         </h2>

    <!--COMPRAS ACTUAL-->
      <div class="row">
        
        <div class="">
           
           <div class="box">

            <div class="box-body">

                      
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10%;text-align: center;" >AÑO</th>
                <th style="width: 10%;text-align: center;" >MES</th>
                <th style="width: 10%;text-align: center;" >PORCENTAJE(%)</th>
                <th style="width: 10%;text-align: center;" >TOTAL</th>
                <th style="width: 20%;text-align: center;" class="hidden-xs" >BARRA PROGRESO DE COMPRAS MENSUALES</th>
              </tr>
            </thead>
             <tbody>
                 <?php  
                    $sumaTotal=0;
                    //sumo el total de los años  
                    db_query("SET lc_time_names = 'es_ES';");
					$sql="SELECT YEAR(FechaReg) as ano,  DATENAME(month, FechaReg) as mes, SUM(Total) as total_compra_mes FROM XOUT.des.PLIST_CAB_TIENDA WHERE YEAR(FechaReg)='2024' GROUP BY YEAR(FechaReg), DATENAME(month, FechaReg)";
                    $resultQ=db_query($sql);
                    while ($rowP1=db_fetch_array($resultQ)) {
                    $sumaTotal= $sumaTotal + $rowP1['total_compra_mes'];
                	}
					$sql1="SELECT YEAR(FechaReg) as ano,  DATENAME(month, FechaReg) as mes, SUM(Total) as total_compra_mes FROM XOUT.des.PLIST_CAB_TIENDA WHERE YEAR(FechaReg)='2024' GROUP BY YEAR(FechaReg), DATENAME(month, FechaReg)";
                    $resultQ1=db_query($sql1);
                    while ($rowP=db_fetch_array($resultQ1)) {                	
                    $porcentaje= round($rowP['total_compra_mes']/$sumaTotal*100,2);
                 ?>
                <tr>
                  <td><?php echo $rowP['ano'];?></td>
                  <td><?php echo $rowP['mes']?></td>
                  <td><?php echo $porcentaje?></td>
                  <td><?php echo number_format($rowP["total_compra_mes"],2)?></td>


                  <td class="hidden-xs">
                     <div class="progress progress-xs" style="margin-bottom: 0px;">
                       <?php
                           if($porcentaje>24){
                            $clase="progress-bar progress-bar-primary";
                           } else if($porcentaje>10 or $porcentaje<24) {
                               $clase="progress-bar progress-bar-yellow";
                             } else if($porcentaje<=10) {
                               $clase="progress-bar progress-bar-danger";
                             }
                       ?>
                        <div class="<?php echo $clase;?>" style="width: <?php echo $porcentaje;?>%">
                        <?php echo $porcentaje;?>%
                        </div>
                     </div>
                  </td>
                </tr>
                <?php
            	}
            	?>
              <tr>
              <td></td>
              <td><strong>IMPORTE TOTAL (<?php echo date("Y");?>)</strong></td>
              <td><strong>100%</strong></td>
              <td><strong><?php echo "KGM ".number_format($sumaTotal,2)?></strong></td>
              <td><strong></strong></td>
              </tr>
            </tbody>

           
          </table>
       </div><!--fin box-body-->
      </div><!--fin box-->
    </div><!--fin col-sm-6-->
</div><!--row-->
</section>

    <div class="row">

          <div class="col-lg-6 col-xs-12">
        
         <div class="box">

               <div class="box-body">

               <h2 class="bg-primary text-white col-lg-12 text-center">RESUMEN DE COMPRAS DEL AÑO <?php echo date("Y");?></h2>

      
              <!--GRAFICA-->
             
              <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
            

                </div><!--fin box-body-->
          </div><!--fin box-->
      </div><!--col-sm-->


      <!--GRAFICA VENTAS-->
        <div class="col-lg-6 col-xs-12">
        
         <div class="box">

               <div class="box-body">

               <h2 class="bg-primary text-white col-lg-12 text-center">RESUMEN DE VENTAS DEL AÑO <?php echo date("Y");?></h2>

      
              <!--GRAFICA-->
              <div id="container_ventas" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<?php

$montoLx = 0;
$montosTalesSx = 0;
$crit = 0;


?>
       <script src="../js/ideasweb.js" type="text/javascript"></script>
        <script type="text/javascript">
            var chart;

            var chartData = [{
                country: "Enero",
                visits: <?php echo $ene ?>
            }, {
                country: "Febrero",
                visits: <?php echo $feb ?>
            }, {
                country: "Marzo",
                visits: <?php echo $mar ?>
            }, {
                country: "Abril",
                visits: <?php echo $abr ?>
            }, {
                country: "Mayo",
                visits: <?php echo $may ?>
            }, {
                country: "Junio",
                visits: <?php echo $jun ?>
            }, {
                country: "julio",
                visits: <?php echo $jul ?>
            }, {
                country: "Agosto",
                visits: <?php echo $ago ?>
            }, {
                country: "Septiembre",
                visits: <?php echo $sep ?>				
            }, {
                country: "Octubre",
                visits: <?php echo $oct ?>
            }, {
                country: "Noviembre",
                visits: <?php echo $nov ?>
            }, {
                country: "Diciembre",
                visits: <?php echo $dic ?>
				
            }];


            ideasweb.ready(function () {
                // PIE CHART
                chart = new ideasweb.AmPieChart();

                // title of the chart
                //chart.addTitle("Visitors countries", 16);

                chart.dataProvider = chartData;
                chart.titleField = "country";
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 15;

                // the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE                                 
                chart.write("container_ventas");
            });
        </script>
        <script type="text/javascript">
            var chart1;

            var chartData1 = [{
                country: "Enero",
                visits: <?php echo $ene1 ?>
            }, {
                country: "Febrero",
                visits: <?php echo $feb1 ?>
            }, {
                country: "Marzo",
                visits: <?php echo $mar1 ?>
            }, {
                country: "Abril",
                visits: <?php echo $abr1 ?>
            }, {
                country: "Mayo",
                visits: <?php echo $may1 ?>
            }, {
                country: "Junio",
                visits: <?php echo $jun1 ?>
            }, {
                country: "julio",
                visits: <?php echo $jul1 ?>
            }, {
                country: "Agosto",
                visits: <?php echo $ago1 ?>
            }, {
                country: "Septiembre",
                visits: <?php echo $sep1 ?>				
            }, {
                country: "Octubre",
                visits: <?php echo $oct1 ?>
            }, {
                country: "Noviembre",
                visits: <?php echo $nov1 ?>
            }, {
                country: "Diciembre",
                visits: <?php echo $dic1 ?>
				
            }];


            ideasweb.ready(function () {
                // PIE CHART
                chart1 = new ideasweb.AmPieChart();

                // title of the chart
                //chart.addTitle("Visitors countries", 16);

                chart1.dataProvider = chartData1;
                chart1.titleField = "country";
                chart1.valueField = "visits";
                chart1.sequencedAnimation = true;
                chart1.startEffect = "elastic";
                chart1.innerRadius = "30%";
                chart1.startDuration = 2;
                chart1.labelRadius = 15;

                // the following two lines makes the chart 3D
                chart1.depth3D = 10;
                chart1.angle = 15;

                // WRITE                                 
                chart1.write("container");
            });
        </script>
                </div>
          </div>
      </div>
    </div>
<?php
include "pie.php";
?>  