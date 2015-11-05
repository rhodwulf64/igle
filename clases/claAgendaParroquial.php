<?php
include_once("clsDatos.php");
class  claAgendaParroquial extends  clsDatos{
		private $aa_Form;
		private $as_Cadena;

		public function __construct(){
			$this->aa_Form=Array();
			$this->as_Cadena="";
		}

		public function __destruct()
		{
		}
	/********* Funcion Obtener Formulario *********************************************************/
		public function f_SetsForm($pa_Form){														
			$this->aa_Form=$pa_Form;																
		}																							
	/**********************************************************************************************/

	/********* Funcion Retornar Formulario ********/
		public function	f_GetsForm(){				
			return $this->aa_Form;					
		}											
	/**********************************************/

	/************************ Funcion Guardar   ***************************************************************************/
	/* Se encarga de volcado de los datos en la base de datos															  */
	/**********************************************************************************************************************/
		public function fpIncluirActividad($EstadoAgenda){		

			$lbHecho=false;
			$this->fpConectar();																								
			$fechaI=explode('-',$this->aa_Form["Fecha_Ini"]);														    	
			$this->aa_Form['Fecha_Ini']=$fechaI[2].'-'.$fechaI[1].'-'.$fechaI[0];

			if ($this->aa_Form['Codigo_Pastoral']=="-")
			{
				$nuloPastoral='NULL';
			}
			else
			{
				$nuloPastoral='"'.$this->aa_Form['Codigo_Pastoral'].'"';
			}

			if ($this->aa_Form['Codigo_Grupo']=="-")
			{
				$nuloGrupo='NULL';
			}
			else
			{
				$nuloGrupo='"'.$this->aa_Form['Codigo_Grupo'].'"';
			}

			if ($this->aa_Form['Actividad']=="")
			{
			/*Con esto Insertamos la nueva actividad*/
				$lsSql="INSERT INTO tactividad (nombre,tipo_actividad) VALUES ('".$this->aa_Form['Nombre']."','".$this->aa_Form['CodigoTipoActividad']."')";
				$lbHecho=$this->fbEjecutarNoDie($lsSql);
				$IDTActividadIngresado=$this->fpGetIDinsertado();
			}
			else
			{
				$IDTActividadIngresado=$this->aa_Form['Actividad'];
			}

				$lsSql="INSERT INTO tagendaparroquial (
				idFcodigo_actividad,
				fecha_act_Inicio,
				hora_act_Inicio,
				idFcodigo_pastoral,
				lugar,
				idFcodigo_grupo,
				EstadoAgenda
				) VALUES (
				'$IDTActividadIngresado',
				'".$this->aa_Form['Fecha_Ini']."',
				'".$this->aa_Form['Hora_Ini']."',
				".$nuloPastoral.",
				'".$this->aa_Form['Lugar_enc']."',
				".$nuloGrupo.",
				'".$EstadoAgenda."')";

																			
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();																										
																						
