<?php
  session_start();
	
	function encabezado_menu($rut)
		{
			if ($rut=='')
			{
				$rut2='vis/';
			}

				return('
				
				<link rel="stylesheet" href="'.$rut.'css/bootstrap.min.css">
				<link rel="stylesheet" href="'.$rut.'css/styles.css">
				<link rel="stylesheet" href="'.$rut.'css/font-awesome.min.css">
				<link rel="stylesheet" type="text/css" href="'.$rut.'css/notifIt.css">
				<script src="'.$rut.'jquery/jquery-latest.min.js" type="text/javascript"></script>
				<script src="'.$rut.'jquery/jquery.maskedinput.min.js" type="text/javascript"></script>
				<script src="'.$rut.'jquery/script.js"></script>
				<script type="text/javascript" src="'.$rut2.'javascript/sistema.js"></script>
				<script type="text/javascript" src="'.$rut2.'javascript/notifIt.js"></script>
				<script type="text/javascript" src="'.$rut2.'javascript/camposEspeciales.js"></script>
				<script type="text/javascript" src="'.$rut2.'javascript/sunwapta.toggleOption.js"></script>
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
    			<meta name="viewport" content="width=device-width, initial-scale=1">
    			<script src="'.$rut2.'javascript/html5shiv.js"></script>
     			<script src="'.$rut2.'javascript/respond.min.js"></script>
   				
			');
					
		}

	function menu_general_web($rut)
	{
	$nombre_archivo = $_SERVER['SCRIPT_NAME'];
	if ( strpos($nombre_archivo, '/') !== FALSE ){
		$nombre_archivo = preg_replace('/\.php$/', '' ,array_pop(explode('/', $nombre_archivo)));
	}
	${$nombre_archivo}='active';
	
	if ($bautismo =='active' or $comunion =='active' or $confirmacion =='active' or $matrimonio =='active' or $feligres =='active' or $sacerdote =='active' or $obispo =='active')
	{
		$registro='active';
	}

	if ($confEstado =='active' or $confCiudad =='active' or $confMunicipio =='active' or $confParroquia =='active' or $confParentesco =='active' or $confTallaFranela =='active' or $confGradoEstudio =='active' or $confSacramento =='active')
	{
		$configuracion='active';
	}

	if ($gestMatrimonio =='active' or $gestBautizo =='active')
	{
		$gestionar='active';
	}
	
	$estado=$_POST["menu"];
	
					if ($rut == ''){
						$oldr='../';
					}else{
						$oldr='';
					}
		$menu = utf8_decode('
			
		<div class="mygrid-wrapper-div">

		<div id="menuprin" style=\'z-index: 2;\'>
			<ul>
				<li  class="'.$index.'"><a href="'.$oldr.'index.php"><i class=\'fa fa-home fa-fw\'></i><span></span></a></li>');
				
						$menu .= utf8_decode('
						
						<li class="'.$seguridad.' has-sub"><a href="#"><i class=\'fa fa-key fa-fw\'></i><span>Registro de Feligreses</span></a>
							<ul>
								<li  class="'.$usuarios.'"><a href="'.$rut.'usuarioPublico.php"><span>Nuevo</span></a></li>	
							</ul>
						</li>');
					

						$menu .= utf8_decode('
						
						
					    <li class="has-sub"><a href="#"><i class=\'fa fa-support fa-fw\'></i><span>Soporte</span></a>
					      <ul>
							<li class="last"><a href="'.$rut.'ayudafeligres.pdf" target="_blank"><span>Manual de Citas</span></a></li>
					      </ul>
					   	</li>
			</ul>
			</div>
		</div>
			');
	print($menu);
	}

	function menu_general($rut)
	{
	$nombre_archivo = $_SERVER['SCRIPT_NAME'];
	if ( strpos($nombre_archivo, '/') !== FALSE ){
		$nombre_archivo = preg_replace('/\.php$/', '' ,array_pop(explode('/', $nombre_archivo)));
	}
	${$nombre_archivo}='active';
	
	if ($bautismo =='active' or $comunion =='active' or $confirmacion =='active' or $matrimonio =='active' or $feligres =='active' or $sacerdote =='active' or $obispo =='active')
	{
		$registro='active';
	}

	if ($confEstado =='active' or $confCiudad =='active' or $confMunicipio =='active' or $confParroquia =='active' or $confParentesco =='active' or $confTallaFranela =='active' or $confGradoEstudio =='active' or $confSacramento =='active')
	{
		$configuracion='active';
	}

	if ($gestMatrimonio =='active' or $gestBautizo =='active')
	{
		$gestionar='active';
	}
	
	$estado=$_POST["menu"];
	
					if ($rut == ''){
						$oldr='../';
					}else{
						$oldr='';
					}
		$menu = utf8_decode('
			
		<div class="mygrid-wrapper-div">

		<div id="menuprin" style=\'z-index: 2;\'>
			<ul>
				<li  class="'.$index.'"><a href="'.$oldr.'index.php"><i class=\'fa fa-home fa-fw\'></i><span></span></a></li>');
				if(array_key_exists('usuario', $_SESSION)) 
				{
					if (($_SESSION['rol']=='A')||($_SESSION['rol']=='S'))
					{
						$menu .= utf8_decode('
						
						<li class="'.$seguridad.' has-sub"><a href="#"><i class=\'fa fa-key fa-fw\'></i><span>Seguridad</span></a>
							<ul>
								<li  class="'.$usuarios.'"><a href="'.$rut.'usuarios.php"><span>Usuarios</span></a></li>	
							</ul>
						</li>');
					}
					if ($_SESSION['rol']=='F')
					{
						$menu .= utf8_decode('
						
						<li class="'.$seguridad.' has-sub"><a href="#"><i class=\'fa fa-key fa-fw\'></i><span>Seguridad</span></a>
							<ul>
								<li  class="'.$usuarios.'"><a href="'.$rut.'usuarioActual.php"><span>Actualizar</span></a></li>	
							</ul>
						</li>
						<li class="'.$citas.' has-sub"><a href="'.$rut.'solicitudes.php"><i class=\'fa fa-key fa-fw\'></i><span>Solicitud de Citas</span></a>
						</li>


						');
					}
					else
					{
						$menu .= utf8_decode('
						<li class="'.$configuracion.' has-sub"><a href="#"><i class=\'fa fa-wrench fa-fw\'></i><span>Configurar</span></a>
							<ul>
								 <li  class="'.$confEstado.'"><a href="'.$rut.'confEstado.php"><span>Estados</span></a></li>	
								 <li  class="'.$confMunicipio.'"><a href="'.$rut.'confMunicipio.php"><span>Municipios</span></a></li>
								 <li  class="'.$confParroquia.'"><a href="'.$rut.'confParroquia.php"><span>Parroquias</span></a></li>	
								 <li  class="'.$confCiudad.'"><a href="'.$rut.'confCiudad.php"><span>Ciudades</span></a></li>
								 <li  class="'.$confParentesco.'"><a href="'.$rut.'confParentesco.php"><span>Parentescos</span></a></li>	
								 <li  class="'.$confArchiprestasgo.'"><a href="'.$rut.'confArchiprestasgo.php"><span>Archiprestasgo</span></a></li>	
								 <li  class="'.$confTipoActividad.'"><a href="'.$rut.'confTipoActividad.php"><span>Tipo de Actividad</span></a></li>	
								 <li  class="'.$confActividad.'"><a href="'.$rut.'confActividad.php"><span>Actividad</span></a></li>	
								
								 ');
					
						if ($_SESSION['rol']=='ZZ')
						{
							 $menu .= utf8_decode('		
								 <li  class="'.$confSacramento.'"><a href="'.$rut.'confSacramento.php"><span>Sacramento</span></a></li>
							');
						}

						 $menu .= utf8_decode('
							</ul>
						</li>
						<li class="'.$registro.' has-sub"><a href="#"><i class=\'fa fa-edit fa-fw\'></i><span>Cargar</span></a>
							<ul>
								 <li  class="'.$bautismo.'"><a href="'.$rut.'bautismo.php"><span>Bautizo</span></a></li>
								 <li  class="'.$matrimonio.'"><a href="'.$rut.'matrimonio.php"><span>Matrimonio</span></a></li>
								 <li  class="'.$parroquiaIglesia.'"><a href="'.$rut.'parroquiaIglesia.php"><span>Parroquia</span></a></li>
								 <li  class="'.$capilla.'"><a href="'.$rut.'capilla.php"><span>Capilla</span></a></li>
								 <li  class="'.$grupoapostolado.'"><a href="'.$rut.'grupoapostolado.php"><span>Grupo de Apostolado</span></a></li>
								 <li  class="'.$pastoral.'"><a href="'.$rut.'pastoral.php"><span>Pastoral</span></a></li>
								 ');
					
						if (($_SESSION['rol']=='S')||($_SESSION['rol']=='C'))
						{
						$menu .= utf8_decode('		
						
						');
						}

						if ($_SESSION['rol']=='S')
						{
						$menu .= utf8_decode('		
						 <li  class="'.$sacerdote.'"><a href="'.$rut.'sacerdote.php"><span>Sacerdote</span></a></li>
						 ');
						
						$menu .= utf8_decode('		
						 <li  class="'.$obispo.'"><a href="'.$rut.'obispo.php"><span>Obispo</span></a></li>
						 ');
						}
						$menu .= utf8_decode('	
						 <li  class="'.$feligres.'"><a href="'.$rut.'feligres.php?obj=4"><span>Feligres</span></a></li>	

							</ul>
						</li>
						');
					
						if ($_SESSION['rol']=='S')
						{
						 $menu .= utf8_decode('
						<li class="'.$gestionar.' has-sub"><a href="#"><i class=\'fa fa-check-square fa-fw\'></i><span>Procesar</span></a>
						<ul>
									
							<li class="'.$gestMatrimonio.'"><a href="'.$rut.'gestMatrimonio.php"><span>Matrimonio</span></a></li>
							<li class="'.$gestAgendaD.'"><a href="'.$rut.'gestAgendaDiocesana.php"><span>Agenda Diocesana</span></a></li>
							<li class="'.$gestAgendaP.'"><a href="'.$rut.'gestAgendaParroquial.php"><span>Agenda Parroqial</span></a></li>
							<li  class="'.$gestAgregar_Grupo.'"><a href="'.$rut.'gestAgregar_Grupo.php"><span>Grupo Apostolado</span></a></li>	
							<li  class="'.$gestAgregar_Pastoral.'"><a href="'.$rut.'gestAgregar_Pastoral.php"><span>Pastoral</span></a></li>	
								
					    </ul>

						');
					
					}
						 $menu .= utf8_decode('	
						<li class="has-sub"><a href="#"><i class=\'fa fa-print fa-fw\'></i><span>Listar</span></a>
					      <ul>

							<li class="last"><a href="'.$rut.'lista_usuarios.php"><span>Usuarios</span></a></li>
							<li class="last"><a href="'.$rut.'lista_matrimonios.php"><span>Matrimonios</span></a></li>
							<li class="last"><a href="'.$rut.'lista_bautizos.php"><span>Bautizos</span></a></li>
							<li class="last"><a href="'.$rut.'lista_agendaDiocesana.php"><span>Actividades Diocesanas</span></a></li>
							<li class="last"><a href="'.$rut.'lista_agendaParroquial.php"><span>Actividades Parroquiales</span></a></li>
							<li class="last"><a href="'.$rut.'reporteCapilla.php"><span>Capillas</span></a></li>
							<li class="last"><a href="'.$rut.'reporteGrupo.php"><span>Grupos</span></a></li>
					      </ul>

					    <li class="has-sub"><a href="#"><i class=\'fa fa-support fa-fw\'></i><span>Soporte</span></a>
					      <ul>
							<li class="last"><a href="'.$rut.'manualusuario.pdf" target="_blank"><span>Manual de Usuarios</span></a></li>
							<li class="last"><a href="'.$rut.'acercade.pdf" target="_blank"><span>Acerca De</span></a></li>
					      </ul>
					      ');
					}
					   	$menu .= utf8_decode('</li><li class="last"><a href="'.$rut.'visSalir.php"><i class=\'fa fa-sign-out fa-fw\'></i><span>Salir</span></a></li>');
				}

				else
				{
					$menu .= utf8_decode('
					<li class="last"><a href="'.$oldr.'index.php?Tag=mv"><i class=\'fa fa-road fa-fw\'></i><span>Mision y Vision</span></a></li>');
				}

			$menu .= utf8_decode('
			</ul>
			</div>
		</div>
			');
	print($menu);
	}
?>
