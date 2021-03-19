<?php

namespace Madam;

use FPDF;

class PDFController extends FPDF
{
    
    private $title;

    public function setHeaderTitle($title)
    {
        $this->title = $title;
    }

    function Header()
    {
        // $this->Image(self::LOGO_PATH, 10, 6, 30);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(80);
        $this->Cell(30, 10, $this->title, 0, 0, 'C');
        $this->Ln(20);
    }
}