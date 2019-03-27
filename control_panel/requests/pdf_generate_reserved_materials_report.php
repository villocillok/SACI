<?php
    require_once('../../fpdf/pdf_mc_table.php');

    class PDF_Generate_Reserved_Materials_Report extends PDF_MC_Table {
        public $dateRange = '';
        public $printedBy = '';
        function Header() {
            $this->SetFillColor(25, 40, 35);
            $this->SetMargins(10, 15, 10);
            
            if($this->PageNo() == 1) {
                $this->SetFont('Arial', '', 20);
                $this->SetTextColor(25, 40, 35);
                //$this->Cell(0, 8, 'Southeast Asian College, Inc.', 0, 0, 'L');
                $this->Image('Southeast Asian College.png',20,10,15);
                $this->Ln(); //added
                $this->Cell(0, 10, 'Web-based Library Management System for', 0, 0, 'C');
                $this->Ln();
                $this->Cell(0, 10, 'Southeast Asian College, Inc.', 0, 0, 'C');
                $this->Ln();
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 5, 'Reservation Report', 0, 0, 'L');
                $this->Ln();//added
                $this->Cell(0, 5, 'Date of report: '. $this->dateRange, 0, 0, 'L');//accoding to date picker
                $this->Ln(20);
            }


            $this->SetFont('Arial', 'B', 10);
            $this->SetTextColor(25, 40, 35);
            $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
            $this->SetWidths(array(25, 20, 15, 20, 20, 35, 30, 25));
            $this->Row(array('Reservation ID', 'Borrower ID', 'Book ID', 'Accession Number', 'Barcode Number', 'Book Title', 'Date Reserved', 'Status'));
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