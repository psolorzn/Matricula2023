<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>UGEL San Román</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="matri_v1.js"></script>
	<style>
		nav{
			position: relative;
			margin: auto;
			width: 100%;
			height: auto;
			background: black;
		}
		nav ul{
			position: relative;
			margin: auto;
			max-width: 900px;
			/*text-align: center;*/
		}
		nav ul li{
			display: inline-block;
			max-width: 19%;
			line-height: 50px;
			list-style: none;
			margin-right: 1.5em;
		}
		nav ul li a{
			color: white;
			text-decoration: none;
		}
		section{
			position: relative;
			margin: auto;
			max-width: 900px;
		}
		section h1{
			position: relative;
			margin: auto;
			padding: 10px;
			text-align: center;
		}
		section form{
			position: relative;
			margin: auto;
			/*width: 400px;*/
		}
		section form input{
			display: inline-block;
			padding: 10px;
			/*width: 95%;*/
			margin: 5px;
		}
		#submit01{
			position: relative;
			margin: 20px auto;
			left: 4.5%;
		}
		table{
			position: relative;
			margin: auto;
			width: 100%;
			/*left: -10%;*/
		}
		table thead tr th{
			padding: 10px;
		}
		table tbody tr td{
			padding: 10px;
		}
	</style>
</head>
<body>
<?php /*include "modules/navegacion.php";*/ ?>
<section>
<?php 

$mvc = new MvcController();
$mvc -> enlacesPaginasController();

?>
</section>
</body>
</html>