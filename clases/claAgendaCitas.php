<?php
include_once("clsDatos.php");
class  claAgendaCitas extends  clsDatos{
		private $aa_Form;
		private $as_Cadena;
		private $asidtPersona;
		private $asOpcionSolicitud;
		private $asFechaParaCita;
		private $asHoraParaCita;
		private $asErroNume;

		public function __construct(){
			$this->aa_Form=Array();
			$this->as_Cadena="";
			$this->asidtPersona="";
			$this->asOpcionSolicitud="";
			$this->asFechaParaCita="";
			$this->asHoraParaCita="";
			$this->asErroNume="";
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

			//metodo magico set
		public function __set($atributo, $valor){ $this->$atributo = strtoupper($valor);}		
		//metodo get
		public function __get($atributo){ return trim(strtoupper($this->$atributo)); }

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

				$lsSql="INSERT INTO tagendadiocesana (
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


		public function fpermiteCrearCita($fechaNDiasAtras)
		{
			$lbEnc=false;
			$this->fpConectar();
			$lsSql="SELECT 
			A.FechaCita,
			A.EstadoSolicitud,
			B.SolicitudUnica
			FROM tsolicitud AS A 
			INNER JOIN tipo_solicitud AS B ON A.idFtipoSolicitud = B.idTipoSolicitud
			WHERE A.idFSolicitante='$this->asidtPersona' AND A.idFtipoSolicitud='$this->asOpcionSolicitud'
			ORDER BY A.FechaCita DESC LIMIT 1";
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$lsFechaCita=$laArreglo["FechaCita"];
				$lsEstadoSolicitud=$laArreglo["EstadoSolicitud"];
				$lsSolicitudUnica=$laArreglo["SolicitudUnica"];
				if ($lsFechaCita<$fechaNDiasAtras)
				{
					if ($lsEstadoSolicitud==0)	//estado pendiente de atender
					{
						$this->asErroNume=10;// lo siento debe cancelar la cita antes de crear una identica
					}
					elseif ($lsEstadoSolicitud==1) //estado atendido Satisfactoriamente
					{
						if ($lsSolicitudUnica==1)
						{
							$this->asErroNume=9;// lo siento usted ya fue atendido para este requerimiento
						}
						else
						{
							$lbEnc=true;
						}
					}
					else 			//2 atendido por secretaria pero no se pudo procesar su solicitud. 3 pospuesta la cita. 4 rechazada la cita.
					{
						$lbEnc=true;
					}
				}
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}	


		public function fDiasDeCitaDesactivados($citaXdia,$pofunc)
		{
			$KHoraXdia=8; //correspondiente a las 8 horas por dia laboral (No es modificable porque se usa para calcular la hora en de las citas en el dia y no para modificar el rango de tiempo)
			$fechaHoy=date("Y-m-j");
			$fechaManana=$pofunc->fSumaDiasAfecha($fechaHoy,'1');
			$HoraActual=time();
			$lbEnc=false;
			$this->fpConectar();
			$lsSql="SELECT 
			A.codigoDiasDesactivados,
			A.idFresponsableDes,
			A.FechaInicioDes,
			A.HoraInicioDes,
			A.FechaFinDes,
			A.HoraFinDes,
			A.motivoDes,
			A.FechaRegistroDes,
			A.Estatus
			FROM tcitas_dias_desactivados AS A 
			WHERE A.FechaInicioDes<='$this->asFechaParaCita' AND A.FechaFinDes>='$this->asFechaParaCita' AND A.Estatus='1'
			ORDER BY A.FechaFinDes DESC,A.HoraFinDes DESC LIMIT 1";
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$lsFechaCitaIncrementable=$laArreglo["FechaFinDes"];
				$lsFechaCita=$laArreglo["FechaFinDes"];
				$lsHoraPrimera=$laArreglo["HoraInicioDes"];
				$lsHoraUltima=$laArreglo["HoraFinDes"];
				$diaSemanaFecha= date('N', strtotime($lsFechaCitaIncrementable)); 	
				if ($lsHoraUltima>='18:00:00')
				{
					$diaSemanaFecha=7; // si la hora del desbloqueo es mayor a las 6 de la tarde, pues entra al while para cambiar la fecha a la siguiente
				}
				while (($diaSemanaFecha==6)OR($diaSemanaFecha==7))
				{
					$lsFechaCitaIncrementable=$pofunc->fSumaDiasAfecha($lsFechaCitaIncrementable,'1');
					$diaSemanaFecha = date('N', strtotime($lsFechaCitaIncrementable)); 						
				}
				$fechaProxCita=$lsFechaCitaIncrementable;
				if($fechaProxCita==$lsFechaCita)
				{
					if ($this->asHoraParaCita<=$lsHoraUltima)
					{
						$horaProxCita=$lsHoraUltima;
					}
					else
					{
						$horaProxCita=$this->asHoraParaCita;
					}
				}
				else
				{
					$horaProxCita='08:00:00';
				}

				$this->asFechaParaCita=$fechaProxCita;
				$this->asHoraParaCita=$horaProxCita;

				$lbEnc=true;
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();

			if ($fechaProxCita!=$lsFechaCita)
			{
				$lbEnc=$this->fDiasDeCitaDesactivados($citaXdia,$pofunc);
			}

			return $lbEnc;
		}	

		public function fDameFechaDeCita($citaXdia,$pofunc)
		{

			$KHoraXdia=8; //correspondiente a las 8 horas por dia laboral (No es modificable porque se usa para calcular la hora en de las citas en el dia y no para modificar el rango de tiempo)
			$fechaHoy=date("Y-m-j");
			$diaSemanaHoy= date('N', strtotime($fechaHoy)); 	
			$HoraActual=time();
			$lbEnc=false;
			$this->fpConectar();
			$lsSql="SELECT 
			A.FechaCita,
			A.EstadoSolicitud,
			max(A.HoraCita) AS HoraUltima,
			count(A.FechaCita) AS cantiPorDia
			FROM tsolicitud AS A 
			INNER JOIN tipo_solicitud AS B ON A.idFtipoSolicitud = B.idTipoSolicitud
			WHERE A.FechaCita>=NOW()
			GROUP BY A.FechaCita
			ORDER BY A.FechaCita DESC LIMIT 1";
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$lsFechaCita=$laArreglo["FechaCita"];
				$lsHoraUltima=$laArreglo["HoraUltima"];
				$lsCantiActual=$laArreglo["cantiPorDia"];
				$restanCitas=$citaXdia-$lsCantiActual;
				$fechaManana=$pofunc->fSumaDiasAfecha($lsFechaCita,'1');
				$diaSemanaManana= date('N', strtotime($fechaManana)); 	
				if($lsFechaCita=="")
				{
					$lsFechaCita=$fechaHoy;
					while (($diaSemanaHoy==6)OR($diaSemanaHoy==7))
					{
						$lsFechaCita=$pofunc->fSumaDiasAfecha($fechaHoy,'1');
						$diaSemanaHoy = date('N', strtotime($lsFechaCita)); 						
					}
					$lsHoraUltima='8:00:00';
				}
				if($lsHoraUltima=="")
				{
					$lsHoraUltima='8:00:00';
				}

				if($restanCitas<=0)	//Si se completaron las citas por dia
				{
					while (($diaSemanaManana==6)OR($diaSemanaManana==7))
					{
						$fechaManana=$pofunc->fSumaDiasAfecha($fechaManana,'1');
						$diaSemanaManana = date('N', strtotime($fechaManana)); 						
					}
					$fechaProxCita=$fechaManana;
					$horaProxCita='8:00:00';//Hora de inicio
				}
				else
				{
					$fechaProxCita=$lsFechaCita;
					$DecMinutosEntreCitas=$KHoraXdia/$citaXdia;
					if($DecMinutosEntreCitas>0)
					{
						$MinEntreCitas=$DecMinutosEntreCitas*60;
						$minutosRestantes = fmod( $MinEntreCitas, 60 );
						$minutosAhoras = ( $MinEntreCitas - $minutosRestantes ) / 60;
					}
					else
					{
						$minutosAhoras=0;
						$minutosRestantes=$DecMinutosEntreCitas*60;
					}
					list($horaX, $minuX, $seguX) = split('[:]', $lsHoraUltima);

					if($horaX+$minutosAhoras==12)
					{
						$horaX+=2;
						$minuX=0;
						$minutosRestantes=0;
					}
					elseif($horaX+$minutosAhoras==13)
					{
						$horaX+=1;
						$minuX=0;
						$minutosRestantes=0;
					}
					

					$horaProxCita=date("H:i:s", mktime($horaX+$minutosAhoras, $minuX+$minutosRestantes, 00));
					if ($horaProxCita>'18:00:00')
					{
						$horaProxCita='18:00:00';
					}
				}

				$this->asFechaParaCita=$fechaProxCita;
				$this->asHoraParaCita=$horaProxCita;
				$lbEnc=true;
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}	


		public function solicitarDiaCita(){		
			$lbHecho=false;
			$this->fpConectar();																								
			$lsSql="INSERT INTO tsolicitud (
				idFSolicitante,
				idFtipoSolicitud,
				FechaCita,
				HoraCita
				) VALUES (
				'$this->asidtPersona',
				'$this->asOpcionSolicitud',
				'$this->asFechaParaCita',
				'$this->asHoraParaCita')";
																		
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();																										
																						
			return $lbHecho;																								
		}		


