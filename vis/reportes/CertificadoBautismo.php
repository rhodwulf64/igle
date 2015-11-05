<?php
  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
require_once("../../clases/claBautismo.php");
require_once("../../clases/claPadrinos.php");
require_once("../../clases/clsFuncionesGlobales.php");
require("../../pdf/fpdf.php");


class PDF extends FPDF{		

function Header()
{
	$this->SetTextColor(111,0,36);
	$loFuncion =new clsFunciones();
	$this->Ln(35);


    $this->Ln(10);
    $this->SetFont('Arial','I',8);
    $this->setX(20);

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
    $this->Ln(10);
   	$this->Cell(0,0,'Usuario: '.$_SESSION["nombreUsuario"]." (".$_SESSION["rolNombre"].")",0,0,'C');
}

function CompletaCaracteres($cadena,$cantidad)
{
	
	if (strlen($cadena)>$cantidad)
	{
		$cadena=substr($cadena,0,$cantidad);
	}
	
	return $cadena;
}

	// Tabla simple
	function BasicTable($header,$Bauti,$poPadrinos)
	{
		$poPadrinos->fpSetEventoPadrino("B");
		$poPadrinos->fpSetIDcumatba($Bauti->asIDbautizo);
		$laMatrizPadri=$poPadrinos->faListarPadrinosReales();
		$this->SetTextColor(111,0,36);
		$loFuncion =new clsFunciones();
		$this->Image('img/fondobautizo.png', 0,0, 210, 295, 'PNG');
		$estadoIMG="img/info_verifique.png";
	    $this->SetFont('Arial','B',8);
	    // Movernos a la derecha
	    $this->Cell(55);
	    // Título
	    $this->Cell(10,48,utf8_decode('El Presbítero: ______________________________________________'),0,0,'L');
		$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('Que según consta del acta reseñada al margen, correspondiente al Libro de Bautismo,'),0,0,'L');
		$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('se encuentra en la partida de: ________________________________________________'),0,0,'L');
		$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('Nació el día: _______________________________________________________________'),0,0,'L');
       	$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('En: ______________________________ Estado: _________________________________'),0,0,'L');
        $this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('Fue Bautizado(a) el día: _____________________________________________________'),0,0,'L');
       	$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('Padres:      ________________________________________________________________'),0,0,'L');
       	$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('                   ________________________________________________________________'),0,0,'L');
		$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('Padrinos:   ________________________________________________________________'),0,0,'L');
       	$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('                    _______________________________________________________________'),0,0,'L');
		$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('Ministro:    ________________________________________________________________'),0,0,'L');
		$this->ln();
		$this->ln();
		$this->Cell(55);
		$this->Cell(10,5,utf8_decode('Se expide el presente Certificado para fines: ____________________________________'),0,0,'L');
		$this->ln();
		$this->ln();
		$this->ln();
		$this->ln();
		$this->ln();
		$this->ln();
		$this->Cell(110);
		$this->Cell(10,5,utf8_decode('Acarigua: '.$loFuncion->fDameFechaEscrita(date("Y-m-d"))." ".$loFuncion->fDameHoraEstandar(substr(date("d-m-Y H:i:s"),11,8))),0,0,'L');
		$this->ln();
		$this->ln();
		$this->ln();
		$this->ln();
		$this->ln();
		$this->ln();
		$this->ln();
		$this->ln();
		$this->ln();
		$this->Cell(90);
		$this->Cell(10,5,utf8_decode('Doy Fe                            _____________________________'),0,0,'L');
		$this->ln();
		$this->Cell(135);
		$this->Cell(10,5,utf8_decode('EL PÁRROCO'),0,0,'L');
		$this->SetY(95);
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('Libro: _________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('Folio: _________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('Número: ______________'),0,0,'L');
	    $this->SetFont('Arial','B',12);
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('NOTA MARGINAL'),0,0,'L');
	    $this->SetFont('Arial','B',8);
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('Registro Civil'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('Prefectura de:'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('Presentado(a)'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('El'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('Bajo el Número'),0,0,'L');
		$this->ln();
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('_____________________'),0,0,'L');
		$this->ln();
		$this->ln();
	    $this->SetFont('Arial','B',9);
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode('SELLO'),0,0,'L');
		$this->ln();
		$this->SetY(69);
		$this->SetTextColor(0,0,0);
	    $this->SetFont('Arial','B',9);
	    $this->Cell(80);
	    $this->Cell(10,48,utf8_decode($this->CompletaCaracteres($Bauti->asNombreSacer,40)),0,0,'L');
		$this->ln();
		$this->SetY(122);
		$this->Cell(100);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Bauti->asNombresBau.' '.$Bauti->asApellidosBau,30)),0,0,'L');
		$this->ln();
		$this->Cell(80);
		$this->Cell(10,5,utf8_decode($loFuncion->fDameFechaEscrita($Bauti->asFechaNacimiento)),0,0,'L');
       	$this->ln();
		$this->Cell(65);
		$this->Cell(10,5,utf8_decode($Bauti->asNombCiudad),0,0,'L');
		$this->Cell(50);
		$this->Cell(10,5,utf8_decode($Bauti->asNombEstado),0,0,'L');
        $this->ln();
		$this->Cell(95);
		$this->Cell(10,5,utf8_decode($loFuncion->fDameFechaEscrita(substr($Bauti->asFechaBautizo,0,10)).", a las ".$loFuncion->fDameHoraEstandar(substr($Bauti->asFechaBautizo,11,8))),0,0,'L');
       	$this->ln();
		$this->Cell(75);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Bauti->asNombMama.' '.$Bauti->asApellMama,40)),0,0,'L');
       	$this->ln();
		$this->Cell(75);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Bauti->asNombPapa.' '.$Bauti->asApellPapa,40)),0,0,'L');
		$this->ln();
		$this->Cell(75);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($laMatrizPadri[0]["Nombres"].' '.$laMatrizPadri[0]["Apellidos"],40)),0,0,'L');
       	$this->ln();
		$this->Cell(75);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($laMatrizPadri[1]["Nombres"].' '.$laMatrizPadri[1]["Apellidos"],40)),0,0,'L');
		$this->ln();
		$this->Cell(75);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Bauti->asNombreMinistro,40)),0,0,'L');
		$this->ln();
		$this->ln();
		$this->Cell(120);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($_GET["FinesCertificado"],27)),0,0,'L');
		$this->ln();
		
		$this->SetY(94);
		$this->Cell(25);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Bauti->asLibro_registro,14)),0,0,'L');
		$this->ln();
		$this->Cell(25);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Bauti->asFolio_registro,14)),0,0,'L');
		$this->ln();
		$this->Cell(28);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Bauti->asNumero_registro,12)),0,0,'L');
		$this->ln();
		$this->ln();
		$this->Cell(15);
		$this->MultiCell(38,5,utf8_decode($this->CompletaCaracteres($Bauti->asNotaMarginal,135)),0,'L');
		$this->SetY(174);
		$this->Cell(15);
		$this->MultiCell(37,5,utf8_decode($this->CompletaCaracteres($Bauti->asPrefectuDe,30)),0,'L');
		$this->SetY(194);
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode($loFuncion->fDameFechaEscrita($Bauti->asPresentadoEl)),0,0,'L');
		$this->SetY(204);
		$this->Cell(15);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Bauti->asNumPartidaNac,19)),0,0,'L');
		$this->ln();


	}
}
$loPadrinos=new claPadrinos();
$objC=new claBautismo();
$objC->asReferenciaInfante=$_GET["ReFinfante"];
$objC->fbBuscarBauti();

if($objC->asEstatusBau==1)
{
	$header = array('Ref',' Fecha Bautizo',' Infante', 'Sexo', 'Representante', 'Estado');
	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->BasicTable($header,$objC,$loPadrinos);
	$pdf->Output();
}
else
{
	$_SESSION["message"]="No se pudo imprimir el Certificado.";
	header("location: ../../index.php");
}
?>
