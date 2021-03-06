<?php

    require_once("clsDatos.php");
    require_once("claPersonas.php");
   	require_once("clsFuncionesGlobales.php");
	$loFuncion =new clsFunciones();
	
    $loPersonas=new claPersonas();
	class claApostoladoFeligres extends clsDatos
	{

		private $asDetalle_Grupocol;
		private $ascodigo_persona;
		private $ascodigo_grupo;
		private $asFechaRegistro;
		private $asidFparroquiaIglesia;
		private $asEstatus;
		private $asFilaFeli;
		private $asNombreGrupo;
		private $asMatrizFeligres;
		
		public function __construct()
		{
			$this->asDetalle_Grupocol= "";
			$this->ascodigo_persona="";
			$this->ascodigo_grupo="";
			$this->asFechaRegistro="";
			$this->asidFparroquiaIglesia="";
			$this->asEstatus="";
			$this->asFilaFeli="";
			$this->asNombreGrupo="";
			$this->asMatrizFeligres=array(array());
		
		}
		

		//metodo magico set
		public function __set($atributo, $valor){ $this->$atributo = strtoupper($valor);}		
		//metodo get
		public function __get($atributo){ return trim(strtoupper($this->$atributo)); }

		public function __destruct()
		{
		}
		
		public function fpSetMatrizFeligres($psMatrizFeligres)
		{
			$this->asMatrizFeligres=$psMatrizFeligres;
		}

		public function fpGetMatrizFeligres()
		{
			return $this->asMatrizFeligres;
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
	
		
		public function fbBuscarFeligreses()
		{
				$this->fpConectar();
				$lsSql="SELECT 
				A.Detalle_Grupocol,
				A.codigo_grupo,
				B.idTpersonas,
				B.Cedula,
				B.Nombres,
				B.Apellidos,
				B.Sexo,
				B.Direccion,
				B.Telefono,
				B.Correo,
				B.idFparroquiaCodigo,
				C.nombre AS NombreGrupo,
				D.codigoParroquiaIglesia,
				A.Estatus,
				D.nombre AS NombreParroquia
				FROM detalle_grupo AS A
				INNER JOIN tpersonas AS B ON A.codigo_persona = B.idTpersonas 	 	
				INNER JOIN tgrupo AS C ON A.codigo_grupo = C.codigoGrupo
				INNER JOIN tparroquiaiglesia AS D ON A.idFparroquiaIglesia = D.codigoParroquiaIglesia
				WHERE A.codigo_grupo='$this->ascodigo_grupo' AND A.idFparroquiaIglesia='$this->asidFparroquiaIglesia'";
				$laMatriz=array();
				$lrTb=$this->frFiltro($lsSql);
				$liI=0;
				while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["Detalle_Grupocol"]=$laArreglo["Detalle_Grupocol"];
				$laMatriz[$liI]["codigo_grupo"]=$laArreglo["codigo_grupo"];
				$laMatriz[$liI]["idTpersonas"]=$laArreglo["idTpersonas"];
				$laMatriz[$liI]["Cedula"]=$laArreglo["Cedula"];
				$laMatriz[$liI]["Nombres"]=$laArreglo["Nombres"];
				$laMatriz[$liI]["Apellidos"]=$laArreglo["Apellidos"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];
				$laMatriz[$liI]["Direccion"]=$laArreglo["Direccion"];
				$laMatriz[$liI]["Telefono"]=$laArreglo["Telefono"];
				$laMatriz[$liI]["Correo"]=$laArreglo["Correo"];
				$laMatriz[$liI]["idFparroquiaCodigo"]=$laArreglo["idFparroquiaCodigo"];
				$laMatriz[$liI]["NombreGrupo"]=$laArreglo["NombreGrupo"];
				$laMatriz[$liI]["codigoParroquiaIglesia"]=$laArreglo["codigoParroquiaIglesia"];
				$laMatriz[$liI]["NombreParroquia"]=$laArreglo["NombreParroquia"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}

		public function buscarLike($tipo = "cc",$cadena = ""){
			switch($tipo){
				case "cc":
					$lsSql=("SELECT 
					A.Detalle_Grupocol,
					A.codigo_grupo,
					count(A.codigo_grupo) AS cantFeligreses,
					A.FechaRegistro,
					A.Estatus,
					B.nombre AS NombreGrupo,
					C.codigoParroquiaIglesia,
					C.nombre AS NombreParroquia
					FROM detalle_grupo AS A
					INNER JOIN tgrupo AS B ON A.codigo_grupo=B.codigoGrupo
					INNER JOIN tparroquiaiglesia AS C ON A.idFparroquiaIglesia=C.codigoParroquiaIglesia
					WHERE B.nombre = '$this->asNombreGrupo'
					GROUP BY A.codigo_grupo,C.nombre
					ORDER BY A.Detalle_Grupocol ASC");

				break;
				case "proximo":
					$lsSql=("SELECT 
					A.Detalle_Grupocol,
					A.codigo_grupo,
					count(A.codigo_grupo) AS cantFeligreses,
					A.FechaRegistro,
					A.Estatus,
					B.nombre AS NombreGrupo,
					C.codigoParroquiaIglesia,
					C.nombre AS NombreParroquia
					FROM detalle_grupo AS A
					INNER JOIN tgrupo AS B ON A.codigo_grupo=B.codigoGrupo
					INNER JOIN tparroquiaiglesia AS C ON A.idFparroquiaIglesia=C.codigoParroquiaIglesia
					WHERE ( (A.Detalle_Grupocol like '%$cadena%') or (B.nombre like '%$cadena%') or (B.mision like '%$cadena%') or (C.nombre like '%$cadena%') )
					GROUP BY A.codigo_grupo,C.nombre
					ORDER BY A.Detalle_Grupocol ASC");
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
	
		public function fbModificarFeligresApostolado()
		{
			$lbHecho=false;
			$lbHecho1=false;
			$conttrue=0;
			$this->fpConectar();
			$MFeligres=$this->asMatrizFeligres;	

				for($liI=1;$liI<=$this->asFilaFeli;$liI++)
				{

					if($MFeligres[$liI][1]!="")
					{
						$MFeligres[$liI][2]=$MFeligres[$liI][1]."-".$MFeligres[$liI][2];
					}

					$lsSql="INSERT INTO tpersonas (Nacionalidad,Cedula,Nombres,Apellidos,Sexo,Telefono,Correo,idFparroquiaCodigo) VALUES 
								('".$MFeligres[$liI][1]."','".$MFeligres[$liI][2]."','".$MFeligres[$liI][3]."','".$MFeligres[$liI][4]."','".$MFeligres[$liI][5]."','".$MFeligres[$liI][6]."','".$MFeligres[$liI][7]."','".$MFeligres[$liI][12]."') ON DUPLICATE KEY UPDATE Nacionalidad='".$MFeligres[$liI][1]."', Cedula='".$MFeligres[$liI][2]."',Nombres='".$MFeligres[$liI][3]."',Apellidos='".$MFeligres[$liI][4]."',Sexo='".$MFeligres[$liI][5]."',Telefono='".$MFeligres[$liI][6]."',Correo='".$MFeligres[$liI][7]."',idFparroquiaCodigo='".$MFeligres[$liI][12]."'";
					$lbHecho1=$this->fbEjecutarNoDie($lsSql);
					$IDTpersona=$this->fpGetIDinsertado();


					if($lbHecho1)
					{	
						$lsSql="INSERT INTO detalle_grupo (
						codigo_persona,
						codigo_grupo,
						idFparroquiaIglesia
						) VALUES (
						'$IDTpersona',
						'$this->ascodigo_grupo',
						'$this->asidFparroquiaIglesia')";
						$lbHecho1=$this->fbEjecutarNoDie($lsSql);
						$conttrue++;
					}

					$lbHecho1=false;		

				}

				$this->fpDesconectar();
				if($conttrue>0)
				{
					$lbHecho=true;
				}	
				

			return $lbHecho;
				
		}

		public function fbActivar($psVar)
		{
			
			$lbHecho=false;
			$this->fpConectar();
			$lsSql="UPDATE detalle_grupo SET Estatus='$psVar' WHERE Detalle_Grupocol='$this->asDetalle_Grupocol'";
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}

		public function faListarFeligres()
		{
		
			$lsSql="SELECT 
				A.Detalle_Grupocol,
				A.codigo_grupo,
				B.idTpersonas,
				B.Cedula,
				B.Nombres,
				B.Apellidos,
				B.Sexo,
				B.Direccion,
				B.Telefono,
				B.Correo,
				B.idFparroquiaCodigo,
				C.nombre AS NombreGrupo,
				D.codigoParroquiaIglesia,
				D.nombre AS NombreParroquia,
				A.Estatus
				FROM detalle_grupo AS A
				INNER JOIN tpersonas AS B ON A.codigo_persona = B.idTpersonas 	 	
				INNER JOIN tgrupo AS C ON A.codigo_grupo = C.codigoGrupo
				INNER JOIN tparroquiaiglesia AS D ON A.idFparroquiaIglesia = D.codigoParroquiaIglesia
				ORDER BY A.Detalle_Grupocol ASC";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["Detalle_Grupocol"]=$laArreglo["Detalle_Grupocol"];
				$laMatriz[$liI]["codigo_grupo"]=$laArreglo["codigo_grupo"];
				$laMatriz[$liI]["idTpersonas"]=$laArreglo["idTpersonas"];
				$laMatriz[$liI]["Cedula"]=$laArreglo["Cedula"];
				$laMatriz[$liI]["Nombres"]=$laArreglo["Nombres"];
				$laMatriz[$liI]["Apellidos"]=$laArreglo["Apellidos"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];
				$laMatriz[$liI]["Direccion"]=$laArreglo["Direccion"];
				$laMatriz[$liI]["Telefono"]=$laArreglo["Telefono"];
				$laMatriz[$liI]["Correo"]=$laArreglo["Correo"];
				$laMatriz[$liI]["idFparroquiaCodigo"]=$laArreglo["idFparroquiaCodigo"];
				$laMatriz[$liI]["NombreGrupo"]=$laArreglo["NombreGrupo"];
				$laMatriz[$liI]["codigoParroquiaIglesia"]=$laArreglo["codigoParroquiaIglesia"];
				$laMatriz[$liI]["NombreParroquia"]=$laArreglo["NombreParroquia"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}

		

		
		
	}
?>