		public function fpListaCitasFeligres()
		{

	$lsSql="SELECT 
		tsoli.idTSolicitud,
		tsoli.idFSolicitante,
		tsoli.idFtipoSolicitud,
		tsoli.FechaCita,
		tsoli.HoraCita,
		tsoli.FechaRegistro,
		tsoli.EstadoSolicitud,
		tsoli.Estatus AS EstatusSoli,
		tper.Cedula,
		tper.Nombres,
		tper.Apellidos,
		tper.Sexo,
		tper.Telefono,
		tper.Correo,
		tper.idFparroquiaCodigo,
		tper.Estatus AS EstatusPersona,
		tips.descripcion,
		tips.requisitos
		FROM tsolicitud AS tsoli
		INNER JOIN tpersonas AS tper ON tsoli.idFSolicitante=tper.idTpersonas	
		INNER JOIN tipo_solicitud AS tips ON tsoli.idFtipoSolicitud=tips.idTipoSolicitud	
		WHERE tsoli.idFSolicitante='$this->asidtPersona'
		ORDER BY tsoli.FechaCita ASC,tsoli.HoraCita ASC";

			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["idTSolicitud"]=$laArreglo["idTSolicitud"];
				$laMatriz[$liI]["idFSolicitante"]=$laArreglo["idFSolicitante"];
				$laMatriz[$liI]["idFtipoSolicitud"]=$laArreglo["idFtipoSolicitud"];
				$laMatriz[$liI]["FechaCita"]=$laArreglo["FechaCita"];
				$laMatriz[$liI]["HoraCita"]=$laArreglo["HoraCita"];
				$laMatriz[$liI]["FechaRegistro"]=$laArreglo["FechaRegistro"];
				$laMatriz[$liI]["EstadoSolicitud"]=$laArreglo["EstadoSolicitud"];
				$laMatriz[$liI]["EstatusSoli"]=$laArreglo["EstatusSoli"];
				$laMatriz[$liI]["Cedula"]=$laArreglo["Cedula"];
				$laMatriz[$liI]["Nombres"]=$laArreglo["Nombres"];
				$laMatriz[$liI]["Apellidos"]=$laArreglo["Apellidos"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];
				$laMatriz[$liI]["Telefono"]=$laArreglo["Telefono"];
				$laMatriz[$liI]["Correo"]=$laArreglo["Correo"];
				$laMatriz[$liI]["idFparroquiaCodigo"]=$laArreglo["idFparroquiaCodigo"];
				$laMatriz[$liI]["EstatusPersona"]=$laArreglo["EstatusPersona"];
				$laMatriz[$liI]["descripcion"]=$laArreglo["descripcion"];
				$laMatriz[$liI]["requisitos"]=$laArreglo["requisitos"];
			
				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}

