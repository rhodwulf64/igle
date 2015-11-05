<?php

    require_once("clsDatos.php");
	class claPastoral extends clsDatos
	{
		private $asidPastoral;
		private $asNombre;
		private $asMision;
		private $asVision;
		private $asFechaRegistro;
		private $asEstatusPastoral;
		private $ascantFeligreses;

		public function __construct()
		{
			$this->asidPastoral="";
			$this->asNombre="";
			$this->asMision="";
			$this->asVision="";
			$this->asFechaRegistro="";
			$this->asEstatusPastoral="";
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
			A.codigoPastoral, 
			A.nombre, A.mision, 
			A.vision, B.codigo_persona, 
			A.FechaRegistroPastoral, 
			DATE_FORMAT(A.FechaRegistroPastoral,'%Y-%m-%d') AS SoloFechaRegistro,
			COUNT( B.Detalle_Pastoralcol ) AS cantFeligreses, 
			A.Estatus AS EstatusPastoral
			FROM tpastoral AS A
			LEFT JOIN detalle_pastoral AS B ON B.codigo_pastoral = A.codigoPastoral
			WHERE A.codigoPastoral='$this->asidPastoral'
			GROUP BY A.codigoPastoral
			ORDER BY A.codigoPastoral ASC";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asidPastoral=$laArreglo["codigoPastoral"];
				$this->asNombre=$laArreglo["nombre"];
				$this->asMision=$laArreglo["mision"];
				$this->asVision=$laArreglo["vision"];
				$this->asFechaRegistro=$laArreglo["FechaRegistroPastoral"];
				$this->asEstatusPastoral=$laArreglo["EstatusPastoral"];
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
			A.codigoPastoral, 
			A.nombre, A.mision, 
			A.vision, B.codigo_persona, 
			A.FechaRegistroPastoral, 
			DATE_FORMAT(A.FechaRegistroPastoral,'%Y-%m-%d') AS SoloFechaRegistro,
			COUNT( B.Detalle_Pastoralcol ) AS cantFeligreses, 
			A.Estatus AS EstatusPastoral
			FROM tpastoral AS A
			LEFT JOIN detalle_pastoral AS B ON B.codigo_pastoral = A.codigoPastoral
			WHERE A.nombre='$this->asNombre'
			GROUP BY A.codigoPastoral
			ORDER BY A.codigoPastoral ASC";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asidPastoral=$laArreglo["codigoPastoral"];
				$this->asNombre=$laArreglo["nombre"];
				$this->asMision=$laArreglo["mision"];
				$this->asVision=$laArreglo["vision"];
				$this->asFechaRegistro=$laArreglo["FechaRegistroPastoral"];
				$this->asEstatusPastoral=$laArreglo["EstatusPastoral"];
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
					A.codigoPastoral, 
					A.nombre, A.mision, 
					A.vision, B.codigo_persona, 
					A.FechaRegistroPastoral, 
					DATE_FORMAT(A.FechaRegistroPastoral,'%Y-%m-%d') AS SoloFechaRegistro,
					COUNT( B.Detalle_Pastoralcol ) AS cantFeligreses, 
					A.Estatus AS EstatusPastoral
					FROM tpastoral AS A
					LEFT JOIN detalle_pastoral AS B ON B.codigo_pastoral = A.codigoPastoral
					WHERE A.nombre='$this->asNombre'
					GROUP BY A.codigoPastoral
					ORDER BY A.codigoPastoral ASC");
				break;
				case "proximo":
					$lsSql=("SELECT 
					A.codigoPastoral, 
					A.nombre, A.mision, 
					A.vision, B.codigo_persona, 
					A.FechaRegistroPastoral, 
					DATE_FORMAT(A.FechaRegistroPastoral,'%Y-%m-%d') AS SoloFechaRegistro,
					COUNT( B.Detalle_Pastoralcol ) AS cantFeligreses, 
					A.Estatus AS EstatusPastoral
					FROM tpastoral AS A
					LEFT JOIN detalle_pastoral AS B ON B.codigo_pastoral = A.codigoPastoral
					WHERE ( (A.codigoPastoral like '%$cadena%') or (A.nombre like '%$cadena%') or (A.mision like '%$cadena%') or (A.vision like '%$cadena%') )
					GROUP BY A.codigoPastoral
					ORDER BY A.codigoPastoral ASC");
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
			$lsSql="INSERT INTO tpastoral (
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
			$lsSql="UPDATE tpastoral SET 
			nombre='$this->asNombre',
			mision='$this->asMision',
			vision='$this->asVision'
			WHERE codigoPastoral='$this->asidPastoral'";
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
			$lsSql="UPDATE tpastoral SET Estatus='$psVar' WHERE codigoPastoral='$this->asidPastoral'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function faListar()
		{
			$lsSql="SELECT 
			A.codigoPastoral, 
			A.nombre, A.mision, 
			A.vision, B.codigo_persona, 
			A.FechaRegistroPastoral, 
			DATE_FORMAT(A.FechaRegistroPastoral,'%Y-%m-%d') AS SoloFechaRegistro,
			COUNT( B.Detalle_Pastoralcol ) AS cantFeligreses, 
			A.Estatus AS EstatusPastoral
			FROM tpastoral AS A
			LEFT JOIN detalle_pastoral AS B ON B.codigo_pastoral = A.codigoPastoral
			GROUP BY A.codigoPastoral
			ORDER BY A.codigoPastoral ASC";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["codigoPastoral"]=$laArreglo["codigoPastoral"];
				$laMatriz[$liI]["nombre"]=$laArreglo["nombre"];
				$laMatriz[$liI]["mision"]=$laArreglo["mision"];
				$laMatriz[$liI]["vision"]=$laArreglo["vision"];
				$laMatriz[$liI]["FechaRegistroPastoral"]=$laArreglo["FechaRegistroPastoral"];
				$laMatriz[$liI]["SoloFechaRegistro"]=$laArreglo["SoloFechaRegistro"];
				$laMatriz[$liI]["EstatusPastoral"]=$laArreglo["EstatusPastoral"];
				$laMatriz[$liI]["cantFeligreses"]=$laArreglo["cantFeligreses"];
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
