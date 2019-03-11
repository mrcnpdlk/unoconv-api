<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 16:39
 */

namespace Mrcnpdlk\Api\Unoconv\Enum;

use Mrcnpdlk\Api\Unoconv\Exception\DomainException;
use MyCLabs\Enum\Enum;

/**
 * Class FormatType
 *
 * @method static BIB()
 * @method static DOC()
 * @method static DOC6()
 * @method static DOC95()
 * @method static DOCBOOK()
 * @method static DOCX()
 * @method static DOCX7()
 * @method static FODT()
 * @method static HTML()
 * @method static LATEX()
 * @method static MEDIAWIKI()
 * @method static ODT()
 * @method static OOXML()
 * @method static OTT()
 * @method static PDB()
 * @method static PDF()
 * @method static PSW()
 * @method static RTF()
 * @method static SDW()
 * @method static SDW4()
 * @method static SDW3()
 * @method static STW()
 * @method static SXW()
 * @method static TEXT()
 * @method static TXT()
 * @method static UOT()
 * @method static VOR()
 * @method static VOR4()
 * @method static VOR3()
 * @method static WPS()
 * @method static XHTML()
 * @method static BMP()
 * @method static EMF()
 * @method static EPS()
 * @method static FODG()
 * @method static GIF()
 * @method static JPG()
 * @method static MET()
 * @method static ODD()
 * @method static OTG()
 * @method static PBM()
 * @method static PCT()
 * @method static PGM()
 * @method static PNG()
 * @method static PPM()
 * @method static RAS()
 * @method static STD()
 * @method static SVG()
 * @method static SVM()
 * @method static SWF()
 * @method static SXD()
 * @method static SXD3()
 * @method static SXD5()
 * @method static TIFF()
 * @method static WMF()
 * @method static XPM()
 * @method static ODG()
 * @method static ODP()
 * @method static OTP()
 * @method static POTM()
 * @method static POT()
 * @method static PPTX()
 * @method static PPS()
 * @method static PPT()
 * @method static PWP()
 * @method static SDA()
 * @method static SDD()
 * @method static SDD3()
 * @method static SDD4()
 * @method static STI()
 * @method static SXI()
 * @method static UOP()
 * @method static VOR5()
 * @method static CSV()
 * @method static DBF()
 * @method static DIF()
 * @method static FODS()
 * @method static ODS()
 * @method static OTS()
 * @method static PXL()
 * @method static SDC()
 * @method static SDC4()
 * @method static SDC3()
 * @method static SLK()
 * @method static STC()
 * @method static SXC()
 * @method static UOS()
 * @method static XLS()
 * @method static XLS5()
 * @method static XLS95()
 * @method static XLT()
 * @method static XLT5()
 * @method static XLT95()
 * @method static XLSX()
 */
final class FormatType extends Enum
{
    public const BIB       = 'bib';
    public const DOC       = 'doc';
    public const DOC6      = 'doc6';
    public const DOC95     = 'doc95';
    public const DOCBOOK   = 'docbook';
    public const DOCX      = 'docx';
    public const DOCX7     = 'docx7';
    public const FODT      = 'fodt';
    public const HTML      = 'html';
    public const LATEX     = 'latex';
    public const MEDIAWIKI = 'mediawiki';
    public const ODT       = 'odt';
    public const OOXML     = 'ooxml';
    public const OTT       = 'ott';
    public const PDB       = 'pdb';
    public const PDF       = 'pdf';
    public const PSW       = 'psw';
    public const RTF       = 'rtf';
    public const SDW       = 'sdw';
    public const SDW4      = 'sdw4';
    public const SDW3      = 'sdw3';
    public const STW       = 'stw';
    public const SXW       = 'sxw';
    public const TEXT      = 'text';
    public const TXT       = 'txt';
    public const UOT       = 'uot';
    public const VOR       = 'vor';
    public const VOR4      = 'vor4';
    public const VOR3      = 'vor3';
    public const WPS       = 'wps';
    public const XHTML     = 'xhtml';
    public const BMP       = 'bmp';
    public const EMF       = 'emf';
    public const EPS       = 'eps';
    public const FODG      = 'fodg';
    public const GIF       = 'gif';
    public const JPG       = 'jpg';
    public const MET       = 'met';
    public const ODD       = 'odd';
    public const OTG       = 'otg';
    public const PBM       = 'pbm';
    public const PCT       = 'pct';
    public const PGM       = 'pgm';
    public const PNG       = 'png';
    public const PPM       = 'ppm';
    public const RAS       = 'ras';
    public const STD       = 'std';
    public const SVG       = 'svg';
    public const SVM       = 'svm';
    public const SWF       = 'swf';
    public const SXD       = 'sxd';
    public const SXD3      = 'sxd3';
    public const SXD5      = 'sxd5';
    public const TIFF      = 'tiff';
    public const WMF       = 'wmf';
    public const XPM       = 'xpm';
    public const ODG       = 'odg';
    public const ODP       = 'odp';
    public const OTP       = 'otp';
    public const POTM      = 'potm';
    public const POT       = 'pot';
    public const PPTX      = 'pptx';
    public const PPS       = 'pps';
    public const PPT       = 'ppt';
    public const PWP       = 'pwp';
    public const SDA       = 'sda';
    public const SDD       = 'sdd';
    public const SDD3      = 'sdd3';
    public const SDD4      = 'sdd4';
    public const STI       = 'sti';
    public const SXI       = 'sxi';
    public const UOP       = 'uop';
    public const VOR5      = 'vor5';
    public const CSV       = 'csv';
    public const DBF       = 'dbf';
    public const DIF       = 'dif';
    public const FODS      = 'fods';
    public const ODS       = 'ods';
    public const OTS       = 'ots';
    public const PXL       = 'pxl';
    public const SDC       = 'sdc';
    public const SDC4      = 'sdc4';
    public const SDC3      = 'sdc3';
    public const SLK       = 'slk';
    public const STC       = 'stc';
    public const SXC       = 'sxc';
    public const UOS       = 'uos';
    public const XLS       = 'xls';
    public const XLS5      = 'xls5';
    public const XLS95     = 'xls95';
    public const XLT       = 'xlt';
    public const XLT5      = 'xlt5';
    public const XLT95     = 'xlt95';
    public const XLSX      = 'xlsx';

