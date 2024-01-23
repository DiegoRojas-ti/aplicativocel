<?php  
$serverName = "192.168.1.207"; 
$uid = "sa";   
$pwd = "Contrasen4";  
$databaseName = "ENTERPRISETEXTIL"; 

$connectionInfo = array( "UID"=>$uid,                            
                         "PWD"=>$pwd,                            
                         "Database"=>$databaseName); 

/* Connect using SQL Server Authentication. */  
$conn = sqlsrv_connect( $serverName, $connectionInfo);  

$tsql = "SELECT * FROM rus_6";  

/* Execute the query. */  

$stmt = sqlsrv_query( $conn, $tsql);  

if ( $stmt )  
{  
     echo "Statement executed.<br>\n";  
}   
else   
{  
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true));  
}  


while( $row = sqlsrv_fetch_array($stmt))  
{  
     echo "Col1: ".$row['usuario']."\n";  
     echo "Col2: ".$row[1]."\n";  
     echo "Col3: ".$row[2]."<br>\n";  
     echo "-----------------<br>\n";  
} 

sqlsrv_free_stmt( $stmt);  
sqlsrv_close( $conn)

?>