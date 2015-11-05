<?php

    require_once("clsDatos.php");
	class claPersonas extends clsDatos
	{
		private $asIDpersona;
		private $asNacionalidad;
		private $asCedula;
		private $asNombre;
		private $asApellido;
		private $asSexo;
		private $asFechaNaci;
		private $asDireccion;
		private $asIDFestado;
		private $asIDFciudad;
		private $asIDFmunicipio;
		private $asIDFparroquia;
		private $asEstadoN;
		private $asCiudadN;
		private $asMunicipioN;
		private $asParroquiaN;
		private $asTelefono;
		private $asCorreo;
		private $asIDIglesia;
		private $asNombreIglesia;
		private $asIDFpadre;
		private $asCedulaPadre;
		private $asNombrePadre;
		private $asIDFmadre;
		private $asCedulaMadre;
		private $asNombreMadre;
		private $asFechaRegistro;
		private $asGradoEstudio;
		private $asTallaFranela;
		private $asEstatus;
		//ADICIONAL DE USUARIOS
		private $asIDTusuario;
		private $asUsuario;
		private $asClave;
		private $asRol;
		private $asPreguntaSecreta;
		private $asRespuestaSecreta;	
		
		public function __construct()
		{
			$this->asIDpersona="";
			$this->asNacionalidad="";
			$this->asCedula="";
			$this->asNombre="";
			$this->asApellido="";
			$this->asSexo="";
			$this->asFechaNaci="";
			$this->asDireccion="";
			$this->asIDFestado="";
			$this->asIDFciudad="";
			$this->asIDFmunicipio="";
			$this->asIDFparroquia="";
			$this->asEstadoN="";
			$this->asCiudadN="";
			$this->asMunicipioN="";
			$this->asParroquiaN="";			
			$this->asTelefono="";
			$this->asCorreo="";
			$this->asIDIglesia="";
			$this->asNombreIglesia="";
			$this->asIDFpadre="";
			$this->asCedulaPadre="";
			$this->asNombrePadre="";
			$this->asIDFmadre="";
			$this->asCedulaMadre="";
			$this->asNombreMadre="";
			$this->asFechaRegistro="";
			$this->asGradoEstudio="";
			$this->asTallaFranela="";
			$this->asEstatus="";
			$this->asIDTusuario="";
			$this->asUsuario="";
			$this->asClave="";
			$this->asRol="";
			$this->asPreguntaSecreta="";
			$this->asRespuestaSecreta="";

		}
		
		public function __destruct()
		{
		}

		//metodo magico set
		public function __set($atributo, $valor){ $this->$atributo = strtoupper($valor);}		
		//metodo get
		public function __get($atributo){ return trim(strtoupper($this->$atributo)); }

		public function fpSetClave($psClave)
		{
			$this->asClave=$psClave;
		}

		public function fbRegistroActivo()
		{
			$this->asCedula=$this->asNacionalidad."-".$this->asCedula;
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

		public function fbBuscarPorCedula()
		{
			$compar=substr($this->asCedula,0,1);
			if (($compar!='E')&&($compar!='V')&&($compar!='P'))
			{
				$this->asCedula=$this->asNacionalidad."-".$this->asCedula;	
			}

		
			$lbEnc=false;
			$lsSql="SELECT 
			hijo.*, edo.descripcion AS EstadoName, 
			city.descripcion AS CiudadName, 
			muni.descripcion AS MunicipioName, 
			parro.descripcion AS ParroquiaName, 
			tpIglesia.codigoParroquiaIglesia AS IDIglesia, 
			tpIglesia.nombre AS NombreIglesia, 
			padre.Cedula AS CeduPadre, 
			CONCAT(padre.Nombres , ' ', padre.Apellidos) AS NombPadre, 
			madre.Cedula AS CeduMadre, 
			CONCAT(madre.Nombres , ' ', madre.Apellidos) AS NombMadre 
			FROM tpersonas AS hijo 
			LEFT JOIN tpersonas AS padre ON hijo.idFpadre=padre.idTpersonas 
			LEFT JOIN tpersonas AS madre ON hijo.idFmadre=madre.idTpersonas 
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
				$this->asIDpersona=$laArreglo["idTpersonas"];
				$this->asNacionalidad=$laArreglo["Nacionalidad"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asNombre=$laArreglo["Nombres"];
				$this->asApellido=$laArreglo["Apellidos"];
				$this->asSexo=$laArreglo["Sexo"];
				$this->asDireccion=$laArreglo["Direccion"];
				$this->asIDFestado=$laArreglo["idFestado"];
				$this->asIDFciudad=$laArreglo["idFciudad"];
				$this->asIDFmunicipio=$laArreglo["idFmunicipio"];
				$this->asIDFparroquia=$laArreglo["idFparroquia"];
				$this->asEstadoN=$laArreglo["EstadoName"];
				$this->asCiudadN=$laArreglo["CiudadName"];
				$this->asMunicipioN=$laArreglo["MunicipioName"];
				$this->asParroquiaN=$laArreglo["ParroquiaName"];
				$this->asIDFpadre=$laArreglo["idFpadre"];	
				$this->asCedulaPadre=$laArreglo["CeduPadre"];
				$this->asNombrePadre=$laArreglo["NombPadre"];
				$this->asIDFmadre=$laArreglo["idFmadre"];
				$this->asCedulaMadre=$laArreglo["CeduMadre"];
				$this->asNombreMadre=$laArreglo["NombMadre"];
				$this->asTelefono=$laArreglo["Telefono"];
				$this->asCorreo=$laArreglo["Correo"];
				$this->asIDIglesia=$laArreglo["IDIglesia"];
				$this->asNombreIglesia=$laArreglo["NombreIglesia"];
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

		public function fbBuscar()
		{
			if ($this->asNacionalidad!="")
			{
				$this->asCedula=$this->asNacionalidad."-".$this->asCedula;	
			}


			$lbEnc=false;
			$lsSql="SELECT 
			hijo.*, edo.descripcion AS EstadoName, 
			city.descripcion AS CiudadName, 
			muni.descripcion AS MunicipioName, 
			parro.descripcion AS ParroquiaName, 
			tpIglesia.codigoParroquiaIglesia AS IDIglesia, 
			tpIglesia.nombre AS NombreIglesia, 
			padre.Cedula AS CeduPadre, 
			CONCAT(padre.Nombres , ' ', padre.Apellidos) AS NombPadre, 
			madre.Cedula AS CeduMadre, 
			CONCAT(madre.Nombres , ' ', madre.Apellidos) AS NombMadre 
			FROM tpersonas AS hijo 
			LEFT JOIN tpersonas AS padre ON hijo.idFpadre=padre.idTpersonas 
			LEFT JOIN tpersonas AS madre ON hijo.idFmadre=madre.idTpersonas 
			LEFT JOIN estado AS edo ON hijo.idFestado = edo.cod_estado 
			LEFT JOIN ciudad AS city ON hijo.idFestado = city.cod_ciudad 
			LEFT JOIN municipio AS muni ON hijo.idFmunicipio = muni.cod_municipio 
			LEFT JOIN parroquia AS parro ON hijo.idFparroquia = parro.cod_parroquia 
			LEFT JOIN tparroquiaiglesia AS tpIglesia ON hijo.idFparroquiaCodigo = tpIglesia.codigoParroquiaIglesia 
			WHERE hijo.idTpersonas='$this->asIDpersona'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asIDpersona=$laArreglo["idTpersonas"];
				$this->asNacionalidad=$laArreglo["Nacionalidad"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asNombre=$laArreglo["Nombres"];
				$this->asApellido=$laArreglo["Apellidos"];
				$this->asSexo=$laArreglo["Sexo"];
				$this->asDireccion=$laArreglo["Direccion"];
				$this->asIDFestado=$laArreglo["idFestado"];
				$this->asIDFciudad=$laArreglo["idFciudad"];
				$this->asIDFmunicipio=$laArreglo["idFmunicipio"];
				$this->asIDFparroquia=$laArreglo["idFparroquia"];
				$this->asEstadoN=$laArreglo["EstadoName"];
				$this->asCiudadN=$laArreglo["CiudadName"];
				$this->asMunicipioN=$laArreglo["MunicipioName"];
				$this->asParroquiaN=$laArreglo["ParroquiaName"];
				$this->asIDFpadre=$laArreglo["idFpadre"];	
				$this->asCedulaPadre=$laArreglo["CeduPadre"];
				$this->asNombrePadre=$laArreglo["NombPadre"];
				$this->asIDFmadre=$laArreglo["idFmadre"];
				$this->asCedulaMadre=$laArreglo["CeduMadre"];
				$this->asNombreMadre=$laArreglo["NombMadre"];
				$this->asTelefono=$laArreglo["Telefono"];
				$this->asCorreo=$laArreglo["Correo"];
				$this->asIDIglesia=$laArreglo["IDIglesia"];
				$this->asNombreIglesia=$laArreglo["NombreIglesia"];
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

		public function buscarLike($tipo = "cc",$cadena = ""){
			switch($tipo){
				case "cc":
					$lsSql=("SELECT 
						hijo.*, 
						tsacer.idFpersona,
						tobis.idFpersona AS IDObispoPersona,
						generoDescrip(hijo.Sexo) AS SexoDescrip, 
						parroI.nombre AS NombreParroquia, padre.Cedula AS CeduPadre, 
						CONCAT(padre.Nombres ,  ' ',  padre.Apellidos) AS NombPadre, 
						madre.Cedula AS CeduMadre, CONCAT(madre.Nombres ,  ' ',  madre.Apellidos) AS NombMadre 
						FROM tpersonas AS hijo 
						LEFT JOIN tpersonas AS padre ON hijo.idFpadre=padre.idTpersonas 
						LEFT JOIN tpersonas AS madre ON hijo.idFmadre=madre.idTpersonas 
						LEFT JOIN tparroquiaiglesia AS parroI ON hijo.idFparroquiaCodigo=parroI.codigoParroquiaIglesia
						LEFT JOIN tsacerdote AS tsacer ON tsacer.idFpersona=hijo.idTpersonas
						LEFT JOIN tobispo AS tobis ON tobis.idFpersona=hijo.idTpersonas
						WHERE hijo.Cedula = '$this->cedula'");
				break;
				case "proximo":
					$lsSql=("SELECT 
						hijo.*, 
						tsacer.idFpersona AS IDSacerdotePersona,
						tobis.idFpersona AS IDObispoPersona,
						generoDescrip(hijo.Sexo) AS SexoDescrip, 
						parroI.nombre AS NombreParroquia, padre.Cedula AS CeduPadre, 
						CONCAT(padre.Nombres ,  ' ',  padre.Apellidos) AS NombPadre, 
						madre.Cedula AS CeduMadre, CONCAT(madre.Nombres ,  ' ',  madre.Apellidos) AS NombMadre 
						FROM tpersonas AS hijo 
						LEFT JOIN tpersonas AS padre ON hijo.idFpadre=padre.idTpersonas 
						LEFT JOIN tpersonas AS madre ON hijo.idFmadre=madre.idTpersonas 
						LEFT JOIN tparroquiaiglesia AS parroI ON hijo.idFparroquiaCodigo=parroI.codigoParroquiaIglesia
						LEFT JOIN tsacerdote AS tsacer ON tsacer.idFpersona=hijo.idTpersonas
						LEFT JOIN tobispo AS tobis ON tobis.idFpersona=hijo.idTpersonas
						WHERE ( (hijo.Cedula like '%$cadena%') or (hijo.Nombres like '%$cadena%') or (hijo.Apellidos like '%$cadena%') ) ORDER BY hijo.idFparroquiaCodigo,hijo.sexo");
				break;
			}

			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
	
			while($laArreglo=$this->faProximo($lrTb))
			{
				//solución chapusera ->
				if (($laArreglo["IDSacerdotePersona"]!=$laArreglo["idTpersonas"]) and ($laArreglo["IDObispoPersona"]!=$laArreglo["idTpersonas"]))
				{
					$arr[] = $laArreglo;					
				}
			
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			return $arr;
		}
		
		
		
		public function fbBuscarNombre()
		{
			$this->asCedula=$this->asNacionalidad."-".$this->asCedula;
			$lbEnc=false;
			$lsSql="SELECT idTpersonas,Cedula,Nombres,Apellidos,Estatus FROM tpersonas WHERE Cedula='$this->asCedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asIDpersona=$laArreglo["idTpersonas"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asNombre=$laArreglo["Nombres"];
				$this->asApellido=$laArreglo["Apellidos"];
				$this->asEstatus=$laArreglo["Estatus"];

				$lbEnc=true;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}

		public function DameIDpersonaDesdeCI($cedula,$modo)
		{
			$respu=array();
			$retorno="";
			$lsSql="SELECT idTpersonas, Cedula AS CedulaFull, CONCAT(Nombres ,  ' ',  Apellidos) AS NombreFull, Sexo FROM tpersonas WHERE Cedula='$cedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$respu["idTpersonas"]=$laArreglo["idTpersonas"];
				$respu["CedulaFull"]=$laArreglo["CedulaFull"];
				$respu["NombreFull"]=$laArreglo["NombreFull"];
				$respu["Sexo"]=$laArreglo["Sexo"];
				$respu["liHay"]="1";
			}
			else
			{
				$respu["liHay"]="0";
			}

			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			if ($modo)
			{
				$retorno=$respu;
			}
			else
			{
				$retorno=$respu["idTpersonas"];
			}

			return $retorno;
		}
		
		
		public function fbIncluir()
		{
			$this->asCedula=$this->asNacionalidad."-".$this->asCedula;
			$lbHecho=false;
			if ($this->asIDFmadre=="")
			{
				$qryfieldM="null";
			}
			else
			{
				$qryfieldM=$this->asIDFmadre;
			}

			if ($this->asIDFpadre=="")
			{
				$qryfieldP="null";
			}
			else
			{
				$qryfieldP=$this->asIDFpadre;
			}
			
			if (($this->asIDFestado=="")||($this->asIDFestado=="0"))
			{
				$setEstado="null";
			}
			else
			{
				$setEstado="'".$this->asIDFestado."'";
			}
			
			if (($this->asIDFciudad=="")||($this->asIDFciudad=="0"))
			{
				$setCiudad="null";
			}
			else
			{
				$setCiudad="'".$this->asIDFciudad."'";
			}
			
			if (($this->asIDFmunicipio=="")||($this->asIDFmunicipio=="0"))
			{
				$setMunicipio="null";
			}
			else
			{
				$setMunicipio="'".$this->asIDFmunicipio."'";
			}

			if (($this->asIDFparroquia=="")||($this->asIDFparroquia=="0"))
			{
				$setParroquia="null";
			}
			else
			{
				$setParroquia="'".$this->asIDFparroquia."'";
			}

			if (($this->asIDIglesia=="")||($this->asIDIglesia=="0"))
			{
				$setIglesia="null";
			}
			else
			{
				$setIglesia="'".$this->asIDIglesia."'";
			}

			 $lsSql="INSERT INTO tpersonas 
					(Nacionalidad,Cedula,Nombres,Apellidos,Sexo,Direccion,idFestado,idFciudad,idFmunicipio,idFparroquia,Telefono,idFmadre,idFpadre,FechaNacimiento,idFgradoEstudio,idFtallaFranela,idFparroquiaCodigo) VALUES 
					('$this->asNacionalidad','$this->asCedula','$this->asNombre','$this->asApellido','$this->asSexo','$this->asDireccion',".$setEstado.",".$setCiudad.",".$setMunicipio.",".$setParroquia.",'$this->asTelefono',".$qryfieldM.",".$qryfieldP.",'$this->asFechaNaci','$this->asGradoEstudio','$this->asTallaFranela',".$setIglesia.")";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function fbIncluirPublico()
		{
			$this->asCedula=$this->asNacionalidad."-".$this->asCedula;
			$lbHecho=false;
			$lbHecho2=false;
			$lbRetorno=false;
			if ($this->asIDFmadre=="")
			{
				$qryfieldM="null";
			}
			else
			{
				$qryfieldM=$this->asIDFmadre;
			}

			if ($this->asIDFpadre=="")
			{
				$qryfieldP="null";
			}
			else
			{
				$qryfieldP=$this->asIDFpadre;
			}
			
			if (($this->asIDFestado=="")||($this->asIDFestado=="0"))
			{
				$setEstado="null";
			}
			else
			{
				$setEstado="'".$this->asIDFestado."'";
			}
			
			if (($this->asIDFciudad=="")||($this->asIDFciudad=="0"))
			{
				$setCiudad="null";
			}
			else
			{
				$setCiudad="'".$this->asIDFciudad."'";
			}
			
			if (($this->asIDFmunicipio=="")||($this->asIDFmunicipio=="0"))
			{
				$setMunicipio="null";
			}
			else
			{
				$setMunicipio="'".$this->asIDFmunicipio."'";
			}

			if (($this->asIDFparroquia=="")||($this->asIDFparroquia=="0"))
			{
				$setParroquia="null";
			}
			else
			{
				$setParroquia="'".$this->asIDFparroquia."'";
			}

			if (($this->asIDIglesia=="")||($this->asIDIglesia=="0"))
			{
				$setIglesia="null";
			}
			else
			{
				$setIglesia="'".$this->asIDIglesia."'";
			}
			$this->fpConectar();
			parent::fpBegin();
			$lsSql="INSERT INTO tpersonas 
					(Nacionalidad,Cedula,Nombres,Apellidos,Sexo,Direccion,idFestado,idFciudad,idFmunicipio,idFparroquia,Telefono,idFmadre,idFpadre,FechaNacimiento,idFgradoEstudio,idFtallaFranela,idFparroquiaCodigo) VALUES 
					('$this->asNacionalidad','$this->asCedula','$this->asNombre','$this->asApellido','$this->asSexo','$this->asDireccion',".$setEstado.",".$setCiudad.",".$setMunicipio.",".$setParroquia.",'$this->asTelefono',".$qryfieldM.",".$qryfieldP.",'$this->asFechaNaci','$this->asGradoEstudio','$this->asTallaFranela',".$setIglesia.")";
			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			$IDTpersona=$this->fpGetIDinsertado();
			$lsSql="INSERT INTO tusuarios (
				idFpersonas, 
				Usuario, 
				PreguntaSecreta, 
				RespuestaSecreta, 
				Estatus, 
				Clave, 
				Rol
				) VALUES (
				'$IDTpersona', 
				'$this->asUsuario', 
				'$this->asPreguntaSecreta', 
				'$this->asRespuestaSecreta', 
				'1', 
				'$this->asClave', 
				'4')";


			$lbHecho2=$this->fbEjecutarNoDie($lsSql);

			
			if(($lbHecho)&&($lbHecho2)) 
			{
				parent::fpCommit();
				$lbRetorno=true;				
			}
			else
			{
				parent::fpRollback();
			}
			
			$this->fpDesconectar();
			return $lbRetorno;
		}
		
		public function fbModificar()
		{
			$this->asCedula=$this->asNacionalidad."-".$this->asCedula;
			$lbHecho=false;
			if ($this->asIDFmadre=="")
			{
				$qryfieldM="null";
			}
			else
			{
				$qryfieldM=$this->asIDFmadre;
			}

			if ($this->asIDFpadre=="")
			{
				$qryfieldP="null";
			}
			else
			{
				$qryfieldP=$this->asIDFpadre;
			}

			if (($this->asIDFestado=="")||($this->asIDFestado=="0"))
			{
				$setEstado="null";
			}
			else
			{
				$setEstado="'".$this->asIDFestado."'";
			}
			
			if (($this->asIDFciudad=="")||($this->asIDFciudad=="0"))
			{
				$setCiudad="null";
			}
			else
			{
				$setCiudad="'".$this->asIDFciudad."'";
			}
			
			if (($this->asIDFmunicipio=="")||($this->asIDFmunicipio=="0"))
			{
				$setMunicipio="null";
			}
			else
			{
				$setMunicipio="'".$this->asIDFmunicipio."'";
			}

			if (($this->asIDFparroquia=="")||($this->asIDFparroquia=="0"))
			{
				$setParroquia="null";
			}
			else
			{
				$setParroquia="'".$this->asIDFparroquia."'";
			}

			if (($this->asIDIglesia=="")||($this->asIDIglesia=="0"))
			{
				$setIglesia="null";
			}
			else
			{
				$setIglesia="'".$this->asIDIglesia."'";
			}



			$lsSql="UPDATE tpersonas 
			SET Nombres='$this->asNombre', 
			Apellidos='$this->asApellido', 
			Sexo='$this->asSexo', 
			Direccion='$this->asDireccion', 
			idFestado=".$setEstado.", 
			idFciudad=".$setCiudad.", 
			idFmunicipio=".$setMunicipio.", 
			idFparroquia=".$setParroquia.", 
			Telefono='$this->asTelefono', 
			idFmadre=".$qryfieldM.", 
			idFpadre=".$qryfieldP.", 
			FechaNacimiento='$this->asFechaNaci', 
			idFgradoEstudio='$this->asGradoEstudio', 
			idFtallaFranela='$this->asTallaFranela', 
			idFparroquiaCodigo=".$setIglesia."
			WHERE idTpersonas='$this->asIDpersona'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			$this->fpDesconectar();
			return $lbHecho;

		}

		public function fbActivar()
		{
			
			$psVar=1;
			if($this->fbRegistroActivo()){
				$psVar=0;
			}
			$lbHecho=false;
			$lsSql="UPDATE tpersonas SET Estatus='$psVar' WHERE Cedula='$this->asCedula'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function faListar()
		{
			$lsSql="select * from tpersonas";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
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
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
