 <h4 style="text-align: center; font-weight: bold;" class="text-primary" >Iniciar sesión</h4>
	<form method="post" style="text-align: center" autocomplete="off">
		<input type="text" placeholder="Código modular" name="usuarioIngreso" style="width: 100%" required><br>
		<input type="password" placeholder="Contraseña" name="passwordIngreso" style="width: 100%" required><br>
		<input type="submit" value="Enviar" id="submit01" class="btn btn-primary py-1 px-3 my-1" style="width: 70%;">
	</form>
<?php

$ingreso = new MvcController();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){
	if($_GET["action"] == "fallo"){
		echo "<div class='text-danger font-weight-bold'>Usuario y/o contraseña no es válido(a)</div>";
	}
}

?>