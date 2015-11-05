<?php
session_start();
	if(!array_key_exists("usuario", $_SESSION)) 
	{
		header("location: visSalir.php");
	}
	if (empty($_GET["RPNovia"])&&(!isset($_GET["RPNovia"]))&&(empty($_GET["RPNovio"]))&&(!isset($_GET["RPNovio"])))
	{
		$_SESSION["message"]="No se pudo mostrar el reporte";
		header("location: ../../index.php");
	}
	require_once("../../clases/claMatrimonio.php");
	require_once("../../clases/clsFuncionesGlobales.php");
	require("../../pdf/fpdf.php");

class PDF extends FPDF{		


function WriteHTML($html)
{

    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}
function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
function Header()
{
    // Logo
    $this->Image('img/header.png',5,5,200);
    // Arial bold 15
	$this->Ln(35);
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(153);
    $this->Cell(30,10,utf8_decode('Fecha: '.date("d-m-Y")),0,0,'C');
    $this->Ln(8);
    // Título
    $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(30,10,utf8_decode('DESEA CONTRAER MATRIMONIO'),0,0,'C');
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
    $this->Cell(0,10,'Pagina  Nro '.$this->PageNo(),0,0,'C');
}

	// Tabla simple
	function BasicTable($header,$data)
	{

		
	$loMatrimo=new claMatrimonio();
	$loFuncion =new clsFunciones();
	$lscedunovia=$_GET["RPNovia"];
	$lscedunovio=$_GET["RPNovio"];

	$varMoF=4;
	if (!empty($lscedunovia) and (!empty($lscedunovio)))
	{
		$loMatrimo->fpSetCInovia($lscedunovia);
		$varMoF=0;
	}
	elseif (empty($lscedunovia) and (!empty($lscedunovio)))
	{
		$loMatrimo->fpSetCInovio($lscedunovio);
		$varMoF=1;
	}
	elseif (!empty($lscedunovia) and (empty($lscedunovio)))
	{
		$loMatrimo->fpSetCInovia($lscedunovia);
		$varMoF=0;
	}
	
	$lbEnc=$loMatrimo->fbBuscarMatrimonio($varMoF);
		if($lbEnc and $varMoF!=4)
		{
				$lsIDmatrimonio=$loMatrimo->fpGetIDTmatrimonio();
				$lsFechaInscri=$loMatrimo->fpGetFechaInscri();
				$lsFechaHoraMatrimonio=$loMatrimo->fsGetFechaMatrimonio();
				$lsFechaMatrimonio=$loFuncion->fDameFechaEscrita(substr($lsFechaHoraMatrimonio,0,10));
				$lsIDsacerdote=$loMatrimo->fsGetIDsacerdote();
				$lsNacionovia=$loMatrimo->fsGetNacionovia();
				$lscedunovia=$loMatrimo->fsGetCInovia();
				$lsNombreNovia=$loMatrimo->fsGetNombnovia();
				$lsEstadonovia=$loMatrimo->fsGetEstadonovia();					
				$lsCiudadnovia=$loMatrimo->fsGetCiudadnovia();
				$lsMunicipionovia=$loMatrimo->fsGetMunicipionovia();
				$lsParroquianovia=$loMatrimo->fsGetParroquianovia();
				$lsEstadonovio=$loMatrimo->fsGetEstadonovio();
				$lsCiudadnovio=$loMatrimo->fsGetCiudadnovio();
				$lsMunicipionovio=$loMatrimo->fsGetMunicipionovio();
				$lsParroquianovio=$loMatrimo->fsGetParroquianovio();					
				$lsNacionovio=$loMatrimo->fsGetNacionovio();
				$lscedunovio=$loMatrimo->fsGetCInovio();
				$lsNombreNovio=$loMatrimo->fsGetNombnovio();
				$lsFechaHoraProclamaUno=$loMatrimo->fsGetFechaProclamaUno();
				$lsFechaHoraProclamaDos=$loMatrimo->fsGetFechaProclamaDos();
				$lsFechaHoraProclamaTres=$loMatrimo->fsGetFechaProclamaTres();
				$lsFechaProclamaUno=$loFuncion->fDameFechaEscrita(substr($lsFechaHoraProclamaUno,0,10));
				$lsFechaProclamaDos=$loFuncion->fDameFechaEscrita(substr($lsFechaHoraProclamaDos,0,10));
				$lsFechaProclamaTres=$loFuncion->fDameFechaEscrita(substr($lsFechaHoraProclamaTres,0,10));
				$lsHoraProclamaUno=$loFuncion->fDameHoraEstandar(substr($lsFechaHoraProclamaUno,11,8));
				$lsHoraProclamaDos=$loFuncion->fDameHoraEstandar(substr($lsFechaHoraProclamaDos,11,8));
				$lsHoraProclamaTres=$loFuncion->fDameHoraEstandar(substr($lsFechaHoraProclamaTres,11,8));
				$lsEstadoMatrimonio=$loMatrimo->fsGetEstadoMatrimonio();
				$laMatrizPadres=$loMatrimo->fsGetDatosPadres();
				$lsFechanaciNovia=$loMatrimo->fsGetFechaNaciNovia();
				$lsFechanaciNovio=$loMatrimo->fsGetFechaNaciNovio();
				$lsEdadNovio=$loFuncion->fDameEdad($lsFechanaciNovia);
				$lsEdadNovia=$loFuncion->fDameEdad($lsFechanaciNovio);
		}
		else
		{
			$_SESSION["message"]="No se encontro ningun matrimonio";
			header("location: ../../index.php");
		}


    $this->SetFont('Arial','B',10);
    



    $this->SetFont('Arial','B',10);
    $this->Cell(80,10,utf8_decode($lsNombreNovio),0,0,'L');
   	$this->SetFont('Arial','',10);
    $this->Cell(30,10,utf8_decode('de'),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($lsEdadNovio),0,0,'L');
   	$this->SetFont('Arial','',10);
    $this->Cell(30,10,utf8_decode(' años de edad '),0,0,'L');
	$this->Ln(10);

   	$this->SetFont('Arial','',10);
    $this->Cell(80,10,utf8_decode(' hijo de '),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($laMatrizPadres[3]["Nombres"]),0,0,'L');
   	$this->SetFont('Arial','',10);
    $this->Cell(30,10,utf8_decode(' y de '),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($laMatrizPadres[2]["Nombres"]),0,0,'L');
	$this->Ln(10);

	$this->SetFont('Arial','',10);
    $this->Cell(80,10,utf8_decode(' natural de '),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($lsCiudadnovio.', Estado '.$lsEstadonovio.','),0,0,'L');
	$this->Ln(10);

	$this->SetFont('Arial','',10);
    $this->Cell(80,10,utf8_decode(' Con '),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($lsNombreNovia),0,0,'L');
   	$this->SetFont('Arial','',10);
    $this->Cell(30,10,utf8_decode(' de '),0,0,'L');
   	$this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($lsEdadNovia),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode(' años de edad '),0,0,'L');
    $this->Ln(10);

