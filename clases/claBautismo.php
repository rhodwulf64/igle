<?php

    require_once("clsDatos.php");
    require_once("claPersonas.php");
    $loPersona=new claPersonas();
	class claBautismo extends clsDatos
	{

		private $asIDbautizo;
		private $asFechaInscri;
		private $asFechaBautizo;
		private $asMatrizPadri;
		private $asFilaPadri;
		private $asReferenciaInfante;
		private $asNombresBau;
		private $asApellidosBau;
		private $asSexoBau;
		private $asFechaNacimiento;
		private $asBautizado;
		private $asDireccion;
		private $asIDestado;
		private $asIDciudad;
		private $asIDmunicipio;
		private $asIDparroquia;		
		private $asNacioRepre;
		private $asCeduRepre;
		private $asIDParentesco;
		private $asIDrepresentante;
		private $asNacioMama;
		private $asCeduMama;
		private $asNacioPapa;
		private $asCeduPapa;
		private $asNombRepre;
		private $asApellRepre;
		private $asSexoRepre;
		private $asNombMama;
		private $asApellMama;
		private $asNombPapa;
		private $asApellPapa;
		private $asIDmama;
		private $asIDpapa;
		private $asIDSacerdote;
		private $asNombreSacer;
		private $asIDMinistro;
		private $asNombreMinistro;
		private $asNotaMarginal;
		private $asPrefectuDe;
		private $asPresentadoEl;
		private $asNumPartidaNac;
		private $asLibro_registro;
		private $asFolio_registro;
		private $asNumero_registro;
		private $asEstatusBau;
		private $asFechaInicioR;
		private $asFechaFinR;
		private $asNombEstado;
		private $asNombMunicipio;
		private $asNombParroquia;
		private $asNombCiudad;





		public function __construct()
		{

			$this->asIDbautizo="";
			$this->asFechaInscri="";
			$this->asFechaBautizo="";
			$this->asMatrizPadri="";
			$this->asFilaPadri="";
			$this->asReferenciaInfante="";
			$this->asNombresBau="";
			$this->asApellidosBau="";
			$this->asSexoBau="";
			$this->asFechaNacimiento="";
			$this->asBautizado="";
			$this->asDireccion="";
			$this->asIDestado="";
			$this->asIDciudad="";
			$this->asIDmunicipio="";
			$this->asIDparroquia="";
			$this->asNacioRepre="";
			$this->asNacioMama="";
			$this->asNacioPapa="";
			$this->asCeduRepre="";
			$this->asIDParentesco="";
			$this->asNombRepre="";
			$this->asApellRepre="";
			$this->asSexoRepre="";
			$this->asCeduMama="";
			$this->asNombMama="";
			$this->asApellMama="";
			$this->asCeduPapa="";
			$this->asNombPapa="";
			$this->asApellPapa="";
			$this->asIDrepresentante="";
			$this->asIDmama="";
			$this->asIDpapa="";
			$this->asIDSacerdote="";
			$this->asNombreSacer="";
			$this->asIDMinistro="";
			$this->asNombreMinistro="";
			$this->asNotaMarginal="";
			$this->asPrefectuDe="";
			$this->asPresentadoEl="";
			$this->asNumPartidaNac="";
			$this->asLibro_registro="";
			$this->asFolio_registro="";
			$this->asNumero_registro="";
			$this->asEstatusBau="";
			$this->asFechaInicioR="";
			$this->asFechaFinR="";
			$this->asCiudadNombre="";
			$this->asEstadoNombre="";
			$this->asNombEstado="";
			$this->asNombMunicipio="";
			$this->asNombParroquia="";
			$this->asNombCiudad="";


		}
		
		public function __destruct()
		{
		}

		public function fpSetMatrizPadri($psMatrizPadri)
		{
			$this->asMatrizPadri=$psMatrizPadri;
		}

				//metodo magico set
		public function __set($atributo, $valor){ $this->$atributo = $valor;}		
		//metodo get
		public function __get($atributo){ return trim(strtoupper($this->$atributo)); }




		public function fbBuscarBauti()
		{
			$lbEnc=false;
			$lsSql="SELECT 
			tbautizo.idTbautizo, 
			tbautizo.FechaInscri, 
			tbautizo.FechaBautizo, 
			tbautizo.ReferenciaInfante, 
			tbautizo.Nombres AS NombresBau, 
			tbautizo.Apellidos  AS ApellidosBau, 
			tbautizo.Sexo AS SexoBau, 
			tbautizo.FechaNaci, 
			tbautizo.idFrepresentante AS idFrepre, 
			tbautizo.idFmama, 
			tbautizo.idFpapa, 
			tbautizo.Bautizado, 
			tbautizo.Direccion, 
			tbautizo.idFestado, 
			tbautizo.idFciudad, 
			tbautizo.idFmunicipio, 
			tbautizo.idFparroquia, 
			tedo.descripcion AS NombEstado, 
			tedo.cod_estado, 
			tcdd.descripcion AS NombCiudad, 
			tcdd.cod_ciudad, 
			tmpo.descripcion AS NombMunicipio, 
			tmpo.cod_municipio, 
			tpqa.descripcion AS NombParroquia, 
			tpqa.cod_parroquia, 
			trepre.Nacionalidad AS NacioRepre, 
			trepre.Cedula AS CeduRepre, 
			tparen.idTparentescoRepre AS IDParentesco,  
			tmama.Nacionalidad AS NacioMama, 
			tmama.Cedula AS CeduMama, 
			CONCAT(tmama.Nombres,' ',tmama.Apellidos) AS NombreMama, 
			tpapa.Nacionalidad AS NacioPapa, 
			tpapa.Cedula AS CeduPapa, 
			CONCAT(tpapa.Nombres,' ',tpapa.Apellidos) AS NombrePapa, 
			tbautizo.NotaMarginal, 
			tbautizo.PrefectuDe, 
			tbautizo.PresentadoEl, 
			tbautizo.NumPartidaNac, 
			tbautizo.Libro_registro, 
			tbautizo.Folio_registro, 
			tbautizo.Numero_registro, 
			tbautizo.Estatus, 
			tminis.idTsacerdote AS IDSacerdote, 
			tminis.idFpersona,
			tsacer.idTsacerdote AS IDMinistro,
			tsacer.idFpersona,
			CONCAT(datMinis.Nombres,' ', datMinis.Apellidos) AS NombreMinistroFull,
			CONCAT(datSacer.Nombres,' ', datSacer.Apellidos) AS NombreSacerFull
			FROM tbautizo 
			INNER JOIN tpersonas AS trepre on tbautizo.idFrepresentante = trepre.idTpersonas 
			INNER JOIN tpersonas AS tmama on tbautizo.idFmama = tmama.idTpersonas 
			INNER JOIN tpersonas AS tpapa on tbautizo.idFpapa = tpapa.idTpersonas 
			INNER JOIN parentescorepre AS tparen on tbautizo.idFparentescoRep = tparen.idTparentescoRepre 
			INNER JOIN tsacerdote AS tminis on tbautizo.idFministro = tminis.idTsacerdote 
			INNER JOIN tsacerdote AS tsacer on tbautizo.idFsacerdote = tsacer.idTsacerdote 
			INNER JOIN tpersonas AS datSacer on tsacer.idFpersona = datSacer.idTpersonas
			INNER JOIN tpersonas AS datMinis on tminis.idFpersona = datMinis.idTpersonas
			LEFT JOIN estado AS tedo ON tbautizo.idFestado = tedo.cod_estado 
			LEFT JOIN ciudad AS tcdd ON tbautizo.idFciudad = tcdd.cod_ciudad 
			LEFT JOIN municipio AS tmpo ON tbautizo.idFmunicipio = tmpo.cod_municipio 
			LEFT JOIN parroquia AS tpqa ON tbautizo.idFparroquia = tpqa.cod_parroquia
			WHERE ReferenciaInfante='$this->asReferenciaInfante'";

			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))
			{
				$this->asIDbautizo=$laArreglo["idTbautizo"];
				$this->asFechaInscri=$laArreglo["FechaInscri"];
				$this->asFechaBautizo=$laArreglo["FechaBautizo"];
				$this->asReferenciaInfante=$laArreglo["ReferenciaInfante"];
				$this->asNombresBau=$laArreglo["NombresBau"];
				$this->asApellidosBau=$laArreglo["ApellidosBau"];
				$this->asSexoBau=$laArreglo["SexoBau"];
				$this->asFechaNacimiento=$laArreglo["FechaNaci"];
				$this->asBautizado=$laArreglo["Bautizado"];
				$this->asDireccion=$laArreglo["Direccion"];
				$this->asIDestado=$laArreglo["idFestado"];
				$this->asIDciudad=$laArreglo["idFciudad"];
				$this->asIDmunicipio=$laArreglo["idFmunicipio"];
				$this->asIDparroquia=$laArreglo["idFparroquia"];
				$this->asNacioRepre=$laArreglo["NacioRepre"];
				$this->asCeduRepre=$laArreglo["CeduRepre"];
				$this->asIDParentesco=$laArreglo["IDParentesco"];
				$this->asNacioMama=$laArreglo["NacioMama"];
				$this->asCeduMama=$laArreglo["CeduMama"];
				$this->asNombMama=$laArreglo["NombreMama"];
				$this->asNacioPapa=$laArreglo["NacioPapa"];
				$this->asCeduPapa=$laArreglo["CeduPapa"];
				$this->asNombPapa=$laArreglo["NombrePapa"];
				$this->asIDrepresentante=$laArreglo["idFrepre"];
				$this->asIDmama=$laArreglo["idFmama"];
				$this->asIDpapa=$laArreglo["idFpapa"];
				$this->asIDSacerdote=$laArreglo["IDSacerdote"];
				$this->asNombreMinistro=$laArreglo["NombreMinistroFull"];
				$this->asNombreSacer=$laArreglo["NombreSacerFull"];
				$this->asIDMinistro=$laArreglo["IDMinistro"];
				$this->asNotaMarginal=$laArreglo["NotaMarginal"];
				$this->asPrefectuDe=$laArreglo["PrefectuDe"];
				$this->asPresentadoEl=$laArreglo["PresentadoEl"];
				$this->asNumPartidaNac=$laArreglo["NumPartidaNac"];
				$this->asLibro_registro=$laArreglo["Libro_registro"];
				$this->asFolio_registro=$laArreglo["Folio_registro"];
				$this->asNumero_registro=$laArreglo["Numero_registro"];
				$this->asNombEstado=$laArreglo["NombEstado"];
				$this->asNombMunicipio=$laArreglo["NombMunicipio"];
				$this->asNombParroquia=$laArreglo["NombParroquia"];
				$this->asNombCiudad=$laArreglo["NombCiudad"];
				$this->asEstatusBau=$laArreglo["Estatus"];
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
						tbautizo.idTbautizo, 
						tbautizo.FechaInscri, 
						tbautizo.FechaBautizo, 
						tbautizo.ReferenciaInfante, 
						tbautizo.Nombres AS NombresBau, 
						tbautizo.Apellidos  AS ApellidosBau, 
						tbautizo.Sexo AS SexoBau, 
						tbautizo.FechaNaci, 
						tbautizo.idFrepresentante AS idFrepre, 
						tbautizo.idFmama, 
						tbautizo.idFpapa, 
						tbautizo.Bautizado, 
						tbautizo.Direccion, 
						tbautizo.idFestado, 
						tbautizo.idFciudad, 
						tbautizo.idFmunicipio, 
						tbautizo.idFparroquia, 
						trepre.Cedula AS CeduRepre, 
						tparen.idTparentescoRepre AS IDParentesco,  
						tmama.Cedula AS CeduMama, 
						tpapa.Cedula AS CeduPapa, 
						tbautizo.NotaMarginal, 
						tbautizo.PrefectuDe, 
						tbautizo.PresentadoEl, 
						tbautizo.NumPartidaNac, 
						tbautizo.Libro_registro, 
						tbautizo.Folio_registro, 
						tbautizo.Numero_registro, 
						tbautizo.Estatus, 
						tminis.idTsacerdote AS IDSacerdote, 
						tsacer.idTsacerdote AS IDMinistro 
						FROM tbautizo INNER JOIN tpersonas AS trepre on tbautizo.idFrepresentante = trepre.idTpersonas 
						INNER JOIN tpersonas AS tmama on tbautizo.idFmama = tmama.idTpersonas 
						INNER JOIN tpersonas AS tpapa on tbautizo.idFpapa = tpapa.idTpersonas 
						INNER JOIN parentescorepre AS tparen on tbautizo.idFparentescoRep = tparen.idTparentescoRepre 
						INNER JOIN tsacerdote AS tminis on tbautizo.idFministro = tminis.idTsacerdote 
						INNER JOIN tsacerdote AS tsacer on tbautizo.idFsacerdote = tsacer.idTsacerdote 
						WHERE ReferenciaInfante='$this->asReferenciaInfante'");
				break;
				case "proximo":
					$lsSql=("SELECT tbautizo.idTbautizo, tbautizo.FechaInscri, tbautizo.FechaBautizo, tbautizo.ReferenciaInfante, tbautizo.Nombres AS NombresBau, tbautizo.Apellidos  AS ApellidosBau, tbautizo.Sexo AS SexoBau, tbautizo.FechaNaci, tbautizo.idFrepresentante AS idFrepre, tbautizo.idFmama, tbautizo.idFpapa, tbautizo.Bautizado, tbautizo.Direccion, tbautizo.idFestado, tbautizo.idFciudad, tbautizo.idFmunicipio, tbautizo.idFparroquia, tbautizo.ReferenciaInfante, trepre.Cedula AS CeduRepre, CONCAT(trepre.Nombres, ' ', trepre.Apellidos) AS RepreFull, tparen.idTparentescoRepre AS IDParentesco,  tmama.Cedula AS CeduMama, tpapa.Cedula AS CeduPapa, tbautizo.NotaMarginal, tbautizo.PrefectuDe, tbautizo.PresentadoEl, tbautizo.NumPartidaNac, tbautizo.Libro_registro, tbautizo.Folio_registro, tbautizo.Numero_registro, tbautizo.Estatus, tminis.idTsacerdote AS IDSacerdote, tsacer.idTsacerdote AS IDMinistro FROM tbautizo INNER JOIN tpersonas AS trepre on tbautizo.idFrepresentante = trepre.idTpersonas INNER JOIN tpersonas AS tmama on tbautizo.idFmama = tmama.idTpersonas INNER JOIN tpersonas AS tpapa on tbautizo.idFpapa = tpapa.idTpersonas INNER JOIN parentescorepre AS tparen on tbautizo.idFparentescoRep = tparen.idTparentescoRepre INNER JOIN tsacerdote AS tminis on tbautizo.idFministro = tminis.idTsacerdote INNER JOIN tsacerdote AS tsacer on tbautizo.idFsacerdote = tsacer.idTsacerdote
					WHERE ( (tbautizo.Nombres like '%$cadena%') or (tbautizo.Apellidos like '%$cadena%') or (trepre.Cedula like '%$cadena%') or (tmama.Cedula like '%$cadena%') or (tpapa.Cedula like '%$cadena%') or (tbautizo.NumPartidaNac like '%$cadena%') or (tbautizo.ReferenciaInfante like '%$cadena%') or (tbautizo.Libro_registro like '%$cadena%') or (tbautizo.Folio_registro like '%$cadena%') or (tbautizo.Numero_registro like '%$cadena%'))");
				break;
			}

			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);

			while($laArreglo=$this->faProximo($lrTb))
			{
				$arr[] = $laArreglo;
			}
			$this->fpCierraFiltro($lrTb);
			return $arr;
		}
		

		public function fbBuscarPadrinoExiste($RefInfante,$CIpadri)
		{
			
			$lbEnc=array();
			$lbEnc["resulta"]=false;
			$lsSql="SELECT * FROM tbautizopadrino WHERE idFbautizo =(SELECT idTbautizo FROM tbautizo WHERE ReferenciaInfante='$RefInfante') AND idFpadrino=(SELECT idTpersonas FROM tpersonas WHERE Cedula='$CIpadri')"; 
			
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))	
			{
				$lbEnc["idFbautizo"]=$laArreglo["idFbautizo"];
				$lbEnc["idFpadrino"]=$laArreglo["idFpadrino"];
				$lbEnc["Tipo"]=$laArreglo["Tipo"];
				$LbEnc["FechaRegistroPadri"]=$laArreglo["FechaRegistroPadri"];
				$lbEnc["Estatus"]=$laArreglo["Estatus"];
				$lbEnc["resulta"]=true;
			}
			
			$this->fpCierraFiltro($lrTb);
			
			return $lbEnc;

		}

		public function fbBuscarPersonaExiste($nacionalidad, $cedPersona)
		{
			if ($nacionalidad!="")
			{
				$cedPersona=$nacionalidad.'-'.$cedPersona;
			}



			$lbEnc=false;
			$lsSql="SELECT * FROM tpersonas WHERE Cedula='$cedPersona'"; 
			$lrTb=$this->frFiltro($lsSql);
			if($laArreglo=$this->faProximo($lrTb))	
			{
				$lbEnc=true;
			}
			
			$this->fpCierraFiltro($lrTb);
			
			return $lbEnc;

		}
		
			
		public function fbIncluir()
		{

			$lbHecho=false;
			$lbHecho1=false;
			$lbHecho2=false;
			$lbHecho3=false;
			$cnfalse=0;
			$this->fpConectar();

			$DB_CeduRepre=$this->fbBuscarPersonaExiste($this->asNacioRepre,$this->asCeduRepre);
			$DB_CeduMama=$this->fbBuscarPersonaExiste($this->asNacioMama,$this->asCeduMama);
			$DB_CeduPapa=$this->fbBuscarPersonaExiste($this->asNacioPapa,$this->asCeduPapa);

			if ($this->asNacioRepre!="")
			{
				$this->asCeduRepre=$this->asNacioRepre.'-'.$this->asCeduRepre;
			}

			if ($this->asNacioMama!="")
			{
				$this->asCeduMama=$this->asNacioMama.'-'.$this->asCeduMama;
			}

			if ($this->asNacioPapa!="")
			{
				$this->asCeduPapa=$this->asNacioPapa.'-'.$this->asCeduPapa;
			}


			$MatrixPadri=$this->asMatrizPadri;	
			parent::fpBegin();
			if ($DB_CeduRepre)
			{
				$lbHecho1=true;
			}
			else
			{
				$lsSql="INSERT INTO tpersonas 
				(Nacionalidad,Cedula,Nombres,Apellidos,Sexo) VALUES 
				('".$this->asNacioRepre."','".$this->asCeduRepre."','".$this->asNombRepre."','".$this->asApellRepre."','".$this->asSexoRepre."')";
				$lbHecho1=$this->fbEjecutarNoDie($lsSql);
			}
			if ($DB_CeduMama)
			{
				$lbHecho2=true;
			}
			else
			{
				$lsSql="INSERT INTO tpersonas 
				(Nacionalidad,Cedula,Nombres,Apellidos,Sexo) VALUES 
				('".$this->asNacioMama."','".$this->asCeduMama."','".$this->asNombMama."','".$this->asApellMama."','F')";
				$lbHecho2=$this->fbEjecutarNoDie($lsSql);
			}
			if ($DB_CeduPapa)
			{
				$lbHecho3=true;
			}
			else
			{
				$lsSql="INSERT INTO tpersonas 
				(Nacionalidad,Cedula,Nombres,Apellidos,Sexo) VALUES 
				('".$this->asNacioPapa."','".$this->asCeduPapa."','".$this->asNombPapa."','".$this->asApellPapa."','M')";
				$lbHecho3=$this->fbEjecutarNoDie($lsSql);
			}

			if(($lbHecho1)&&($lbHecho2)&&($lbHecho3))
			{
				$lsSql="INSERT INTO tbautizo 
					(FechaBautizo,ReferenciaInfante,Nombres,Apellidos,Sexo,FechaNaci,Bautizado,Direccion,idFestado,idFciudad,idFmunicipio,idFparroquia,idFrepresentante,idFparentescoRep,idFmama,idFpapa,idFsacerdote,idFministro,NotaMarginal,PrefectuDe,PresentadoEl,NumPartidaNac,Libro_registro,Folio_registro,Numero_registro,Estatus) VALUES ('$this->asFechaBautizo','$this->asReferenciaInfante','$this->asNombresBau','$this->asApellidosBau','$this->asSexoBau','$this->asFechaNacimiento','1','$this->asDireccion','$this->asIDestado','$this->asIDciudad','$this->asIDmunicipio','$this->asIDparroquia',(SELECT idTpersonas FROM tpersonas WHERE Cedula='$this->asCeduRepre'),'$this->asIDParentesco',(SELECT idTpersonas FROM tpersonas WHERE Cedula='$this->asCeduMama'),(SELECT idTpersonas FROM tpersonas WHERE Cedula='$this->asCeduPapa'),'$this->asIDSacerdote','$this->asIDMinistro','$this->asNotaMarginal','$this->asPrefectuDe','$this->asPresentadoEl','$this->asNumPartidaNac','$this->asLibro_registro','$this->asFolio_registro','$this->asNumero_registro','1')";
				$lbHecho=$this->fbEjecutarNoDie($lsSql);

			}
			else
			{
				$cnfalse=1;
			}

			if($lbHecho)
			{

				for($liI=1;$liI<=$this->asFilaPadri;$liI++)
				{		

						$resultPer=$this->fbBuscarPersonaExiste($MatrixPadri[$liI][1],$MatrixPadri[$liI][2]);
						if ($MatrixPadri[$liI][1]!="")
						{
							$MatrixPadri[$liI][2]=$MatrixPadri[$liI][1]."-".$MatrixPadri[$liI][2];
						}
						if (!$resultPer)
						{
							$lsSql="INSERT INTO tpersonas 
								(Nacionalidad,Cedula,Nombres,Apellidos,Sexo,Direccion,Telefono,FechaNacimiento,FechaRegistro,idFgradoEstudio,idFtallaFranela,Estatus) VALUES 
								('".$MatrixPadri[$liI][1]."','".$MatrixPadri[$liI][2]."','".$MatrixPadri[$liI][3]."','".$MatrixPadri[$liI][4]."','".$MatrixPadri[$liI][5]."','".$MatrixPadri[$liI][6]."','".$MatrixPadri[$liI][7]."','".$this->asFechaRegistro."','".$MatrixPadri[$liI][8]."','".$MatrixPadri[$liI][9]."','".$MatrixPadri[$liI][10]."','".$MatrixPadri[$liI][11]."')";
							$lbHecho=$this->fbEjecutarNoDie($lsSql);
						}
						else
						{
							$lbHecho=true;
						}
						if ($lbHecho)
						{

							$lsSql="INSERT INTO tbautizopadrino 
							(idFbautizo,idFpadrino,Estatus) VALUES 
							((SELECT idTbautizo FROM tbautizo WHERE NumPartidaNac='$this->asNumPartidaNac'),(SELECT idTpersonas FROM tpersonas WHERE Cedula='".$MatrixPadri[$liI][2]."'),'1')";
									
							$lbHecho=$this->fbEjecutarNoDie($lsSql);

							if ($lbHecho==false)
							{

								$cnfalse++;
						
							}

						}
						else
						{
							$cnfalse++;
						}
				}
			}
			if($cnfalse===0) 
			{
				$lbHecho=true;
				parent::fpCommit();
			}
			else
			{
				$lbHecho=false;
				parent::fpRollback();
			}
			
			$this->fpDesconectar();
			return $lbHecho;
		}	

		
		public function fbModificar()
		{
			$lbHecho=false;
			$lbHecho1=false;
			$lbHecho2=false;
			$lbHecho3=false;
			$lbHecho4=false;
			$lbHecho5=false;
			$MatrixPadri=$this->asMatrizPadri;	
			$this->fpConectar();
			$DB_CeduRepre=$this->fbBuscarPersonaExiste($this->asNacioRepre,$this->asCeduRepre);
			$DB_CeduMama=$this->fbBuscarPersonaExiste($this->asNacioMama,$this->asCeduMama);
			$DB_CeduPapa=$this->fbBuscarPersonaExiste($this->asNacioPapa,$this->asCeduPapa);

			if ($this->asNacioRepre!="")
			{
				$this->asCeduRepre=$this->asNacioRepre.'-'.$this->asCeduRepre;
			}

			if ($this->asNacioMama!="")
			{
				$this->asCeduMama=$this->asNacioMama.'-'.$this->asCeduMama;
			}

			if ($this->asNacioPapa!="")
			{
				$this->asCeduPapa=$this->asNacioPapa.'-'.$this->asCeduPapa;
			}
			$MatrixPadri=$this->asMatrizPadri;	
			if ($DB_CeduRepre)
			{
				$lbHecho1=true;
			}
			else
			{
				$lsSql="INSERT INTO tpersonas 
				(Nacionalidad,Cedula,Nombres,Apellidos,Sexo) VALUES 
				('".$this->asNacioRepre."','".$this->asCeduRepre."','".$this->asNombRepre."','".$this->asApellRepre."','".$this->asSexoRepre."')";
				$lbHecho1=$this->fbEjecutarNoDie($lsSql);
			}
			if ($DB_CeduMama)
			{
				$lbHecho2=true;
			}
			else
			{
				$lsSql="INSERT INTO tpersonas 
				(Nacionalidad,Cedula,Nombres,Apellidos,Sexo) VALUES 
				('".$this->asNacioMama."','".$this->asCeduMama."','".$this->asNombMama."','".$this->asApellMama."','F')";
				$lbHecho2=$this->fbEjecutarNoDie($lsSql);
			}
			if ($DB_CeduPapa)
			{
				$lbHecho3=true;
			}
			else
			{
				$lsSql="INSERT INTO tpersonas 
				(Nacionalidad,Cedula,Nombres,Apellidos,Sexo) VALUES 
				('".$this->asNacioPapa."','".$this->asCeduPapa."','".$this->asNombPapa."','".$this->asApellPapa."','M')";
				$lbHecho3=$this->fbEjecutarNoDie($lsSql);
			}

			if(($lbHecho1)&&($lbHecho2)&&($lbHecho3))
			{
			
				$lsSql="UPDATE tbautizo SET 
				FechaBautizo='$this->asFechaBautizo',
				Nombres='$this->asNombresBau',
				Apellidos='$this->asApellidosBau',
				Sexo='$this->asSexoBau',
				FechaNaci='$this->asFechaNacimiento',
				Direccion='$this->asDireccion',
				idFestado='$this->asIDestado',
				idFciudad='$this->asIDciudad',
				idFmunicipio='$this->asIDmunicipio',
				idFparroquia='$this->asIDparroquia',
				idFrepresentante=(SELECT idTpersonas FROM tpersonas WHERE Cedula='$this->asCeduRepre'),
				idFparentescoRep='$this->asIDParentesco',idFmama=(SELECT idTpersonas FROM tpersonas WHERE Cedula='$this->asCeduMama'),
				idFpapa=(SELECT idTpersonas FROM tpersonas WHERE Cedula='$this->asCeduPapa'),idFsacerdote='$this->asIDSacerdote',
				idFministro='$this->asIDMinistro',NotaMarginal='$this->asNotaMarginal',PrefectuDe='$this->asPrefectuDe',
				Libro_registro='$this->asLibro_registro',Folio_registro='$this->asFolio_registro',
				Numero_registro='$this->asNumero_registro' 
				WHERE ReferenciaInfante='$this->asReferenciaInfante'";
				$lbHecho=$this->fbEjecutarNoDie($lsSql);
			}
	
				for($liI=1;$liI<=$this->asFilaPadri;$liI++)
				{
					if($MatrixPadri[$liI][1]!="")
					{
						$MatrixPadri[$liI][2]=$MatrixPadri[$liI][1]."-".$MatrixPadri[$liI][2];
					}
					$lsSql="INSERT INTO tpersonas (Nacionalidad,Cedula,Nombres,Apellidos,Sexo) VALUES ('".$MatrixPadri[$liI][1]."','".$MatrixPadri[$liI][2]."','".$MatrixPadri[$liI][3]."','".$MatrixPadri[$liI][4]."','".$MatrixPadri[$liI][5]."') ON DUPLICATE KEY UPDATE Nacionalidad='".$MatrixPadri[$liI][1]."', Cedula='".$MatrixPadri[$liI][2]."',Nombres='".$MatrixPadri[$liI][3]."',Apellidos='".$MatrixPadri[$liI][4]."',Sexo='".$MatrixPadri[$liI][5]."'";
						$lbHecho4=$this->fbEjecutarNoDie($lsSql);
			
					$lbEncPadri=$this->fbBuscarPadrinoExiste($this->asReferenciaInfante,$MatrixPadri[$liI][2]);
					
					if($lbEncPadri["resulta"]==false)
					{	
						$lsSql="INSERT INTO tbautizopadrino (idFbautizo,idFpadrino,Estatus) VALUES ((SELECT idTbautizo FROM tbautizo WHERE NumPartidaNac='$this->asNumPartidaNac'),(SELECT idTpersonas FROM tpersonas WHERE Cedula='".$MatrixPadri[$liI][2]."'),'1')";
					}
					else
					{
						$lsSql="UPDATE tbautizopadrino SET Estatus='".$MatrixPadri[$liI][13]."' WHERE idFbautizo='".$lbEncPadri["idFbautizo"]."' AND idFpadrino='".$lbEncPadri["idFpadrino"]."'";
					}
						$lbHecho5=$this->fbEjecutarNoDie($lsSql);
				}
				
				$this->fpDesconectar();
				if(($lbHecho1)OR($lbHecho2)OR($lbHecho3)OR($lbHecho4)OR($lbHecho5))
				{
					$lbHecho=true;
				}

			return $lbHecho;
				
		}

		public function fbActivar($psVar)
		{
			if($psVar==""){
				$psVar=1;
			}
			$lbHecho=false;
			$lsSql="UPDATE tbautizo SET Estatus='$psVar' WHERE ReferenciaInfante='$this->asReferenciaInfante'";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}
		
		public function faListarBautizantesPorAdulto($sujeto)
		{
			
			switch ($sujeto) {
			    case "representante":
						$lsSql="select * from tbautizo WHERE idFrepresentante='$this->asIDrepre'";
			        break;
			    case "madre":
						$lsSql="select * from tbautizo WHERE idFmama='$this->asIDrepre'";
			        break;
			    case "padre":
						$lsSql="select * from tbautizo WHERE idFpapa='$this->asIDrepre'";
			        break;
			}

			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["idTbautizo"]=$laArreglo["idTbautizo"];
				$laMatriz[$liI]["FechaInscri"]=$laArreglo["FechaInscri"];
				$laMatriz[$liI]["FechaBautizo"]=$laArreglo["FechaBautizo"];
				$laMatriz[$liI]["Nombres"]=$laArreglo["Nombres"];
				$laMatriz[$liI]["Apellidos"]=$laArreglo["Apellidos"];
				$laMatriz[$liI]["Sexo"]=$laArreglo["Sexo"];
				$laMatriz[$liI]["FechaNacimiento"]=$laArreglo["FechaNaci"];
				$laMatriz[$liI]["Bautizado"]=$laArreglo["Bautizado"];
				$laMatriz[$liI]["idFrepresentante"]=$laArreglo["idFrepresentante"];
				$laMatriz[$liI]["idFparentescoRep"]=$laArreglo["idFparentescoRep"];
				$laMatriz[$liI]["idFmama"]=$laArreglo["idFmama"];
				$laMatriz[$liI]["idFpapa"]=$laArreglo["idFpapa"];
				$laMatriz[$liI]["idFsacerdote"]=$laArreglo["idFsacerdote"];
				$laMatriz[$liI]["NumPartidaNac"]=$laArreglo["NumPartidaNac"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}

		public function fbActivarPadri($psVar)
		{
			if($psVar==""){
				$psVar=1;
			}
			$lbHecho=false;
			$lsSql="UPDATE tbautizopadrino SET Estatus='$psVar' WHERE idFpadrino=(SELECT idTpersonas FROM tpersonas WHERE Cedula='$this->asCeduPadri') AND idFbautizo=(SELECT idTbautizo FROM tbautizo WHERE ReferenciaInfante='$this->asReferenciaInfante' AND Bautizado=0)";
			$this->fpConectar();
			$lbHecho=$this->fbEjecutarNoDie($lsSql);
			$this->fpDesconectar();
			return $lbHecho;
		}

		public function faListarBautizos()
		{
	
			$lsSql="SELECT 
			tbautizo.idTbautizo, 
			tbautizo.FechaInscri, 
			tbautizo.FechaBautizo, 
			tbautizo.ReferenciaInfante, 
			tbautizo.Nombres AS NombresBau, 
			tbautizo.Apellidos  AS ApellidosBau, 
			tbautizo.Sexo AS SexoBau, 
			generoDescrip(tbautizo.Sexo) AS SexoBauDescrip, 
			tbautizo.FechaNaci, 
			tbautizo.idFrepresentante AS idFrepre, 
			tbautizo.idFmama, 
			tbautizo.idFpapa, 
			tbautizo.Bautizado, 
			tbautizo.Direccion, 
			tbautizo.idFestado, 
			tbautizo.idFciudad, 
			tbautizo.idFmunicipio, 
			tbautizo.idFparroquia, 
			trepre.Nacionalidad AS NacioRepre, 
			trepre.Cedula AS CeduRepre, 
			CONCAT(trepre.Nombres,' ',trepre.Apellidos) AS NombreFullRepre,
			tparen.idTparentescoRepre AS IDParentesco,  
			tmama.Nacionalidad AS NacioMama, 
			tmama.Cedula AS CeduMama, 
			tpapa.Nacionalidad AS NacioPapa, 
			tpapa.Cedula AS CeduPapa, 
			tbautizo.NotaMarginal, 
			tbautizo.PrefectuDe, 
			tbautizo.PresentadoEl, 
			tbautizo.NumPartidaNac, 
			tbautizo.Libro_registro, 
			tbautizo.Folio_registro, 
			tbautizo.Numero_registro, 
			tbautizo.Estatus, 
			tminis.idTsacerdote AS IDSacerdote, 
			tsacer.idTsacerdote AS IDMinistro 
			FROM tbautizo 
			INNER JOIN tpersonas AS trepre on tbautizo.idFrepresentante = trepre.idTpersonas 
			INNER JOIN tpersonas AS tmama on tbautizo.idFmama = tmama.idTpersonas 
			INNER JOIN tpersonas AS tpapa on tbautizo.idFpapa = tpapa.idTpersonas 
			INNER JOIN parentescorepre AS tparen on tbautizo.idFparentescoRep = tparen.idTparentescoRepre 
			INNER JOIN tsacerdote AS tminis on tbautizo.idFministro = tminis.idTsacerdote 
			INNER JOIN tsacerdote AS tsacer on tbautizo.idFsacerdote = tsacer.idTsacerdote 
			WHERE FechaBautizo > '$this->asFechaInicioR' AND FechaBautizo < '$this->asFechaFinR' 
			ORDER BY tbautizo.Estatus,tbautizo.ReferenciaInfante ASC";
			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["idTbautizo"]=$laArreglo["idTbautizo"];
				$laMatriz[$liI]["FechaInscri"]=$laArreglo["FechaInscri"];
				$laMatriz[$liI]["FechaBautizo"]=$laArreglo["FechaBautizo"];
				$laMatriz[$liI]["ReferenciaInfante"]=$laArreglo["ReferenciaInfante"];
				$laMatriz[$liI]["NombresBau"]=$laArreglo["NombresBau"];
				$laMatriz[$liI]["ApellidosBau"]=$laArreglo["ApellidosBau"];
				$laMatriz[$liI]["SexoBau"]=$laArreglo["SexoBau"];
				$laMatriz[$liI]["SexoBauDescrip"]=$laArreglo["SexoBauDescrip"];
				$laMatriz[$liI]["FechaNaci"]=$laArreglo["FechaNaci"];
				$laMatriz[$liI]["Bautizado"]=$laArreglo["Bautizado"];
				$laMatriz[$liI]["Direccion"]=$laArreglo["Direccion"];
				$laMatriz[$liI]["idFestado"]=$laArreglo["idFestado"];
				$laMatriz[$liI]["idFciudad"]=$laArreglo["idFciudad"];
				$laMatriz[$liI]["idFmunicipio"]=$laArreglo["idFmunicipio"];
				$laMatriz[$liI]["idFparroquia"]=$laArreglo["idFparroquia"];
				$laMatriz[$liI]["NacioRepre"]=$laArreglo["NacioRepre"];
				$laMatriz[$liI]["CeduRepre"]=$laArreglo["CeduRepre"];
				$laMatriz[$liI]["NombreFullRepre"]=$laArreglo["NombreFullRepre"];
				$laMatriz[$liI]["IDParentesco"]=$laArreglo["IDParentesco"];
				$laMatriz[$liI]["NacioMama"]=$laArreglo["NacioMama"];
				$laMatriz[$liI]["CeduMama"]=$laArreglo["CeduMama"];
				$laMatriz[$liI]["NacioPapa"]=$laArreglo["NacioPapa"];
				$laMatriz[$liI]["CeduPapa"]=$laArreglo["CeduPapa"];
				$laMatriz[$liI]["idFrepre"]=$laArreglo["idFrepre"];
				$laMatriz[$liI]["idFmama"]=$laArreglo["idFmama"];
				$laMatriz[$liI]["idFpapa"]=$laArreglo["idFpapa"];
				$laMatriz[$liI]["IDSacerdote"]=$laArreglo["IDSacerdote"];
				$laMatriz[$liI]["IDMinistro"]=$laArreglo["IDMinistro"];
				$laMatriz[$liI]["NotaMarginal"]=$laArreglo["NotaMarginal"];
				$laMatriz[$liI]["PrefectuDe"]=$laArreglo["PrefectuDe"];
				$laMatriz[$liI]["PresentadoEl"]=$laArreglo["PresentadoEl"];
				$laMatriz[$liI]["NumPartidaNac"]=$laArreglo["NumPartidaNac"];
				$laMatriz[$liI]["Libro_registro"]=$laArreglo["Libro_registro"];
				$laMatriz[$liI]["Folio_registro"]=$laArreglo["Folio_registro"];
				$laMatriz[$liI]["Numero_registro"]=$laArreglo["Numero_registro"];
				$laMatriz[$liI]["Estatus"]=$laArreglo["Estatus"];
				$liI++;
			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}
	}
?>
