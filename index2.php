#!opt/lampp/bin/php
<?php
$usuario= $_POST["user"];
while ($usuario==""){
	$usuario= $_POST["user"];
}
$clave=$_POST['contra'];
while ($clave==""){
	$clave= $_POST["contra"];
}
$contrasenia = md5("$clave");
$basedatos='usuarioycontra';
$tabla='prueba';
$conexion= mysqli_connect('localhost','root','')or die ( "No se pudo conectar con el servidor de base de datos!");
#para que cree la base de datos si no existe
$consulta="CREATE DATABASE IF NOT EXISTS $basedatos";
$resultado = mysqli_query($conexion,$consulta);

$db=mysqli_select_db($conexion,$basedatos);
$consulta="CREATE TABLE IF NOT EXISTS ".$tabla." (
	rfid VARCHAR(40) NOT NULL,
	usuario VARCHAR(20) NOT NULL,
	contrasenia VARCHAR(40) NOT NULL)";
$resultado = mysqli_query($conexion,$consulta);
$consulta="SELECT * FROM `$tabla` WHERE 1";
$resultado = mysqli_query($conexion,$consulta);
if (mysqli_num_rows($resultado)==0){
	$contraaux=md5("1234");
	$rfidaux=md5("43 f9 ff 02");
	$consulta="INSERT INTO `prueba` (`rfid`,`usuario`, `contrasenia`) VALUES ('$rfidaux','henry', '$contraaux')";
	$resultado = mysqli_query($conexion,$consulta);
	$contraaux=md5("5678");
	$rfidaux=md5("43 f9 ff 02");
	$consulta="INSERT INTO `prueba` (`rfid`,`usuario`, `contrasenia`) VALUES ('$rfidaux','juanma', '$contraaux')";
	$resultado = mysqli_query($conexion,$consulta);
	$contraaux=md5("0101");
	$rfidaux=md5("43 f9 ff 02");
	$consulta="INSERT INTO `prueba` (`rfid`,`usuario`, `contrasenia`) VALUES ('$rfidaux','carlangas', '$contraaux')";
	$resultado = mysqli_query($conexion,$consulta);
	$contraaux=md5("3445");
	$rfidaux=md5("43 f9 ff 02");
	$consulta="INSERT INTO `prueba` (`rfid`,`usuario`, `contrasenia`) VALUES ('$rfidaux','facu', '$contraaux')";
	$resultado = mysqli_query($conexion,$consulta);
}
#fin para que cree la base de datos si no existe

#si el usuario ya existe
$consulta="SELECT * FROM `$tabla` WHERE usuario='$usuario' AND contrasenia='$contrasenia' ";
#$db=mysqli_select_db($conexion,$basedatos);
$resultado = mysqli_query($conexion,$consulta);
if (mysqli_num_rows($resultado)==0){
	echo"debe registrarse";
}
else{
	$rfid="43 f9 ff 02";
	#$DirIp=$_SERVER("REMOTE_ADDR");
	$DirIP="192.168.1.1";
	$TimeStamp=date('h:i:s');
	$DirIpTimeStamp=$DirIP."-".$TimeStamp.".info";
	echo "$DirIpTimeStamp";
	$fp = fopen("$DirIpTimeStamp.info","w"); 
	if($fp == false) { 
   		die("No se ha podido crear el archivo."); 
	}
	else{
		die("se creo el archivo.");
		fwrite($fp,$rfid);
	}
	
	$md5rfid=md5("43 f9 ff 02");
	$consulta="SELECT * FROM `$tabla` WHERE rfid='$md5rfid' AND usuario='$usuario' AND contrasenia='$contrasenia' ";
	$resultado = mysqli_query($conexion,$consulta);
	if (mysqli_num_rows($resultado)==0){
		echo"entro1";
		$bienvenido=false;
		#header("Location: ./index.html?bienvenido=$bienvenido");
		
	}
	else{
		echo"entro2";
		$bienvenido=true;
		#header("Location: ./index.html?bienvenido=$bienvenido");
		
	}	
}
mysqli_close($conexion);
?> 
