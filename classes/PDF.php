<?php

//include_once LIB_PATH.'/tfpdf/tfpdf.php';
include_once LIB_PATH.'/fpdf/fpdf.php';



class PdfGenerator{

	private $moderator;

	public function __construct($moderator){
		$this->moderator = $moderator;
	}

	public function defineHeader($pdf){
		
		$pdf->AddPage();
		$pdf->SetFont('Arial','',8);
		$pdf->SetMargins(2, 3);
		
		$pdf->SetAuthor('JCI - Londrina');
		$pdf -> SetTitle('Cruzamento de dados - JCI Londrina');
		$pdf->Image("./img/logo.jpg", 6, 1, 10);

		$pdf->setXY(6,7);
		$pdf->SetFont('Arial','B',22);

		$str = utf8_decode("Relatório de Cruzamento de Dados");
		$pdf->Cell(10,1,$str,0,0,'C',0);

		$pdf->Ln();
	}

	public function generateReportField($listVolunteer, $listEntities, $field){
		//return $this->generateRelatorioUser();
		$pdf = new PDF("P","cm","A4", $this->moderator);
		$this->defineHeader($pdf);

		/***  Fiel Area ***/
		$pdf->SetFont('Arial','',14);
		$str1 = utf8_decode("Área de Atuação: ".$field->getName());
		$pdf->write(3, $str1);

		$pdf->setFont('Arial','B',14);

		/***  Entidade Label ***/	
		$middlePage = 9;
		$pdf->setXY(5.1,11);
		$pdf->cell(1,1,"Entidade",0,0,'C');

		/***  Voluntário Label ***/
		$pdf->setXY(14.7,11);
		$pdf->cell(1,1,utf8_decode("Voluntário"),0,0,'C');


		$pdf->SetFont('Arial','B',10);
		/***  Nome e Email da Entidade ***/	
		$pdf->setXY(2-($pdf->GetStringWidth("Nome")/2),12);
		$pdf->cell(4,1,"Nome",0,0,'C');

		$pdf->setXY(5.65-($pdf->GetStringWidth("E-mail")/2),12);
		$pdf->cell(6,1,"Email",0,0,'C');

		/***  Nome e Email do Voluntário ***/	
		$pdf->setXY(11.5-($pdf->GetStringWidth("Nome")/2),12);
		$pdf->cell(4,1,"Nome",0,0,'C');

		$pdf->setXY(15.3-($pdf->GetStringWidth("E-mail")/2),12);
		$pdf->cell(6,1,"Email",0,0,'C');

		/***  Linha Horizontais ***/	
		
		$pdf->Line(2,13,20,13);
		$y = 13;

		for($i = 0; $i < count($listVolunteer) || $i < count($listEntities); $i++){
			
			if(array_key_exists($i, $listEntities)){

				/***  Nome da Entidade Iterada ***/
				$pdf->SetFont('Arial','B',10);
				$pdf->setXY(2 - ($pdf->GetStringWidth("Nome")/2),$y);
				$pdf->SetFont('Arial','',9);
				$pdf->cell(4,1,utf8_decode($listEntities[$i]->getName()),0,0,'C',false);

				/***  Email da Entidade Iterada ***/
				$pdf->SetFont('Arial','B',10);
				$pdf->setXY(5.65 - ($pdf->GetStringWidth('Email')/2),$y);
				$pdf->SetFont('Arial','',9);
				$pdf->cell(6,1,utf8_decode($listEntities[$i]->getEmail()),0,0,'C',false);
			}

			if(array_key_exists($i, $listVolunteer)){

				/***  Nome da Entidade Iterada ***/
				$pdf->SetFont('Arial','B',10);
				$pdf->setXY(11.5 - ($pdf->GetStringWidth("Nome")/2),$y);
				$pdf->SetFont('Arial','',9);
				$pdf->cell(4,1,utf8_decode($listVolunteer[$i]->getName()),0,0,'C',false);

				/***  Email da Entidade Iterada ***/
				$pdf->SetFont('Arial','B',10);
				$pdf->setXY(15.3 - ($pdf->GetStringWidth('Email')/2),$y);
				$pdf->SetFont('Arial','',9);
				$pdf->cell(6,1,utf8_decode($listVolunteer[$i]->getEmail()),0,0,'C',false);
			}

			$y++;
			$pdf->Line(2,$y,20,$y);
		}


		$pdf->Output();
	}

