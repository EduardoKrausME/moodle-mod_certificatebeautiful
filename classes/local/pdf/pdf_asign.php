<?php
// This file is part of the mod_certificatebeautiful plugin for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Class pdf_asign
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\pdf\asign;

use Mpdf\Mpdf;
use setasign\Fpdi\Tcpdf\Fpdi;

use Exception;

/**
 * Class pdf_asign
 *
 * @package mod_certificatebeautiful\local\pdf\asign
 */
class pdf_asign {

    /**
     * Var documentoparaassinar
     *
     * @var string
     */
    public $documentoparaassinar;
    /**
     * Var fileprivate
     *
     * @var string
     */
    public $fileprivate;
    /**
     * Var filecrt
     *
     * @var string
     */
    public $filecrt;
    /**
     * Var password
     *
     * @var string
     */
    public $password;

    /** @var Mpdf */
    public $mpdf;

    /**
     * pdf_asign constructor.
     *
     * @param $pdf
     * @param Mpdf $mpdf
     */
    public function __construct($pdf, Mpdf $mpdf) {
        global $CFG;

        $diretorio = "{$CFG->tempdir}/" . uniqid();
        $this->filecrt = "{$diretorio}-tcpdf.crt";
        $this->password = "1234567890";
        $this->mpdf = $mpdf;

        $this->filecrt = __DIR__ . "/cert/domain.csr";
        $this->fileprivate = __DIR__ . "/cert/domain.key";

        $this->documentoparaassinar = "{$diretorio}-contrato.pdf";
        file_put_contents($this->documentoparaassinar, $pdf);
    }

    /**
     * create_signature
     *
     * @throws \setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException
     * @throws \setasign\Fpdi\PdfParser\Filter\FilterException
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     * @throws \setasign\Fpdi\PdfParser\Type\PdfTypeException
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     * @throws Exception
     */
    public function create_signature() {
        $info = [
            'Name' => 'TCPDF',
            'Location' => 'Office',
            'Reason' => 'Testing TCPDF',
            'ContactInfo' => 'http://www.tcpdf.org',
        ];

        $pdf = new Fpdi('L', 'mm', 'A4', true, 'UTF-8', false, false);
        $numpages = 2;
        $pdf->setSignature("file://{$this->filecrt}", "file://{$this->fileprivate}", $this->password, '', 2, $info);

        for ($i = 0; $i < $numpages; $i++) {
            $pdf->AddPage();

            $pdf->setSignatureAppearance(10, 20, 30, 30);
            $pdf->addEmptySignatureAppearance(10, 20, 30, 30);

            $pdf->writeHTML(uniqid());

            return $pdf->Output('doc.pdf', 'S');
        }

    }
}
