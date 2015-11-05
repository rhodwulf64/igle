<?php
	/*
    *      clsEstudiante.php
    *      
    *      Copyright 2014 José Silva <jobasiher@cantv.net>
    *      
    *      Este programa es software libre, puede redistribuirlo y / o modificar
    *      Bajo los términos de la GNU Licensia Pública General(GPL) publicada por
    *      La Fundación de Software Libre(FSF), bien de la versión 2 o cualquier versión posterior.
    *      
    *      Este programa se distribuye con la esperanza de que sea útil,
    *      Pero SIN NINGUNA GARANTÍA, incluso sin la garantía implícita de
    *      COMERCIALIZACIÓN o IDONEIDAD PARA UN PROPÓSITO PARTICULAR.
    */
    require_once("clsDatos.php");
	class clsEstudiante extends clsDatos
	{
		private $asCedula;
		private $asNombre;
		private $asApellido;
		private $asFecha_Naci;
		private $asSexo;
		private $asE_Civil;
		
		public function __construct()
		{
			$this->asCedula="";
			$this->asNombre="";
			$this->asApellido="";
			$this->asFecha_Naci="";
			$this->asSexo="";
			$this->asE_Civil="";
		}
		
		public function __destruct()
		{
		}
		
		public function fpSetCedula($psCedula)
		{
			$this->asCedula=$psCedula;
		}
		
		public function fpSetNombre($psNombre)
		{
			$this->asNombre=$psNombre;
		}
		
		public function fpSetApellido($psApellido)
		{
			$this->asApellido=$psApellido;
		}
		
		public function fpSetFecha_Naci($psFecha_Naci)
		{
			$this->asFecha_Naci=$psFecha_Naci;
		}
		
		public function fpSetSexo($psSexo)
		{
			$this->asSexo=$psSexo;
		}
		
		public function fpSetE_Civil($psE_Civil)
		{
			$this->asE_Civil=$psE_Civil;
		}
		
		public function fsGetCedula()
		{
			return $this->asCedula;
		}
		
		public function fsGetNombre()
		{
			return $this->asNombre;
		}
		
		public function fsGetApellido()
		{
			return $this->asApellido;
		}
		
		public function fsGetFecha_Naci()
		{
			return $this->asFecha_Naci;
		}
		
		public function fsGetSexo()
		{
			return $this->asSexo;
		}
		
		public function fsGetE_Civil()
		{
			return $this->asE_Civil;
		}
		
		public function fbBuscar()
		{
			$lbEnc=false;
			print $lsSql="SELECT *,date_format(fecha_naci,'%d-%m-%Y') as fecha_naci FROM estudiante WHERE cedula='$this->asCedula'";
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asCedula=$laArreglo["cedula"];
				$this->asNombre=$laArreglo["nombre"];
				$this->asApellido=$laArreglo["apellido"];
				$this->asFecha_Naci=$laArreglo["fecha_naci"];
				$this->asSexo=$laArreglo["sexo"];
				$this->asE_Civil=$laArreglo["e_civil"];
				$lbEnc=true;
			}
			
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $lbEnc;
		}
		
		
		public function fbIncluir()
		{
			$lbHecho=false;
			$this->asFecha_Naci=parent::fsFecha_B($this->asFecha_Naci);
			print $lsSql="INSERT INTO estudiante 
					(cedula,nombre,apellido,fecha_naci,sexo,e_civil) VALUES 
					('$this->asCedula','$this->asNombre','$this->asApellido','$this->asFecha_Naci','$this->asSexo','$this->asE_Civil')";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function fbModificar()
		{
			$lbHecho=false;
			$this->asFecha_Naci=parent::fsFecha_B($this->asFecha_Naci);
			print $lsSql="UPDATE estudiante SET nombre='$this->asNombre',apellido='$this->asApellido',fecha_naci='$this->asFecha_Naci',
					sexo='$this->asSexo',e_civil='$this->asE_Civil' WHERE cedula='$this->asCedula'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function fbEliminar()
		{
			$lbHecho=false;
			$lsSql="DELETE FROM estudiante WHERE cedula='$this->asCedula'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutar($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function faListar()
		{
			$lsSql="select * from estudiante";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["cedula"]=$laArreglo["cedula"];
				$laMatriz[$liI]["nombre"]=$laArreglo["nombre"];
				$laMatriz[$liI]["apellido"]=$laArreglo["apellido"];
				$laMatriz[$liI]["fecha_naci"]=$laArreglo["fecha_naci"];
				$laMatriz[$liI]["e_civil"]=$laArreglo["e_civil"];
				$laMatriz[$liI]["sexo"]=$laArreglo["sexo"];
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
