<?php
require_once('db.php');
require_once('fpdf.php');

class PDF extends FPDF
{
function Header()
{
	global $title;
     
	$this->Ln(35);
	// Arial bold 15
	$this->SetFont('Arial','B',18);
	// Move to the right
	$this->Cell(80);
	$w = $this->GetStringWidth($title)+6;
	$this->SetX((210-$w)/2);
	// Title
	$this->Cell($w,10,$title,0,1,'C');
	// Line break
	$this->Ln(4);
}

function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	$copyright = "All rights reserved to the author of NITC";
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Text color in gray
	$this->SetTextColor(128);
	// Page number
	$this->Cell(0,10,$copyright,0,0,'C');
}

function ChapterTitle($num, $label)
{
	// Arial 12
	$this->SetFont('Arial','',12);
	// Background color
	$this->SetFillColor(200,220,255);
	// Title
	$this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
	// Line break
	$this->Ln(4);
}

function ChapterBody($file)
{
	// Read text file
	$txt = file_get_contents($file);
	// Times 12
	$this->SetFont('Times','',12);
	// Output justified text
	$this->MultiCell(0,5,$txt);
	// Line break
	$this->Ln();
	// Mention in italics
	$this->SetFont('','I');
	$this->Cell(0,5,'(end of excerpt)');
}

function PrintChapter($num, $title, $file)
{
	$this->AddPage();
	$this->ChapterTitle($num,$title);
	$this->ChapterBody($file);
}
}

$pdf = new PDF();
$title = 'National Institue of Technology, Calicut';
$pdf->SetTitle($title);
$pdf->SetAuthor('Jules Verne');
$pdf->AddPage();

$pdf->SetFont('Arial','B',13);
$dept = 'Department of Computer Science and Engineering';
$pdf->Cell(190,10,$dept,0,1,'C');

$pdf->SetFont('Arial','B',10);
$str = 'Technical Report';
$pdf->Cell(200,10,$str,0,1,'C');

$pdf->SetFont('Arial','B',10);
$rid = $_GET['id'];
$que = mysqli_query($con,"select * from techreport where reportid='$rid'");
while($res = mysqli_fetch_array($que))
{
	$aid = $res['authorid'];
	$uid = $res['uniqueid'];
	$title = $res['title'];
	$year = $res['year'];
	$seque = mysqli_query($con,"select * from author where authorid='$aid'");
	if($op = mysqli_fetch_array($seque))
	 $val = $op['authorname'];
    $pdf->Cell(200,0,$title,0,1,'C');
    //$pdf->Cell(190,0,',');
    $pdf->Cell(200,10,$val,0,1,'C');
    $pdf->Cell(200,2,$uid,0,1,'C');
    //$pdf->Cell(250,7,$year,0,1,'C');
}
$pdf->Cell(200);
$pdf->Image('images/1.jpg',80,120,60);
$pdf->Ln(35);

$pdf->Output();
?>
