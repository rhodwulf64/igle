<?php

    require_once("clsDatos.php");
	class claCapilla extends clsDatos
	{
		private $asidCapilla;
		private $asNombre;
		private $asDireccion;
		private $asTelefono;
		private $asCorreo;
		private $asidFestado;
		private $asidFciudad;
		private $asidFmunicipio;
		private $asidFparroquia;
		private $asFecha_creacion;
		private $asCodigo_ParroIgle;
		private $asNombre_ParroIgle;
		private $asEstatus;

		public function __construct()
		{
			$this->asidCapilla="";
			$this->asNombre="";
			$this->asDireccion="";
			$this->asTelefono="";
			$this->asCorreo="";
			$this->asidFestado="";
			$this->asidFciudad="";
			$this->asidFmunicipio="";
			$this->asidFparroquia="";
			$this->asFecha_creacion="";
			$this->asCodigo_ParroIgle="";
			$this->asNombre_ParroIgle="";
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
			A.codigoCapilla,
			A.nombre,
			A.direccion,
			A.telefono,
			A.correo,
			A.idFestado,
			A.idFciudad,
			A.idFmunicipio,
			A.idFparroquia,
			A.fecha_creacion,
			A.codigo_parroquia,
			A.Estatus,
			B.nombre AS nombreParroIgle
			FROM tcapilla AS A 
			RIGHT JOIN tparroquiaiglesia AS B ON A.codigo_parroquia=B.codigoParroquiaIglesia
			WHERE A.codigoCapilla='".$this->asidCapilla."' 
			ORDER BY A.codigoCapilla ASC";
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asidCapilla=$laArreglo["codigoCapilla"];
				$this->asNombre=$laArreglo["nombre"];
				$this->asDireccion=$laArreglo["direccion"];
				$this->asTelefono=$laArreglo["telefono"];
				$this->asCorreo=$laArreglo["correo"];
				$this->idFestado=$laArreglo["idFestado"];
				$this->idFciudad=$laArreglo["idFciudad"];
				$this->idFmunicipio=$laArreglo["idFmunicipio"];
				$this->idFparroquia=$laArreglo["idFparroquia"];
				$this->asFecha_creacion=$laArreglo["fecha_creacion"];
				$this->asCodigo_ParroIgle=$laArreglo["codigo_parroquia"];
				$this->asNombre_ParroIgle=$laArreglo["nombreParroIgle"];
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
			A.codigoCapilla,
			A.nombre,
			A.direccion,
			A.telefono,
			A.correo,
			A.idFestado,
			A.idFciudad,
			A.idFmunicipio,
			A.idFparroquia,
			A.fecha_creacion,
			A.codigo_parroquia,
			A.Estatus,
			B.nombre AS nombreParroIgle
			FROM tcapilla AS A 
			RIGHT JOIN tparroquiaiglesia AS B ON A.codigo_parroquia=B.codigoParroquiaIglesia
			WHERE A.nombre='".$this->asNombre."' 
			ORDER BY A.codigoCapilla ASC";
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asidCapilla=$laArreglo["codigoCapilla"];
				$this->asNombre=$laArreglo["nombre"];
				$this->asDireccion=$laArreglo["direccion"];
				$this->asTelefono=$laArreglo["telefono"];
				$this->asCorreo=$laArreglo["correo"];
				$this->idFestado=$laArreglo["idFestado"];
				$this->idFciudad=$laArreglo["idFciudad"];
				$this->idFmunicipio=$laArreglo["idFmunicipio"];
				$this->idFparroquia=$laArreglo["idFparroquia"];
				$this->asFecha_creacion=$laArreglo["fecha_creacion"];
				$this->asCodigo_ParroIgle=$laArreglo["codigo_parroquia"];
				$this->asNombre_ParroIgle=$laArreglo["nombreParroIgle"];
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
					A.codigoCapilla,
					A.nombre,
					A.direccion,
					A.telefono,
					A.correo,
					A.idFestado,
					A.idFciudad,
					A.idFmunicipio,
					A.idFparroquia,
					A.fecha_creacion,
					A.codigo_parroquia,
					A.Estatus,
					B.nombre AS nombreParroIgle,
					C.descripcion AS CEstado,
					D.descripcion AS DCiudad,
					E.descripcion AS EMunicipio,
					F.descripcion AS FParroquia
					FROM tcapilla AS A 
					RIGHT JOIN tparroquiaiglesia AS B ON A.codigo_parroquia=B.codigoParroquiaIglesia
					LEFT JOIN estado AS C ON A.idFestado=C.cod_estado
					LEFT JOIN ciudad AS D ON A.idFciudad=D.cod_ciudad
					LEFT JOIN municipio AS E ON A.idFmunicipio=E.cod_municipio
					LEFT JOIN parroquia AS F ON A.idFparroquia=F.cod_parroquia
					WHERE A.nombre='".$this->asNombre."'
					ORDER BY A.codigoCapilla ASC");
				break;
				case "proximo":
					$lsSql=("SELECT 
					A.codigoCapilla,
					A.nombre,
					A.direccion,
					A.telefono,
					A.correo,
					A.idFestado,
					A.idFciudad,
					A.idFmunicipio,
					A.idFparroquia,
					A.fecha_creacion,
					A.codigo_parroquia,
					A.Estatus,
					B.nombre AS nombreParroIgle,
					C.descripcion AS CEstado,
					D.descripcion AS DCiudad,
					E.descripcion AS EMunicipio,
					F.descripcion AS FParroquia
					FROM tcapilla AS A 
					LEFT JOIN tparroquiaiglesia AS B ON A.codigo_parroquia=B.codigoParroquiaIglesia
					LEFT JOIN estado AS C ON A.idFestado=C.cod_estado
					LEFT JOIN ciudad AS D ON A.idFciudad=D.cod_ciudad
					LEFT JOIN municipio AS E ON A.idFmunicipio=E.cod_municipio
					LEFT JOIN parroquia AS F ON A.idFparroquia=F.cod_parroquia
					WHERE ( (A.codigoCapilla like '%$cadena%') or (A.nombre like '%$cadena%') or (A.telefono like '%$cadena%') or (A.correo like '%$cadena%') or (B.nombre like '%$cadena%') or (C.descripcion like '%$cadena%') or (D.descripcion like '%$cadena%') or (E.descripcion like '%$cadena%') or (F.descripcion like '%$cadena%') )
					ORDER BY A.codigoCapilla ASC");
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
			$lsSql="INSERT INTO tcapilla (
				nombre,
				direccion,
				telefono,
				correo,
				idFestado,
				idFciudad,
				idFmunicipio,
				idFparroquia,
				fecha_creacion,
				codigo_parroquia
				) VALUES (
				'$this->asNombre',
				'$this->asDireccion',
				'$this->asTelefono',
				'$this->asCorreo',
				'$this->asidFestado',
				'$this->asidFciudad',
				'$this->asidFmunicipio',
				'$this->asidFparroquia',
				'$this->asFecha_creacion',
				'$this->asCodigo_ParroIgle')";

				$lbHecho=$this->fbEjecutarNoDie($lsSql);

				$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function fbModificar()
		{
			$lbHecho=false;

			$this->fpConectar();
			$lsSql="UPDATE tcapilla SET 
			nombre='$this->asNombre', 
			direccion='$this->asDireccion', 
			telefono='$this->asTelefono', 
			correo='$this->asCorreo', 
			idFestado='$this->asidFestado', 
			idFciudad='$this->asidFciudad', 
			idFmunicipio='$this->asidFmunicipio', 
			idFparroquia='$this->asidFparroquia', 
			fecha_creacion='$this->asFecha_creacion', 
			codigo_parroquia='$this->asCodigo_ParroIgle'
			WHERE  codigoCapilla='".$this->asidCapilla."'";
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
			$lsSql="UPDATE tcapilla SET Estatus='$psVar' WHERE codigoCapilla='$this->asidCapilla'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function faListar()
		{
			$lsSql="SELECT 
					A.codigoCapilla,
					A.nombre,
					A.direccion,
					A.telefono,
					A.correo,
					A.idFestado,
					A.idFciudad,
					A.idFmunicipio,
					A.idFparroquia,
					A.fecha_creacion,
					A.codigo_parroquia,
					A.Estatus,
					B.nombre AS nombreParroIgle
					FROM tcapilla AS A 
					RIGHT JOIN tparroquiaiglesia AS B ON A.codigo_parroquia=B.codigoParroquiaIglesia
					ORDER BY A.codigoCapilla ASC";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["codigoCapilla"]=$laArreglo["codigoCapilla"];
				$laMatriz[$liI]["nombre"]=$laArreglo["nombre"];
				$laMatriz[$liI]["direccion"]=$laArreglo["direccion"];
				$laMatriz[$liI]["telefono"]=$laArreglo["telefono"];
				$laMatriz[$liI]["correo"]=$laArreglo["correo"];
				$laMatriz[$liI]["idFestado"]=$laArreglo["idFestado"];
				$laMatriz[$liI]["idFciudad"]=$laArreglo["idFciudad"];
				$laMatriz[$liI]["idFmunicipio"]=$laArreglo["idFmunicipio"];
				$laMatriz[$liI]["idFparroquia"]=$laArreglo["idFparroquia"];
				$laMatriz[$liI]["fecha_creacion"]=$laArreglo["fecha_creacion"];
				$laMatriz[$liI]["codigo_parroquia"]=$laArreglo["codigo_parroquia"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$laMatriz[$liI]["nombreParroIgle"]=$laArreglo["nombreParroIgle"];
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
