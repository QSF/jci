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
		$pdf->Image("./assets/img/logo-pdf.jpg", 6, 1, 10);


		$pdf->setXY(6,7);
		$pdf->SetFont('Arial','B',22);

		$str = utf8_decode("Relatório de Cruzamento de Dados");
		$pdf->Cell(10,1,$str,0,0,'C',0);

		$pdf->Ln();
	}

	public function generateReportField($listVolunteer, $listEntities, $field){

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

		$pdf->setXY(5.65-($pdf->GetStringWidth("Campo")/2),12);
		$pdf->cell(6,1,"Campo",0,0,'C');

		/***  Nome e Email do Voluntário ***/	
		$pdf->setXY(11.5-($pdf->GetStringWidth("Nome")/2),12);
		$pdf->cell(4,1,"Nome",0,0,'C');

		$pdf->setXY(15.3-($pdf->GetStringWidth("Campo")/2),12);
		$pdf->cell(6,1,"Campo",0,0,'C');

		/***  Linha Horizontais ***/	

		$y = 13;
		$pdf->Line(2,$y,19.3,$y);
		for($i = 0; $i < count($listVolunteer) || $i < count($listEntities); $i++){

			if(array_key_exists($i, $listEntities)){

				/***  Nome da Entidade Iterada ***/
				$pdf->SetFont('Arial','B',10);
				$pdf->setXY(2 - ($pdf->GetStringWidth("Nome")/2),$y);
				$pdf->SetFont('Arial','',9);
				$pdf->cell(4,1,utf8_decode($listEntities[$i]->getName()),0,0,'C',false);

				/***  Email da Entidade Iterada ***/
				$pdf->SetFont('Arial','B',10);
				$pdf->setXY(5.65 - ($pdf->GetStringWidth('Campo')/2),$y);
				$pdf->SetFont('Arial','',9);
				$pdf->cell(6,1,utf8_decode($this->returnStringFields($listEntities[$i]->getActingArea())),0,0,'C',false);
			}

			if(array_key_exists($i, $listVolunteer)){

				/***  Nome da Entidade Iterada ***/
				$pdf->SetFont('Arial','B',10);
				$pdf->setXY(11.5 - ($pdf->GetStringWidth("Nome")/2),$y);
				$pdf->SetFont('Arial','',9);
				$pdf->cell(4,1,utf8_decode($listVolunteer[$i]->getName()),0,0,'C',false);

				/***  Email da Entidade Iterada ***/
				$pdf->SetFont('Arial','B',10);
				$pdf->setXY(15.3 - ($pdf->GetStringWidth('Campo')/2),$y);
				$pdf->SetFont('Arial','',9);
				$pdf->cell(6,1,utf8_decode($this->returnStringFields($listVolunteer[$i]->getActingArea())),0,0,'C',false);
			}

			$y++;
			$pdf->Line(2,$y,19.3,$y);

		}
		$pdf->Output();
	}

	private function returnStringFields($fields){
		return implode(', ',$fields);
	}

	public function generateReportUser($userTarget, $listUsers){
		$pdf = new PDF("P","cm","A4", $this->moderator);
		$this->defineHeader($pdf);

		$typeUserPortuguese = $this->getTypeUserPortuguese($userTarget);

		$pdf->SetFont('Arial','',14);		

		$pdf->Ln();
		$typeUserLabel = $typeUserPortuguese .": ". utf8_decode($userTarget->getName());
		$pdf->write(1, $typeUserLabel);

		$pdf->SetFont('Arial','',12);
		$pdf->Ln();
		$fields = "Áreas de Atuação: ". implode(', ', $userTarget->getActingArea());
		$pdf->write(1, utf8_decode($fields));

		$pdf->Ln();

		$y = 11.3;
		$pdf->SetFont('Arial','B',10);
		$pdf->setXY(2-($pdf->GetStringWidth("Pos")/2),$y);
		$pdf->cell(1,1,"Pos",0,0,'C');

		$pdf->setXY(2.9-($pdf->GetStringWidth("Nome")/2),$y);
		$pdf->cell(6.9,1,"Nome",0,0,'C');

		$pdf->setXY(7.7-($pdf->GetStringWidth("Email")/2),$y);
		$pdf->cell(6,1,"Email",0,0,'C');
		//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
		$pdf->setXY(13.9-($pdf->GetStringWidth("Telefone")/2),$y);
		$pdf->cell(2,1,"Telefone",0,0,'C',false);

		$pdf->setXY(15.9-($pdf->GetStringWidth("Campos")/2),$y);
		$pdf->cell(4,1,"Campos",0,0,'C',false);

		$i = 1;
		$y++;
		$pdf->SetFont('Arial','',8);
		//$vetor = $this->populateArray();

		$pdf->SetFillColor(0,127,255);
		foreach($listUsers as $user){

			if(($i % 2) == 1)
				$pdf->Rect(2-($pdf->GetStringWidth("Pos")/2),$y,17.6-($pdf->GetStringWidth("Telefone")/2),1,"F");
			$pdf->SetFont('Arial','B',10);
			$pdf->setXY(2 - ($pdf->GetStringWidth("Pos")/2),$y);
			$pdf->SetFont('Arial','',8);
			$pdf->cell(1,1,$i,0,0,'C',false);

			$pdf->SetFont('Arial','B',10);
			$pdf->setXY(2.9 - ($pdf->GetStringWidth("Nome")/2),$y);
			$pdf->SetFont('Arial','',8);
			$nameUTF8 = utf8_decode($user->getName());
			$pdf->cell(6.9,1,$nameUTF8,0,0,'C',false);

			//echo $pdf->GetStringWidth($elem['email'])/2;
			$pdf->SetFont('Arial','B',10);
			$pdf->setXY(7.7 - ($pdf->GetStringWidth('Email')/2),$y);
			$pdf->SetFont('Arial','',8);
			$emailUTF8 = utf8_decode($user->getEmail());
			$pdf->cell(6,1,$emailUTF8,0,0,'C',false);
			//$pdf->text(10 - ($pdf->GetStringWidth($elem['email'])/2) ,$y,$elem['email']);

			$pdf->SetFont('Arial','B',10);
			$pdf->setXY(13.9 - ($pdf->GetStringWidth("Telefone")/2),$y);
			$pdf->SetFont('Arial','',8);
			$telefoneUTF8 = utf8_decode($user->getPhone());
			$pdf->cell(2,1,$telefoneUTF8,0,0,'C',false);

			$pdf->SetFont('Arial','B',10);
			$pdf->setXY(15.9 - ($pdf->GetStringWidth("Campos")/2),$y);
			$pdf->SetFont('Arial','',8);
			$telefoneUTF8 = utf8_decode($this->getSameFields($userTarget, $user));
			$pdf->cell(4,1,$telefoneUTF8,0,0,'C',false);


			$i++;
			$y++;
		}

		$pdf->Output();

	}

	private function getSameFields($userTarget, $userReport){

		$fieldsTargetId = array();
		foreach($userTarget->getActingArea() as $field){
			array_push($fieldsTargetId, $field->getId());
		}
		$arraySameFields = array();
		foreach($userReport->getActingArea() as $field){

			if(in_array($field->getId(), $fieldsTargetId))
				array_push($arraySameFields, $field);
		}

		return implode(', ', $arraySameFields);

	}

	private function getTypeUserPortuguese($user){
		$typeUser = get_class($user);
		switch( $typeUser ){
			case "VolunteerNaturalPerson":
				$typePortuguese = "Voluntário Pessoa Física";
				break;
			case "VolunteerLegalPerson":
				$typePortuguese = "Voluntário Pessoa Jurídica";
				break;
			case "Entity":
				$typePortuguese = "Entidade";
				break;
		}
		return utf8_decode($typePortuguese);
	}

}
	class PDF extends FPDF{

		private $moderator;

		public function __construct($type, $size, $typePaper, $moderator){
			$this->moderator = $moderator;
			parent::__construct($type, $size, $typePaper);
		}

		public function header(){
			$this->setXY(1,0.2);
			$this->SetFont('Arial','',8);
			$msgHeader = "Relatorio gerado por ".$this->moderator->getLogin()." as ".date ('d-m-Y  H:i');
			$this->Cell(10,1,$msgHeader,0,0,'L',0);
		}
	}

?>