			return $lbHecho;																								
		}			

		public function fpModificarActividad($EstadoAgenda){		

			$lbHecho=false;
			$this->fpConectar();																								
			$fechaI=explode('-',$this->aa_Form["Fecha_Ini"]);														    	
			$this->aa_Form['Fecha_Ini']=$fechaI[2].'-'.$fechaI[1].'-'.$fechaI[0];

			if ($this->aa_Form['Codigo_Pastoral']=="-")
			{
				$nuloPastoral='NULL';
			}
			else
			{
				$nuloPastoral='"'.$this->aa_Form['Codigo_Pastoral'].'"';
			}

			if ($this->aa_Form['Codigo_Grupo']=="-")
			{
				$nuloGrupo='NULL';
			}
			else
			{
				$nuloGrupo='"'.$this->aa_Form['Codigo_Grupo'].'"';
			}

			if ($this->aa_Form['Actividad']=="")
			{
			/*Con esto Insertamos la nueva actividad*/
				$lsSql="INSERT INTO tactividad (nombre,tipo_actividad) VALUES ('".$this->aa_Form['Nombre']."','".$this->aa_Form['CodigoTipoActividad']."')";
				$lbHecho=$this->fbEjecutarNoDie($lsSql);
				$IDTActividadIngresado=$this->fpGetIDinsertado();
			}
			else
			{
				$IDTActividadIngresado=$this->aa_Form['Actividad'];
			}

				$lsSql="UPDATE tagendaparroquial SET 
				idFcodigo_actividad='$IDTActividadIngresado', 
				fecha_act_Inicio='".$this->aa_Form['Fecha_Ini']."', 
				hora_act_Inicio='".$this->aa_Form['Hora_Ini']."', 
				idFcodigo_pastoral=".$nuloPastoral.", 
				lugar='".$this->aa_Form['Lugar_enc']."', 
				idFcodigo_grupo=".$nuloGrupo.", 
				EstadoAgenda='".$EstadoAgenda."' 
				WHERE  codigoAgenda='".$this->aa_Form['Codigo']."'";
																			
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();																										
																						
			return $lbHecho;																								
		}																													
	/**********************************************************************************************************************/

	/************************ Funcion Guardar   ***************************************************************************/
	/* Se encarga de volcado de los datos en la base de datos															  */
	/**********************************************************************************************************************/
		public function fpDesactivar($variControl){	
			switch ($variControl)  //variControl tiene como valor el estatus actual, por eso si es 1 cambiaremos por un 0 y viceversa.
			{
				case '0':
					$variControl='1';
					break;
				case '1':
					$variControl='0';
					break;
			}
			$lbHecho=false;																									
			$lsSql="UPDATE tagendaparroquial SET 
				Estatus='".$variControl."' 
				WHERE  codigoAgenda='".$this->aa_Form['Codigo']."'";

				$this->fpConectar();	
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();			
																				
			return $lbHecho;																								
		}		

		

		public function faListarActividades($EstadoAgendaMostrar,$Reporte_FechaInicio,$Reporte_FechaFin)
		{

			$lsSql="SELECT 
			tage.codigoAgenda,
			tage.idFcodigo_actividad,
			tage.fecha_act_Inicio,
			date_format(tage.fecha_act_Inicio,'%Y') AS Calendario_Anno,
			date_format(tage.fecha_act_Inicio,'%m') AS Calendario_Mes,
			tage.hora_act_Inicio,
			DATE_FORMAT(tage.hora_act_Inicio,'%h:%i %p') AS HoraExacta,
			tage.idFcodigo_pastoral,
			tage.lugar,
			tage.idFcodigo_grupo,
			tage.EstadoAgenda,
			tage.FechaRegistro,
			tage.Estatus AS Agenda_Estatus,
			tacti.codigoActividad,
			tacti.nombre AS Actividad_Nombre,
			tacti.tipo_actividad,
			tacti.Estatus AS Actividad_Estatus,
			tipoAc.idtipo_actividad,
			tipoAc.nombre AS TipoAct_Nombre,
			tipoAc.descripcion,
			tipoAc.Estatus AS TipoAct_Estatus,
			tpast.codigoPastoral AS Pastoral_Codigo,
			tpast.nombre AS Pastoral_Nombre,
			tpast.mision AS Pastoral_Mision,
			tpast.vision AS Pastoral_Vision,
			tpast.FechaRegistroPastoral AS Pastoral_FechaRegistro,
			tpast.Estatus AS Pastoral_Estatus,
			tgrup.codigoGrupo AS Grupo_Codigo,
			tgrup.nombre AS Grupo_Nombre,
			tgrup.mision AS Grupo_Mision,
			tgrup.vision AS Grupo_Vision,
			tgrup.FechaRegistroGrupo AS Grupo_FechaRegistro,
			tgrup.Estatus AS Grupo_Estatus
			FROM tagendaparroquial AS tage 
			LEFT JOIN tactividad AS tacti ON tage.idFcodigo_actividad = tacti.codigoActividad 
			INNER JOIN tipo_actividad AS tipoAc ON tacti.tipo_actividad = tipoAc.idtipo_actividad 
			LEFT JOIN tpastoral AS tpast ON tage.idFcodigo_pastoral = tpast.codigoPastoral 
			LEFT JOIN tgrupo AS tgrup ON tage.idFcodigo_grupo = tgrup.codigoGrupo 
			WHERE tage.EstadoAgenda='".$EstadoAgendaMostrar."' AND tage.fecha_act_Inicio >= '$Reporte_FechaInicio' AND tage.fecha_act_Inicio <= '$Reporte_FechaFin'
			ORDER BY tage.fecha_actividad,tage.hora_act_Inicio";

			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["codigoAgenda"]=$laArreglo["codigoAgenda"];
				$laMatriz[$liI]["idFcodigo_actividad"]=$laArreglo["idFcodigo_actividad"];
				$laMatriz[$liI]["fecha_act_Inicio"]=$laArreglo["fecha_act_Inicio"];
				$laMatriz[$liI]["Calendario_Anno"]=$laArreglo["Calendario_Anno"];
				$laMatriz[$liI]["Calendario_Mes"]=$laArreglo["Calendario_Mes"];
				$laMatriz[$liI]["hora_act_Inicio"]=$laArreglo["hora_act_Inicio"];
				$laMatriz[$liI]["HoraExacta"]=$laArreglo["HoraExacta"];
				$laMatriz[$liI]["codigo_pastoral"]=$laArreglo["idFcodigo_pastoral"];
				$laMatriz[$liI]["lugar"]=$laArreglo["lugar"];
				$laMatriz[$liI]["codigo_grupo"]=$laArreglo["idFcodigo_grupo"];
				$laMatriz[$liI]["EstadoAgenda"]=$laArreglo["EstadoAgenda"];
				$laMatriz[$liI]["FechaRegistro"]=$laArreglo["FechaRegistro"];
				$laMatriz[$liI]["Agenda_Estatus"]=$laArreglo["Agenda_Estatus"];
				$laMatriz[$liI]["codigoActividad"]=$laArreglo["codigoActividad"];
				$laMatriz[$liI]["Actividad_Nombre"]=$laArreglo["Actividad_Nombre"];
				$laMatriz[$liI]["tipo_actividad"]=$laArreglo["tipo_actividad"];
				$laMatriz[$liI]["Actividad_Estatus"]=$laArreglo["Actividad_Estatus"];
				$laMatriz[$liI]["TipoAct_Nombre"]=$laArreglo["TipoAct_Nombre"];
				$laMatriz[$liI]["descripcion"]=$laArreglo["descripcion"];
				$laMatriz[$liI]["TipoAct_Estatus"]=$laArreglo["TipoAct_Estatus"];
				$laMatriz[$liI]["Pastoral_Codigo"]=$laArreglo["Pastoral_Codigo"];
				$laMatriz[$liI]["Pastoral_Nombre"]=$laArreglo["Pastoral_Nombre"];
				$laMatriz[$liI]["Pastoral_Mision"]=$laArreglo["Pastoral_Mision"];
				$laMatriz[$liI]["Pastoral_Vision"]=$laArreglo["Pastoral_Vision"];
				$laMatriz[$liI]["Pastoral_FechaRegistro"]=$laArreglo["Pastoral_FechaRegistro"];
				$laMatriz[$liI]["Pastoral_Estatus"]=$laArreglo["Pastoral_Estatus"];
				$laMatriz[$liI]["Grupo_Codigo"]=$laArreglo["Grupo_Codigo"];
				$laMatriz[$liI]["Grupo_Nombre"]=$laArreglo["Grupo_Nombre"];
				$laMatriz[$liI]["Grupo_Mision"]=$laArreglo["Grupo_Mision"];
				$laMatriz[$liI]["Grupo_Vision"]=$laArreglo["Grupo_Vision"];
				$laMatriz[$liI]["Grupo_FechaRegistro"]=$laArreglo["Grupo_FechaRegistro"];
				$laMatriz[$liI]["Grupo_Estatus"]=$laArreglo["Grupo_Estatus"];
				
				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}


	/**********************************************************************************************************************/
}