<?php

	class clsDatos
	{
		private $arCon;
		private $asIDinsertado;
		private function __construct()
		{
			$this->asIDinsertado="";
		}
		
		private function __destruct()
		{
		}

		protected function fpGetIDinsertado()
		{
			return $this->asIDinsertado;
		}
		
		protected function fpConectar()
		{
			$lsServidor="localhost:3306";
			$lsUsuario="job";
			$lsContrasena="1234";
			$lsBaseDatos="diglesia4";
			$this->arCon=mysql_connect($lsServidor,$lsUsuario,$lsContrasena) or die('No se pudo conectar'. mysql_error()); //conectar con el servidor
			mysql_select_db($lsBaseDatos,$this->arCon) or die('Selección invalida'. mysql_error());
			mysql_query("SET NAMES utf8");
		}
		
		protected function FilasRecibidas($matrix)
		{
			$numeroFilas = mysql_num_rows($matrix);
			return $numeroFilas;
		}

		protected function frFiltro($psSql)
		{
			$lrTb=mysql_query($psSql,$this->arCon) or die('No se pudo hacer la busqueda'. mysql_error());
			return $lrTb;
		}
		
		protected function faProximo($prTb)
		{
			$laArreglo=mysql_fetch_array($prTb);
			return $laArreglo;
		}
		
		protected function fpCierraFiltro($prTb)
		{
			mysql_free_result($prTb);
		}
		
		protected function fpDesconectar()
		{
			mysql_close($this->arCon);
		}
		
		protected function fbEjecutar($psSql)
		{
			$lrTb=mysql_query($psSql,$this->arCon) or die('No se pudo hacer la ejecución -'. mysql_error());
			if (mysql_affected_rows($this->arCon)<=0)
			{
				return false;
			}
			else
			{
				$this->asIDinsertado=mysql_insert_id($this->arCon);
				return true;
			}
		}

		protected function fbEjecutarNoDie($psSql)
		{
			$lrTb=mysql_query($psSql,$this->arCon);
			if (mysql_affected_rows($this->arCon)<=0)
			{

				return false;
			}
			else
			{
				$this->asIDinsertado=mysql_insert_id($this->arCon);
				return true;
			}
		}

		protected function fpBegin()
	    {
	        mysql_query("BEGIN",$this->arCon);
	    }
	  
	    protected function fpCommit()
	    {
	        mysql_query("COMMIT",$this->arCon);
	    }
	  
	    protected function fpRollback()
	    {
	        mysql_query("ROLLBACK",$this->arCon);
	    }
		
		protected function fsFecha_B($psFecha)
		{
			$lsHoy=date("Y-m-d");
			if(strlen($psFecha)==10)
			{
				$lsDia=substr($psFecha,0,2);
				$lsMes=substr($psFecha,3,2);
				$lsAno=substr($psFecha,6,4);
				$lsHoy=$lsAno."-".$lsMes."-".$lsDia;
			}
			return $lsHoy;
		}

		protected function fechafrombd($pcFecha){
	  	 $lcNow="now()";
	  	 if (strlen($pcFecha)==10)
	  	 {
	  	 	$lcYear=substr($pcFecha,0,4);
	  	 	$lcMes=substr($pcFecha,5,2);
	  	 	$lcDia=substr($pcFecha,8,2);
	  	 	$lcNow=$lcDia."-".$lcMes."-".$lcYear;
	  	 }
	  	 return $lcNow;
	  }

		
	}
?>
