<?php

    require_once("clsDatos.php");
	class claApostolado extends clsDatos
	{
		private $asidApostolado;
		private $asNombre;
		private $asMision;
		private $asVision;
		private $asFechaRegistro;
		private $asEstatusApostolado;
		private $ascantFeligreses;

		public function __construct()
		{
			$this->asidApostolado="";
			$this->asNombre="";
			$this->asMision="";
			$this->asVision="";
			$this->asFechaRegistro="";
			$this->asEstatusApostolado="";
			$this->ascantFeligreses="";
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
			$lsSql="SELECT 
			A.codigoGrupo, 
			A.nombre, A.mision, 
			A.vision, B.codigo_persona, 
			A.FechaRegistroGrupo, 
			DATE_FORMAT(A.FechaRegistroGrupo,'%Y-%m-%d') AS SoloFechaRegistro,
			COUNT( B.Detalle_Grupocol ) AS cantFeligreses, 
			A.Estatus AS EstatusApostolado
			FROM tgrupo AS A
			LEFT JOIN Detalle_Grupo AS B ON B.codigo_grupo = A.codigoGrupo
			WHERE A.codigoGrupo='$this->asidApostolado'
			GROUP BY A.codigoGrupo
			ORDER BY A.codigoGrupo ASC";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asidApostolado=$laArreglo["codigoGrupo"];
				$this->asNombre=$laArreglo["nombre"];
				$this->asMision=$laArreglo["mision"];
				$this->asVision=$laArreglo["vision"];
				$this->asFechaRegistro=$laArreglo["FechaRegistroGrupo"];
				$this->asEstatusApostolado=$laArreglo["EstatusApostolado"];
				$this->ascantFeligreses=$laArreglo["cantFeligreses"];
				$lbEnc=true;
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}

		public function fbBuscarNombre()
		{
			$lbEnc=false;
			$lsSql="SELECT 
			A.codigoGrupo, 
			A.nombre, A.mision, 
			A.vision, B.codigo_persona, 
			A.FechaRegistroGrupo, 
			DATE_FORMAT(A.FechaRegistroGrupo,'%Y-%m-%d') AS SoloFechaRegistro,
			COUNT( B.Detalle_Grupocol ) AS cantFeligreses, 
			A.Estatus AS EstatusApostolado
			FROM tgrupo AS A
			LEFT JOIN Detalle_Grupo AS B ON B.codigo_grupo = A.codigoGrupo
			WHERE A.nombre='$this->asNombre'
			GROUP BY A.codigoGrupo
			ORDER BY A.codigoGrupo ASC";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asidApostolado=$laArreglo["codigoGrupo"];
				$this->asNombre=$laArreglo["nombre"];
				$this->asMision=$laArreglo["mision"];
				$this->asVision=$laArreglo["vision"];
				$this->asFechaRegistro=$laArreglo["FechaRegistroGrupo"];
				$this->asEstatusApostolado=$laArreglo["EstatusApostolado"];
				$this->ascantFeligreses=$laArreglo["cantFeligreses"];
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
					A.codigoGrupo, 
					A.nombre, A.mision, 
					A.vision, B.codigo_persona, 
					A.FechaRegistroGrupo, 
					DATE_FORMAT(A.FechaRegistroGrupo,'%Y-%m-%d') AS SoloFechaRegistro,
					COUNT( B.Detalle_Grupocol ) AS cantFeligreses, 
					A.Estatus AS EstatusApostolado
					FROM tgrupo AS A
					LEFT JOIN Detalle_Grupo AS B ON B.codigo_grupo = A.codigoGrupo
					WHERE A.nombre='$this->asNombre'
					GROUP BY A.codigoGrupo
					ORDER BY A.codigoGrupo ASC");
				break;
				case "proximo":
					$lsSql=("SELECT 
					A.codigoGrupo, 
					A.nombre, A.mision, 
					A.vision, B.codigo_persona, 
					A.FechaRegistroGrupo, 
					DATE_FORMAT(A.FechaRegistroGrupo,'%Y-%m-%d') AS SoloFechaRegistro,
					COUNT( B.Detalle_Grupocol ) AS cantFeligreses, 
					A.Estatus AS EstatusApostolado
					FROM tgrupo AS A
					LEFT JOIN Detalle_Grupo AS B ON B.codigo_grupo = A.codigoGrupo
					WHERE ( (A.codigoGrupo like '%$cadena%') or (A.nombre like '%$cadena%') or (A.mision like '%$cadena%') or (A.vision like '%$cadena%') )
					GROUP BY A.codigoGrupo
					ORDER BY A.codigoGrupo ASC");
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
			$lsSql="INSERT INTO tgrupo (
					nombre,
					mision,
					vision
					) VALUES (
					'$this->asNombre',
					'$this->asMision',
					'$this->asVision')";
			$lbHecho=$this->fbEjecutarNoDie($lsSql);

			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function fbModificar()
		{
			$lbHecho=false;

			$this->fpConectar();
			$lsSql="UPDATE tgrupo SET 
			nombre='$this->asNombre',
			mision='$this->asMision',
			vision='$this->asVision'
			WHERE codigoGrupo='$this->asidApostolado'";
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
			$lsSql="UPDATE tgrupo SET Estatus='$psVar' WHERE codigoGrupo='$this->asidApostolado'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function faListar()
		{
			$lsSql="SELECT 
			A.codigoGrupo, 
			A.nombre, A.mision, 
			A.vision, B.codigo_persona, 
			A.FechaRegistroGrupo, 
			DATE_FORMAT(A.FechaRegistroGrupo,'%Y-%m-%d') AS SoloFechaRegistro,
			COUNT( B.Detalle_Grupocol ) AS cantFeligreses, 
			A.Estatus AS EstatusApostolado
			FROM tgrupo AS A
			LEFT JOIN Detalle_Grupo AS B ON B.codigo_grupo = A.codigoGrupo
			GROUP BY A.codigoGrupo
			ORDER BY A.codigoGrupo ASC";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["codigoGrupo"]=$laArreglo["codigoGrupo"];
				$laMatriz[$liI]["nombre"]=$laArreglo["nombre"];
				$laMatriz[$liI]["mision"]=$laArreglo["mision"];
				$laMatriz[$liI]["vision"]=$laArreglo["vision"];
				$laMatriz[$liI]["FechaRegistroGrupo"]=$laArreglo["FechaRegistroGrupo"];
				$laMatriz[$liI]["SoloFechaRegistro"]=$laArreglo["SoloFechaRegistro"];
				$laMatriz[$liI]["EstatusApostolado"]=$laArreglo["EstatusApostolado"];
				$laMatriz[$liI]["cantFeligreses"]=$laArreglo["cantFeligreses"];
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
