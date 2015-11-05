<?php
	require_once("clases/cls_Archi.php");
	$lobjlista= new cls_Archiprestasgo();
   	$laMatriz=$lobjlista->fBusqueda_Pastorales();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pastorales Diosesanas</title>
	<link rel="stylesheet" type="text/css" href="vistas/css/estilos.css">
	<link rel="stylesheet" type="text/css" href="vistas/css/index.css">
	<meta http-equiv='content-type' content='text/html;charset=utf-8' />
	<style type="text/css">
	div[gale-banner]{
		min-width: 868px;
		height: 120px;
		background: url("vistas/imagenes/banner.gif") no-repeat;
		background-size: 100% 100%;
	}

	div[enlaces]{
		width: 1024px;
		margin: 0px auto;
	}
	</style>
</head>
<body>
	<div Cabecera>
	<div banner>		
		<div gale-banner>
		
		</div>

			<img src="vistas/imagenes/escudo.jpg" width="154px" height="162px" style="float:right;margin-top:-120px;">
		</div>
	</div>
	<div Menu>
		<div cont-menu>
			<ul>
				<li><a href='quienes_ somos.php'>Quienes Somos</a></li>
				<li><a href="index.php">Volver a Pagina de Inicio</a></li>
			</ul>
		</div>
	</div>
<div Contenedor>
	<div contenido>
		<div menu-acor>
			<ul>
				<li a><a href='Archi_Norte.php'>Archiprestasgo NORTE</a></li>
				<li b><a href='Archi_Sur.php'>Archiprestasgo SUR</a></li>
				<li c><a href='Archi_Centro.php'>Archiprestasgo CENTRO</a></li>
				<li d><a href='Archi_Foraneo.php'>Archiprestasgo FORANEO</a></li>
				<li e><a href='Pastorales_Diosesanas.php'>PASTORALES DIOCESANAS</a></li>
			</ul>
		</div>
		<div reflexion>
			<h2>Lista de Pastorales Diosesanas</h2>
			<style type="text/css">
				table{
					border-collapse: collapse;
					width: 95%;
					margin: 0px auto;
					border: 1px solid rgb(153, 205, 82);
					margin-bottom: 10px;
				}

				tr{
					height: 30px;
					color: rgb(153, 205, 82);
					border: 1px solid rgb(153, 205, 82);
				}

				tr:first-child{
					background:rgb(153, 205, 82);
					color: white;
					font-weight: bold;
				}

				td{
					padding: 0px 5px;
					border: 1px solid rgb(153, 205, 82);

				}
				td a{	
					color: rgb(153, 205, 82);
					font-weight: bold;
				}

				td a:hover{	
					color: grey;
				}
			</style>

			<table border="1">
				<tr>
					<td>Nombre de la Pastoral</td>
				</tr>
				<?php 
					for ($x=0; $x <count($laMatriz) ; $x++) { 
						print"<tr>";
							print"<td><a href='Info_Pastoral.php?nombre=".$laMatriz[$x][0]."&mision=".$laMatriz[$x][1]."&vision=".$laMatriz[$x][2]."&lugar=".$laMatriz[$x][3]."&dia=".$laMatriz[$x][4]."&correo=".$laMatriz[$x][5]."&parroquia=".$laMatriz[$x][6]."'>".$laMatriz[$x][0]."</a></td>";
						print"</tr>";
					}
				 ?>
			</table>
			
		</div>
		<hr style="height:10px; background:#008A8A; width:1019px; float:right;margin-bottom:3px;border:none; ">
		
	</div>
	<div style="clear:both; height:1px;width:100%;"></div>
</div>
<div Pie>
	<div enlaces>
		<a target="_blanck" href="http://www.es.catholic.net/"><img title="Catholic" src="vistas/imagenes/catholicnet.jpg"></a>
		<a target="_blanck" href="http://w2.vatican.va/content/vatican/it.html"><img title="La Santa Sede" src="vistas/imagenes/logo_vaticano.jpg" ></a>
		<a target="_blanck" href="http://www.seguroshorizonte.com/"><img title="Seguros Horizonte" src="vistas/imagenes/logo_seguros_horizonte01.jpg" ></a>
		<a target="_blanck" href="http://www.vatican.va/news_services/or/or_spa/"><img title="Observatorio Romano" src="vistas/imagenes/osservat3.jpg" ></a>
		<a target="_blanck" href="http://www.cev.org.ve/"><img title="Conferencia Episcopal Venezolana" src="vistas/imagenes/cev-logo.jpg" ></a>
		<a target="_blanck" href="http://www.unica.edu.ve/cpv/"><img title="Concilio Planario de Venezuela" src="vistas/imagenes/concilio_plenario_venezuela.jpg" ></a>
		<a target="_blanck" href="http://www.arquidiocesisdemerida.org.ve/"><img title="Arquidiocesis de Merida" src="vistas/imagenes/cropped-logo-blanco.jpg" ></a>
		<a target="_blanck" href="http://www.celam.org/"><img title="Celam" src="vistas/imagenes/images.jpg" ></a>
		<a target="_blanck" href="http://www.aciprensa.com/"><img title="Aci-Prensa" src="vistas/imagenes/descarga.jpg" ></a>
	</div>
</div>
</body>
</html>