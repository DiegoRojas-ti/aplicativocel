<?php
error_reporting(0);
define('SERVER_MYSQL', '192.168.1.207');
define('DATABASE',   'ENTERPRISETEXTIL');
define('BD_USUARIO', 'sa');
define('BD_CLAVE',   'Contrasen4');
$xtbl='ENTERPRISETEXTIL_';
$_SESSION['tbl']='ENTERPRISETEXTIL_';
$TIPOmodulos="123";
$igvnum1='1.18';

$MODULOcreditolibre = 'Si'; // INCLUIR opcion credito (saldra delsde cotizacion)-  post facturacion solo sirve para servicios   Si / No
$mostarCOMISION = 'No';
$req="<font color=red>(*)</font>";
$conexion = db_data(SERVER_MYSQL,BD_USUARIO,BD_CLAVE,DATABASE);
function db_data($server , $user, $password, $database = DATABASE, $link = 'link_db'){
    global $$link;
    $connectionInfo = array( "UID"=>$user,                            
                             "PWD"=>$password,                            
                             "Database"=>$database);
    $$link = sqlsrv_connect( $server, $connectionInfo);     
    
    if (!$$link) 
    { 
        die('Estamos en mantenimiento para brindar un mejor servicio (BD)'); 
    } 
    if($$link) 
    {
        return $$link;
    }                              

}
function db_query($query, $link = 'link_db'){
    global $$link;
    $result = sqlsrv_query($$link,$query);
    return $result;
}
function db_fetch_array($query){
    return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
}

function db_num_rows($query){
    return sqlsrv_num_rows($query);
}
function db_close(){
    global $$link;
    return sqlsrv_close($$link);   
}
function db_error(){
    return sqlsrv_errors();
}
?>