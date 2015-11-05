<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsCombos extends clsDatos{
private $asCod_Combo;
private $asForaneoID;
private $asDescripCombo;
private $asSelector;
private $asEstatus;
private $asNombreCombo;
private $DatosArrayDB;

//constructor de la clase		
public function __construct(){
$this->asCod_Combo = "";
$this->asForaneoID = "";
$this->asDescripCombo = "";
$this->asSelector = "";
$this->asNombreCombo = "";
$this->asEstatus = "";
$this->DatosArrayDB =array(
	"archiprestazgo" => array(1 => "codigoArchiPrestazgo", 2 => "nombre", 3 => ""),
	"tipo_agenda" => array(1 => "idtipoagenda", 2 => "descripcion", 3 => ""),
	"tipo_actividad" => array(1 => "idtipo_actividad", 2 => "nombre", 3 => "descripcion"),
	"ciudad" => array(1 => "cod_ciudad", 2 => "descripcion", 3 => "cod_foraneo"),
    "estado" => array(1 => "cod_estado", 2 => "descripcion", 3 => ""),
    "municipio" => array(1 => "cod_municipio", 2 => "descripcion", 3 => "cod_foraneo"),
    "parroquia" => array(1 => "cod_parroquia", 2 => "descripcion", 3 => "cod_foraneo"),
    "gradoestudio" => array(1 => "idTgradoEstudio", 2 => "Grado", 3 => ""),
    "iglesia" => array(1 => "idTiglesia", 2 => "Nombre", 3 => ""),
    "parentescorepre" => array(1 => "idTparentescoRepre", 2 => "Nombre", 3 => ""),
    "sacramento" => array(1 => "idTsacramento", 2 => "Nombre", 3 => ""),
    "tallafranela" => array(1 => "idTtallaFranela", 2 => "Talla", 3 => ""),
    "sacramento" => array(1 => "idTsacramento", 2 => "Nombre", 3 => ""),
    "tactividad" => array(1 => "codigoActividad", 2 => "nombre", 3 => "tipo_actividad"),
);
}

//metodo magico set
public function __set($atributo, $valor)
{
	$this->$atributo = $valor;

}		
//metodo get
public function __get($atributo)
{
	return trim(strtoupper($this->$atributo));
}
//destructor de la clase        
public function __destruct() { }





//funcion Buscar        
public function buscar()
{

$llEnc=false;
$lsSql="SELECT * FROM $this->asSelector WHERE (".$this->DatosArrayDB[$this->asSelector][2]." = '$this->asDescripCombo')";
$this->fpConectar();
$lrTb=$this->frFiltro($lsSql);
if($laRow=$this->faProximo($lrTb))
{		
	$this->asCod_Combo=$laRow[$this->DatosArrayDB[$this->asSelector][1]];
	$this->asDescripCombo=$laRow[$this->DatosArrayDB[$this->asSelector][2]];
	$this->asForaneoID=$laRow[$this->DatosArrayDB[$this->asSelector][3]];	
	$this->asEstatus=$laRow["Estatus"];	
	strtoupper($this->asDescripCombo);	
	$llEnc=true;
}
	$this->fpCierraFiltro($lrTb);
	$this->fpDesconectar();
return $llEnc;
}

public function buscar2()
{
$llEnc=false;
$lsSql="SELECT * FROM $this->asSelector WHERE (".$this->DatosArrayDB[$this->asSelector][1]." = '$this->asCod_Combo')";
$this->fpConectar();
$lrTb=$this->frFiltro($lsSql);
if($laRow=$this->faProximo($lrTb))
{		
	$this->asCod_Combo=$laRow[$this->DatosArrayDB[$this->asSelector][1]];
	$this->asDescripCombo=$laRow[$this->DatosArrayDB[$this->asSelector][2]];		
	$this->asForaneoID=$laRow[$this->DatosArrayDB[$this->asSelector][3]];	
	$this->asEstatus=$laRow["Estatus"];	
	strtoupper($this->asDescripCombo);	
	$llEnc=true;
}
	$this->fpCierraFiltro($lrTb);
	$this->fpDesconectar();
return $llEnc;
}

//funcion inlcuir
public function incluir()
{
	$this->fpConectar();
	strtoupper($this->asDescripCombo);
	if($this->DatosArrayDB[$this->asSelector][3]=="")
	{
		$lsSql="INSERT INTO $this->asSelector (".$this->DatosArrayDB[$this->asSelector][1].",".$this->DatosArrayDB[$this->asSelector][2].") VALUES ('$this->asCod_Combo','$this->asDescripCombo')";
	}
	else
	{
		$lsSql="INSERT INTO $this->asSelector (".$this->DatosArrayDB[$this->asSelector][1].",".$this->DatosArrayDB[$this->asSelector][2].",".$this->DatosArrayDB[$this->asSelector][3].") VALUES ('$this->asCod_Combo','$this->asDescripCombo','$this->asForaneoID')";
	}

	$lbecho=$this->fbEjecutarNoDie($lsSql);
	$this->fpDesconectar();
	return $lbecho;
}
        


//funcion modificar
public function modificar()
{
	$this->fpConectar();
	strtoupper($this->asDescripCombo);
	if($this->DatosArrayDB[$this->asSelector][3]=="")
	{	
		$lsSql="UPDATE $this->asSelector SET ".$this->DatosArrayDB[$this->asSelector][2]." = '$this->asDescripCombo' WHERE (".$this->DatosArrayDB[$this->asSelector][1]." = '$this->asCod_Combo')";
	}
	else
	{
		$lsSql="UPDATE $this->asSelector SET ".$this->DatosArrayDB[$this->asSelector][2]." = '$this->asDescripCombo', ".$this->DatosArrayDB[$this->asSelector][3]." = '$this->asForaneoID' WHERE (".$this->DatosArrayDB[$this->asSelector][1]." = '$this->asCod_Combo')";
	}
	$lbecho=$this->fbEjecutarNoDie($lsSql);
	$this->fpDesconectar();
	return $lbecho;
}
 
 
//funcion desactivar        
public function desactivar()
{
	$this->fpConectar();
	$lsSql="UPDATE $this->asSelector SET Estatus = '0' WHERE (".$this->DatosArrayDB[$this->asSelector][1]." = '$this->asCod_Combo')";
	$lbecho=$this->fbEjecutarNoDie($lsSql);
	$this->fpDesconectar();
	return $lbecho;
}
public function reactivar()
{
	$this->fpConectar();
	$lsSql="UPDATE $this->asSelector SET Estatus = '1' WHERE (".$this->DatosArrayDB[$this->asSelector][1]." = '$this->asCod_Combo')";
	$lbecho=$this->fbEjecutarNoDie($lsSql);
	$this->fpDesconectar();
	return $lbecho;
}
//fin clase
}?>