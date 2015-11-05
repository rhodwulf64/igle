<?php
require_once("clsDatos.php");

class clsFunciones extends clsDatos
{
		private $asFechaRegistro;
		public function __construct()
		{
			$this->asFechaRegistro=date("Y-m-d H:i:s");
			$this->MatrizPadri= "";
		}

		public function __destruct()
		{
		}

	function fncreateComboSelectConfDos($tabla, $value, $text, $selected)
	{
		$prefijo="Na";
		if ($tabla=="estado") 
		{
			$prefijo="Es";
		}
		elseif($tabla=="ciudad")
		{
			$prefijo="Ci";		
		}
		elseif($tabla=="municipio")
		{
			$prefijo="Mu";
		}
		elseif($tabla=="parroquia")
		{
			$prefijo="Pa";
		}

		$lsSql="SELECT * FROM $tabla ORDER BY Estatus DESC";
	
		$this->fpConectar();
		$lrTb=$this->frFiltro($lsSql);

		while($laArreglo=$this->faProximo($lrTb))
		{	
			
				if ($laArreglo["Estatus"]=="0")
				{
					if( (isset($selected)) && ($selected == trim($laArreglo[$value])) ){
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."*".trim($laArreglo["descripcion"])."' id='".$prefijo.trim($laArreglo[$value])."' style=\"background:url('img/desac.png') no-repeat center left; padding-left:20px;\" class='".$prefijo.trim($laArreglo[$idtabla])."' selected>".$laArreglo[$text]."</option>";
					}else{
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."*".trim($laArreglo["descripcion"])."' style=\"background:url('img/desac.png') no-repeat center left; padding-left:20px;\" class='".$prefijo.trim($laArreglo[$idtabla])."'>".$laArreglo[$text]."</option>";
					}
				}
				elseif ($laArreglo["Estatus"]=="1")
				{
					if( (isset($selected)) && ($selected == trim($laArreglo[$value])) ){
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."*".trim($laArreglo["descripcion"])."' id='".$prefijo.trim($laArreglo[$value])."' style=\"background:url('img/acti.png') no-repeat center left; padding-left:20px;\" class='".$prefijo.trim($laArreglo[$idtabla])."' selected>".$laArreglo[$text]."</option>";
					}else{
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."*".trim($laArreglo["descripcion"])."' id='".$prefijo.trim($laArreglo[$value])."' style=\"background:url('img/acti.png') no-repeat center left; padding-left:20px;\" class='".$prefijo.trim($laArreglo[$idtabla])."'>".$laArreglo[$text]."</option>";
					}
				}
				else
				{
					if( (isset($selected)) && ($selected == trim($laArreglo[$value])) ){
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."*".trim($laArreglo["descripcion"])."' id='".$prefijo.trim($laArreglo[$value])."' class='".$prefijo.trim($laArreglo[$idtabla])."' selected>".$laArreglo[$text]."</option>";
					}else{
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."*".trim($laArreglo["descripcion"])."' id='".$prefijo.trim($laArreglo[$value])."' class='".$prefijo.trim($laArreglo[$idtabla])."'>".$laArreglo[$text]."</option>";
					}
				}
			
		}
		$this->fpCierraFiltro($lrTb);
		return $llEnc;
	}		

	function fncreateComboSelectConf($tabla, $tablados, $value, $concauno, $concaSplit, $concados, $text, $selected, $join, $idtabla, $idtablados)
	{
		$prefijo="Na";
		if ($tabla=="estado") 
		{
			$prefijo="Es";
		}
		elseif($tabla=="ciudad")
		{
			$prefijo="Ci";		
		}
		elseif($tabla=="municipio")
		{
			$prefijo="Mu";
		}
		elseif($tabla=="parroquia")
		{
			$prefijo="Pa";
		}

		if ($join=="")
		{
			$lsSql="SELECT * FROM $tabla ORDER BY Estatus DESC";
		}
		elseif (($join!="")&&($tabla=="tsacerdote"))
		{
			$lsSql="SELECT $tabla.*, CONCAT($concauno, '$concaSplit',$concados, ' (', Nacionalidad, '-', Cedula,')') AS $text FROM $tabla $join $tablados ON $idtabla=$idtablados ORDER BY Estatus DESC";
		}
		else
		{
			$lsSql="SELECT $tabla.*, CONCAT($concauno, '$concaSplit',$concados) AS $text FROM $tabla $join $tablados ON $idtabla=$idtablados ORDER BY Estatus DESC";
		}
		$this->fpConectar();
		$lrTb=$this->frFiltro($lsSql);

		while($laArreglo=$this->faProximo($lrTb))
		{	
			
				if ($laArreglo["Estatus"]=="0")
				{
					if( (isset($selected)) && ($selected == trim($laArreglo[$value])) ){
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' style=\"background:url('img/desac.png') no-repeat center left; padding-left:20px;\" class='".$prefijo.trim($laArreglo[$idtabla])."' selected>".$laArreglo[$text]."</option>";
					}else{
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' style=\"background:url('img/desac.png') no-repeat center left; padding-left:20px;\" class='".$prefijo.trim($laArreglo[$idtabla])."'>".$laArreglo[$text]."</option>";
					}
				}
				elseif ($laArreglo["Estatus"]=="1")
				{
					if( (isset($selected)) && ($selected == trim($laArreglo[$value])) ){
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' style=\"background:url('img/acti.png') no-repeat center left; padding-left:20px;\" class='".$prefijo.trim($laArreglo[$idtabla])."' selected>".$laArreglo[$text]."</option>";
					}else{
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' style=\"background:url('img/acti.png') no-repeat center left; padding-left:20px;\" class='".$prefijo.trim($laArreglo[$idtabla])."'>".$laArreglo[$text]."</option>";
					}
				}
				else
				{
					if( (isset($selected)) && ($selected == trim($laArreglo[$value])) ){
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' class='".$prefijo.trim($laArreglo[$idtabla])."' selected>".$laArreglo[$text]."</option>";
					}else{
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' class='".$prefijo.trim($laArreglo[$idtabla])."'>".$laArreglo[$text]."</option>";
					}
				}
			
		}
		$this->fpCierraFiltro($lrTb);
		return $llEnc;
	}
	

