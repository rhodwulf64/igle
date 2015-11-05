<?php

    require_once("clsDatos.php");
	class claSacerdote extends clsDatos
	{
		private $asIDSacerdo;
		private $asIDpersona;
		private $asNacionalidad;
		private $asCedula;
		private $asNombre;
		private $asApellido;
		private $asSexo;
		private $asFechaNaci;
		private $asIDFiglesia;
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
		private $asIDFpadre;
		private $asCedulaPadre;
		private $asNombrePadre;
		private $asIDFmadre;
		private $asCedulaMadre;
		private $asNombreMadre;
		private $asFechaRegistro;
		private $asGradoEstudio;
		private $asTallaFranela;
		private $asProxCeduEscolar;
		private $asIDIglesia;
		private $asNombreIglesia;
		private $asFechaInicioParroquia;
		private $asFechaFinParroquia;
		private $asObservacion;
		private $asEstatus;
		
		public function __construct()
		{
			$this->asIDSacerdo="";
			$this->asIDpersona="";
			$this->asNacionalidad="";
			$this->asCedula="";
			$this->asNombre="";
			$this->asApellido="";
			$this->asSexo="";
			$this->asFechaNaci="";
			$this->asIDFiglesia="";
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
			$this->asIDFpadre="";
			$this->asCedulaPadre="";
			$this->asNombrePadre="";
			$this->asIDFmadre="";
			$this->asCedulaMadre="";
			$this->asNombreMadre="";
			$this->asFechaRegistro="";
			$this->asGradoEstudio="";
			$this->asTallaFranela="";
			$this->asProxCeduEscolar="";
			$this->asIDIglesia="";
			$this->asNombreIglesia="";
			$this->asFechaInicioParroquia="";
			$this->asFechaFinParroquia="";
			$this->asObservacion="";
			$this->asEstatus="";

		}
		
		public function __destruct()
		{
		}

		//metodo magico set
		public function __set($atributo, $valor){ $this->$atributo = strtoupper($valor);}		
		//metodo get
		public function __get($atributo){ return trim(strtoupper($this->$atributo)); }


		public function fbRegistroActivo()
		{
			$lbEnc=false;
			$lsSql="SELECT Estatus FROM tsacerdote WHERE idFpersona=(SELECT idTpersonas FROM tpersonas WHERE Cedula='$this->asCedula')";
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
			$this->asCedula=$this->asNacionalidad."-".$this->asCedula;
			$lbEnc=false;
			$lsSql="SELECT 
			hijo.*, 
			edo.descripcion AS EstadoName, 
			city.descripcion AS CiudadName, 
			muni.descripcion AS MunicipioName, 
			parro.descripcion AS ParroquiaName, 
			CONCAT(padre.Nacionalidad ,  '-',  padre.Cedula) AS CeduPadre, 
			CONCAT(padre.Nombres ,  ' ',  padre.Apellidos) AS NombPadre, 
			CONCAT(madre.Nacionalidad ,  '-',  madre.Cedula) AS CeduMadre, 
			CONCAT(madre.Nombres ,  ' ',  madre.Apellidos) AS NombMadre, 
			sacer.idTsacerdote,
			sacer.idFiglesia AS Iglesia, 
			sacer.idFpersona,
			sacer.FechaRegistro,
			sacer.FechaInicioParroquia,
			sacer.FechaFinParroquia,
			sacer.Observacion,
			sacer.Estatus AS EstatusSac 
			FROM tsacerdote AS sacer 
			INNER JOIN tpersonas AS hijo ON hijo.idTpersonas = sacer.idFpersona 
			LEFT JOIN tpersonas AS padre ON hijo.idFpadre=padre.idTpersonas 
			LEFT JOIN tpersonas AS madre ON hijo.idFmadre=madre.idTpersonas 
			LEFT JOIN estado AS edo ON hijo.idFestado = edo.cod_estado 
			LEFT JOIN ciudad AS city ON hijo.idFestado = city.cod_ciudad 
			LEFT JOIN municipio AS muni ON hijo.idFmunicipio = muni.cod_municipio 
			LEFT JOIN parroquia AS parro ON hijo.idFparroquia = parro.cod_parroquia 
			WHERE hijo.Cedula='$this->asCedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asIDSacerdo=$laArreglo["idTsacerdote"];
				$this->asIDpersona=$laArreglo["idTpersonas"];
				$this->asNacionalidad=$laArreglo["Nacionalidad"];
				$this->asCedula=$laArreglo["Cedula"];
				$this->asNombre=$laArreglo["Nombres"];
				$this->asApellido=$laArreglo["Apellidos"];
				$this->asSexo=$laArreglo["Sexo"];
				$this->asIDFiglesia=$laArreglo["Iglesia"];
				$this->asDireccion=$laArreglo["Direccion"];
				$this->asObservacion=$laArreglo["Observacion"];
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
				$this->asFechaNaci=$laArreglo["FechaNacimiento"];
				$this->asFechaRegistro=$laArreglo["FechaRegistro"];
				$this->asGradoEstudio=$laArreglo["idFgradoEstudio"];
				$this->asTallaFranela=$laArreglo["idFtallaFranela"];
				$this->asFechaInicioParroquia=$laArreglo["FechaInicioParroquia"];
				$this->asFechaFinParroquia=$laArreglo["FechaFinParroquia"];
				$this->asEstatus=$laArreglo["EstatusSac"];
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
						sacer.*, 
						hijo.*, 
						generoDescrip(hijo.Sexo) AS SexoDescrip, 
						parroI.nombre AS NombreParroquia, 
						padre.Cedula AS CeduPadre, 
						CONCAT(padre.Nombres ,  ' ',  padre.Apellidos) AS NombPadre, 
						madre.Cedula AS CeduMadre, CONCAT(madre.Nombres ,  ' ',  madre.Apellidos) AS NombMadre 
						FROM tsacerdote AS sacer 
						INNER JOIN tpersonas AS hijo ON sacer.idFpersona=hijo.idTpersonas 
						LEFT JOIN tpersonas AS padre ON hijo.idFpadre=padre.idTpersonas 
						LEFT JOIN tpersonas AS madre ON hijo.idFmadre=madre.idTpersonas 
						LEFT JOIN tparroquiaiglesia AS parroI ON sacer.idFiglesia=parroI.codigoParroquiaIglesia
						WHERE hijo.Cedula = '$this->cedula'");
				break;
				case "proximo":
					$lsSql=("SELECT 
						sacer.*, 
						hijo.*, 
						generoDescrip(hijo.Sexo) AS SexoDescrip, 
						parroI.nombre AS NombreParroquia, 
						padre.Cedula AS CeduPadre, 
						CONCAT(padre.Nombres ,  ' ',  padre.Apellidos) AS NombPadre, 
						madre.Cedula AS CeduMadre, CONCAT(madre.Nombres ,  ' ',  madre.Apellidos) AS NombMadre 
						FROM tsacerdote AS sacer 
						INNER JOIN tpersonas AS hijo ON sacer.idFpersona=hijo.idTpersonas 
						LEFT JOIN tpersonas AS padre ON hijo.idFpadre=padre.idTpersonas 
						LEFT JOIN tpersonas AS madre ON hijo.idFmadre=madre.idTpersonas 
						LEFT JOIN tparroquiaiglesia AS parroI ON sacer.idFiglesia=parroI.codigoParroquiaIglesia
					WHERE ( (hijo.Cedula like '%$cadena%') or (hijo.Nombres like '%$cadena%') or (hijo.Apellidos like '%$cadena%') ) ORDER BY sacer.idFiglesia,sacer.FechaInicioParroquia");
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
		
		
		
		public function fbBuscarNombre()
		{
			$this->asCedula=$this->asNacionalidad."-".$this->asCedula;
			$lbEnc=false;
			$lsSql="SELECT idTpersonas,Cedula,Nombres,Apellidos,ProxCeduEscolar,Estatus, sacer.idFiglesia AS Iglesia FROM tpersonas INNER JOIN tsacerdote AS sacer ON hijo.idTpersonas = sacer.idFpersona WHERE Cedula='$this->asCedula'";
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
				$this->asIDFiglesia=$laArreglo["Iglesia"];

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
			$lsSql="SELECT idTpersonas, CONCAT(Nacionalidad,'-',Cedula) AS CedulaFull, CONCAT(Nombres ,  ' ',  Apellidos) AS NombreFull FROM tpersonas WHERE Cedula='$cedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$respu["idTpersonas"]=$laArreglo["idTpersonas"];
				$respu["CedulaFull"]=$laArreglo["CedulaFull"];
				$respu["NombreFull"]=$laArreglo["NombreFull"];
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
			$lbHecho=false;
			$retorna=false;

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
			$lsSql="INSERT INTO tpersonas 
					(Nacionalidad,Cedula,Nombres,Apellidos,Sexo,Direccion,idFestado,idFciudad,idFmunicipio,idFparroquia,Telefono,idFmadre,idFpadre,FechaNacimiento,idFgradoEstudio,idFtallaFranela) VALUES 
					('$this->asNacionalidad','$this->asCedula','$this->asNombre','$this->asApellido','M','$this->asDireccion',".$setEstado.",".$setCiudad.",".$setMunicipio.",".$setParroquia.",'$this->asTelefono',".$qryfieldM.",".$qryfieldP.",'$this->asFechaNaci','$this->asGradoEstudio','$this->asTallaFranela')";
			$this->fpConectar();
			parent::fpBegin();
			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			$IDTpersonaNew=$this->fpGetIDinsertado();
			if ($lbHecho)
			{
				$lsSql="INSERT INTO tsacerdote 
					(idFiglesia,idFpersona,FechaInicioParroquia,FechaFinParroquia,Observacion,Estatus) VALUES 
					('$this->asidFiglesia',$IDTpersonaNew,'$this->asFechaInicioParroquia','$this->asFechaFinParroquia','$this->asObservacion','1')";
				$lbHecho=$this->fbEjecutarNoDie($lsSql);
				if ($lbHecho)
				{
					$retorna=true;
				}
			}
			if ($retorna)
			{
				parent::fpCommit();
			}
			else
			{
				parent::fpRollback();
			}

			$this->fpDesconectar();
			return $retorna;
		}
		
		public function fbModificar()
		{
			$lbHecho=false;
			$retorna=false;

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

			$lsSql="UPDATE tpersonas SET Nacionalidad='$this->asNacionalidad', Nombres='$this->asNombre',Apellidos='$this->asApellido',Direccion='$this->asDireccion', idFestado=".$setEstado.", idFciudad=".$setCiudad.", idFmunicipio=".$setMunicipio.", idFparroquia=".$setParroquia.", Telefono='$this->asTelefono', idFmadre=".$qryfieldM.", idFpadre=".$qryfieldP.", FechaNacimiento='$this->asFechaNaci',idFgradoEstudio='$this->asGradoEstudio',idFtallaFranela='$this->asTallaFranela' WHERE idTpersonas='$this->asIDpersona'";
			$this->fpConectar();

			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			if ($lbHecho)
			{
				$retorna=true;
			}
			$lsSql="UPDATE tsacerdote SET idFiglesia='$this->asidFiglesia', FechaInicioParroquia='$this->asFechaInicioParroquia', FechaFinParroquia='$this->asFechaFinParroquia', Observacion='$this->asObservacion' WHERE  idTsacerdote='$this->asIDSacerdo'";
			
			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			if ($lbHecho)
			{
				$retorna=true;
			}
			$this->fpDesconectar();
			return $retorna;
		}

		public function fbActivar()
		{
			$this->asCedula=$this->asNacionalidad."-".$this->asCedula;
			$psVar=1;
			if($this->fbRegistroActivo()){
				$psVar=0;
			}
			$lbHecho=false;
			$lsSql="UPDATE tsacerdote SET Estatus='$psVar' WHERE idTsacerdote='$this->asIDSacerdo'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function faListar()
		{
			$lsSql="SELECT tper.*, sacer.idFiglesia AS IDiglesia, sacer.Estatus AS EstatuSacer FROM tpersonas AS tper INNER JOIN tsacerdote AS sacer ON tpersonas.idTpersonas=tsacerdote.idFpersona";
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
				$laMatriz[$liI]["IDiglesia"]=$laArreglo["IDiglesia"];
				$laMatriz[$liI]["EstatuSacer"]=$laArreglo["EstatuSacer"];
				
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
