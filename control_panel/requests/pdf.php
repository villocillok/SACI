<?php
    require_once('../../fpdf/pdf_mc_table.php');

    class PDF extends PDF_MC_Table {
        public $sub = '';

        function Header() {
            $this->SetFillColor(25, 40, 35);
            $this->SetMargins(10, 15, 10);
            
            if($this->PageNo() == 1) {
                $this->SetFont('Arial', '', 20);
                $this->SetTextColor(25, 40, 35);
                $this->Cell(0, 8, 'Southeast Asian College, Inc.', 0, 0, 'L');
                $this->Ln();
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 5, $this->sub, 0, 0, 'L');
                $this->Ln(20);
            }

            $this->SetFont('Arial', '', 8);
            $this->SetTextColor(25, 40, 35);
        }

        function Footer() {
            $this->SetFont('Arial', 'I', 8);
            $this->SetTextColor(150);
            $this->SetY(-20);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'R');
            $this->SetY(-20);
            $this->Cell(0, 10, 'Library System: Generated Report', 0, 0, 'L');
        }
    }
?>