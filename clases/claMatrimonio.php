<?php

    require_once("clsDatos.php");
    require_once("claPersonas.php");
   	require_once("clsFuncionesGlobales.php");
	$loFuncion =new clsFunciones();
	
    $loPersonas=new claPersonas();
	class claMatrimonio extends clsDatos
	{

		private $asFechaRegistro;
		private $MatrizPadri;
		private $asFilaPadri;
		private $asIDTmatrimonio;
		private $asFechaInscri;
		private $asFechaMatrimonio;
		private $asIDsacerdote;
		private $asNombSacerdote;
		private $asCInovia;
		private $asIDnovia;
		private $asNombnovia;
		private $asSexonovia;
		private $asCInovio;
		private $asIDnovio;
		private $asNombnovio;
		private $asSexonovio;
		private $asEstadoMatrimonio;
		private $asEstatus;
		private $asCeduPadri;
		//agregados luego
		private $asNacionovia;
		private $asNacionovio;
		private $asFechaProclamaUno;
		private $asFechaProclamaDos;
		private $asFechaProclamaTres;
		private $asNombMadreNovia;
		private $asNombPadreNovia;
		private $asNombMadreNovio;
		private $asNombPadreNovio;
		private $asDatosPadres;
		private $asEstadonovia;
		private $asCiudadnovia;
		private $asMunicipionovia;
		private $asParroquianovia;
		private $asEstadonovio;
		private $asInterLibro;
		private $asInterFolio;
		private $asInterNumero;
		private $asNotaMarginal;
		private $asCiudadnovio;
		private $asMunicipionovio;
		private $asParroquianovio;
		private $asFechaNaciNovia;
		private $asFechaNaciNovio;
		private $asArraymatrimo;
		private $asRefMatrimonio;
		private $asIDTMatriAuxiliar;


		public function __construct()
		{
			$this->asFechaRegistro=date("Y-m-d H:i:s");
			$this->MatrizPadri= "";
			$this->asFilaPadri="";
			$this->asIDTmatrimonio="";
			$this->asFechaInscri="";
			$this->asFechaMatrimonio="";
			$this->asIDsacerdote="";
			$this->asNombSacerdote="";
			$this->asCInovia="";
			$this->asIDnovia="";
			$this->asNombnovia="";
			$this->asSexonovia="";			
			$this->asCInovio="";
			$this->asIDnovio="";
			$this->asNombnovio="";	
			$this->asSexonovio="";
			$this->asEstadoMatrimonio="";
			$this->asEstatus="";
			$this->asInterLibro="";
			$this->asInterFolio="";
			$this->asInterNumero="";
			$this->asNotaMarginal="";
			$this->asCeduPadri="";
			$this->asNacionovia="";
			$this->asNacionovio="";
			$this->asFechaProclamaUno="";
			$this->asFechaProclamaDos="";
			$this->asFechaProclamaTres="";
			$this->asNombMadreNovia="";
			$this->asNombPadreNovia="";
			$this->asNombMadreNovio="";
			$this->asNombPadreNovio="";
			$this->asEstadonovia="";
			$this->asCiudadnovia="";
			$this->asMunicipionovia="";
			$this->asParroquianovia="";
			$this->asEstadonovio="";
			$this->asCiudadnovio="";
			$this->asMunicipionovio="";
			$this->asParroquianovio="";			
			$this->asDatosPadres=array(array());
			$this->asFechaNaciNovia="";
			$this->asFechaNaciNovio="";
			$this->asArraymatrimo="";
			$this->asRefMatrimonio="";
			$this->asIDTMatriAuxiliar="";
		}
		

		//metodo magico set
		public function __set($atributo, $valor){ $this->$atributo = strtoupper($valor);}		
		//metodo get
		public function __get($atributo){ return trim(strtoupper($this->$atributo)); }

		public function __destruct()
		{
		}
		
		public function fbceduPadri($psCeduPadri)
		{
			$this->asCeduPadri=$psCeduPadri;
		}

		public function fpSetIDTmatrimonio($psIDTmatrimonio)
		{
			$this->asIDTmatrimonio=$psIDTmatrimonio;
		}

		public function fpSetFechaInscri($psFechaInscri)
		{
			$this->asFechaInscri=$psFechaInscri;
		}
		
		public function fpSetFechaMatrimonio($psFechaMatrimonio)
		{
			$this->asFechaMatrimonio=$psFechaMatrimonio;
		}
		
		public function fpSetIDsacerdote($psIDsacerdote)
		{
			$this->asIDsacerdote=$psIDsacerdote;
		}

		public function fpSetCInovia($psCInovia)
		{
			$this->asCInovia=$psCInovia;
		}

		public function fpSetIDnovia($psIDnovia)
		{
			$this->asIDnovia=$psIDnovia;
		}

		public function fpSetNombnovia($psNombnovia)
		{
			$this->asNombnovia=$psNombnovia;
		}
		public function fpSetCInovio($psCInovio)
		{
			$this->asCInovio=$psCInovio;
		}

		public function fpSetIDnovio($psIDnovio)
		{
			$this->asIDnovio=$psIDnovio;
		}

		public function fpSetNombnovio($psNombnovio)
		{
			$this->asNombnovio=$psNombnovio;
		}
		public function fpSetEstadoMatrimonio($psEstadoMatrimonio)
		{
			$this->asEstadoMatrimonio=$psEstadoMatrimonio;
		}
		public function fpSetInterLibro($psInterLibro)
		{
			$this->asInterLibro=$psInterLibro;
		}
		public function fpSetInterFolio($psInterFolio)
		{
			$this->asInterFolio=$psInterFolio;
		}
		public function fpSetInterNumero($psInterNumero)
		{
			$this->asInterNumero=$psInterNumero;
		}
		public function fpSetNotaMarginal($psNotaMarginal)
		{
			$this->asNotaMarginal=$psNotaMarginal;
		}

		public function fpSetEstatus($psEstatus)
		{
			$this->asEstatus=$psEstatus;
		}
		public function fpSetMatrizPadri($psMatrizPadri)
		{
			$this->MatrizPadri=$psMatrizPadri;
		}

		public function fpSetFilaPadri($psFilaPadri)
		{
			$this->asFilaPadri=$psFilaPadri;
		}

		public function fpSetNacionovia($psNacionovia)
		{
			$this->asNacionovia=$psNacionovia;
		}

		public function fpSetNacionovio($psNacionovio)
		{
			$this->asNacionovio=$psNacionovio;
		}

		public function fpSetFechaProclamaUno($psFechaProclamaUno)
		{
			$this->asFechaProclamaUno=$psFechaProclamaUno;
		}

		public function fpSetFechaProclamaDos($psFechaProclamaDos)
		{
			$this->asFechaProclamaDos=$psFechaProclamaDos;
		}

		public function fpSetFechaProclamaTres($psFechaProclamaTres)
		{
			$this->asFechaProclamaTres=$psFechaProclamaTres;
		}

		public function fpSetIDmadreNovia($psIDmadreNovia)
		{
			$this->asNombMadreNovia=$psIDmadreNovia;
		}

		public function fpSetIDpadreNovia($psIDpadreNovia)
		{
			$this->asNombPadreNovia=$psIDpadreNovia;
		}

		public function fpSetIDmadreNovio($psIDmadreNovio)
		{
			$this->asNombMadreNovio=$psIDmadreNovio;
		}

		public function fpSetIDpadreNovio($psIDpadreNovio)
		{
			$this->asNombPadreNovio=$psIDpadreNovio;
		}

		public function fpSetDatosPadres($psDatosPadres)
		{
			$this->asDatosPadres=$psDatosPadres;
		}
		public function fpSetRefMatrimonio($psRefMartrimonio)
		{
			$this->asRefMatrimonio=$psRefMartrimonio;
		}

						/*GETS:*/

		public function fpGetIDTmatrimonio()
		{
			return $this->asIDTmatrimonio;
		}
		public function fpGetFechaInscri()
		{
			return $this->asFechaInscri;
		}

		public function fsGetFechaMatrimonio()
		{
			return $this->asFechaMatrimonio;
		}
		
		public function fsGetIDsacerdote()
		{
			return $this->asIDsacerdote;
		}
		
		public function fsGetCInovia()
		{
			return $this->asCInovia;
		}

		public function fsGetIDnovia()
		{
			return $this->asIDnovia;
		}
		
		public function fsGetNombnovia()
		{
			return $this->asNombnovia;
		}

		public function fsGetSexonovia()
		{
			return $this->asSexonovia;
		}

		public function fsGetCInovio()
		{
			return $this->asCInovio;
		}

		public function fsGetIDnovio()
		{
			return $this->asIDnovio;
		}
		
		public function fsGetNombnovio()
		{
			return $this->asNombnovio;
		}

		public function fsGetSexonovio()
		{
			return $this->asSexonovio;
		}

		public function fsGetEstadoMatrimonio()
		{
			return $this->asEstadoMatrimonio;
		}

		public function fsGetInterLibro()
		{
			return $this->asInterLibro;
		}

		public function fsGetInterFolio()
		{
			return $this->asInterFolio;
		}

		public function fsGetInterNumero()
		{
			return $this->asInterNumero;
		}

		public function fsGetNotaMarginal()
		{
			return $this->asNotaMarginal;
		}
		
		public function fsGetEstatus()
		{
			return $this->asEstatus;
		}

		public function fsGetNacionovia()
		{
			return $this->asNacionovia;
		}

		public function fsGetNacionovio()
		{
			return $this->asNacionovio;
		}

		public function fsGetFechaProclamaUno()
		{
			return $this->asFechaProclamaUno;
		}

		public function fsGetFechaProclamaDos()
		{
			return $this->asFechaProclamaDos;
		}

		public function fsGetFechaProclamaTres()
		{
			return $this->asFechaProclamaTres;
		}

		public function fsGetIDmadreNovia()
		{
			return $this->asNombMadreNovia;
		}

		public function fsGetIDpadreNovia()
		{
			return $this->asNombPadreNovia;
		}

		public function fsGetIDmadreNovio()
		{
			return $this->asNombMadreNovio;
		}

		public function fsGetIDpadreNovio()
		{
			return $this->asNombPadreNovio;
		}

		public function fsGetDatosPadres()
		{
			return $this->asDatosPadres;
		}

		public function fsGetEstadonovia()
		{
			return $this->asEstadonovia;
		}

		public function fsGetCiudadnovia()
		{
			return $this->asCiudadnovia;
		}

		public function fsGetMunicipionovia()
		{
			return $this->asMunicipionovia;
		}

		public function fsGetParroquianovia()
		{
			return $this->asParroquianovia;
		}

		public function fsGetEstadonovio()
		{
			return $this->asEstadonovio;
		}

		public function fsGetCiudadnovio()
		{
			return $this->asCiudadnovio;
		}

		public function fsGetMunicipionovio()
		{
			return $this->asMunicipionovio;
		}

		public function fsGetParroquianovio()
		{
			return $this->asParroquianovio;
		}

		public function fsGetFechaNaciNovia()
		{
			return $this->asFechaNaciNovia;
		}

		public function fsGetFechaNaciNovio()
		{
			return $this->asFechaNaciNovio;
		}

		public function fsGetArraymatrimo()
		{
			return $this->asArraymatrimo;
		}

		public function fsGetRefMatrimonio()
		{
			return $this->asRefMatrimonio;
		}

		public function fsGetNombSacerdote()
		{
			return $this->asNombSacerdote;
		}


	public function fbBuscIncluMatrimonio()    //OJOOOO Aparentemente no se utiliza
		{
			$lbEnc=0;
			$lsSql="SELECT matrimo.idTmatrimonio, matrimo.FechaInscri, matrimo.FechaMatrimonio, matrimo.idFsacerdote, matrimo.idFnovia, matrimo.idFnovio, matrimo.FechaProclamaUno, matrimo.FechaProclamaDos, matrimo.FechaProclamaTres, matrimo.EstadoMatrimonio, matrimo.Estatus, DatNovia.idTpersonas, DatNovia.Nacionovia, DatNovia.Cedula, DatNovia.Nombres, DatNovia.Apellidos, DatNovia.Sexo, DatNovia.idFmadre, DatNovia.idFpadre FROM tmatrimonio AS matrimo RIGHT JOIN tpersonas AS DatNovia ON DatNovia.idTpersonas = matrimo.idFnovia WHERE DatNovia.Cedula='$this->asCInovia' UNION ALL SELECT matrimo.idTmatrimonio, matrimo.FechaInscri, matrimo.FechaMatrimonio, matrimo.idFsacerdote, matrimo.idFnovia, matrimo.idFnovio, matrimo.FechaProclamaUno, matrimo.FechaProclamaDos, matrimo.FechaProclamaTres, matrimo.EstadoMatrimonio, matrimo.Estatus, DatNovio.idTpersonas, DatNovio.Nacionovia, DatNovio.Cedula, DatNovio.Nombres, DatNovio.Apellidos, DatNovio.Sexo, DatNovio.idFmadre, DatNovio.idFpadre FROM tmatrimonio AS matrimo RIGHT JOIN tpersonas AS DatNovio ON DatNovio.idTpersonas = matrimo.idFnovio WHERE DatNovio.Cedula='$this->asCInovio' AND matrimo.Estatus = 1";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				if ($this->FilasRecibidas($lrTb)==1)
				{
					
						if($laArreglo["Sexo"]=="F") //encuentra a la novia
						{
							$this->asIDTmatrimonio=$laArreglo["idTmatrimonio"];
							$this->asFechaInscri=$laArreglo["FechaInscri"];
							$this->asFechaMatrimonio=$laArreglo["FechaMatrimonio"];
							$this->asIDsacerdote=$laArreglo["idFsacerdote"];
							$this->asFechaProclamaUno=$laArreglo["FechaProclamaUno"];
							$this->asFechaProclamaDos=$laArreglo["FechaProclamaDos"];
							$this->asFechaProclamaTres=$laArreglo["FechaProclamaTres"];
							$this->asCInovia=$laArreglo["Cedula"];
							$this->asNombnovia=$laArreglo["Nombres"]." ".$laArreglo["Apellidos"];
							$this->asSexonovia=$laArreglo["Sexo"];
							$this->asEstadoMatrimonio=$laArreglo["EstadoMatrimonio"];
							$this->asRefMatrimonio=$laArreglo["ReferenciaMatrimonio"];
							$this->asEstatus=$laArreglo["Estatus"];
							$lbEnc=2;
						}
						
						elseif($laArreglo["Sexo"]=="M") //encuentra al novio
						{
							$this->asIDTmatrimonio=$laArreglo["idTmatrimonio"];
							$this->asFechaInscri=$laArreglo["FechaInscri"];
							$this->asFechaMatrimonio=$laArreglo["FechaMatrimonio"];
							$this->asIDsacerdote=$laArreglo["idFsacerdote"];
							$this->asFechaProclamaUno=$laArreglo["FechaProclamaUno"];
							$this->asFechaProclamaDos=$laArreglo["FechaProclamaDos"];
							$this->asFechaProclamaTres=$laArreglo["FechaProclamaTres"];
							$this->asCInovio=$laArreglo["Cedula"];
							$this->asNombnovio=$laArreglo["Nombres"]." ".$laArreglo["Apellidos"];
							$this->asSexonovio=$laArreglo["Sexo"];
							$this->asEstadoMatrimonio=$laArreglo["EstadoMatrimonio"];
							$this->asRefMatrimonio=$laArreglo["ReferenciaMatrimonio"];
							$this->asEstatus=$laArreglo["Estatus"];
							$lbEnc=3;
						}

				}
				elseif ($this->FilasRecibidas($lrTb)==2)
				{

					if($laArreglo[1]["idTmatrimonio"]==$laArreglo[2]["idTmatrimonio"])
					{
								if($laArreglo[1]["Sexo"]=="F") //encuentra a la novia
								{
											$this->asIDTmatrimonio=$laArreglo[1]["idTmatrimonio"];
											$this->asFechaInscri=$laArreglo[1]["FechaInscri"];
											$this->asFechaMatrimonio=$laArreglo[1]["FechaMatrimonio"];
											$this->asIDsacerdote=$laArreglo[1]["idFsacerdote"];
											$this->asCInovia=$laArreglo[1]["Cedula"];
											$this->asNombnovia=$laArreglo[1]["Nombres"]." ".$laArreglo[1]["Apellidos"];
											$this->asSexonovia=$laArreglo[1]["Sexo"];
											$this->asEstatus=$laArreglo[1]["Estatus"];
											$lbEnc=4;

								if($laArreglo[2]["Sexo"]=="M") //encuentra al novio
										{				//encuentra a los 2 registrados


											$this->asCInovio=$laArreglo[2]["Cedula"];
											$this->asNombnovio=$laArreglo[2]["Nombres"]." ".$laArreglo[2]["Apellidos"];
											$this->asSexonovio=$laArreglo[2]["Sexo"];
											$lbEnc=1;
										
										}
								}		
					}
					else
					{
						$lbEnc=5;
					}

				}
				else
				{
					$lbEnc=0;
				}
		
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}

		public function fbBuscarPadrinoExiste($sacer,$novia,$novio,$CIpadri,$MatriS)
		{
			
			$lbEnc=array();
			$lbEnc["resulta"]=false;
			$lsSql="SELECT * FROM tmatrimoniopadrinos WHERE idFmatrimonio=(SELECT idTmatrimonio FROM tmatrimonio WHERE ReferenciaMatrimonio='$MatriS') AND idFpadrino=(SELECT idTpersonas FROM tpersonas WHERE Cedula='$CIpadri')"; 
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))	
			{
				$lbEnc["idFmatrimonio"]=$laArreglo["idFmatrimonio"];
				$lbEnc["idFpadrino"]=$laArreglo["idFpadrino"];
				$lbEnc["Tipo"]=$laArreglo["Tipo"];
				$LbEnc["FechaRegistroPadri"]=$laArreglo["FechaRegistroPadri"];
				$lbEnc["Estatus"]=$laArreglo["Estatus"];
				$lbEnc["resulta"]=true;
			}
			
			$this->fpCierraFiltro($lrTb);
			
			return $lbEnc;

		}

		public function fbBuscarPersonaExiste($cedPersona)
		{
			
			$lbEnc=array();
			$lbEnc["resulta"]=false;
			$lsSql="SELECT * FROM tpersonas WHERE Cedula='$cedPersona'"; 
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))	
			{
				$lbEnc["idTpersonas"]=$laArreglo["idTpersonas"];
				$lbEnc["Cedula"]=$laArreglo["Cedula"];
				$lbEnc["Nombres"]=$laArreglo["Nombres"];
				$LbEnc["Apellidos"]=$laArreglo["Apellidos"];
				$lbEnc["Sexo"]=$laArreglo["Sexo"];
				$lbEnc["resulta"]=true;
			}
			
			$this->fpCierraFiltro($lrTb);
			
			return $lbEnc;

		}

		public function fbBuscaIDmatri()
		{
		
		$lbIDmatri=0;
		$lsSql="SELECT matrimo.idTmatrimonio FROM tmatrimonio AS matrimo WHERE matrimo.idFnovio='$this->asIDnovio' AND matrimo.Estatus = 1 OR matrimo.idFnovia='$this->asIDnovia' AND matrimo.Estatus = 1";

		$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				
				$lbIDmatri=$laArreglo["idTmatrimonio"];
	
			}

			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbIDmatri;
		}
		
		public function EsSacerdoteCedula($IDpersona)
		{
			$lbEnc=false;
		$lsSql="SELECT * FROM tsacerdote WHERE idFpersona = '$IDpersona' AND Estatus = '1'";
		$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$lbEnc=true;	
			}

			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}
	
		
		public function fbBuscarMatrimonio()
		{
			if ($this->asNacionovia!="")
			{
				$this->asCInovia=$this->asNacionovia."-".$this->asCInovia;
			}
			if ($this->asNacionovio!="")
			{
				$this->asCInovio=$this->asNacionovio."-".$this->asCInovio;
			}


				$lsSql="SELECT 
				matrimo.idTmatrimonio, 
				matrimo.FechaInscri, 
				matrimo.FechaMatrimonio, 
				matrimo.idFsacerdote, 
				matrimo.idFnovia, 
				matrimo.idFnovio, 
				matrimo.FechaProclamaUno, 
				matrimo.FechaProclamaDos, 
				matrimo.FechaProclamaTres, 
				matrimo.EstadoMatrimonio, 
				matrimo.ReferenciaMatrimonio, 
				sacer.idFpersona AS SacerID, 
				CONCAT(sacerPersona.Nombres,' ',sacerPersona.Apellidos) AS NombSacer, 
				matrimo.Libro_registro AS interLibro, 
				matrimo.Folio_registro AS interFolio, 
				matrimo.Numero_registro AS interNumero, 
				matrimo.NotaMarginal AS NotaMarginal, 
				matrimo.Estatus, 
				DatNovia.idTpersonas, 
				DatNovia.Nacionalidad AS Nacionovia, 
				DatNovia.Cedula, 
				DatNovia.Nombres, 
				DatNovia.Apellidos, 
				DatNovia.Sexo, 
				DatNovia.idFpadre AS idFpadrenovia, 
				DatNovia.idFmadre AS idFmadrenovia, 
				DatNovia.idFestado, 
				DatNovia.idFciudad, 
				DatNovia.idFmunicipio, 
				DatNovia.idFparroquia, 
				DatNovia.FechaNacimiento AS FechaNaciNovia, 
				EstadoNovia.descripcion AS Estadonovia, 
				CiudadNovia.descripcion AS Ciudadnovia, 
				MunicipioNovia.descripcion AS Municipionovia, 
				ParroquiaNovia.descripcion AS Parroquianovia, 
				DatNovio.idTpersonas AS idnovio, 
				DatNovio.Nacionalidad AS Nacionovio, 
				DatNovio.Cedula AS Cedunovio, 
				DatNovio.Nombres AS Nombnovio, 
				DatNovio.Apellidos AS Apellnovio, 
				DatNovio.Sexo AS Sexonovio, 
				DatNovio.idFpadre AS idFpadrenovio, 
				DatNovio.idFmadre AS idFmadrenovio, 
				DatNovio.idFestado, 
				DatNovio.idFciudad, 
				DatNovio.idFmunicipio, 
				DatNovio.idFparroquia, 
				DatNovio.FechaNacimiento AS FechaNaciNovio, 
				EstadoNovio.descripcion AS Estadonovio, 
				CiudadNovio.descripcion AS Ciudadnovio, 
				MunicipioNovio.descripcion AS Municipionovio, 
				ParroquiaNovio.descripcion AS Parroquianovio, 
				GoPadreNovia.idTpersonas, 
				GoPadreNovia.Nacionalidad AS NacionaPadreNovia, 
				GoPadreNovia.Cedula AS CedulaPadreNovia, 
				CONCAT(  GoPadreNovia.Nombres ,  ' ',  GoPadreNovia.Apellidos ) AS NombresPadreNovia, 
				GoPadreNovia.idFestado AS EstadoPadreNovia, 
				GoPadreNovia.idFciudad AS CiudadPadreNovia, 
				GoPadreNovia.idFmunicipio AS MunicipioPadreNovia, 
				GoPadreNovia.idFparroquia AS ParroquiaPadreNovia, 
				GoMadreNovia.idTpersonas, GoMadreNovia.Nacionalidad AS NacionaMadreNovia, 
				GoMadreNovia.Cedula AS CedulaMadreNovia, 
				CONCAT(  GoMadreNovia.Nombres ,  ' ',  GoMadreNovia.Apellidos ) AS NombresMadreNovia, 
				GoMadreNovia.idFestado AS EstadoMadreNovia, 
				GoMadreNovia.idFciudad AS CiudadMadreNovia, 
				GoMadreNovia.idFmunicipio AS MunicipioMadreNovia, 
				GoMadreNovia.idFparroquia AS ParroquiaMadreNovia, 
				GoPadreNovio.idTpersonas, GoPadreNovio.Nacionalidad AS NacionaPadreNovio, 
				GoPadreNovio.Cedula AS CedulaPadreNovio, 
				CONCAT(  GoPadreNovio.Nombres ,  ' ',  GoPadreNovio.Apellidos ) AS NombresPadreNovio, 
				GoPadreNovio.idFestado AS EstadoPadreNovio, GoPadreNovio.idFciudad AS CiudadPadreNovio, 
				GoPadreNovio.idFmunicipio AS MunicipioPadreNovio, GoPadreNovio.idFparroquia AS ParroquiaPadreNovio, 
				GoMadreNovio.idTpersonas, GoMadreNovio.Nacionalidad AS NacionaMadreNovio, 
				GoMadreNovio.Cedula AS CedulaMadreNovio, 
				CONCAT(  GoMadreNovio.Nombres ,  ' ',  GoMadreNovio.Apellidos ) AS NombresMadreNovio, 
				GoMadreNovio.idFestado AS EstadoMadreNovio, GoMadreNovio.idFciudad AS CiudadMadreNovio, 
				GoMadreNovio.idFmunicipio AS MunicipioMadreNovio, 
				GoMadreNovio.idFparroquia AS ParroquiaMadreNovio 
				FROM tmatrimonio AS matrimo 
				INNER JOIN tsacerdote AS sacer ON matrimo.idFsacerdote = sacer.idTsacerdote 
				INNER JOIN tpersonas AS sacerPersona ON sacer.idFpersona = sacerPersona.idTpersonas 
				LEFT JOIN tpersonas AS DatNovio ON DatNovio.idTpersonas = matrimo.idFnovio 
				LEFT JOIN estado AS EstadoNovio ON EstadoNovio.cod_estado = DatNovio.idFestado 
				LEFT JOIN ciudad AS CiudadNovio ON CiudadNovio.cod_ciudad = DatNovio.idFciudad 
				LEFT JOIN municipio AS MunicipioNovio ON MunicipioNovio.cod_municipio = DatNovio.idFmunicipio 
				LEFT JOIN parroquia AS ParroquiaNovio ON ParroquiaNovio.cod_parroquia = DatNovio.idFparroquia 
				LEFT JOIN tpersonas AS GoPadreNovio ON GoPadreNovio.idTpersonas = DatNovio.idFpadre 
				LEFT JOIN tpersonas AS GoMadreNovio ON GoMadreNovio.idTpersonas = DatNovio.idFmadre 
				LEFT JOIN tpersonas AS DatNovia ON DatNovia.idTpersonas = matrimo.idFnovia 
				LEFT JOIN estado AS EstadoNovia ON EstadoNovia.cod_estado = DatNovia.idFestado 
				LEFT JOIN ciudad AS CiudadNovia ON CiudadNovia.cod_ciudad = DatNovia.idFciudad 
				LEFT JOIN municipio AS MunicipioNovia ON MunicipioNovia.cod_municipio = DatNovia.idFmunicipio 
				LEFT JOIN parroquia AS ParroquiaNovia ON ParroquiaNovia.cod_parroquia = DatNovia.idFparroquia 
				LEFT JOIN tpersonas AS GoPadreNovia ON GoPadreNovia.idTpersonas = DatNovia.idFpadre 
				LEFT JOIN tpersonas AS GoMadreNovia ON GoMadreNovia.idTpersonas = DatNovia.idFmadre 
				WHERE matrimo.ReferenciaMatrimonio='$this->asRefMatrimonio'";
				
			
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				if ($this->FilasRecibidas($lrTb)==1)
				{
					
						if($laArreglo["Sexo"]!="F" or $laArreglo["Sexonovio"]!="M") 
						{
							$lbEnc=3;
						}
						else
						{
							$lbEnc=1;
						}
							$DatosPadres=array(array());

							$DatosPadres[0]["Nacionalidad"]=$laArreglo["NacionaMadreNovia"];
							$DatosPadres[0]["Cedula"]=$laArreglo["CedulaMadreNovia"];
							$DatosPadres[0]["Nombres"]=$laArreglo["NombresMadreNovia"];
							$DatosPadres[0]["Estado"]=$laArreglo["EstadoMadreNovia"];
							$DatosPadres[0]["Ciudad"]=$laArreglo["CiudadMadreNovia"];
							$DatosPadres[0]["Municipio"]=$laArreglo["MunicipioMadreNovia"];
							$DatosPadres[0]["Parroquia"]=$laArreglo["ParroquiaMadreNovia"];

							$DatosPadres[1]["Nacionalidad"]=$laArreglo["NacionaPadreNovia"];
							$DatosPadres[1]["Cedula"]=$laArreglo["CedulaPadreNovia"];
							$DatosPadres[1]["Nombres"]=$laArreglo["NombresPadreNovia"];
							$DatosPadres[1]["Estado"]=$laArreglo["EstadoPadreNovia"];
							$DatosPadres[1]["Ciudad"]=$laArreglo["CiudadPadreNovia"];
							$DatosPadres[1]["Municipio"]=$laArreglo["MunicipioPadreNovia"];
							$DatosPadres[1]["Parroquia"]=$laArreglo["ParroquiaPadreNovia"];

							$DatosPadres[2]["Nacionalidad"]=$laArreglo["NacionaMadreNovio"];
							$DatosPadres[2]["Cedula"]=$laArreglo["CedulaMadreNovio"];
							$DatosPadres[2]["Nombres"]=$laArreglo["NombresMadreNovio"];
							$DatosPadres[2]["Estado"]=$laArreglo["EstadoMadreNovio"];
							$DatosPadres[2]["Ciudad"]=$laArreglo["CiudadMadreNovio"];
							$DatosPadres[2]["Municipio"]=$laArreglo["MunicipioMadreNovio"];
							$DatosPadres[2]["Parroquia"]=$laArreglo["ParroquiaMadreNovio"];

							$DatosPadres[3]["Nacionalidad"]=$laArreglo["NacionaPadreNovio"];
							$DatosPadres[3]["Cedula"]=$laArreglo["CedulaPadreNovio"];
							$DatosPadres[3]["Nombres"]=$laArreglo["NombresPadreNovio"];
							$DatosPadres[3]["Estado"]=$laArreglo["EstadoPadreNovio"];
							$DatosPadres[3]["Ciudad"]=$laArreglo["CiudadPadreNovio"];
							$DatosPadres[3]["Municipio"]=$laArreglo["MunicipioPadreNovio"];
							$DatosPadres[3]["Parroquia"]=$laArreglo["ParroquiaPadreNovio"];

							$this->asIDTmatrimonio=$laArreglo["idTmatrimonio"];
							$this->asFechaInscri=$laArreglo["FechaInscri"];
							$this->asFechaMatrimonio=$laArreglo["FechaMatrimonio"];
							$this->asIDsacerdote=$laArreglo["idFsacerdote"];
							$this->asFechaProclamaUno=$laArreglo["FechaProclamaUno"];
							$this->asFechaProclamaDos=$laArreglo["FechaProclamaDos"];
							$this->asFechaProclamaTres=$laArreglo["FechaProclamaTres"];
							$this->asNacionovia=$laArreglo["Nacionovia"];
							$this->asNacionovio=$laArreglo["Nacionovio"];
							$this->asCInovia=$laArreglo["Cedula"];
							$this->asNombnovia=$laArreglo["Nombres"]." ".$laArreglo["Apellidos"];
							$this->asSexonovia=$laArreglo["Sexo"];
							$this->asCInovio=$laArreglo["Cedunovio"];
							$this->asNombnovio=$laArreglo["Nombnovio"]." ".$laArreglo["Apellnovio"];
							$this->asSexonovio=$laArreglo["Sexonovio"];
							$this->asEstadonovia=$laArreglo["Estadonovia"];
							$this->asCiudadnovia=$laArreglo["Ciudadnovia"];
							$this->asMunicipionovia=$laArreglo["Municipionovia"];
							$this->asParroquianovia=$laArreglo["Parroquianovia"];
							$this->asFechaNaciNovia=$laArreglo["FechaNaciNovia"];
							$this->asEstadonovio=$laArreglo["Estadonovio"];
							$this->asCiudadnovio=$laArreglo["Ciudadnovio"];
							$this->asMunicipionovio=$laArreglo["Municipionovio"];
							$this->asParroquianovio=$laArreglo["Parroquianovio"];
							$this->asFechaNaciNovio=$laArreglo["FechaNaciNovio"];
							$this->asEstadoMatrimonio=$laArreglo["EstadoMatrimonio"];
							$this->asInterLibro=$laArreglo["interLibro"];
							$this->asInterFolio=$laArreglo["interFolio"];
							$this->asInterNumero=$laArreglo["interNumero"];
							$this->asNotaMarginal=$laArreglo["NotaMarginal"];
							$this->asRefMatrimonio=$laArreglo["ReferenciaMatrimonio"];
							$this->asNombSacerdote=$laArreglo["NombSacer"];
							$this->asEstatus=$laArreglo["Estatus"];
							$this->asDatosPadres=$DatosPadres;
				}
				else
				{
					$lbEnc=0;
				}
				
			}
			
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}

		public function buscarLike($tipo = "cc",$cadena = ""){
			switch($tipo){
				case "cc":
					$lsSql=("SELECT *, sacerDat.idFpersona, CONCAT(Sacer.Nombres ,  ' ',  Sacer.Apellidos) AS NombreSacer, sacerDat.idTsacerdote AS IDSacer from tmatrimonio INNER JOIN tpersonas AS sacerDat ON matrimo.idFsacerdote = sacerDat.idTpersonas INNER JOIN tpersonas AS Sacer ON sacerDat.idFpersona = Sacer.idTpersonas WHERE idFnovia = '(SELECT idTpersonas from tpersonas WHERE Cedula = '$this->asCInovia')' or idFnovio = '(SELECT idTpersonas from tpersonas WHERE Cedula = '$this->asCInovio')'");
				break;
				case "proximo":
					$lsSql=("SELECT matrimo.idTmatrimonio AS IDmatri, matrimo.EstadoMatrimonio AS MatriEdo,matrimo.Libro_registro AS interLibro,matrimo.Folio_registro AS interFolio,matrimo.Numero_registro AS interNumero,matrimo.NotaMarginal AS NotaMarginal, matrimo.Motivo AS Motivo, matrimo.ReferenciaMatrimonio, sacerDat.idFpersona, CONCAT(Sacer.Nombres ,  ' ',  Sacer.Apellidos) AS NombreSacer, sacerDat.idTsacerdote AS IDSacer, matrimo.FechaMatrimonio AS MatriFecha, matrimo.FechaProclamaUno, matrimo.FechaProclamaDos, matrimo.FechaProclamaTres, CONCAT(Dnovia.Nacionalidad, '-', Dnovia.Cedula ) AS NvaCedula, CONCAT(  Dnovia.Nombres ,  ' ',  Dnovia.Apellidos ) AS NvaNombre, Dnovia.FechaNacimiento as FechaNaciNovia, CONCAT( Dnovio.Nacionalidad, '-', Dnovio.Cedula ) AS NvoCedula, CONCAT(  Dnovio.Nombres ,  ' ',  Dnovio.Apellidos ) AS NvoNombre, Dnovio.FechaNacimiento AS FechaNaciNovio  FROM tmatrimonio AS matrimo INNER JOIN tpersonas AS Dnovia ON matrimo.idFnovia = Dnovia.idTpersonas INNER JOIN tpersonas AS Dnovio ON matrimo.idFnovio = Dnovio.idTpersonas INNER JOIN tsacerdote AS sacerDat ON matrimo.idFsacerdote = sacerDat.idTsacerdote INNER JOIN tpersonas AS Sacer ON sacerDat.idFpersona = Sacer.idTpersonas
					WHERE ( (Dnovia.Cedula like '%$cadena%') or (Dnovia.Nombres like '%$cadena%') or (Dnovia.Apellidos like '%$cadena%') or (Dnovio.Cedula like '%$cadena%') or (Dnovio.Nombres like '%$cadena%') or (Dnovio.Apellidos like '%$cadena%') or (matrimo.ReferenciaMatrimonio like '%$cadena%'))");
				break;
			}
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);

			while($laArreglo=$this->faProximo($lrTb))
			{
				$arr[] = $laArreglo;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			return $arr;
		}
		
		public function fbBuscarRefMatrimonioExiste($refRecibida)
		{
			
			$this->fpConectar();
			$lbEnc=false;
			$lsSql="SELECT * FROM tmatrimonio WHERE ReferenciaMatrimonio='".$refRecibida."'"; 
		
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))	
			{
				$this->asIDTMatriAuxiliar=$laArreglo["idTmatrimonio"];
				$lbEnc=true;
			}

			$this->fpCierraFiltro($lrTb);
			return $lbEnc;

		}

		function fCadenaAleatoria($cant)
		{
			$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; //posibles caracteres a usar
			$cadena = ""; //variable para almacenar la cadena generada
			for($i=0;$i<$cant;$i++)
			{
			    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres 
			entre el rango 0 a Numero de letras que tiene la cadena */
			}
			return $cadena;
		}

		public function fbIncluirMatrimonio()
		{
			$lbHecho=false;
			$lbHecho1=false;
			$RadHecho=false;

			$cnfalse=0;
			$this->fpConectar();
			$MatrixPadri=$this->MatrizPadri;
			$IDTMatriAuxiliar=0; //para almacenar temporalmente el idTmatrimonio que viene de la funcion fbBuscarRefMatrimonioExiste()
			parent::fpBegin();
			$lsSql="INSERT INTO tmatrimonio 
					(FechaInscri,FechaMatrimonio,idFsacerdote,idFnovia,idFnovio,FechaProclamaUno,FechaProclamaDos,FechaProclamaTres,EstadoMatrimonio,Libro_registro,Folio_registro,Numero_registro,NotaMarginal,ReferenciaMatrimonio,Estatus) VALUES ('$this->asFechaInscri','$this->asFechaMatrimonio','$this->asIDsacerdote','$this->asIDnovia','$this->asIDnovio','$this->asFechaProclamaUno','$this->asFechaProclamaDos','$this->asFechaProclamaTres','0','$this->asInterLibro','$this->asInterFolio','$this->asInterNumero','$this->asNotaMarginal','Indefinido','3')";
			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			$IDTMatriAuxiliar=$this->fpGetIDinsertado();
			if ($lbHecho)
			{
				$ReferenciaNueva=$IDTMatriAuxiliar.$this->fCadenaAleatoria(2);
				$lsSql="UPDATE tmatrimonio SET ReferenciaMatrimonio='".$ReferenciaNueva."' WHERE idTmatrimonio='".$IDTMatriAuxiliar."'";
				$lbHecho1=$this->fbEjecutarNoDie($lsSql);
				$this->asRefMatrimonio=$ReferenciaNueva;
				if(!$lbHecho1)
				{
					$cnfalse=550;
				}
			
			

				if ($cnfalse===0)
				{

					for($liI=1;$liI<=$this->asFilaPadri;$liI++)
					{		
							$resultPer=$this->fbBuscarPersonaExiste($MatrixPadri[$liI][2]);
							
							if ($resultPer["resulta"]==false)
							{
							$lsSql="INSERT INTO tpersonas 
									(Nacionalidad,Cedula,Nombres,Apellidos,Sexo,Direccion,Telefono,FechaNacimiento,FechaRegistro,idFgradoEstudio,idFtallaFranela,Estatus) VALUES 
									('".$MatrixPadri[$liI][1]."','".$MatrixPadri[$liI][2]."','".$MatrixPadri[$liI][3]."','".$MatrixPadri[$liI][4]."','".$MatrixPadri[$liI][5]."','".$MatrixPadri[$liI][6]."','".$MatrixPadri[$liI][7]."','".$this->asFechaRegistro."','".$MatrixPadri[$liI][8]."','".$MatrixPadri[$liI][9]."','".$MatrixPadri[$liI][10]."','".$MatrixPadri[$liI][11]."')";
								$lbHecho=$this->fbEjecutarNoDie($lsSql);
							}
							else
							{
								$lbHecho=true;
							}
							if ($lbHecho)
							{

							$lsSql="INSERT INTO tmatrimoniopadrinos 
								(idFmatrimonio,idFpadrino,Tipo,Estatus) VALUES 
								((SELECT idTmatrimonio FROM tmatrimonio WHERE idFnovia='".$this->asIDnovia."' AND idFnovio='".$this->asIDnovio."' AND EstadoMatrimonio='0'),(SELECT idTpersonas FROM tpersonas WHERE Cedula='".$MatrixPadri[$liI][2]."'),'".$MatrixPadri[$liI][12]."','".$MatrixPadri[$liI][13]."')";
										
								$lbHecho=$this->fbEjecutarNoDie($lsSql);

								if ($lbHecho==false)
								{

									$cnfalse++;
							
								}

							}
							else
							{
								$cnfalse++;
							}
					}
				}
			}
			else
			{
				$cnfalse++;
			}		

			if($cnfalse===0) 
			{
				parent::fpCommit();
			}
			else
			{
				parent::fpRollback();
			}
			
			$this->fpDesconectar();
			return $lbHecho;

		}	
	
		public function fbModificarMatrimonio($MatriS)
		{
			$lbHecho=false;
			$lbHecho1=false;
			$lbHecho2=false;
			$lbHecho3=false;
			$this->fpConectar();
			$MatrixPadri=$this->MatrizPadri;	
			$lsSql="UPDATE tmatrimonio SET FechaMatrimonio='".$this->asFechaMatrimonio."', idFsacerdote='".$this->asIDsacerdote."', FechaProclamaUno='".$this->asFechaProclamaUno."', FechaProclamaDos='".$this->asFechaProclamaDos."', FechaProclamaTres='".$this->asFechaProclamaTres."', Libro_registro='".$this->asInterLibro."', Folio_registro='".$this->asInterFolio."', Numero_registro='".$this->asInterNumero."', NotaMarginal='".$this->asNotaMarginal."' WHERE ReferenciaMatrimonio='".$MatriS."' AND EstadoMatrimonio=0 OR ReferenciaMatrimonio='".$MatriS."' AND EstadoMatrimonio=2";
			$lbHecho1=$this->fbEjecutarNoDie($lsSql);
			
				for($liI=1;$liI<=$this->asFilaPadri;$liI++)
				{

					if($MatrixPadri[$liI][1]!="")
					{
						$MatrixPadri[$liI][2]=$MatrixPadri[$liI][1]."-".$MatrixPadri[$liI][2];
					}

						$lsSql="INSERT INTO tpersonas (Nacionalidad,Cedula,Nombres,Apellidos,Sexo) VALUES ('".$MatrixPadri[$liI][1]."','".$MatrixPadri[$liI][2]."','".$MatrixPadri[$liI][3]."','".$MatrixPadri[$liI][4]."','".$MatrixPadri[$liI][5]."') ON DUPLICATE KEY UPDATE Nacionalidad='".$MatrixPadri[$liI][1]."', Cedula='".$MatrixPadri[$liI][2]."',Nombres='".$MatrixPadri[$liI][3]."',Apellidos='".$MatrixPadri[$liI][4]."',Sexo='".$MatrixPadri[$liI][5]."'";
						$lbHecho2=$this->fbEjecutarNoDie($lsSql);
						if($lbHecho2)
						{
							$lbHecho1=true;
						}			
				}
				
					for($liI=1;$liI<=$this->asFilaPadri;$liI++)
					{

						$lbEncPadri=$this->fbBuscarPadrinoExiste($this->asIDsacerdote,$this->asIDnovia,$this->asIDnovio,$MatrixPadri[$liI][2],$MatriS);
						
						if($lbEncPadri["resulta"]==false)
						{	
							$lsSql="INSERT INTO tmatrimoniopadrinos (idFmatrimonio,idFpadrino,Tipo,Estatus) VALUES ((SELECT idTmatrimonio FROM tmatrimonio WHERE ReferenciaMatrimonio='".$MatriS."'),(SELECT idTpersonas FROM tpersonas WHERE Cedula='".$MatrixPadri[$liI][2]."'),'".$MatrixPadri[$liI][12]."','".$MatrixPadri[$liI][13]."')";
						}
						else
						{
							$lsSql="UPDATE tmatrimoniopadrinos SET Tipo='".$MatrixPadri[$liI][12]."',Estatus='".$MatrixPadri[$liI][13]."' WHERE idFmatrimonio='".$lbEncPadri["idFmatrimonio"]."' AND idFpadrino='".$lbEncPadri["idFpadrino"]."'";
						}
							$lbHecho3=$this->fbEjecutarNoDie($lsSql);
							if($lbHecho3)
							{
								$lbHecho1=true;
							}	
					}
				
				$this->fpDesconectar();
				if(($lbHecho1)OR($lbHecho2)OR($lbHecho3))
				{
					$lbHecho=true;
				}

			return $lbHecho;
				
		}

		public function fbActivar($psVar)
		{
			if($psVar==""){
				$psVar=1;
			}
			$lbHecho=false;
			$lsSql="UPDATE tmatrimonio SET Estatus='".$psVar."' WHERE idFnovia=(SELECT idTpersonas FROM `tpersonas` WHERE Cedula = '$this->asCInovia') AND EstadoMatrimonio!=1 OR idFnovio=(SELECT idTpersonas FROM `tpersonas` WHERE Cedula = '$this->asCInovio') AND  EstadoMatrimonio!=1";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}


		public function fbBuscarMatrimonioExiste()
		{
			
			$lbEnc=array();
			$lbEnc=false;
			$lsSql="SELECT * FROM tmatrimonio WHERE idFnovia=(SELECT idTpersonas FROM `tpersonas` WHERE Cedula = '$this->asCInovia') AND EstadoMatrimonio=0 OR idFnovio=(SELECT idTpersonas FROM `tpersonas` WHERE Cedula = '$this->asCInovio') AND EstadoMatrimonio=0 OR idFnovia=(SELECT idTpersonas FROM `tpersonas` WHERE Cedula = '$this->asCInovia') AND EstadoMatrimonio=2 OR idFnovio=(SELECT idTpersonas FROM `tpersonas` WHERE Cedula = '$this->asCInovio') AND EstadoMatrimonio=2"; 
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))	
			{
				$lbEnc=true;
			}
			$this->fpDesconectar();
			$this->fpCierraFiltro($lrTb);
			
			return $lbEnc;

		}

		public function fbGestion($psVar,$motivo,$lsMatriS)
		{	
			$evade=true;
			$lbHecho=false;
			$varPendiente="";
			
			if ($psVar==0)
			{
				if ($this->fbBuscarMatrimonioExiste()==false)
				{
					$lsSql="UPDATE tmatrimonio SET EstadoMatrimonio='".$psVar."', Motivo='' WHERE ReferenciaMatrimonio='".$lsMatriS."'";
				}
				else
				{
					$evade=false;
					$varPendiente="99";
				}
			}
			elseif (($psVar==2)or($psVar==3)or($psVar==4))
			{
				$lsSql="UPDATE tmatrimonio SET EstadoMatrimonio='".$psVar."', Motivo='".$motivo."' WHERE ReferenciaMatrimonio='".$lsMatriS."'";
			}
			else
			{
				$lsSql="UPDATE tmatrimonio SET EstadoMatrimonio='".$psVar."' WHERE ReferenciaMatrimonio='".$lsMatriS."'";
			}

			
			if ($evade)
			{
				
				$this->fpConectar();
				$lbHecho=$this->fbEjecutar($lsSql);
				$this->fpDesconectar();
				if ($lbHecho)
				{
					$varPendiente="1";
				}
				else
				{
					$varPendiente="0";
				}
			}
			return $varPendiente;
		}

		public function fbActivarPadri($psVar)
		{
			if($psVar==""){
				$psVar=1;
			}
			$lbHecho=false;
			$lsSql="UPDATE tmatrimoniopadrinos SET Estatus='".$psVar."' WHERE idFpadrino=(SELECT idTpersonas FROM tpersonas WHERE Cedula='$this->asCeduPadri') AND idFmatrimonio=(SELECT idTmatrimonio FROM tmatrimonio WHERE idFsacerdote='$this->asIDsacerdote' AND idFnovia='$this->asCInovia' AND idFnovio='$this->asCInovio' AND EstadoMatrimonio=0)";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}

		public function faListarMatrimonios()
		{
		
			$lsSql="SELECT matrimo.idTmatrimonio, matrimo.FechaInscri, matrimo.FechaMatrimonio, matrimo.idFsacerdote, matrimo.idFnovia, matrimo.idFnovio, matrimo.FechaProclamaUno, matrimo.FechaProclamaDos, matrimo.FechaProclamaTres, matrimo.EstadoMatrimonio, matrimo.ReferenciaMatrimonio, matrimo.Libro_registro AS interLibro, matrimo.Folio_registro AS interFolio, matrimo.Numero_registro AS interNumero, matrimo.NotaMarginal AS NotaMarginal, matrimo.Estatus, matrimo.Motivo AS Motivo, DatNovia.idTpersonas, DatNovia.Nacionalidad AS Nacionovia, DatNovia.Cedula AS Cedunovia, DatNovia.Nombres AS Nombnovia, DatNovia.Apellidos AS Apellnovia, DatNovia.Sexo, DatNovia.idFpadre AS idFpadrenovia, DatNovia.idFmadre AS idFmadrenovia, DatNovia.idFestado, DatNovia.idFciudad, DatNovia.idFmunicipio, DatNovia.idFparroquia, DatNovia.FechaNacimiento AS FechaNaciNovia, EstadoNovia.descripcion AS Estadonovia, CiudadNovia.descripcion AS Ciudadnovia, MunicipioNovia.descripcion AS Municipionovia, ParroquiaNovia.descripcion AS Parroquianovia, DatNovio.idTpersonas AS idnovio, DatNovio.Nacionalidad AS Nacionovio, DatNovio.Cedula AS Cedunovio, DatNovio.Nombres AS Nombnovio, DatNovio.Apellidos AS Apellnovio, DatNovio.Sexo AS Sexonovio, DatNovio.idFpadre AS idFpadrenovio, DatNovio.idFmadre AS idFmadrenovio, DatNovio.idFestado, DatNovio.idFciudad, DatNovio.idFmunicipio, DatNovio.idFparroquia, DatNovio.FechaNacimiento AS FechaNaciNovio, EstadoNovio.descripcion AS Estadonovio, CiudadNovio.descripcion AS Ciudadnovio, MunicipioNovio.descripcion AS Municipionovio, ParroquiaNovio.descripcion AS Parroquianovio, GoPadreNovia.idTpersonas, GoPadreNovia.Nacionalidad AS NacionaPadreNovia, GoPadreNovia.Cedula AS CedulaPadreNovia, CONCAT(  GoPadreNovia.Nombres ,  ' ',  GoPadreNovia.Apellidos ) AS NombresPadreNovia, GoPadreNovia.idFestado AS EstadoPadreNovia, GoPadreNovia.idFciudad AS CiudadPadreNovia, GoPadreNovia.idFmunicipio AS MunicipioPadreNovia, GoPadreNovia.idFparroquia AS ParroquiaPadreNovia, GoMadreNovia.idTpersonas, GoMadreNovia.Nacionalidad AS NacionaMadreNovia, GoMadreNovia.Cedula AS CedulaMadreNovia, CONCAT(  GoMadreNovia.Nombres ,  ' ',  GoMadreNovia.Apellidos ) AS NombresMadreNovia, GoMadreNovia.idFestado AS EstadoMadreNovia, GoMadreNovia.idFciudad AS CiudadMadreNovia, GoMadreNovia.idFmunicipio AS MunicipioMadreNovia, GoMadreNovia.idFparroquia AS ParroquiaMadreNovia, GoPadreNovio.idTpersonas, GoPadreNovio.Nacionalidad AS NacionaPadreNovio, GoPadreNovio.Cedula AS CedulaPadreNovio, CONCAT(  GoPadreNovio.Nombres ,  ' ',  GoPadreNovio.Apellidos ) AS NombresPadreNovio, GoPadreNovio.idFestado AS EstadoPadreNovio, GoPadreNovio.idFciudad AS CiudadPadreNovio, GoPadreNovio.idFmunicipio AS MunicipioPadreNovio, GoPadreNovio.idFparroquia AS ParroquiaPadreNovio, GoMadreNovio.idTpersonas, GoMadreNovio.Nacionalidad AS NacionaMadreNovio, GoMadreNovio.Cedula AS CedulaMadreNovio, CONCAT(  GoMadreNovio.Nombres ,  ' ',  GoMadreNovio.Apellidos ) AS NombresMadreNovio, GoMadreNovio.idFestado AS EstadoMadreNovio, GoMadreNovio.idFciudad AS CiudadMadreNovio, GoMadreNovio.idFmunicipio AS MunicipioMadreNovio, GoMadreNovio.idFparroquia AS ParroquiaMadreNovio FROM tmatrimonio AS matrimo LEFT JOIN tpersonas AS DatNovio ON DatNovio.idTpersonas = matrimo.idFnovio LEFT JOIN estado AS EstadoNovio ON EstadoNovio.cod_estado = DatNovio.idFestado LEFT JOIN ciudad AS CiudadNovio ON CiudadNovio.cod_ciudad = DatNovio.idFciudad LEFT JOIN municipio AS MunicipioNovio ON MunicipioNovio.cod_municipio = DatNovio.idFmunicipio LEFT JOIN parroquia AS ParroquiaNovio ON ParroquiaNovio.cod_parroquia = DatNovio.idFparroquia LEFT JOIN tpersonas AS GoPadreNovio ON GoPadreNovio.idTpersonas = DatNovio.idFpadre LEFT JOIN tpersonas AS GoMadreNovio ON GoMadreNovio.idTpersonas = DatNovio.idFmadre LEFT JOIN tpersonas AS DatNovia ON DatNovia.idTpersonas = matrimo.idFnovia LEFT JOIN estado AS EstadoNovia ON EstadoNovia.cod_estado = DatNovia.idFestado LEFT JOIN ciudad AS CiudadNovia ON CiudadNovia.cod_ciudad = DatNovia.idFciudad LEFT JOIN municipio AS MunicipioNovia ON MunicipioNovia.cod_municipio = DatNovia.idFmunicipio LEFT JOIN parroquia AS ParroquiaNovia ON ParroquiaNovia.cod_parroquia = DatNovia.idFparroquia LEFT JOIN tpersonas AS GoPadreNovia ON GoPadreNovia.idTpersonas = DatNovia.idFpadre LEFT JOIN tpersonas AS GoMadreNovia ON GoMadreNovia.idTpersonas = DatNovia.idFmadre ORDER BY matrimo.EstadoMatrimonio";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["idTmatrimonio"]=$laArreglo["idTmatrimonio"];
				$laMatriz[$liI]["FechaInscri"]=$laArreglo["FechaInscri"];
				$laMatriz[$liI]["FechaMatrimonio"]=$laArreglo["FechaMatrimonio"];
				$laMatriz[$liI]["idFsacerdote"]=$laArreglo["idFsacerdote"];
				$laMatriz[$liI]["FechaProclamaUno"]=$laArreglo["FechaProclamaUno"];
				$laMatriz[$liI]["FechaProclamaDos"]=$laArreglo["FechaProclamaDos"];
				$laMatriz[$liI]["FechaProclamaTres"]=$laArreglo["FechaProclamaTres"];
				$laMatriz[$liI]["Nacionovia"]=$laArreglo["Nacionovia"];
				$laMatriz[$liI]["Nacionovio"]=$laArreglo["Nacionovio"];
				$laMatriz[$liI]["Cedunovia"]=$laArreglo["Cedunovia"];
				$laMatriz[$liI]["Nombnovia"]=$laArreglo["Nombnovia"];
				$laMatriz[$liI]["Apellnovia"]=$laArreglo["Apellnovia"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];
				$laMatriz[$liI]["Cedunovio"]=$laArreglo["Cedunovio"];
				$laMatriz[$liI]["Nombnovio"]=$laArreglo["Nombnovio"];
				$laMatriz[$liI]["Apellnovio"]=$laArreglo["Apellnovio"];
				$laMatriz[$liI]["Sexonovio"]=$laArreglo["Sexonovio"];
				$laMatriz[$liI]["Estadonovia"]=$laArreglo["Estadonovia"];
				$laMatriz[$liI]["Ciudadnovia"]=$laArreglo["Ciudadnovia"];
				$laMatriz[$liI]["Municipionovia"]=$laArreglo["Municipionovia"];
				$laMatriz[$liI]["Parroquianovia"]=$laArreglo["Parroquianovia"];
				$laMatriz[$liI]["FechaNaciNovia"]=$laArreglo["FechaNaciNovia"];
				$laMatriz[$liI]["Estadonovio"]=$laArreglo["Estadonovio"];
				$laMatriz[$liI]["Ciudadnovio"]=$laArreglo["Ciudadnovio"];
				$laMatriz[$liI]["Municipionovio"]=$laArreglo["Municipionovio"];
				$laMatriz[$liI]["Parroquianovio"]=$laArreglo["Parroquianovio"];
				$laMatriz[$liI]["FechaNaciNovio"]=$laArreglo["FechaNaciNovio"];
				$laMatriz[$liI]["EstadoMatrimonio"]=$laArreglo["EstadoMatrimonio"];
				$laMatriz[$liI]["interLibro"]=$laArreglo["interLibro"];
				$laMatriz[$liI]["interFolio"]=$laArreglo["interFolio"];
				$laMatriz[$liI]["interNumero"]=$laArreglo["interNumero"];
				$laMatriz[$liI]["NotaMarginal"]=$laArreglo["NotaMarginal"];
				$laMatriz[$liI]["Motivo"]=$laArreglo["Motivo"];
				$laMatriz[$liI]["ReferenciaMatrimonio"]=$laArreglo["ReferenciaMatrimonio"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}

		

		
		
	}
?>
