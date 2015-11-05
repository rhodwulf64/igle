<?php

    require_once("clsDatos.php");
	class claPadrinos extends clsDatos
	{
		private $MatrizPadri;
		private $asIDpersona;
		private $asIDcumatba;
		private $asEventoPadrino;
		private $asIDTPadrinos;	//Posible uso futuro
		private $asIDFSacra;	//id del matrimonio, bautizo o confirmacion
		private $asIDFPadrino;	//id del padrino
		private $asFechaRegistro;
		private $asTipoPadrino;
		private $asEstatusPadrino;
		//estas 3 variables hacen referencia a los campos de las 3 tablas de padrinos y asi usando la misma clase se puedan gestionar todos los padrinos.
		private $asFilaPadri;
		private $asNombreIDpadrino;		
		private $asTablaPadrinos;
		private $asCualSujeto;



		
		public function __construct()
		{
			$this->MatrizPadri= "";
			$this->asIDpersona="";
			$this->asIDcumatba="";
			$this->asEventoPadrino="";
			$this->asIDTPadrinos="";	//Posible uso futuro
			$this->asIDFSacra="";	//id del matrimonio, bautizo o confirmacion
			$this->asIDFPadrino="";	//id del padrino
			$this->asFechaRegistro=date("Y-m-d H:i:s");
			$this->asTipoPadrino="";
			$this->asEstatusPadrino="";
			$this->asFilaPadri="";
			$this->asNombreIDpadrino="";
			$this->asTablaPadrinos="";
			$this->asCualSujeto="";			

		}
		
		public function __destruct()
		{
		}

		public function fpSetMatrizPadri($psMatrizPadri)
		{
			$this->MatrizPadri=$psMatrizPadri;
		}

		public function fpSetIDpersona($psIDpersona)
		{
			$this->asIDpersona=$psIDpersona;
		}
		
		public function fpSetCedula($psCedula)
		{
			$this->asCedula=$psCedula;
		}
		
		public function fpSetNombre($psNombre)
		{
			$this->asNombre=$psNombre;
		}
		
		public function fpSetApellido($psApellido)
		{
			$this->asApellido=$psApellido;
		}
		
		public function fpSetSexo($psSexo)
		{
			$this->asSexo=$psSexo;
		}
		
		public function fpSetFechaNaci($psFechaNaci)
		{
			$this->asFechaNaci=$psFechaNaci;
		}
		
		public function fpSetDireccion($psDireccion)
		{
			$this->asDireccion=$psDireccion;
		}

		public function fpSetTelefono($psTelefono)
		{
			$this->asTelefono=$psTelefono;
		}

		public function fpSetGradoEstudio($psGradoEstudio)
		{
			$this->asGradoEstudio=$psGradoEstudio;
		}
		public function fpSetTallaFranela($psTallaFranela)
		{
			$this->asTallaFranela=$psTallaFranela;
		}
		public function fpSetProxCeduEscolar($psProxCeduEscolar)
		{
			$this->asProxCeduEscolar=$psProxCeduEscolar;
		}
		public function fpSetEstatus($psEstatus)
		{
			$this->asEstatus=$psEstatus;
		}

		public function fpSetIDcumatba($psIDcumatba)
		{
			$this->asIDcumatba=$psIDcumatba;
		}

		public function fpSetIDTPadrinos($psIDTPadrinos)
		{
			$this->asIDTPadrinos=$psIDTPadrinos;
		}
		public function fpSetIDFSacra($psIDFSacra)
		{
			$this->asIDFSacra=$psIDFSacra;
		}
		public function fpSetIDFPadrino($psIDFPadrino)
		{
			$this->asIDFPadrino=$psIDFPadrino;
		}
		public function fpSetTipoPadrino($psTipoPadrino)
		{
			$this->asTipoPadrino=$psTipoPadrino;
		}
		public function fpSetEstatusPadrino($psEstatusPadrino)
		{
			$this->asEstatusPadrino=$psEstatusPadrino;
		}
		public function fpSetFilaPadri($psFilaPadri)
		{
			$this->asFilaPadri=$psFilaPadri;
		}
			public function fpSetEventoPadrino($psEventoPadrino)
		{
			$lbHecho=false;

			$this->asEventoPadrino=$psEventoPadrino;
			$TablaPadrinos="";
			if ($psEventoPadrino=="M")
			{
				$this->asNombreIDpadrino="idTmatrimonioPadrinos";

				$this->asTablaPadrinos="tmatrimoniopadrinos";
				
				$this->asCualSujeto="idFmatrimonio";

				$lbHecho=true;
			}
			elseif($psEventoPadrino=="B")
			{
				$this->asNombreIDpadrino="idTbautizoPadrino";

				$this->asTablaPadrinos="tbautizopadrino";
				 
				 $this->asCualSujeto="idFbautizo";

				 $lbHecho=true;
			}
			elseif($psEventoPadrino=="C")
			{
				$this->asNombreIDpadrino="idConfirmacionPadrino";				

				$this->asTablaPadrinos="tconfirmacionpadrino";
				 
				 $this->asCualSujeto="idFconfirmado";

				 $lbHecho=true;
			}

				return $lbHecho;
			
		}


/*

					GETSSSSS

*/

		public function fsGetMatrizPadri()
		{
			return $this->MatrizPadri;
		}


		public function fsGetIDpersona()
		{
			return $this->asIDpersona;
		}

		public function fsGetCedula()
		{
			return $this->asCedula;
		}
		
		public function fsGetNombre()
		{
			return $this->asNombre;
		}
		
		public function fsGetApellido()
		{
			return $this->asApellido;
		}
		
		public function fsGetSexo()
		{
			return $this->asSexo;
		}
		
		public function fsGetFechaNaci()
		{
			return $this->asFechaNaci;
		}
		
		public function fsGetDireccion()
		{
			return $this->asDireccion;
		}

		public function fsGetTelefono()
		{
			return $this->asTelefono;
		}
		public function fsGetFechaRegistro()
		{
			return $this->asFechaRegistro;
		}
		public function fsGetGradoEstudio()
		{
			return $this->asGradoEstudio;
		}
		public function fsGetTallaFranela()
		{
			return $this->asTallaFranela;
		}
		public function fsGetProxCeduEscolar()
		{
			return $this->asProxCeduEscolar;
		}
		public function fsGetEstatus()
		{
			return $this->asEstatus;
		}

		public function fsGetIDcumatba()
		{
			return $this->asIDcumatba;
		}

		public function fsGetIDTPadrinos()
		{
			return $this->asIDTPadrinos;
		}
		public function fsGetIDFSacra()
		{
			return $this->asIDFSacra;
		}
		public function fsGetIDFPadrino()
		{
			return $this->asIDFPadrino;
		}
		public function fsGetTipoPadrino()
		{
			return $this->asTipoPadrino;
		}
		public function fsGetEstatusPadrino()
		{
			return $this->asEstatusPadrino;
		}

		public function fbRegistroActivo()
		{
			$lbEnc=false;
			$lsSql="SELECT Estatus FROM tpersonas WHERE Cedula='$this->asCedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				
				if($laArreglo["Estatus"] == 1){

					$lbEnc=true;
				}
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}


		public function fbBuscar()
		{
			$lbEnc=false;
			$lsSql="SELECT * FROM tpersonas WHERE Cedula='$this->asCedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asIDpersona=$laArreglo["idTpersonas"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asNombre=$laArreglo["Nombres"];
				$this->asApellido=$laArreglo["Apellidos"];
				$this->asSexo=$laArreglo["Sexo"];
				$this->asDireccion=$laArreglo["Direccion"];
				$this->asTelefono=$laArreglo["Telefono"];
				$this->asFechaNaci=$laArreglo["FechaNacimiento"];
				$this->asFechaRegistro=$laArreglo["FechaRegistro"];
				$this->asGradoEstudio=$laArreglo["idFgradoEstudio"];
				$this->asTallaFranela=$laArreglo["idFtallaFranela"];
				$this->asEstatus=$laArreglo["Estatus"];

				$lbEnc=true;
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}
		
		
		
		public function fbBuscarNombre()
		{
			$lbEnc=false;
			$lsSql="SELECT idTpersonas,Cedula,Nombres,Apellidos,ProxCeduEscolar,Estatus FROM tpersonas WHERE Cedula='$this->asCedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asIDpersona=$laArreglo["idTpersonas"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asNombre=$laArreglo["Nombres"];
				$this->asApellido=$laArreglo["Apellidos"];
				$this->asEstatus=$laArreglo["Estatus"];
				$this->asProxCeduEscolar=$laArreglo["ProxCeduEscolar"];

				$lbEnc=true;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}
		
		public function fbIncluir()
		{
			$lbHecho=false;
			$lsSql="INSERT INTO tpersonas 
					(Cedula,Nombres,Apellidos,Sexo,Direccion,Telefono,FechaNacimiento,FechaRegistro,idFgradoEstudio,idFtallaFranela,Estatus) VALUES 
					('$this->asCedula','$this->asNombre','$this->asApellido','$this->asSexo','$this->asDireccion','$this->asTelefono','$this->asFechaNaci','$this->asFechaRegistro','$this->asGradoEstudio','$this->asTallaFranela','$this->asEstatus')";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}

		public function fbIncluirPadrinos()
		{
			$lbHecho=false;
			$this->fpConectar();
			parent::fpBegin();
			$MatrixPadri=$this->MatrizPadri;
			$cnfalse=0;
			for($liI=1;$liI<=$this->asFilaPadri;$liI++)
			{
					 $lsSql="INSERT INTO tpersonas 
					(Cedula,Nombres,Apellidos,Sexo,Direccion,Telefono,FechaNacimiento,FechaRegistro,idFgradoEstudio,idFtallaFranela,Estatus) VALUES 
					('".$MatrixPadri[$liI][1]."','".$MatrixPadri[$liI][2]."','".$MatrixPadri[$liI][3]."','".$MatrixPadri[$liI][4]."','".$MatrixPadri[$liI][5]."','".$MatrixPadri[$liI][6]."','".$MatrixPadri[$liI][7]."','".$this->asFechaRegistro."','".$MatrixPadri[$liI][8]."','".$MatrixPadri[$liI][9]."','".$MatrixPadri[$liI][10]."')";
					$lbHecho=$this->fbEjecutar($lsSql);
					if ($lbHecho===false)
					{
						$cnfalse++;
						break;
					}
					else
					{

						 $lsSql="INSERT INTO ".$this->asTablaPadrinos." 
						(".$this->asCualSujeto.",idFpadrino,Tipo,Estatus) VALUES 
						('$this->asIDFSacra',(SELECT idTpersonas FROM tpersonas WHERE Cedula='".$MatrixPadri[$liI][1]."'),'".$MatrixPadri[$liI][11]."','".$MatrixPadri[$liI][12]."')";
								
						$lbHecho=$this->fbEjecutar($lsSql);

						if ($lbHecho===false)
						{

							$cnfalse++;
							break;
						}


					}
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
		
		public function fbModificar()
		{
			$lbHecho=false;
			$lsSql="UPDATE tpersonas SET Nombres='$this->asNombre',Apellidos='$this->asApellido',Sexo='$this->asSexo',Direccion='$this->asDireccion',Telefono='$this->asTelefono',Telefono='$this->asTelefono',FechaNacimiento='$this->asFechaNaci',FechaRegistro='$this->asFechaRegistro',idFgradoEstudio='$this->asGradoEstudio',idFtallaFranela='$this->asTallaFranela',Estatus='$this->asEstatus' WHERE Cedula='$this->asCedula'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}

		public function fbActivar($psVar)
		{
			$psVar=1;
			if(fbRegistroActivo()){
				$psVar=0;
			}
			$lbHecho=false;
			$lsSql="UPDATE tpersonas SET Estatus='$psVar' WHERE Cedula='$this->asCedula'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function faListarPadrinos()
		{

			$lsSql="SELECT padri.Tipo AS TipoPadri, padri.Estatus AS EstatusPadri, per.* FROM ".$this->asTablaPadrinos." AS padri LEFT JOIN tpersonas AS per ON padri.idFpadrino = idTpersonas WHERE ".$this->asCualSujeto."='$this->asIDcumatba' ORDER BY 11";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{

				$laMatriz[$liI]["Nacionalidad"]=$laArreglo["Nacionalidad"];
				$laMatriz[$liI]["Cedula"]=$laArreglo["Cedula"];
				$laMatriz[$liI]["Nombres"]=$laArreglo["Nombres"];
				$laMatriz[$liI]["Apellidos"]=$laArreglo["Apellidos"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];
				$laMatriz[$liI]["Direccion"]=$laArreglo["Direccion"];
				$laMatriz[$liI]["Telefono"]=$laArreglo["Telefono"];
				$laMatriz[$liI]["FechaNacimiento"]=$laArreglo["FechaNacimiento"];
				$laMatriz[$liI]["FechaRegistro"]=$laArreglo["FechaRegistro"];
				$laMatriz[$liI]["GradoEstudio"]=$laArreglo["idFgradoEstudio"];
				$laMatriz[$liI]["TallaFranela"]=$laArreglo["idFtallaFranela"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$laMatriz[$liI]["TipoPadri"]=$laArreglo["TipoPadri"];
				$laMatriz[$liI]["EstatusPadri"]=$laArreglo["EstatusPadri"];
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}

		public function faListarPadrinosReales()
		{

			$lsSql="SELECT padri.Tipo AS TipoPadri, padri.Estatus AS EstatusPadri, per.* FROM ".$this->asTablaPadrinos." AS padri LEFT JOIN tpersonas AS per ON padri.idFpadrino = per.idTpersonas WHERE ".$this->asCualSujeto."='$this->asIDcumatba' AND Tipo = 'C' ORDER BY idFpadrino";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{

				$laMatriz[$liI]["Nacionalidad"]=$laArreglo["Nacionalidad"];
				$laMatriz[$liI]["Cedula"]=$laArreglo["Cedula"];
				$laMatriz[$liI]["Nombres"]=$laArreglo["Nombres"];
				$laMatriz[$liI]["Apellidos"]=$laArreglo["Apellidos"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];
				$laMatriz[$liI]["Direccion"]=$laArreglo["Direccion"];
				$laMatriz[$liI]["Telefono"]=$laArreglo["Telefono"];
				$laMatriz[$liI]["FechaNacimiento"]=$laArreglo["FechaNacimiento"];
				$laMatriz[$liI]["FechaRegistro"]=$laArreglo["FechaRegistro"];
				$laMatriz[$liI]["GradoEstudio"]=$laArreglo["idFgradoEstudio"];
				$laMatriz[$liI]["TallaFranela"]=$laArreglo["idFtallaFranela"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$laMatriz[$liI]["TipoPadri"]=$laArreglo["TipoPadri"];
				$laMatriz[$liI]["EstatusPadri"]=$laArreglo["EstatusPadri"];
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
