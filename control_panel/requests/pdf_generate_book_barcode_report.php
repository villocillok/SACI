<?php
    require_once('../../fpdf/pdf_mc_table.php');

    class PDF_Generate_Book_Barcode_Report extends PDF_MC_Table {
        //public $dateRange = '';
        public $printedBy = '';
        
        function Header() {
            $this->SetFillColor(25, 40, 35);
            $this->SetMargins(20, 15, 10);
            
            if($this->PageNo() == 1) {
                $this->SetFont('Arial', '', 20);
                $this->SetTextColor(20, 40, 35);
                //$this->Cell(0, 8, 'Southeast Asian College, Inc.', 0, 0, 'L');
                $this->Image('Southeast Asian College.png',30,10,15);
                $this->Ln(); //added
                $this->Cell(0, 10, 'Web-based Library Management System for', 0, 0, 'C');
                $this->Ln();
                $this->Cell(0, 10, 'Southeast Asian College, Inc.', 0, 0, 'C');
                $this->Ln();
                $this->SetFont('Arial', '', 10);
                $this->Cell(20, 5, 'Book Barcode Report', 0, 0, 'L');
                $this->Ln();//added
                //$this->Cell(0, 5, 'Date of report: '. $this->dateRange, 0, 0, 'L');//accoding to date picker
                $this->Ln(20);
            }

            $this->SetFont('Arial', 'B', 10);
            $this->SetTextColor(25, 40, 35);
            $this->SetAligns(array('C', 'C', 'C', 'C', 'C'));
            $this->SetWidths(array(25, 30, 30, 40, 40));
            $this->Row(array('Book ID', 'Accession Number','Barcode number', 'Book Title', 'Barcode'));
            $this->SetFont('Arial', '', 8);
            $this->SetTextColor(25, 40, 35);
        }

         function Footer() {
            $this->SetFont('Arial', 'I', 8);
            $this->SetTextColor(150);
            $this->SetY(-20);
            
            $this->SetY(-20);
            //$this->Cell(0, 10, 'Library System: Generated Report', 0, 0, 'L');
            $this->Cell(0, 10, 'Printed by: '.$this->printedBy, 0, 1, 'L'); 
            $this->Cell(0, 10, 'Date printed: ' . date('F d, Y'), 0, 0, 'L');//who print the report
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
            //$this->Cell(0, 10, 'Date printed: ', 0, 0, 'L');// current date
        }

        function BarcodeRow($data) {
            $h=25;
            //Issue a page break first if needed
            $this->CheckPageBreak($h);
            //Draw the cells of the row
            for($i=0;$i<count($data);$i++)
            {
                $w=$this->widths[$i];
                $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                //Save the current position
                $x=$this->GetX();
                $y=$this->GetY();

                $barcodeParser = explode(":::", $data[$i]);

                //Print barcode if text is a barcode number
                if($barcodeParser[0] === 'BARCODE') {
                    $this->Barcode($x+3,$y+3,$barcodeParser[1],14,.35,9,13);
                }

                //Draw the border
                $this->Rect($x,$y,$w,$h);
                
                //Print the text if text is not a barcode number
                if($barcodeParser[0] !== 'BARCODE') {
                    $this->MultiCell($w,5,$data[$i],0,$a);
                }

                //Put the position to the right of the cell
                $this->SetXY($x+$w,$y);
            }
            //Go to the next line
            $this->Ln($h);
        }

        function Barcode($x, $y, $barcode, $h, $w, $fSize, $len)
        {
            //Padding
            $barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
            if($len==12)
                $barcode='0'.$barcode;
            //Add or control the check digit
            if(strlen($barcode)==12)
                $barcode.=$this->GetCheckDigit($barcode);
            elseif(!$this->TestCheckDigit($barcode))
                $this->Error('Incorrect check digit');
            //Convert digits to bars
            $codes=array(
                'A'=>array(
                    '0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
                    '5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
                'B'=>array(
                    '0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
                    '5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
                'C'=>array(
                    '0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
                    '5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
                );
            $parities=array(
                '0'=>array('A','A','A','A','A','A'),
                '1'=>array('A','A','B','A','B','B'),
                '2'=>array('A','A','B','B','A','B'),
                '3'=>array('A','A','B','B','B','A'),
                '4'=>array('A','B','A','A','B','B'),
                '5'=>array('A','B','B','A','A','B'),
                '6'=>array('A','B','B','B','A','A'),
                '7'=>array('A','B','A','B','A','B'),
                '8'=>array('A','B','A','B','B','A'),
                '9'=>array('A','B','B','A','B','A')
                );
            $code='101';
            $p=$parities[$barcode[0]];
            for($i=1;$i<=6;$i++)
                $code.=$codes[$p[$i-1]][$barcode[$i]];
            $code.='01010';
            for($i=7;$i<=12;$i++)
                $code.=$codes['C'][$barcode[$i]];
            $code.='101';
            //Draw bars
            for($i=0;$i<strlen($code);$i++)
            {
                if($code[$i]=='1')
                    $this->Rect($x+$i*$w,$y,$w,$h,'F');
            }
            //Print text uder barcode
            $this->SetFont('Arial','',$fSize);
            $this->Text($x,$y+$h+11/$this->k,substr($barcode,-$len));
        }

        function GetCheckDigit($barcode)
        {
            //Compute the check digit
            $sum=0;
            for($i=1;$i<=11;$i+=2)
                $sum+=3*$barcode[$i];
            for($i=0;$i<=10;$i+=2)
                $sum+=$barcode[$i];
            $r=$sum%10;
            if($r>0)
                $r=10-$r;
            return $r;
        }
        function TestCheckDigit($barcode)
        {
            //Test validity of check digit
            $sum=0;
            for($i=1;$i<=11;$i+=2)
                $sum+=3*$barcode[$i];
            for($i=0;$i<=10;$i+=2)
                $sum+=$barcode[$i];
            return ($sum+$barcode[12])%10==0;
        }
    }
?>
