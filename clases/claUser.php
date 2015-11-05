<?php

    require_once("clsDatos.php");
	class claUser extends clsDatos
	{
		private $asIDTusuario;
		private $asIDFpersonas;
		private $asIDTpersonas;
		private $asNacioUser;
		private $asCedula;
		private $asClave;
		private $asRol;
		private $asPreguntaSecreta;
		private $asRespuestaSecreta;	
		private $asUltimoIngreso;
		private $asFechaRegistro;
		private $asEstatus;
		private $asNombres;
		private $asApellidos;
		private $asUsuario;
		private $asSexo;
		private $asDireccion;
		private $asTelefono;
		private $asFechaNaci;
		private $asFechaRegistroPer;
		private $asGradoEstudio;
		private $asTallaFranela;
		private $asEstatusPer;
				
		public function __construct()
		{
			$this->asIDTusuario="";
			$this->asIDFpersonas="";
			$this->asIDTpersonas="";
			$this->asNacioUser="";
			$this->asCedula="";
			$this->asClave="";
			$this->asRol="";
			$this->asPreguntaSecreta="";
			$this->asRespuestaSecreta="";
			$this->asUltimoIngreso="";
			$this->asFechaRegistro=date("Y-m-d H:i:s");
			$this->asEstatus="";
			$this->asNombres="";
			$this->asApellidos="";
			$this->asUsuario="";
			$this->asSexo="";
			$this->asDireccion="";
			$this->asTelefono="";
			$this->asFechaNaci="";
			$this->asFechaRegistroPer=date("Y-m-d H:i:s");
			$this->asGradoEstudio="";
			$this->asTallaFranela="";
			$this->asEstatusPer="";
					
		}
		
		public function __destruct()
		{
		}
		
		public function fpSetNacionalidad($psNacioUser)
		{
			$this->asNacioUser=$psNacioUser;
		}

		public function fpSetIDTusuario($psIDTusuario)
		{
			$this->asIDTusuario=$psIDTusuario;
		}

		public function fpSetNombres($psNombres)
		{
			$this->asNombres=$psNombres;
		}

		public function fpSetApellidos($psApellidos)
		{
			$this->asApellidos=$psApellidos;
		}

		public function fpSetIDFpersonas($psIDFpersonas)
		{
			$this->asIDFpersonas=$psIDFpersonas;
		}
		
		public function fpSetIDTpersonas($psIDTpersonas)
		{
			$this->asIDTpersonas=$psIDTpersonas;
		}
		
		public function fpSetCedula($psCedula)
		{
			$this->asCedula=$psCedula;
		}
		
		public function fpSetClave($psClave)
		{
			$this->asClave=sha1(md5($psClave));
		}
		
		public function fpSetRol($psRol)
		{
			$this->asRol=$psRol;
		}

		public function fpSetPreguntaSecreta($psPreguntaSecreta)
		{
			$this->asPreguntaSecreta=$psPreguntaSecreta;
		}
		public function fpSetRespuestaSecreta($psRespuestaSecreta)
		{
			$this->asRespuestaSecreta=$psRespuestaSecreta;
		}




			public function fpSetUltimoIngreso($psUltimoIngreso)
			{
				$this->asUltimoIngreso=$psUltimoIngreso;
			}
			
			public function fpSetFechaRegistro($psFechaRegistro)
			{
				$this->asFechaRegistro=$psFechaRegistro;
			}
			
			public function fpSetEstatus($psEstatus)
			{
				$this->asEstatus=$psEstatus;
			}

			public function fpSetUsuario($psUsuario)
			{
				$this->asUsuario=$psUsuario;
			}
			public function fpSetSexo($psSexo)
			{
				$this->asSexo=$psSexo;
			}
			public function fpSetDireccion($psDireccion)
			{
				$this->asDireccion=$psDireccion;
			}
			public function fpSetTelefono($psTelefono)
			{
				$this->asTelefono=$psTelefono;
			}
			public function fpSetFechaNaci($psFechaNaci)
			{
				$this->asFechaNaci=$psFechaNaci;
			}
			public function fpSetFechaRegistroPer($psFechaRegistroPer)
			{
				$this->asFechaRegistroPer=$psFechaRegistroPer;
			}
			public function fpSetGradoEstudio($psGradoEstudio)
			{
				$this->asGradoEstudio=$psGradoEstudio;
			}
			public function fpSetTallaFranela($psTallaFranela)
			{
				$this->asTallaFranela=$psTallaFranela;
			}
			public function fpSetEstatusPer($psEstatusPer)
			{
				$this->asEstatusPer=$psEstatusPer;
			}


		/*GETSS*/

		public function fsGetIDTusuario()
		{
			return $this->asIDTusuario;
		}
		
		public function fsGetNombre()
		{
			return $this->asNombres;
		}

		public function fsGetApellido()
		{
			return $this->asApellidos;
		}

		public function fsGetIDFpersonas()
		{
			return $this->asIDFpersonas;
		}
		
		public function fsGetIDTpersonas()
		{
			return $this->asIDTpersonas;
		}
		
		public function fsGetNacioUser()
		{
			return $this->asNacioUser;
		}		
		
		public function fsGetCedula()
		{
			return $this->asCedula;
		}
				
		public function fsGetClave()
		{
			return $this->asClave;
		}
		
		public function fsGetRol()
		{
			return $this->asRol;
		}

		public function fsGetPreguntaSecreta()
		{
			return $this->asPreguntaSecreta;
		}
		public function fsGetRespuestaSecreta()
		{
			return $this->asRespuestaSecreta;
		}

		
		public function fsGetUltimoIngreso()
		{
			return $this->asUltimoIngreso;
		}
		
		public function fsGetFechaRegistro()
		{
			return $this->asFechaRegistro;
		}
		
		public function fsGetEstatus()
		{
			return $this->asEstatus;
		}

		public function fsGetUsuario()
		{
			return $this->asUsuario;
		}
		public function fsGetSexo()
		{
			return $this->asSexo;
		}
		public function fsGetDireccion()
		{
			return $this->asDireccion;
		}
		public function fsGetTelefono()
		{
			return $this->asTelefono;
		}
		public function fsGetFechaNaci()
		{
			return $this->asFechaNaci;
		}
		public function fsGetRegistroPer()
		{
			return $this->asFechaRegistroPer;
		}
		public function fsGetGradoEstudio()
		{
			return $this->asGradoEstudio;
		}
		public function fsGetTallaFranela()
		{
			return $this->asTallaFranela;
		}
		public function fsGetEstatusPer()
		{
			return $this->asEstatusPer;
		}
						

		public function fbBuscar()
		{
			$lbEnc=0;
			$compar=substr($this->asCedula,0,1);
			if (($compar!='E')&&($compar!='V')&&($compar!='P'))
			{
				$this->asCedula=$this->asNacioUser."-".$this->asCedula;	
			}
			$lsSql="SELECT
			 hijo.*, edo.descripcion AS EstadoName, 
			 tuser.idTusuario,
			 tuser.idFpersonas, 
			 tuser.Usuario, 
			 tuser.Rol, 
			 tuser.PreguntaSecreta, 
			 tuser.RespuestaSecreta, 
			 tuser.UltimoIngreso, 
			 tuser.FechaRegistro AS fechaRegUser, 
			 tuser.Estatus AS EstatusUser, 
			city.descripcion AS CiudadName, 
			muni.descripcion AS MunicipioName, 
			parro.descripcion AS ParroquiaName, 
			tpIglesia.codigoParroquiaIglesia AS IDIglesia, 
			tpIglesia.nombre AS NombreIglesia
			FROM tpersonas AS hijo 
			LEFT JOIN tusuarios AS tuser ON hijo.idTpersonas = tuser.idFpersonas
			LEFT JOIN estado AS edo ON hijo.idFestado = edo.cod_estado 
			LEFT JOIN ciudad AS city ON hijo.idFestado = city.cod_ciudad 
			LEFT JOIN municipio AS muni ON hijo.idFmunicipio = muni.cod_municipio 
			LEFT JOIN parroquia AS parro ON hijo.idFparroquia = parro.cod_parroquia 
			LEFT JOIN tparroquiaiglesia AS tpIglesia ON hijo.idFparroquiaCodigo = tpIglesia.codigoParroquiaIglesia 
			WHERE hijo.cedula='$this->asCedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{

				/*USUARIO*/
				$this->asIDTusuario=$laArreglo["idTusuario"];
				$this->asIDFpersonas=$laArreglo["idFpersonas"];
				$this->asUsuario=$laArreglo["Usuario"];
				$this->asRol=$laArreglo["Rol"];
				$this->asPreguntaSecreta=$laArreglo["PreguntaSecreta"];
				$this->asRespuestaSecreta=$laArreglo["RespuestaSecreta"];
				$this->asUltimoIngreso=$laArreglo["UltimoIngreso"];
				$this->asFechaRegistro=$laArreglo["fechaRegUser"];
				$this->asEstatus=$laArreglo["EstatusUser"];	

				/*PERSONAS*/
				$this->asIDTpersonas=$laArreglo["idTpersonas"];
				$this->asNombres=$laArreglo["Nombres"];
				$this->asApellidos=$laArreglo["Apellidos"];
				$this->asNacioUser=$laArreglo["Nacionalidad"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asSexo=$laArreglo["Sexo"];
				$this->asDireccion=$laArreglo["Direccion"];
				$this->asTelefono=$laArreglo["Telefono"];
				$this->asFechaNaci=$laArreglo["FechaNacimiento"];
				$this->asFechaRegistroPer=$laArreglo["FechaRegistro"];
				$this->asGradoEstudio=$laArreglo["idFgradoEstudio"];
				$this->asTallaFranela=$laArreglo["idFtallaFranela"];
				$this->asEstatusPer=$laArreglo["Estatus"];

				if ($laArreglo["Rol"]=="" and $laArreglo["Cedula"]!="")
				{
					$lbEnc=1;
				}else{
					$lbEnc=2;
				}
				
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}

		public function fbBuscarPersona()
		{
			$lbEnc=0;
			 $lsSql="SELECT tuser.idTusuario,
			 tuser.idFpersonas, 
			 tuser.Usuario, 
			 tuser.Rol, 
			 tuser.PreguntaSecreta, 
			 tuser.RespuestaSecreta, 
			 tuser.UltimoIngreso, 
			 tuser.FechaRegistro AS fechaRegUser, 
			 tuser.Estatus AS EstatusUser, 
			 tuserDatos.* 
			 FROM tusuarios AS tuser 
			 RIGHT JOIN tpersonas AS tuserDatos on tuser.idFpersonas = tuserDatos.idTpersonas 
			 WHERE tuser.Usuario='$this->asUsuario' ";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{

				/*USUARIO*/
				$this->asIDTusuario=$laArreglo["idTusuario"];
				$this->asIDFpersonas=$laArreglo["idFpersonas"];
				$this->asUsuario=$laArreglo["Usuario"];
				$this->asRol=$laArreglo["Rol"];
				$this->asPreguntaSecreta=$laArreglo["PreguntaSecreta"];
				$this->asRespuestaSecreta=$laArreglo["RespuestaSecreta"];
				$this->asUltimoIngreso=$laArreglo["UltimoIngreso"];
				$this->asFechaRegistro=$laArreglo["fechaRegUser"];
				$this->asEstatus=$laArreglo["EstatusUser"];	

				/*PERSONAS*/
				$this->asIDTpersonas=$laArreglo["idTpersonas"];
				$this->asNombres=$laArreglo["Nombres"];
				$this->asApellidos=$laArreglo["Apellidos"];
				$this->asNacioUser=$laArreglo["Nacionalidad"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asSexo=$laArreglo["Sexo"];
				$this->asDireccion=$laArreglo["Direccion"];
				$this->asTelefono=$laArreglo["Telefono"];
				$this->asFechaNaci=$laArreglo["FechaNacimiento"];
				$this->asFechaRegistroPer=$laArreglo["FechaRegistro"];
				$this->asGradoEstudio=$laArreglo["idFgradoEstudio"];
				$this->asTallaFranela=$laArreglo["idFtallaFranela"];
				$this->asEstatusPer=$laArreglo["Estatus"];

				if ($laArreglo["Rol"]=="" and $laArreglo["Cedula"]!="")
				{
					$lbEnc=1;
				}else{
					$lbEnc=2;
				}
				
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}


		public function fbBuscarRecu()
		{
			if ($this->asNacioUser!="")
			{
				$this->asCedula=$this->asNacioUser."-".$this->asCedula;
			}
			$lbEnc=0;
			$lsSql="SELECT tuser.idTusuario, tuser.idFpersonas, tuser.Usuario, tuser.Rol, tuser.PreguntaSecreta, tuser.RespuestaSecreta, tuser.UltimoIngreso, tuser.FechaRegistro AS fechaRegUser, tuser.Estatus AS EstatusUser, tuserDatos.*  FROM tpersonas AS tuserDatos LEFT JOIN tusuarios AS tuser on tuserDatos.idTpersonas = tuser.idFpersonas WHERE tuser.Usuario='$this->asUsuario' ";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{

				/*USUARIO*/
				$this->asIDTusuario=$laArreglo["idTusuario"];
				$this->asIDFpersonas=$laArreglo["idFpersonas"];
				$this->asUsuario=$laArreglo["Usuario"];
				$this->asRol=$laArreglo["Rol"];
				$this->asPreguntaSecreta=$laArreglo["PreguntaSecreta"];
				$this->asRespuestaSecreta=$laArreglo["RespuestaSecreta"];
				$this->asUltimoIngreso=$laArreglo["UltimoIngreso"];
				$this->asFechaRegistro=$laArreglo["fechaRegUser"];
				$this->asEstatus=$laArreglo["EstatusUser"];	

				/*PERSONAS*/
				$this->asNombres=$laArreglo["Nombres"];
				$this->asApellidos=$laArreglo["Apellidos"];
				$this->asNacioUser=$laArreglo["Nacionalidad"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asSexo=$laArreglo["Sexo"];
				$this->asDireccion=$laArreglo["Direccion"];
				$this->asTelefono=$laArreglo["Telefono"];
				$this->asFechaNaci=$laArreglo["FechaNacimiento"];
				$this->asFechaRegistroPer=$laArreglo["FechaRegistro"];
				$this->asGradoEstudio=$laArreglo["idFgradoEstudio"];
				$this->asTallaFranela=$laArreglo["idFtallaFranela"];
				$this->asEstatusPer=$laArreglo["Estatus"];

				if ($laArreglo["Rol"]=="" and $laArreglo["Cedula"]!="")
				{
					$lbEnc=1;
				}else{
					$lbEnc=2;
				}
				
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}
		
		public function fbBuscar2()
		{
			$lbEnc=false;
			$lsSql="SELECT tuser.idTusuario, tuser.idFpersonas, tuser.Usuario, tuser.Clave, tuser.Rol, Param.Prefijo, tuser.PreguntaSecreta, tuser.RespuestaSecreta, tuser.UltimoIngreso, tuser.FechaRegistro AS fechaRegUser, tuser.Estatus AS EstatusUser, tuserDatos.* FROM tusuarios AS tuser INNER JOIN tpersonas AS tuserDatos ON tuserDatos.idTpersonas = tuser.idFpersonas INNER JOIN rol AS Param ON tuser.Rol = Param.idTrol WHERE tuser.Usuario='$this->asCedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asIDTusuario=$laArreglo["idTusuario"];
				$this->asIDFpersonas=$laArreglo["idFpersonas"];
				$this->asUsuario=$laArreglo["Usuario"];
				$this->asUltimoIngreso=$laArreglo["UltimoIngreso"];
				$this->asFechaRegistro=$laArreglo["fechaRegUser"];
				$this->asEstatus=$laArreglo["EstatusUser"];

				/*DATOS DE TABLA PERSONAS:*/
				$this->asNombres=$laArreglo["Nombres"];
				$this->asApellidos=$laArreglo["Apellidos"];
				$this->asNacioUser=$laArreglo["Nacionalidad"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asSexo=$laArreglo["Sexo"];
				$this->asDireccion=$laArreglo["Direccion"];
				$this->asTelefono=$laArreglo["Telefono"];
				$this->asFechaNaci=$laArreglo["FechaNacimiento"];	
					
				if ($this->asClave==$laArreglo["Clave"])
				{
					$lbEnc=true;
					$this->asClave=$laArreglo["Clave"];
					$this->asRol=$laArreglo["Prefijo"];
				}
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			return $lbEnc;
		}
		
		public function fbIncluir()
		{
			if ($this->asNacioUser!="")
			{
				$this->asCedula=$this->asNacioUser."-".$this->asCedula;
			}
			$lbHecho=false;
			$RlsIDTpersonas=0;
				if ($this->asCedula!=""){
				$lbEnc=false;
				$lsSql="SELECT tuserDatos.idTpersonas  FROM tpersonas AS tuserDatos WHERE tuserDatos.Cedula='$this->asCedula' ";
				$this->fpConectar();
				$lrTb=$this->frFiltro($lsSql);
					if($laArreglo=$this->faProximo($lrTb))
					{
						$RlsIDTpersonas=$laArreglo["idTpersonas"];
						if ($RlsIDTpersonas>0)
						{
							$lbEnc=1;
						}
					}			
				$this->fpCierraFiltro($lrTb);
				$this->fpDesconectar();
				if ($lbEnc==1)
					{
					$lsSql="INSERT INTO tusuarios (idFpersonas,Usuario,UltimoIngreso, PreguntaSecreta, RespuestaSecreta, FechaRegistro,Estatus,Clave,Rol) VALUES ('$RlsIDTpersonas','$this->asUsuario','$this->asUltimoIngreso','$this->asPreguntaSecreta','$this->asRespuestaSecreta','$this->asFechaRegistro','$this->asEstatus','$this->asClave','$this->asRol')";
					$this->fpConectar();
					$lbHecho=$this->fbEjecutar($lsSql);
					$this->fpDesconectar();
					}
				}

			return $lbHecho;
		}
		

		public function fbRecuperarClave()
		{
				$lbHecho=false;
				$lsSql="UPDATE tusuarios SET Clave='$this->asClave' WHERE Usuario='$this->asUsuario'";
				$this->fpConectar();
				$lbHecho=$this->fbEjecutar($lsSql);
				$this->fpDesconectar();
			
	

			return $lbHecho;
		}


		public function fbModificar()
		{
			$lbHecho=false;
			if ($this->asNacioUser!="")
			{
				$this->asCedula=$this->asNacioUser."-".$this->asCedula;
			}
			$lsSql="INSERT INTO tusuarios (idFpersonas,Usuario,UltimoIngreso, PreguntaSecreta, RespuestaSecreta, FechaRegistro,Estatus,Clave,Rol) VALUES ((SELECT idTpersonas FROM tpersonas WHERE Cedula = '$this->asCedula'),'$this->asUsuario','$this->asUltimoIngreso','$this->asPreguntaSecreta','$this->asRespuestaSecreta','$this->asFechaRegistro','$this->asEstatus','$this->asClave','$this->asRol') ON DUPLICATE KEY UPDATE PreguntaSecreta='$this->asPreguntaSecreta', RespuestaSecreta='$this->asRespuestaSecreta',
					FechaRegistro='$this->asFechaRegistro', Estatus='$this->asEstatus',Clave='$this->asClave',Rol='$this->asRol'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}

		public function fbActivar($psVar)
		{
			
			$lbHecho=false;
			$lsSql="UPDATE tusuarios SET Estatus='$psVar' WHERE idTusuario='$this->asIDTusuario'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function fbEliminarUsuario()
		{
			$lbHecho=false;
			$lsSql="DELETE FROM tusuarios WHERE idTusuario='$this->asIDTusuario'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		public function fbEstatusUsuario($param)
		{
			$lbHecho=false;
			$lsSql="UPDATE tusuarios SET Estatus='$param' WHERE idTusuario='$this->asIDTusuario'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}

		
		public function faListar()
		{
			$lsSql="SELECT Datos.Cedula, Datos.Nombres, Datos.Apellidos, Datos.Sexo, Param.Descripcion AS RolDesc, User.idTusuario, User.idFpersonas,User.Usuario,User.UltimoIngreso,User.FechaRegistro,User.Estatus AS EstatusUser, User.Rol AS RolID FROM tusuarios AS User INNER JOIN tpersonas AS Datos ON User.idFpersonas = Datos.idTpersonas INNER JOIN rol AS Param ON User.Rol = Param.idTrol";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["IDTusuario"]=$laArreglo["idTusuario"];
				$laMatriz[$liI]["IDFpersonas"]=$laArreglo["idFpersonas"];

				$laMatriz[$liI]["Cedula"]=$laArreglo["Cedula"];
				$laMatriz[$liI]["Nombres"]=$laArreglo["Nombres"];
				$laMatriz[$liI]["Apellidos"]=$laArreglo["Apellidos"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];

				$laMatriz[$liI]["Usuario"]=$laArreglo["Usuario"];
				$laMatriz[$liI]["UltimoIngreso"]=$laArreglo["UltimoIngreso"];
				$laMatriz[$liI]["FechaRegistro"]=$laArreglo["FechaRegistro"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$laMatriz[$liI]["RolID"]=$laArreglo["RolID"];
				$laMatriz[$liI]["RolDesc"]=$laArreglo["RolDesc"];


				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