   	$this->SetFont('Arial','',10);
    $this->Cell(80,10,utf8_decode(' hija de '),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($laMatrizPadres[1]["Nombres"]),0,0,'L');
   	$this->SetFont('Arial','',10);
    $this->Cell(30,10,utf8_decode(' y de '),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($laMatrizPadres[0]["Nombres"]),0,0,'L');
	$this->Ln(10);

	$this->SetFont('Arial','',10);
    $this->Cell(80,10,utf8_decode(' natural de '),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($lsCiudadnovia.', Estado '.$lsEstadonovia.','),0,0,'L');
	$this->Ln(10);

	$this->SetFont('Arial','',10);
    $this->Cell(80,10,utf8_decode(' El matrimonio se realizará el '),0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(30,10,utf8_decode($lsFechaMatrimonio),0,0,'L');
	$this->Ln(15);

	$this->SetFont('Arial','B',10);
	$this->Cell(120,10,utf8_decode(' Primera Proclama: '),0,0,'L');
	$this->Cell(30,10,utf8_decode(' Hora: '),0,0,'L');
	$this->Ln(10);
	$this->Cell(120,10,utf8_decode(' Segunda Proclama: '),0,0,'L');
	$this->Cell(30,10,utf8_decode(' Hora: '),0,0,'L');
	$this->Ln(10);	
	$this->Cell(120,10,utf8_decode(' Tercera Proclama: '),0,0,'L');
	$this->Cell(30,10,utf8_decode(' Hora: '),0,0,'L');
	$this->Ln(10);

	$this->Cell(80);
	$this->SetFont('Arial','B',11);
	$this->Cell(30,10,utf8_decode(' Quien(es) conozca(n) algún impedimento que pueda hacer inválido este matrimonio '),0,0,'C');
	$this->Ln(10);
	$this->Cell(30);
	$this->Cell(30,10,utf8_decode(' tiene(n) la obligación de manifestarlo al Párroco. '),0,0,'C');
	$this->Ln(10);





$html = utf8_decode('

 <b></b>



<center><table style="width:800px;">
				<tr>
					<td colspan="2"><font style="text-align: justify; font-size:204px; line-height: 2.5em;">
					<strong>'.$lsNombreNovio.'</strong> de <strong>'.$lsEdadNovio.'</strong> años de edad, hijo de <strong>'.$laMatrizPadres[3]["Nombres"].'</strong> y de <strong>'.$laMatrizPadres[2]["Nombres"].'</strong>,
					 natural de '.$lsCiudadnovio.', Estado '.$lsEstadonovio.' Con <strong>'.$lsNombreNovia.'</strong> de <strong>'.$lsEdadNovia.'</strong> años de edad,
					hija de <strong>'.$laMatrizPadres[1]["Nombres"].'</strong> y de <strong>'.$laMatrizPadres[0]["Nombres"].'</strong>, natural de '.$lsCiudadnovia.', Estado '.$lsEstadonovia.'
					El matrimonio se realizará el <strong>'.$lsFechaMatrimonio.'.</strong>
					</font></td>
				</tr>
				</table></center>
				<br><br>
			<center><table style="width:600px;">
				<tr align="left">
					<td style="width:500px;"><strong>Primera proclama: '.$lsFechaProclamaUno.'</strong></td>
					<td style="width:400px;" align="center"><strong>Hora: '.$lsHoraProclamaUno.'</strong></td>
				</tr>
				<tr align="left">
					<td style="width:500px;"><strong>Segunda proclama: '.$lsFechaProclamaDos.'</strong></td>
					<td style="width:400px;" align="center"><strong>Hora: '.$lsHoraProclamaDos.'</strong></td>
				</tr>
				<tr align="left">
					<td style="width:500px;"><strong>Tercera proclama: '.$lsFechaProclamaTres.'</strong></td>
					<td style="width:400px;" align="center"><strong>Hora: '.$lsHoraProclamaTres.'</strong></td>
				</tr>
				 <tr>
				 	<td colspan="10" align="center"><button type="button" onclick="history.go(-1);" id="volver">Volver</button><button type="button" onclick="imprimir()" id="impri">Imprimir</button></td>
				 </tr>
			</table></center><br><br><br><br><b>
			<center><div style="width:800px;">Quien(es) conozca(n) algún impedimento que pueda hacer inválido este matrimonio tiene(n) la obligación de manifestarlo al Párroco.</div></center>
			<br><br><br><br><br><div align="center">_____________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________________</div>
			<div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Los contrayentes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

	<br><br><br><br><div align="center" style="float:right; margin-right:100px;">_____________________________<br>
			Párroco</div>
			
			<div id="usuario">Elaborado por:
				'.$_SESSION["nombreUsuario"].'
			</div>
		</div>
	</body>
	</html>');

$this->WriteHTML($html);








       
	
	}

}


$arregloCl = "";
$header = array('Cedula',' Nombre', 'Apellido', 'Sexo','Fecha Nacimiento','Direccion');
$pdf = new PDF();
$pdf->AddPage();
$pdf->BasicTable($header,$arregloCl,$lsNombreNovio);
$pdf->Output();
?>
