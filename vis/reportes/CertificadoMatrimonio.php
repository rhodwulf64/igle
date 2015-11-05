<?php
  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
	require_once("../../clases/claMatrimonio.php");
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
	function BasicTable($header,$Matrimo,$poPadrinos)
	{
		$poPadrinos->fpSetEventoPadrino("M");
		$poPadrinos->fpSetIDcumatba($Matrimo->fpGetIDTmatrimonio());
		$laMatrizPadri=$poPadrinos->faListarPadrinosReales();
		$this->SetTextColor(111,0,36);
		$loFuncion =new clsFunciones();
		$this->Image('img/fondomatrimonio.png', 0,0, 210, 295, 'PNG');
		$estadoIMG="img/info_verifique.png";
	    $this->SetFont('Arial','B',8);
	    // Movernos a la derecha
	    $this->SetY(123);
		$this->ln();
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('_______________________________________________'),0,0,'C');
		$this->ln(3);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('Nombre y Apellido de soltera de la novia'),0,0,'C');
		$this->ln();
	    $this->SetY(144);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('_______________________________________________'),0,0,'C');
		$this->ln(3);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('Nombre y Apellido de soltero de el novio'),0,0,'C');
		$this->ln();
		$this->SetY(163);
		$this->SetFont('Courier','B',10);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('Se han unido en Santo Matrimonio, siguiendo los estatutos'),0,0,'C');
		$this->ln(3);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('y ordenanzas de Dios, y bajo las leyes terrenales de:'),0,0,'C');
		$this->ln();
		$this->SetFont('Arial','B',8);
		$this->SetY(185);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('_______________________________________________'),0,0,'C');
		$this->ln(3);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('Ciudad y País'),0,0,'C');
		$this->ln();
		$this->SetY(200);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('Realizado en: _____________________________________________________'),0,0,'C');
       	$this->ln();
       	$this->SetY(214);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('_______________________________________________'),0,0,'C');
		$this->ln(3);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('Nombre del Ministro'),0,0,'C');
		$this->ln();
		$this->SetY(235);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('________________________________           ________________________________'),0,0,'C');
		$this->ln(4);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode('Nombre del Testigo                                       Nombre del Testigo'),0,0,'C');
		$this->ln();
		$this->SetY(250);
		$this->Cell(150);
		$this->Cell(10,5,utf8_decode('...Por esto el hombre dejará padre y madre, y se unirá a su mujer, y los dos serán  una sola carne.'),0,0,'R');
		$this->ln(3);
		$this->Cell(150);
		$this->Cell(10,5,utf8_decode('Mateo 19:5'),0,0,'R');
		$this->ln();

		$this->Cell(110);
		$this->Cell(10,5,utf8_decode('Acarigua: '.$loFuncion->fDameFechaEscrita(date("Y-m-d"))." ".$loFuncion->fDameHoraEstandar(substr(date("d-m-Y H:i:s"),11,8))),0,0,'L');
		$this->ln();
		$this->ln();
		$this->ln();

	    $this->SetY(117);
	    $this->SetTextColor(0,0,0);
		$this->ln();
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Matrimo->fsGetNombnovia(),40)),0,0,'C');
	    $this->SetY(143);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Matrimo->fsGetNombnovio(),40)),0,0,'C');
		$this->SetY(184);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres('ACARIGUA, VENEZUELA',40)),0,0,'C');
		$this->SetY(199);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres('LA IGLESIA SAN ROQUE',40)),0,0,'C');
       	$this->SetY(213);
		$this->Cell(92);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($Matrimo->fsGetNombSacerdote(),40)),0,0,'C');
		$this->SetY(234);
		$this->Cell(62);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($laMatrizPadri[0]["Nombres"].' '.$laMatrizPadri[0]["Apellidos"],40)),0,0,'C');
		$this->Cell(50);
		$this->Cell(10,5,utf8_decode($this->CompletaCaracteres($laMatrizPadri[1]["Nombres"].' '.$laMatrizPadri[1]["Apellidos"],40)),0,0,'C');

	}
}
$loPadrinos=new claPadrinos();
$objC=new claMatrimonio();
$objC->fpSetRefMatrimonio($_GET["ReFmatrimonio"]);
$objC->fbBuscarMatrimonio(1,"uno");

if($objC->fsGetEstadoMatrimonio()==1)
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
