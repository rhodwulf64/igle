<?php
include_once("clsDatos.php");
class  cls_Calendario extends  clsDatos{
		private $aa_Form;
		private $as_Cadena;

		public function __construct()
		{
			$this->aa_Eventos=Array();
			$this->as_Cadena="";
		}
		public function __destruct()
		{
		}
		public function Cargar($tabla){
			$lii=0;
			$ls_Sql="SELECT 
			tage.codigoAgenda,
			tage.idFcodigo_actividad,
			tage.fecha_act_Inicio,
			tage.hora_act_Inicio,
			tage.fecha_act_Fin,
			tage.hora_act_Fin,
			DATE_FORMAT(tage.hora_act_Inicio,'%h:%i %p') AS HoraExactaInicio,
			DATE_FORMAT(tage.hora_act_Fin,'%h:%i %p') AS HoraExactaFin,
			tage.idFcodigo_pastoral,
			tage.lugar,
			tage.idFcodigo_grupo,
			tage.FechaRegistro,
			tage.EstadoAgenda,
			tage.Estatus AS Agenda_Estatus,
			tacti.codigoActividad,
			tacti.nombre,
			tacti.tipo_actividad,
			tacti.Estatus AS Actividad_Estatus 
			FROM ".$tabla." AS tage 
			LEFT JOIN tactividad AS tacti ON tage.idFcodigo_actividad = tacti.codigoActividad";							
			$this->fpConectar();																								
			$lr_Tabla=$this->frFiltro($ls_Sql);																			
			while($la_Tupla=$this->faProximo($lr_Tabla)){		
				$this->aa_Eventos[$lii]["Codigo"]=$la_Tupla["codigoAgenda"];
				$this->aa_Eventos[$lii]["Actividad"]=$la_Tupla["idFcodigo_actividad"];
				$this->aa_Eventos[$lii]["Fecha_Ini"]=$la_Tupla["fecha_act_Inicio"];
				$this->aa_Eventos[$lii]["Hora_Ini"]=$la_Tupla["hora_act_Inicio"];
				$this->aa_Eventos[$lii]["Hora_Fin"]=$la_Tupla["fecha_act_Fin"];
				$this->aa_Eventos[$lii]["Hora_Fin"]=$la_Tupla["hora_act_Fin"];
				$this->aa_Eventos[$lii]["HoraExacta"]=$la_Tupla["HoraExactaInicio"];
				$this->aa_Eventos[$lii]["HoraExactaFin"]=$la_Tupla["HoraExactaFin"];
				$this->aa_Eventos[$lii]["codigoPastoral"]=$la_Tupla["idFcodigo_pastoral"];
				$this->aa_Eventos[$lii]["lugar_enc"]=$la_Tupla["lugar"];
				$this->aa_Eventos[$lii]["codigoGrupo"]=$la_Tupla["idFcodigo_grupo"];
				$this->aa_Eventos[$lii]["FechaRegistro"]=$la_Tupla["FechaRegistro"];
				$this->aa_Eventos[$lii]["Nombre"]=$la_Tupla["nombre"];
				$this->aa_Eventos[$lii]["tipo_acti"]=$la_Tupla["tipo_actividad"];
				$this->aa_Eventos[$lii]["EstadoAgenda"]=$la_Tupla["EstadoAgenda"];
				$this->aa_Eventos[$lii]["Agenda_Estatus"]=$la_Tupla["Agenda_Estatus"];
				$this->aa_Eventos[$lii]["Actividad_Estatus"]=$la_Tupla["Actividad_Estatus"];
				$this->aa_Eventos[$lii]["Color"]="ff0000";
				if(is_null($this->aa_Eventos[$lii]["codigoPastoral"]))
				{
					$this->aa_Eventos[$lii]["codigoPastoral"]="'-'";
				}		

				if(is_null($this->aa_Eventos[$lii]["codigoGrupo"]))
				{
					$this->aa_Eventos[$lii]["codigoGrupo"]="'-'";
				}

				$lii++;
			}		
			$this->fpCierraFiltro($lr_Tabla);
			$this->fpDesconectar();

		}
		public function eventos(){
			for($lix=0;$lix<count($this->aa_Eventos);$lix++){
				$diaI=substr($this->aa_Eventos[$lix]["Fecha_Ini"], 8,2);
				$diaF=substr($this->aa_Eventos[$lix]["Fecha_Ini"], 8,2);
				$mesI=substr($this->aa_Eventos[$lix]["Fecha_Ini"], 5,2);
				$mesF=substr($this->aa_Eventos[$lix]["Fecha_Ini"], 5,2);
				$anoI=substr($this->aa_Eventos[$lix]["Fecha_Ini"], 0,4);
				$anoF=substr($this->aa_Eventos[$lix]["Fecha_Ini"], 0,4);
				echo "\n\t{";
				echo "\n\t\tid: ".$this->aa_Eventos[$lix]["Codigo"].",";
				echo "\n\t\ttitle: '".$this->aa_Eventos[$lix]["Nombre"]."',";
				echo "\n\t\tstart: new Date($anoI,".($mesI-1).",$diaI),";
				echo "\n\t\tend: new Date($anoF,".($mesF-1).",$diaF),";
				echo "\n\t\thora_ini: '".$this->aa_Eventos[$lix]["Hora_Ini"]."',";
				echo "\n\t\thora_Exacta: '".$this->aa_Eventos[$lix]["HoraExacta"]."',";
				echo "\n\t\tactividad: ".$this->aa_Eventos[$lix]["Actividad"].",";
				echo "\n\t\tgrupo_apos: ".$this->aa_Eventos[$lix]["codigoGrupo"].",";
				echo "\n\t\tpastoral: ".$this->aa_Eventos[$lix]["codigoPastoral"].",";
				echo "\n\t\ttipo_acti: ".$this->aa_Eventos[$lix]["tipo_acti"].",";
				echo "\n\t\tlugar_enc: '".$this->aa_Eventos[$lix]["lugar_enc"]."',";
				echo "\n\t\tcolor: '".$this->aa_Eventos[$lix]["Color"]."',";
				echo "\n\t\tevento_Estatus: ".$this->aa_Eventos[$lix]["Agenda_Estatus"]."";
				if($lix!=count($this->aa_Eventos)-1){
					echo "\n\t},";
				}else{
					echo "\n\t}";
				}
			}
		}
		
		public function f_Cabecera(){
		echo "<div ddt>
				<input type='button' id='atras' title='Atras' onclick='window.history.back();'>
				<div id='nom_usu'>";
					print('<span align="right">Bienvenido: '.$_SESSION['usuario']['Nombre'].'</span>');
					print('<span id="hora">Hora: '.date('h:i:s').'</span>');
					print('<span id="hora">Fecha: '.date('d-m-Y').'</span>');
				echo "</div>";
		echo"</div>";
	}
}
