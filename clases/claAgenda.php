<?php
include_once("clsDatos.php");
class  claAgenda extends  clsDatos{
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
		public function fpIncluirActividad($idTipoAgenda){		

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

				$lsSql="INSERT INTO tagenda (
				codigo_actividad,
				fecha_actividad,
				hora_actividad,
				codigo_pastoral,
				lugar,
				codigo_grupo,
				idtipo
				) VALUES (
				'$IDTActividadIngresado',
				'".$this->aa_Form['Fecha_Ini']."',
				'".$this->aa_Form['Hora_Ini']."',
				".$nuloPastoral.",
				'".$this->aa_Form['Lugar_enc']."',
				".$nuloGrupo.",
				'".$idTipoAgenda."')";

																			
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();																										
																						
			return $lbHecho;																								
		}			

		public function fpModificarActividad($idTipoAgenda){		

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

				$lsSql="UPDATE tagenda SET 
				codigo_actividad='$IDTActividadIngresado', 
				fecha_actividad='".$this->aa_Form['Fecha_Ini']."', 
				hora_actividad='".$this->aa_Form['Hora_Ini']."', 
				codigo_pastoral=".$nuloPastoral.", 
				lugar='".$this->aa_Form['Lugar_enc']."', 
				codigo_grupo=".$nuloGrupo.", 
				idtipo='".$idTipoAgenda."' 
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
			$lsSql="UPDATE tagenda SET 
				Estatus='".$variControl."' 
				WHERE  codigoAgenda='".$this->aa_Form['Codigo']."'";

				$this->fpConectar();	
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();			
																				
			return $lbHecho;																								
		}		

		

		public function faListarActividades($tipoAgenda,$Reporte_FechaInicio,$Reporte_FechaFin)
		{

			$lsSql="SELECT 
			tage.codigoAgenda,
			tage.codigo_actividad,
			tage.fecha_actividad,
			date_format(tage.fecha_actividad,'%Y') AS Calendario_Anno,
			date_format(tage.fecha_actividad,'%m') AS Calendario_Mes,
			tage.hora_actividad,
			DATE_FORMAT(tage.hora_actividad,'%h:%i %p') AS HoraExacta,
			tage.codigo_pastoral,
			tage.lugar,
			tage.codigo_grupo,
			tage.idtipo,
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
			FROM tagenda AS tage 
			LEFT JOIN tactividad AS tacti ON tage.codigo_actividad = tacti.codigoActividad 
			INNER JOIN tipo_actividad AS tipoAc ON tacti.tipo_actividad = tipoAc.idtipo_actividad 
			LEFT JOIN tpastoral AS tpast ON tage.codigo_pastoral = tpast.codigoPastoral 
			LEFT JOIN tgrupo AS tgrup ON tage.codigo_grupo = tgrup.codigoGrupo 
			WHERE tage.idtipo='".$tipoAgenda."' AND tage.fecha_actividad >= '$Reporte_FechaInicio' AND tage.fecha_actividad <= '$Reporte_FechaFin'
			ORDER BY tage.fecha_actividad,tage.hora_actividad";

			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["codigoAgenda"]=$laArreglo["codigoAgenda"];
				$laMatriz[$liI]["codigo_actividad"]=$laArreglo["codigo_actividad"];
				$laMatriz[$liI]["fecha_actividad"]=$laArreglo["fecha_actividad"];
				$laMatriz[$liI]["Calendario_Anno"]=$laArreglo["Calendario_Anno"];
				$laMatriz[$liI]["Calendario_Mes"]=$laArreglo["Calendario_Mes"];
				$laMatriz[$liI]["hora_actividad"]=$laArreglo["hora_actividad"];
				$laMatriz[$liI]["HoraExacta"]=$laArreglo["HoraExacta"];
				$laMatriz[$liI]["codigo_pastoral"]=$laArreglo["codigo_pastoral"];
				$laMatriz[$liI]["lugar"]=$laArreglo["lugar"];
				$laMatriz[$liI]["codigo_grupo"]=$laArreglo["codigo_grupo"];
				$laMatriz[$liI]["idtipo"]=$laArreglo["idtipo"];
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