	public function generateRelatorioUser(){
		$pdf = new PDF("P","cm","A4", $this->moderator);
		$this->defineHeader($pdf);
		
		
		$pdf->SetFont('Arial','',14);
		$str1 = utf8_decode("Entidade: São Pedro");
		$pdf->write(3, $str1);

		$pdf->Ln();
		$pdf->Ln();

		$pdf->SetFont('Arial','B',10);
		$pdf->setXY(2-($pdf->GetStringWidth("Pos")/2),11);
		$pdf->cell(1,1,"Pos",0,0,'C');

		$pdf->setXY(3.1-($pdf->GetStringWidth("Nome")/2),11);
		$pdf->cell(6.9,1,"Nome",0,0,'C');

		$pdf->setXY(10-($pdf->GetStringWidth("Email")/2),11);
		$pdf->cell(6,1,"Email",0,0,'C');
//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
		$pdf->setXY(16.6-($pdf->GetStringWidth("Telefone")/2),11);
		$pdf->cell(2,1,"Telefone",0,0,'C',false);

		$i = 1;
		$y=12;
		$pdf->SetFont('Arial','',8);
		$vetor = $this->populateArray();
	
		$pdf->SetFillColor(0,127,255);
		foreach($vetor as $elem){

			if(($i % 2) == 1)
				$pdf->Rect(2-($pdf->GetStringWidth("Pos")/2),$y,16.6-($pdf->GetStringWidth("Telefone")/2),1,"F");
			$pdf->SetFont('Arial','B',10);
			$pdf->setXY(2 - ($pdf->GetStringWidth("Pos")/2),$y);
			$pdf->SetFont('Arial','',8);
			$pdf->cell(1,1,100,0,0,'C',false);

			$pdf->SetFont('Arial','B',10);
			$pdf->setXY(3.1 - ($pdf->GetStringWidth("Nome")/2),$y);
			$pdf->SetFont('Arial','',8);
			$pdf->cell(6.9,1,utf8_decode($elem['name']),0,0,'C',false);

			//echo $pdf->GetStringWidth($elem['email'])/2;
			$pdf->SetFont('Arial','B',10);
			$pdf->setXY(10 - ($pdf->GetStringWidth('Email')/2),$y);
			$pdf->SetFont('Arial','',8);
			$pdf->cell(6,1,$elem['email'],0,0,'C',false);
			//$pdf->text(10 - ($pdf->GetStringWidth($elem['email'])/2) ,$y,$elem['email']);

			$pdf->SetFont('Arial','B',10);
			$pdf->setXY(16.6 - ($pdf->GetStringWidth("Telefone")/2),$y);
			$pdf->SetFont('Arial','',8);
			$pdf->cell(2,1,$elem['telefone'],0,0,'C',false);

			$i++;
			$y++;
		}

		$pdf->Output();

	}

	public function populateArray(){
		return array(1=>array('name'=>'Jpowdpwopdoqwpdoqpoqdpodqpodqpoq','email'=>'joaoooooooooo@bol.com','telefone'=>33235153),
				2=>array('name'=>'jaj','email'=>'haha','telefone'=>30302),3=>array('name'=>'woowo','email'=>'jsjs','telefone'=>2002));
	}

	
}
	class PDF extends FPDF{

		private $moderator;

		public function __construct($type, $size, $typePaper, $moderator){
			$this->moderator = $moderator;
			parent::__construct($type, $size, $typePaper);
		}

		public function header(){

			$this->SetFont('Arial','',8);
			$this->Cell(10,1,"Relatorio gerado por ".$this->moderator->getLogin(),0,0,'L',0);
		}
	}

?>