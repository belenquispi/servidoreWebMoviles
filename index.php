<?php 

//	Función para la conexión de la base de datos
function connectDB(){
	$servername = "localhost";
	$username = "root";  //your user name for php my admin if in local most probaly it will be "root"
	$password = "root";  //password probably it will be empty
	$databasename = "contactos"; //Your db nane
	// Create connection
	$conn = new mysqli($servername, $username, $password,$databasename);
	return $conn ;
}

//	Función para desconexión
function disconnectDB($conexion){

    $close = mysqli_close($conexion);

    if($close){
       // echo 'La desconexión de la base de datos se ha hecho satisfactoriamente';
    }else{
        // echo 'Ha sucedido un error inesperado en la desconexión de la base de datos';
    }   

    return $close;
}

// Función para la obtención de los datos desde la base y pasarlos a un array
function getArraySQL($sql){
    //Creación de la conexión con la función anterior
    $conexion = connectDB();

   
    $result = mysqli_query($conexion, $sql) or die(); //si la conexión da error, cancelar programa

    $rawdata = array(); //creamos un array

        
    //Almacenamiento de todos los datos de la consulta en un array multidimensional 
      while($row = mysqli_fetch_assoc($result))
    {
    	
		$rawdata['contactos'][] = $row;
		
    }
    
    

    //disconnectDB($conexion); //desconexión la base de datos

    return $rawdata; //devolución del array
}

// Instrucción SQL
$sql = "SELECT * from contactos";

// Generación del array con los datos de la base de datos
$array = getArraySQL($sql);

// Transformación del array a JSON
echo json_encode($array);

?>