		public function fpListaCitasFeligresPendiente()
		{

	$lsSql="SELECT 
		tsoli.idTSolicitud,
		tsoli.idFSolicitante,
		tsoli.idFtipoSolicitud,
		tsoli.FechaCita,
		tsoli.HoraCita,
		tsoli.FechaRegistro,
		tsoli.EstadoSolicitud,
		tsoli.Estatus AS EstatusSoli,
		tper.Cedula,
		tper.Nombres,
		tper.Apellidos,
		tper.Sexo,
		tper.Telefono,
		tper.Correo,
		tper.idFparroquiaCodigo,
		tper.Estatus AS EstatusPersona,
		tips.descripcion,
		tips.requisitos
		FROM tsolicitud AS tsoli
		INNER JOIN tpersonas AS tper ON tsoli.idFSolicitante=tper.idTpersonas	
		INNER JOIN tipo_solicitud AS tips ON tsoli.idFtipoSolicitud=tips.idTipoSolicitud	
		WHERE tsoli.idFSolicitante='$this->asidtPersona' AND EstadoSolicitud='0'
		ORDER BY tsoli.FechaCita ASC,tsoli.HoraCita ASC";

			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["idTSolicitud"]=$laArreglo["idTSolicitud"];
				$laMatriz[$liI]["idFSolicitante"]=$laArreglo["idFSolicitante"];
				$laMatriz[$liI]["idFtipoSolicitud"]=$laArreglo["idFtipoSolicitud"];
				$laMatriz[$liI]["FechaCita"]=$laArreglo["FechaCita"];
				$laMatriz[$liI]["HoraCita"]=$laArreglo["HoraCita"];
				$laMatriz[$liI]["FechaRegistro"]=$laArreglo["FechaRegistro"];
				$laMatriz[$liI]["EstadoSolicitud"]=$laArreglo["EstadoSolicitud"];
				$laMatriz[$liI]["EstatusSoli"]=$laArreglo["EstatusSoli"];
				$laMatriz[$liI]["Cedula"]=$laArreglo["Cedula"];
				$laMatriz[$liI]["Nombres"]=$laArreglo["Nombres"];
				$laMatriz[$liI]["Apellidos"]=$laArreglo["Apellidos"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];
				$laMatriz[$liI]["Telefono"]=$laArreglo["Telefono"];
				$laMatriz[$liI]["Correo"]=$laArreglo["Correo"];
				$laMatriz[$liI]["idFparroquiaCodigo"]=$laArreglo["idFparroquiaCodigo"];
				$laMatriz[$liI]["EstatusPersona"]=$laArreglo["EstatusPersona"];
				$laMatriz[$liI]["descripcion"]=$laArreglo["descripcion"];
				$laMatriz[$liI]["requisitos"]=$laArreglo["requisitos"];
			
				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}

