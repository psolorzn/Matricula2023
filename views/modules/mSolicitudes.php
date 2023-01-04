<?php
session_start();
?>

<img src="https://i.ibb.co/dj646bT/logo-SR.png">
<h1 class="text-warning" style="font-weight: bold;">MATRICULA ESCOLAR 2023</h1>
<?php if (!isset($_SESSION["usuario"])) { ?>

<div class="container rounded p-3 my-2" style="background: rgb(213, 229, 237);">
	<div style="padding: 1em; width: 250px; border: 1px solid steelblue;">

<?php include "ingresar.php"; ?>

	</div>
</div>

<?php } else {
?>

<div class="container rounded p-3 my-2" style="background: rgb(213, 229, 237);">
	<span class="text-primary font-weight-bold">Institución Educativa:</span> [<?php echo $_SESSION['usuario']; ?>] - <span class="font-weight-bold"><?php echo $_SESSION['ie']; ?></span> - (<?php
		$nivel = array( "1"=>"Inicial","2"=>"Primaria","3"=>"Secundaria","4"=>"Otro");
		echo $nivel[$_SESSION["nivel"]]; ?>)
</div>

<div class="container rounded p-3 my-2" style="background: rgb(213, 229, 237);">
	<div>
		<a href="?action=salir" class="btn btn-primary py-1 px-3 my-1">Cerrar sesión</a>&nbsp;<a href="?action=regresar" class="btn btn-primary py-1 px-3 my-1">Regresar</a>
	</div>
</div>

<div class="container">
	<h5 class="text-warning" style="font-weight: bold;">REGISTRO DE SOLICITUDES</h5>
</div>

<div class="container rounded p-3 my-2" style="background: rgb(213, 229, 237);">
	<div>
		<button class="btn btn-primary py-1 px-3 my-1" onclick="nuevaSolicitud()">Nueva solicitud</button>
		<button class="btn btn-primary py-1 px-3 my-1" onclick="buscarSolicitud()">Buscar solicitud</button>
		<button class="btn btn-primary py-1 px-3 my-1" onclick="eliminarSolicitud()">Eliminar solicitud</button>
		<a href="?action=listar" class="btn btn-primary py-1 px-3 my-1">Listado de solicitudes</a>
	</div>
</div>

<div id="divSolicitud" class="container rounded p-3 my-2" style="background: rgb(213, 229, 237); display: none;">
	<h4 class="text-primary font-weight-bold">Nueva solicitud</h4>
	<form>
		<h6 class="text-primary font-weight-bold">Datos del representante legal (solicitante)</h6>
		<label style="width: 12em">DNI: </label><input type="text" name="" id="dni1" placeholder="DNI del rep. legal" style="width: 20%"><br>
		<label style="width: 12em">Apellidos: </label><input type="text" name="" id="apellidos1" placeholder="Apellidos del rep. legal" style="width: 55%"><br>
		<label style="width: 12em">Nombres: </label><input type="text" name="" id="nombres1" placeholder="Nombres del rep. legal" style="width: 55%"><br>
		<h6 class="text-primary font-weight-bold">Datos del estudiante</h6>
		<label style="width: 12em">DNI: </label><input type="text" name="" id="dni2" placeholder="DNI del estudiante" style="width: 20%"><br>
		<label style="width: 12em">Apellidos: </label><input type="text" name="" id="apellidos2" placeholder="Apellidos del estudiante" style="width: 55%"><br>
		<label style="width: 12em">Nombres: </label><input type="text" name="" id="nombres2" placeholder="Nombres del estudiante" style="width: 55%"><br>
		<label style="width: 12em">Institución educativa: </label><input type="text" name="" id="ie" placeholder="Institución educativa de origen" style="width: 55%"><br>
<?php if($_SESSION["nivel"] == "1"){
	echo '
		<table><tr><td style="width: 12em">Edad:</td><td>
		<input type="radio" id="g3" name="grado" value="3">
		<label for="g3">3 Años</label><br>
		<input type="radio" id="g4" name="grado" value="4">
		<label for="g4">4 Años</label><br>
		<input type="radio" id="g5" name="grado" value="5">
		<label for="g5">5 Años</label>
		</td></tr></table>
	';
} else {
	echo '
		<table><tr><td style="width: 12em">Grado que solicita:</td><td>
		<input type="radio" id="g1" name="grado" value="1">
		<label for="g1">Primer grado</label><br>
		<input type="radio" id="g2" name="grado" value="2">
		<label for="g2">Segundo grado</label><br>
		<input type="radio" id="g3" name="grado" value="3">
		<label for="g3">Tercer grado</label><br>
		<input type="radio" id="g4" name="grado" value="4">
		<label for="g4">Cuarto grado</label><br>
		<input type="radio" id="g5" name="grado" value="5">
		<label for="g5">Quinto grado</label>
	';
	if($_SESSION["nivel"] == "2") {
		echo '<br>
		<input type="radio" id="g6" name="grado" value="6">
		<label for="g6">Sexto grado</label>
		';
	}
	echo '
		</td></tr></table>
	';
}
?>
		<div id='msgError' class='text-danger font-weight-bold'></div>
		<div id='msgSolicitud' class='text-primary font-weight-bold'></div>
		<input type="button" name="" value="Guardar" onclick="guardarSolicitud()" class="btn btn-primary py-1 px-3 my-1">
		<input type="button" name="" value="Cancelar" onclick="cancelarSolicitud()" class="btn btn-primary py-1 px-3 my-1">
	</form>
</div>

<div id="divBuscar" class="container rounded p-3 my-2" style="background: rgb(213, 229, 237); display: none;">
	<h4 class="text-primary font-weight-bold">Buscar solicitud</h4>
	<div id=divSolicitud2></div>
	<form id="frmBuscar">
		<label style="width: 10em">DNI: </label><input type="text" name="" id="dni20" placeholder="DNI del estudiante" style="width: 20%"><br>
		<input type="button" name="" value="Buscar" onclick="buscarDni2()" class="btn btn-primary py-1 px-3 my-1">
		<input type="button" name="" value="Cancelar" onclick="cancelarBuscar()" class="btn btn-primary py-1 px-3 my-1">
	</form>
  <div id='msgError' class='text-danger font-weight-bold'></div>
</div>

<div id="divEliminar" class="container rounded p-3 my-2" style="background: rgb(213, 229, 237); display: none;">
	<h4 class="text-primary font-weight-bold">Eliminar solicitud</h4>
	<div>La función de eliminar solicitud se deshabilitó.</div>
	<!-- 
	<div>IMPORTANTE.- La solicitud a eliminar debe estar registrada en su institución educativa.</div>
	<form id="frmEliminar">
		<label style="width: 10em">DNI: </label><input type="text" name="" id="dni21" placeholder="DNI del estudiante" style="width: 20%"><br>
		<input type="button" name="" value="Buscar" onclick="buscarDni20()" class="btn btn-primary py-1 px-3 my-1">
		<input type="button" name="" value="Cancelar" onclick="cancelarEliminar()" class="btn btn-primary py-1 px-3 my-1">
	</form>
	 -->
	<div id=divSolicitud3></div>
	<form id="frmEliminar">
		<label style="width: 10em; display: none;">DNI: </label><input type="text" name="" id="dni21" placeholder="DNI del estudiante" style="width: 20%; display: none;"><br>
		<input type="button" name="" value="Aceptar" onclick="cancelarEliminar()" class="btn btn-primary py-1 px-3 my-1">
	</form>
	<form id="frmEliminar2" style="display: none;">
		<input type="button" name="" value="Eliminar" onclick="eliminarSolicitud2()" class="btn btn-primary py-1 px-3 my-1">
		<input type="button" name="" value="Cancelar" onclick="cancelarEliminar()" class="btn btn-primary py-1 px-3 my-1">
	</form>
  	<div id='msgError2' class='text-danger font-weight-bold'></div>
</div>

<?php
//		<label style="width: 50%">Grado/edad: </label><input type="text" name="" id="gradoNee" placeholder=""><br>
}
/*
?>

<img src="https://i.ibb.co/jMwk6vX/cronograma-matricula-2021.png" width="100%">

<?php
*/
/*if(isset($_GET["action"])){
	if($_GET["action"] == "fallo"){
		echo "Fallo al ingresar";
	}
}*/
?>