    /**
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\DomainException
     *
     * @return string
     */
    public function getExtension(): string
    {
        $tMap = [
            self::BIB       => 'bib',
            self::DOC       => 'doc',
            self::DOC6      => 'doc',
            self::DOC95     => 'doc',
            self::DOCBOOK   => 'xml',
            self::DOCX      => 'docx',
            self::DOCX7     => 'docx',
            self::FODT      => 'fodt',
            self::HTML      => 'html',
            self::LATEX     => 'ltx',
            self::MEDIAWIKI => 'txt',
            self::ODT       => 'odt',
            self::OOXML     => 'xml',
            self::OTT       => 'ott',
            self::PDB       => 'pdb',
            self::PDF       => 'pdf',
            self::PSW       => 'psw',
            self::RTF       => 'rtf',
            self::SDW       => 'sdw',
            self::SDW4      => 'sdw',
            self::SDW3      => 'sdw',
            self::STW       => 'stw',
            self::SXW       => 'sxw',
            self::TEXT      => 'txt',
            self::TXT       => 'txt',
            self::UOT       => 'uot',
            self::VOR       => 'vor',
            self::VOR4      => 'vor',
            self::VOR3      => 'vor',
            self::WPS       => 'wps',
            self::XHTML     => 'html',
            self::BMP       => 'bmp',
            self::EMF       => 'emf',
            self::EPS       => 'eps',
            self::FODG      => 'fodg',
            self::GIF       => 'gif',
            self::JPG       => 'jpg',
            self::MET       => 'met',
            self::ODD       => 'odd',
            self::OTG       => 'otg',
            self::PBM       => 'pbm',
            self::PCT       => 'pct',
            self::PGM       => 'pgm',
            self::PNG       => 'png',
            self::PPM       => 'ppm',
            self::RAS       => 'ras',
            self::STD       => 'std',
            self::SVG       => 'svg',
            self::SVM       => 'svm',
            self::SWF       => 'swf',
            self::SXD       => 'sxd',
            self::SXD3      => 'sxd',
            self::SXD5      => 'sxd',
            self::TIFF      => 'tiff',
            self::WMF       => 'wmf',
            self::XPM       => 'xpm',
            self::ODG       => 'odg',
            self::ODP       => 'odp',
            self::OTP       => 'otp',
            self::POTM      => 'potm',
            self::POT       => 'pot',
            self::PPTX      => 'pptx',
            self::PPS       => 'pps',
            self::PPT       => 'ppt',
            self::PWP       => 'pwp',
            self::SDA       => 'sda',
            self::SDD       => 'sdd',
            self::SDD3      => 'sdd',
            self::SDD4      => 'sdd',
            self::STI       => 'sti',
            self::SXI       => 'sxi',
            self::UOP       => 'uop',
            self::VOR5      => 'vor',
            self::CSV       => 'csv',
            self::DBF       => 'dbf',
            self::DIF       => 'dif',
            self::FODS      => 'fods',
            self::ODS       => 'ods',
            self::OTS       => 'ots',
            self::PXL       => 'pxl',
            self::SDC       => 'sdc',
            self::SDC4      => 'sdc',
            self::SDC3      => 'sdc',
            self::SLK       => 'slk',
            self::STC       => 'stc',
            self::SXC       => 'sxc',
            self::UOS       => 'uos',
            self::XLS       => 'xls',
            self::XLS5      => 'xls',
            self::XLS95     => 'xls',
            self::XLT       => 'xlt',
            self::XLT5      => 'xlt',
            self::XLT95     => 'xlt',
            self::XLSX      => 'xlsx',
        ];

        if (isset($tMap[$this->getValue()])) {
            return $tMap[$this->getValue()];
        }
        throw new DomainException(sprintf('Default extension form "%s" not defined', $this->getKey()));
    }
}
