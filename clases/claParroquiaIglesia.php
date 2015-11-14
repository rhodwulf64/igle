<?php

    require_once("clsDatos.php");
	class claParroquiaIglesia extends clsDatos
	{
		private $asidParroquiaIglesia;
		private $asNombre;
		private $asMision;
		private $asVision;
		private $asDireccion;
		private $asTelefono;
		private $asCorreo;
		private $asidFestado;
		private $asidFciudad;
		private $asidFmunicipio;
		private $asidFparroquia;
		private $asFecha_creacion;
		private $asCodigo_archi;
		private $asNombreArchi;
		private $asEstatus;

		public function __construct()
		{
			$this->asidParroquiaIglesia="";
			$this->asNombre="";
			$this->asMision="";
			$this->asVision="";
			$this->asDireccion="";
			$this->asTelefono="";
			$this->asCorreo="";
			$this->asidFestado="";
			$this->asidFciudad="";
			$this->asidFmunicipio="";
			$this->asidFparroquia="";
			$this->asFecha_creacion="";
			$this->asCodigo_archi="";
			$this->asNombreArchi="";
			$this->asEstatus="";
		}
		
		public function __destruct()
		{
		}

		//metodo magico set
		public function __set($atributo, $valor){ $this->$atributo = strtoupper($valor);}		
		//metodo get
		public function __get($atributo){ return trim(strtoupper($this->$atributo)); }


		public function fbBuscar()
		{
			$lbEnc=false;
			$this->fpConectar();
			$lsSql="SELECT 
			A.codigoParroquiaIglesia,
			A.nombre,
			A.mision,
			A.vision,
			A.direccion,
			A.telefono,
			A.correo,
			A.idFestado,
			A.idFciudad,
			A.idFmunicipio,
			A.idFparroquia,
			A.fecha_creacion,
			A.codigo_archi,
			A.Estatus,
			B.nombre AS nombreArchi
			FROM tparroquiaiglesia AS A 
			RIGHT JOIN archiprestazgo AS B ON A.codigo_archi=B.codigoArchiPrestazgo
			WHERE A.codigoParroquiaIglesia='".$this->asidParroquiaIglesia."' 
			ORDER BY A.codigoParroquiaIglesia ASC";
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asidParroquiaIglesia=$laArreglo["codigoParroquiaIglesia"];
				$this->asNombre=$laArreglo["nombre"];
				$this->asMision=$laArreglo["mision"];
				$this->asVision=$laArreglo["vision"];
				$this->asDireccion=$laArreglo["direccion"];
				$this->asTelefono=$laArreglo["telefono"];
				$this->asCorreo=$laArreglo["correo"];
				$this->idFestado=$laArreglo["idFestado"];
				$this->idFciudad=$laArreglo["idFciudad"];
				$this->idFmunicipio=$laArreglo["idFmunicipio"];
				$this->idFparroquia=$laArreglo["idFparroquia"];
				$this->asFecha_creacion=$laArreglo["fecha_creacion"];
				$this->asCodigo_archi=$laArreglo["codigo_archi"];
				$this->asNombreArchi=$laArreglo["nombreArchi"];
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
			$this->fpConectar();
			$lsSql="SELECT 
			A.codigoParroquiaIglesia,
			A.nombre,
			A.mision,
			A.vision,
			A.direccion,
			A.telefono,
			A.correo,
			A.idFestado,
			A.idFciudad,
			A.idFmunicipio,
			A.idFparroquia,
			A.fecha_creacion,
			A.codigo_archi,
			A.Estatus,
			B.nombre AS nombreArchi
			FROM tparroquiaiglesia AS A 
			RIGHT JOIN archiprestazgo AS B ON A.codigo_archi=B.codigoArchiPrestazgo
			WHERE A.nombre='".$this->asNombre."' 
			ORDER BY A.codigoParroquiaIglesia ASC";
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asidParroquiaIglesia=$laArreglo["codigoParroquiaIglesia"];
				$this->asNombre=$laArreglo["nombre"];
				$this->asMision=$laArreglo["mision"];
				$this->asVision=$laArreglo["vision"];
				$this->asDireccion=$laArreglo["direccion"];
				$this->asTelefono=$laArreglo["telefono"];
				$this->asCorreo=$laArreglo["correo"];
				$this->idFestado=$laArreglo["idFestado"];
				$this->idFciudad=$laArreglo["idFciudad"];
				$this->idFmunicipio=$laArreglo["idFmunicipio"];
				$this->idFparroquia=$laArreglo["idFparroquia"];
				$this->asFecha_creacion=$laArreglo["fecha_creacion"];
				$this->asCodigo_archi=$laArreglo["codigo_archi"];
				$this->asNombreArchi=$laArreglo["nombreArchi"];
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
					A.codigoParroquiaIglesia,
					A.nombre,
					A.mision,
					A.vision,
					A.direccion,
					A.telefono,
					A.correo,
					A.idFestado,
					A.idFciudad,
					A.idFmunicipio,
					A.idFparroquia,
					A.fecha_creacion,
					A.codigo_archi,
					A.Estatus,
					B.nombre AS nombreArchi,
					C.descripcion AS CEstado,
					D.descripcion AS DCiudad,
					E.descripcion AS EMunicipio,
					F.descripcion AS FParroquia
					FROM tparroquiaiglesia AS A 
					RIGHT JOIN archiprestazgo AS B ON A.codigo_archi=B.codigoArchiPrestazgo
					LEFT JOIN estado AS C ON A.idFestado=C.cod_estado
					LEFT JOIN ciudad AS D ON A.idFciudad=D.cod_ciudad
					LEFT JOIN municipio AS E ON A.idFmunicipio=E.cod_municipio
					LEFT JOIN parroquia AS F ON A.idFparroquia=F.cod_parroquia
					WHERE A.nombre='".$this->asNombre."'
					ORDER BY A.codigoParroquiaIglesia ASC");
				break;
				case "proximo":
					$lsSql=("SELECT 
					A.codigoParroquiaIglesia,
					A.nombre,
					A.mision,
					A.vision,
					A.direccion,
					A.telefono,
					A.correo,
					A.idFestado,
					A.idFciudad,
					A.idFmunicipio,
					A.idFparroquia,
					A.fecha_creacion,
					A.codigo_archi,
					A.Estatus,
					B.nombre AS nombreArchi,
					C.descripcion AS CEstado,
					D.descripcion AS DCiudad,
					E.descripcion AS EMunicipio,
					F.descripcion AS FParroquia
					FROM tparroquiaiglesia AS A 
					RIGHT JOIN archiprestazgo AS B ON A.codigo_archi=B.codigoArchiPrestazgo
					LEFT JOIN estado AS C ON A.idFestado=C.cod_estado
					LEFT JOIN ciudad AS D ON A.idFciudad=D.cod_ciudad
					LEFT JOIN municipio AS E ON A.idFmunicipio=E.cod_municipio
					LEFT JOIN parroquia AS F ON A.idFparroquia=F.cod_parroquia
					WHERE ( (A.codigoParroquiaIglesia like '%$cadena%') or (A.nombre like '%$cadena%') or (A.mision like '%$cadena%') or (A.vision like '%$cadena%') or (A.telefono like '%$cadena%') or (A.correo like '%$cadena%') or (B.nombre like '%$cadena%') or (C.descripcion like '%$cadena%') or (D.descripcion like '%$cadena%') or (E.descripcion like '%$cadena%') or (F.descripcion like '%$cadena%') )
					ORDER BY A.codigoParroquiaIglesia ASC");
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
		
				
		public function fbIncluir()
		{
			$lbHecho=false;
			$this->fpConectar();
			$lsSql="INSERT INTO tparroquiaiglesia (
				nombre,
				mision,
				vision,
				direccion,
				telefono,
				correo,
				idFestado,
				idFciudad,
				idFmunicipio,
				idFparroquia,
				fecha_creacion,
				codigo_archi
				) VALUES (
				'$this->asNombre',
				'$this->asMision',
				'$this->asVision',
				'$this->asDireccion',
				'$this->asTelefono',
				'$this->asCorreo',
				'$this->asidFestado',
				'$this->asidFciudad',
				'$this->asidFmunicipio',
				'$this->asidFparroquia',
				'$this->asFecha_creacion',
				'$this->asCodigo_archi')";

				$lbHecho=$this->fbEjecutarNoDie($lsSql);

				$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function fbModificar()
		{
			$lbHecho=false;

			$this->fpConectar();
			$lsSql="UPDATE tparroquiaiglesia SET 
			nombre='$this->asNombre', 
			mision='$this->asMision', 
			vision='$this->asVision', 
			direccion='$this->asDireccion', 
			telefono='$this->asTelefono', 
			correo='$this->asCorreo', 
			idFestado='$this->asidFestado', 
			idFciudad='$this->asidFciudad', 
			idFmunicipio='$this->asidFmunicipio', 
			idFparroquia='$this->asidFparroquia', 
			fecha_creacion='$this->asFecha_creacion', 
			codigo_archi='$this->asCodigo_archi'
			WHERE  codigoParroquiaIglesia='".$this->asidParroquiaIglesia."'";
			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			
			$this->fpDesconectar();
			return $lbHecho;
		}

		public function fbActivar($psVar)
		{
			if($psVar=='0')
			{
				$psVar='1';
			}
			else
			{
				$psVar='0';
			}
			$lbHecho=false;
			$lsSql="UPDATE tparroquiaiglesia SET Estatus='$psVar' WHERE codigoParroquiaIglesia='$this->asidParroquiaIglesia'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function faListar()
		{
			$lsSql="SELECT 
					A.codigoParroquiaIglesia,
					A.nombre,
					A.mision,
					A.vision,
					A.direccion,
					A.telefono,
					A.correo,
					A.idFestado,
					A.idFciudad,
					A.idFmunicipio,
					A.idFparroquia,
					A.fecha_creacion,
					A.codigo_archi,
					A.Estatus,
					B.nombre AS nombreArchi
					FROM tparroquiaiglesia AS A 
					RIGHT JOIN archiprestazgo AS B ON A.codigo_archi=B.codigoArchiPrestazgo
					ORDER BY A.codigoParroquiaIglesia ASC";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["codigoParroquiaIglesia"]=$laArreglo["codigoParroquiaIglesia"];
				$laMatriz[$liI]["nombre"]=$laArreglo["nombre"];
				$laMatriz[$liI]["mision"]=$laArreglo["mision"];
				$laMatriz[$liI]["vision"]=$laArreglo["vision"];
				$laMatriz[$liI]["direccion"]=$laArreglo["direccion"];
				$laMatriz[$liI]["telefono"]=$laArreglo["telefono"];
				$laMatriz[$liI]["correo"]=$laArreglo["correo"];
				$laMatriz[$liI]["idFestado"]=$laArreglo["idFestado"];
				$laMatriz[$liI]["idFciudad"]=$laArreglo["idFciudad"];
				$laMatriz[$liI]["idFmunicipio"]=$laArreglo["idFmunicipio"];
				$laMatriz[$liI]["idFparroquia"]=$laArreglo["idFparroquia"];
				$laMatriz[$liI]["fecha_creacion"]=$laArreglo["fecha_creacion"];
				$laMatriz[$liI]["codigo_archi"]=$laArreglo["codigo_archi"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$laMatriz[$liI]["nombreArchi"]=$laArreglo["nombreArchi"];
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
