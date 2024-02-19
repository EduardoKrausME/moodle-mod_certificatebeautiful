<?php
/**
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @date        18/02/2024 11:31
 */

namespace mod_certificatebeautiful\local\pdf\asign;

use Mpdf\Mpdf;
use setasign\Fpdi\Tcpdf\Fpdi;

use Exception;

class pdf_asign {

    public $documentoParaAssinar;
    public $filePrivate;
    public $fileCRT;
    public $password;

    /** @var Mpdf */
    public $mpdf;

    public function __construct($pdf, Mpdf $mpdf) {
        global $CFG;

        $diretorio = "{$CFG->tempdir}/" . uniqid();
        $this->fileCRT = "{$diretorio}-tcpdf.crt";
        $this->password = "1234567890";
        $this->mpdf = $mpdf;


        $this->fileCRT = __DIR__ . "/cert/domain.csr";
        $this->filePrivate = __DIR__ . "/cert/domain.key";

        $this->documentoParaAssinar = "{$diretorio}-contrato.pdf";
        file_put_contents($this->documentoParaAssinar, $pdf);

//        $dn = array(
//            "countryName" => "GB",
//            "stateOrProvinceName" => "Somerset",
//            "localityName" => "Glastonbury",
//            "organizationName" => "The Brain Room Limited",
//            "organizationalUnitName" => "PHP Documentation Team",
//            "commonName" => "Wez Furlong",
//            "emailAddress" => "wez@example.com"
//        );
//        $privkey = openssl_pkey_new(array(
//            "private_key_bits" => 2048,
//            "private_key_type" => OPENSSL_KEYTYPE_RSA,
//        ));
//        $csr = openssl_csr_new($dn, $privkey, ['digest_alg' => 'sha256']);
//        $x509 = openssl_csr_sign($csr, null, $privkey, $days = 365, ['digest_alg' => 'sha256']);
//        openssl_csr_export($csr, $csrout);
//        openssl_x509_export($x509, $certout);
//        openssl_pkey_export($privkey, $pkeyout, $this->password);
//
//        file_put_contents($this->filePrivate, $pkeyout);
//        file_put_contents($this->fileCRT, $pkeyout);

    }

    /**
     * @throws \setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException
     * @throws \setasign\Fpdi\PdfParser\Filter\FilterException
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     * @throws \setasign\Fpdi\PdfParser\Type\PdfTypeException
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     * @throws Exception
     */
    public function createSignature() {

        // $p = file_get_contents($this->fileCRT);
        // $cert = openssl_x509_read($p);
        // $cert_parsed = openssl_x509_parse($cert, true);
        // echo '<pre>';print_r($cert_parsed);echo '</pre>';

        $info = array(
            'Name' => 'TCPDF',
            'Location' => 'Office',
            'Reason' => 'Testing TCPDF',
            'ContactInfo' => 'http://www.tcpdf.org',
        );

        $pdf = new Fpdi('L', 'mm', 'A4', true, 'UTF-8', false, false);
        // $numPages = $pdf->setSourceFile($this->documentoParaAssinar);
        $numPages = 2;
        $pdf->setSignature("file://{$this->fileCRT}", "file://{$this->filePrivate}", $this->password, '', 2, $info);

        for ($i = 0; $i < $numPages; $i++) {
            $pdf->AddPage();

            //$pdf->useTemplate($pdf->importPage($i + 1), 0, 0);
            $pdf->setSignatureAppearance(10, 20, 30, 30);
            $pdf->addEmptySignatureAppearance(10, 20, 30, 30);

            $pdf->writeHTML(uniqid());

            return $pdf->Output('doc.pdf', 'S');
        }

    }
}