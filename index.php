<?php 

//	Funci�n para la conexi�n de la base de datos
function connectDB(){
	$servername = "localhost";
	$username = "root";  //your user name for php my admin if in local most probaly it will be "root"
	$password = "root";  //password probably it will be empty
	$databasename = "contactos"; //Your db nane
	// Create connection
	$conn = new mysqli($servername, $username, $password,$databasename);
	return $conn ;
}

//	Funci�n para desconexi�n
function disconnectDB($conexion){

    $close = mysqli_close($conexion);

    if($close){
       // echo 'La desconexi�n de la base de datos se ha hecho satisfactoriamente';
    }else{
        // echo 'Ha sucedido un error inesperado en la desconexi�n de la base de datos';
    }   

    return $close;
}

// Funci�n para la obtenci�n de los datos desde la base y pasarlos a un array
function getArraySQL($sql){
    //Creaci�n de la conexi�n con la funci�n anterior
    $conexion = connectDB();

   
    $result = mysqli_query($conexion, $sql) or die(); //si la conexi�n da error, cancelar programa

    $rawdata = array(); //creamos un array

        
    //Almacenamiento de todos los datos de la consulta en un array multidimensional 
      while($row = mysqli_fetch_assoc($result))
    {
    	
		$rawdata['contactos'][] = $row;
		
    }
    
    

    //disconnectDB($conexion); //desconexi�n la base de datos

    return $rawdata; //devoluci�n del array
}

// Instrucci�n SQL
$sql = "SELECT * from contactos";

// Generaci�n del array con los datos de la base de datos
$array = getArraySQL($sql);

// Transformaci�n del array a JSON
echo json_encode($array);

?>