	function fncreateComboSelect($tabla, $tablados, $value, $concauno, $concaSplit, $concados, $text, $selected, $join, $idtabla, $idtablados)
	{
		$prefijo="Na";
		if ($tabla=="estado") 
		{
			$prefijo="Es";
		}
		elseif($tabla=="ciudad")
		{
			$prefijo="Ci";		
		}
		elseif($tabla=="municipio")
		{
			$prefijo="Mu";
		}
		elseif($tabla=="parroquia")
		{
			$prefijo="Pa";
		}

		if ($join=="")
		{
			$lsSql="SELECT * FROM $tabla";
		}
		elseif (($join!="")&&($tabla=="tsacerdote"))
		{
			$lsSql="SELECT $tabla.*, CONCAT($concauno, '$concaSplit',$concados, ' (', Cedula,')') AS $text FROM $tabla $join $tablados ON $idtabla=$idtablados";
		}
		else
		{
			$lsSql="SELECT $tabla.*, CONCAT($concauno, '$concaSplit',$concados) AS $text FROM $tabla $join $tablados ON $idtabla=$idtablados";
		}
		$this->fpConectar();
		$lrTb=$this->frFiltro($lsSql);
		while($laArreglo=$this->faProximo($lrTb))
		{	
			if ($laArreglo["Estatus"]=="")
			{
				if( (isset($selected)) && ($selected == trim($laArreglo[$value])) ){
					$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' class='".$prefijo.trim($laArreglo[$idtabla])."' selected>".$laArreglo[$text]."</option>";
				}else{
					$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' class='".$prefijo.trim($laArreglo[$idtabla])."'>".$laArreglo[$text]."</option>";
				}
			}
			else
			{
				if ($laArreglo["Estatus"]!="0")
				{
					if( (isset($selected)) && ($selected == trim($laArreglo[$value])) ){
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' class='".$prefijo.trim($laArreglo[$idtabla])."' selected>".$laArreglo[$text]."</option>";
					}else{
						$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' id='".$prefijo.trim($laArreglo[$value])."' class='".$prefijo.trim($laArreglo[$idtabla])."'>".$laArreglo[$text]."</option>";
					}
				}
			}
		}
		$this->fpCierraFiltro($lrTb);
		return $llEnc;
	}
	
	function fngetComboSelect($tabla,$value,$text,$padre,$value_padre,$selected)
	{
		$lsSql="select * from $tabla where $padre = $value_padre";
		$this->fpConectar();
		$lrTb=$this->frFiltro($lsSql);
		while($laArreglo=$this->faProximo($lrTb))
		{	
			if( (isset($selected)) && ($selected == trim($laArreglo[$value])) ){
				$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."' selected>".$laArreglo[$text]."</option>";
			}else{
				$llEnc=$llEnc."<option value='".trim($laArreglo[$value])."'>".$laArreglo[$text]."</option>";
			}
		}
		$this->fpCierraFiltro($lrTb);
		return $llEnc;
	}

	function DameCIyNaci($string)			//Regresa un arreglo de la CI y la Nacionalidad
	{
		$pos = strpos($string, "-");
		$string=ltrim($string);
		$string=rtrim($string);
		if($pos===false)
		{
			$result["0"]="V";
			$result["1"]=$string;
		}
		else	
		{
			$result=preg_split("/\/|-/",$string);  
		}
		if ($result["0"]=="")
		{
			$result["0"]="V";
		}
		return $result;
	}

	function fCadenaAleatoria($cant)
	{
		$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
		$cadena = ""; //variable para almacenar la cadena generada
		for($i=0;$i<$cant;$i++)
		{
		    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres 
		entre el rango 0 a Numero de letras que tiene la cadena */
		}
		return $cadena;
	}

	function fTipoPersona($ref)
	{
		$TipoPersonas = array("el Participante", "el Representante","la Novia","el Novio","el Feligrés");
		return $TipoPersonas[$ref];
	}

	function fDameEdad($fecha)
	{
		list($Y,$m,$d) = explode("-",$fecha);
  		return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	function fDameFechaEscrita($fecha)
	{
		$meses = array("Enero", "Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$dia=substr($fecha,8,10);
		$mes=substr($fecha,5,2);
		$mes=(string)(int)$mes-1;
		$año=substr($fecha,0,4);

		$string=$dia." de ".$meses[$mes]." de ".$año;
  		return $string;
	}

	function fDameHoraEstandar($tiempo)
	{
	$sufijo="a.m.";
	$hora=substr($tiempo,0,2);
	$minutos=substr($tiempo,3,2);
	$segundos=substr($tiempo,6,8);

	if($hora>12)
	{
		$hora=$hora-12;
		$sufijo="p.m.";
	}
	else if($hora==12)
	{
		$sufijo="p.m.";
	}
	$string=$hora.':'.$minutos.' '.$sufijo;
  		return $string;
	}


}

























?>