<?php
    require_once('../../fpdf/pdf_mc_table.php');

    class PDF_Generate_Materials_Report extends PDF_MC_Table {
        //public $dateRange = '';
        public $printedBy = '';
        function Header() {
            $this->SetFillColor(25, 40, 35);
            $this->SetMargins(10, 15, 10);
            
            if($this->PageNo() == 1) {
                $this->SetFont('Arial', '', 20);
                $this->SetTextColor(25, 40, 35);
                //$this->Cell(0, 8, 'Southeast Asian College, Inc.', 0, 0, 'L');
                $this->Image('Southeast Asian College.png',10,10,10);
                $this->Ln(); //added
				$this->Cell(0, 10, 'Web-based Library Management System for Southeast Asian College, Inc.', 0, 0, 'C');
                $this->Ln();
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 5, 'Books Report', 0, 0, 'L');
				$this->Ln();//added
               // $this->Cell(0, 5, 'Date of report: '. $this->dateRange, 0, 0, 'L');//accoding to date picker
                $this->Ln(20);
            }

            $this->SetFont('Arial', 'B', 10);
            $this->SetTextColor(25, 40, 35);
            $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C','C','C','C')); #Original, there are only 8 Cs. There should be 11.
            $this->SetWidths(array(20, 25, 30, 20, 20, 20, 30, 25, 25, 25, 25));
            $this->Row(array('Book ID', 'Publisher', 'Section', 'Book Title', 'Call Number', 'Edition', 'Year Published','Quantity','Unit of price', 'Author(s)', 'Category'));
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
    }
?>