		public function fpListaCitasSecretaria()
		{
			$hoyFecha=date('Y-m-j');
			$FechaLimiteMuestra = strtotime ( '-1 month' , strtotime ( $hoyFecha ) ) ;
			$FechaLimiteMuestra = date ( 'Y-m-j' , $FechaLimiteMuestra );
	$lsSql="SELECT 
		tsoli.idTSolicitud,
		tsoli.idFSolicitante,
		tsoli.idFtipoSolicitud,
		tsoli.FechaCita,
		tsoli.HoraCita,
		tsoli.FechaRegistro,
		tsoli.EstadoSolicitud,
		tsoli.Estatus AS EstatusSoli,
		tper.Cedula,
		tper.Nombres,
		tper.Apellidos,
		tper.Sexo,
		tper.Telefono,
		tper.Correo,
		tper.idFparroquiaCodigo,
		tper.Estatus AS EstatusPersona,
		tips.descripcion,
		tips.requisitos
		FROM tsolicitud AS tsoli
		INNER JOIN tpersonas AS tper ON tsoli.idFSolicitante=tper.idTpersonas	
		INNER JOIN tipo_solicitud AS tips ON tsoli.idFtipoSolicitud=tips.idTipoSolicitud	
		WHERE tsoli.FechaCita>='$FechaLimiteMuestra' AND tsoli.EstadoSolicitud='0'
		ORDER BY tsoli.FechaCita ASC,tsoli.HoraCita ASC";

			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["idTSolicitud"]=$laArreglo["idTSolicitud"];
				$laMatriz[$liI]["idFSolicitante"]=$laArreglo["idFSolicitante"];
				$laMatriz[$liI]["idFtipoSolicitud"]=$laArreglo["idFtipoSolicitud"];
				$laMatriz[$liI]["FechaCita"]=$laArreglo["FechaCita"];
				$laMatriz[$liI]["HoraCita"]=$laArreglo["HoraCita"];
				$laMatriz[$liI]["FechaRegistro"]=$laArreglo["FechaRegistro"];
				$laMatriz[$liI]["EstadoSolicitud"]=$laArreglo["EstadoSolicitud"];
				$laMatriz[$liI]["EstatusSoli"]=$laArreglo["EstatusSoli"];
				$laMatriz[$liI]["Cedula"]=$laArreglo["Cedula"];
				$laMatriz[$liI]["Nombres"]=$laArreglo["Nombres"];
				$laMatriz[$liI]["Apellidos"]=$laArreglo["Apellidos"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];
				$laMatriz[$liI]["Telefono"]=$laArreglo["Telefono"];
				$laMatriz[$liI]["Correo"]=$laArreglo["Correo"];
				$laMatriz[$liI]["idFparroquiaCodigo"]=$laArreglo["idFparroquiaCodigo"];
				$laMatriz[$liI]["EstatusPersona"]=$laArreglo["EstatusPersona"];
				$laMatriz[$liI]["descripcion"]=$laArreglo["descripcion"];
				$laMatriz[$liI]["requisitos"]=$laArreglo["requisitos"];
			
				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
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

				$lsSql="UPDATE tagendadiocesana SET 
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
			$lsSql="UPDATE tagendadiocesana SET 
				Estatus='".$variControl."' 
				WHERE  codigoAgenda='".$this->aa_Form['Codigo']."'";

				$this->fpConectar();	
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();			
																				
			return $lbHecho;																								
		}	

