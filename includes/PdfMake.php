<?php
/**
 * Created by PhpStorm.
 * User: Sakri
 * Date: 20.7.2019
 * Time: 3.17
 */

use setasign\Fpdi\Fpdi;

class PDF extends Fpdi
{
    protected $watermark_text;

    public function set_watermark_text($text)
    {
        $this->watermark_text = $text;
    }

    function Footer()
    {
        $this->SetFont('Helvetica', '', 9);
        $this->SetTextColor(255, 0, 0);
        $this->SetY(-10);
        $this->Cell(0, 10, $this->watermark_text, 0, 1, "C");
    }
}

class PdfMake
{
    public function __construct()
    {

    }

    /** Loads PDF from sourcePath, adds a watermark to it and saves it ot outputPath
     * @param $sourcePath
     * @param $outputPath
     * @return mixed
     */
    public function AddFooterWatermark($watermark_text, $source_path, $output_path)
    {
        $pdf = new PDF();
        $pdf->set_watermark_text($watermark_text);

        $pdf->setSourceFile($source_path);
        $tplIdx = $pdf->importPage(1);

        $size = $pdf->getTemplateSize($tplIdx);
        $orientation = ($size['height'] > $size['width']) ? 'P' : 'L';

        if ($orientation == "P") {
            $pdf->AddPage($orientation, array($size['width'], $size['height']));
        } else {
            $pdf->AddPage($orientation, array($size['height'], $size['width']));
        }

        $pdf->useTemplate($tplIdx);

        $pdf->SetTitle("Any Title");
        $pdf->SetAuthor("Any Author");
        $pdf->SetSubject("Any Subject");
        $pdf->SetCreator("Any Creator");

        $pdf->Output("F", $output_path);

        return true;
    }
}