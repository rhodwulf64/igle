<?php
  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
	require_once("../../clases/claAgenda.php");
	require_once("../../clases/clsFuncionesGlobales.php");
	require("../../pdf/fpdf.php");

if (empty($_POST["f_Inicio"]))
{
	$_POST["f_Inicio"]='1970-01-01';
}

if (empty($_POST["f_Fin"]))
{
	$_POST["f_Fin"]='2099-01-01';
}

$lsTipoAgenda=$_POST['txtTipoAgenda'];

class PDF extends FPDF{		

function Header()
{
	$loFuncion =new clsFunciones();

	if ($_POST['txtTipoAgenda']=='1')
	{
		$NombreVar='Diocesanas';
	}
	else
	{
		$NombreVar='Parroquiales';
	}

    // Logo
    $this->Image('../../logos/encabezado.png',5,5,200,0,'','localhost/iglesia/vis/lista_agendaDiocesana.php');
    // Arial bold 15
	$this->Ln(35);
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
	
    $this->Cell(30,10,'Listado de Agenda de Actividades '.$NombreVar.'',0,0,'C');
    $this->Ln(5);
    $this->SetFont('Arial','I',10);
    $this->setX(90);
    $this->Cell(30,10,'(Desde el '.$loFuncion->fDameFechaEscrita($_POST["f_Inicio"]).', Hasta el '.$loFuncion->fDameFechaEscrita($_POST["f_Fin"]).')',0,0,'C');
    $this->Ln(5);
    $this->SetFont('Arial','I',8);
    $this->setX(20);
    $this->Cell(40,10,'Fecha: '.$loFuncion->fDameFechaEscrita(date("Y-m-d"))." ".$loFuncion->fDameHoraEstandar(substr(date("d-m-Y H:i:s"),11,8)),0,0,'R');
    // Salto de línea
    $this->Ln(15);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->AliasNbPages();
    $this->Cell(0,10,'Pagina  Nro '.$this->PageNo()." de {nb}",0,0,'C');
}

function CompletaCaracteres($cadena,$num)
{
	
	if (strlen($cadena)>$num)
	{
		$cadena=substr($cadena,0,$num);
	}
	
	return $cadena;
}

	// Tabla simple
	function BasicTable($header,$data)
	{
		$loFuncion =new clsFunciones();
		$estadoIMG="img/info_verifique.png";
		$w = array(6,25,35,14,30,25,22,28,10);
		$this->SetFont('Arial','B',14);
		for($i=0;$i<count($header);$i++)
		{
			$this->Cell($w[$i],7,$header[$i],1,0,'C');
			
		}
		
		$this->ln();
		
		for($z=0;$z<count($data);$z++)
		{
		$x=$z;
			$lsEstadoAgenda=$data[$z]['Agenda_Estatus'];
			$BienPueda="0";

			if (($lsEstadoAgenda==$_POST["option0"])&&($_POST["option0"]!=""))
			{
				$BienPueda="1";
			}
			if (($lsEstadoAgenda==$_POST["option1"])&&($_POST["option1"]!=""))
			{
				$BienPueda="1";
			}
			
			if (($_POST["option0"]=="")&&($_POST["option1"]==""))
			{
				$_POST["option0"]="0";
				$_POST["option1"]="1";
				$BienPueda="1";
			}



			if ($BienPueda=="1")
			{
				switch ($lsEstadoAgenda)
				{
				    case "0":
				       	$estadoIMG="img/info_Desactivado.png";
				    break;

				    case "1":
				       	$estadoIMG="img/info_Activo.png";
				    break;

	        	}


        		$this->SetFont('Arial','',8);
				$this->Cell($w[0],7,$this->CompletaCaracteres($data[$z]['codigoAgenda'],17),1,0,'C');
				$this->Cell($w[1],7,$this->CompletaCaracteres($data[$z]['Actividad_Nombre'],15),1,0,'C');
				$this->Cell($w[2],7,$loFuncion->fDameFechaEscrita(substr($data[$z]['fecha_actividad'], 0, 10)),1,0,'C');
				$this->Cell($w[3],7,$this->CompletaCaracteres($data[$z]['HoraExacta'],17),1,0,'C');
				$this->Cell($w[4],7,$this->CompletaCaracteres($data[$z]['lugar'],17),1,0,'C');
				$this->Cell($w[5],7,$this->CompletaCaracteres($data[$z]['TipoAct_Nombre'],13),1,0,'C');
				$this->Cell($w[6],7,$this->CompletaCaracteres($data[$z]['Pastoral_Nombre'],12),1,0,'C');
				$this->Cell($w[7],7,$this->CompletaCaracteres($data[$z]['Grupo_Nombre'],17),1,0,'C');
				$da=$this->getY();
				$this->Cell($w[8],7,$this->Image($estadoIMG,195.3,$da+0.6,0,0,'','../gestAgendaDiocesana.php?CalendarioA='.$data[$z]['Calendario_Anno'].'&CalendarioM='.$data[$z]['Calendario_Mes']),1,0,'C');
				$this->Ln(7);
		
			}
		}

		$this->Ln(10);
	    $this->SetFont('Arial','I',8);
	    $this->setX(20);
	    $this->Cell(40,10,'Usuario: '.$_SESSION["nombreUsuario"]." (".$_SESSION["rolNombre"].")",0,0,'L');
		
	
	}

}
$objC=new claAgenda();

$arregloCl = $objC->faListarActividades($lsTipoAgenda,$_POST["f_Inicio"],$_POST["f_Fin"]);
$header = array('#','Actividad','Fecha', 'Hora', 'Lugar', 'Tipo', 'Pastoral', 'Apostolado', 'Edo');
$pdf = new PDF();
$pdf->AddPage();
$pdf->BasicTable($header,$arregloCl);
$pdf->Output();
?>