		public function fpAnularCitaFeligres($idCita){	

			$lbHecho=false;																									
				$lsSql="UPDATE tsolicitud SET 
				EstadoSolicitud= '3' 
				WHERE  idTSolicitud='$idCita'";
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
			FROM tagendadiocesana AS tage 
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
		public function fpListaCitasSecretariaCriterio($criterio)
		{
			$hoyFecha=date('Y-m-j');
			$FechaLimiteMuestra = strtotime ( '-1 month' , strtotime ( $hoyFecha ) ) ;
			$FechaLimiteMuestra = date ( 'Y-m-j' , $FechaLimiteMuestra );
			$lsSql="SELECT 
				tsoli.idTSolicitud,
				tsoli.idFSolicitante,
				tsoli.idFtipoSolicitud,
				tsoli.FechaCita,
				tsoli.HoraCita,
				tsoli.FechaRegistro,
				tsoli.EstadoSolicitud,
				tsoli.Estatus AS EstatusSoli,
				tper.Cedula,
				tper.Nombres,
				tper.Apellidos,
				tper.Sexo,
				tper.Telefono,
				tper.Correo,
				tper.idFparroquiaCodigo,
				tper.Estatus AS EstatusPersona,
				tips.descripcion,
				tips.requisitos
				FROM tsolicitud AS tsoli
				INNER JOIN tpersonas AS tper ON tsoli.idFSolicitante=tper.idTpersonas	
				INNER JOIN tipo_solicitud AS tips ON tsoli.idFtipoSolicitud=tips.idTipoSolicitud	
				WHERE tsoli.EstadoSolicitud='0' AND (tpersonas.Cedula like '%".$criterio."%' OR tsoli.idTSolicitud like '%".$criterio."%')
				ORDER BY tsoli.FechaCita ASC,tsoli.HoraCita ASC";

			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb)) $datos = $laArreglo;
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}


	/**********************************************************************************************************************/
}