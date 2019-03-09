<?php
/**
 * Created by Marcin.
 * Date: 09.03.2019
 * Time: 16:34
 */

namespace Mrcnpdlk\Api\Unoconv\Enum;

use MyCLabs\Enum\Enum;

/**
 * Class ExportType
 *
 * @see http://www.linux-magazine.com/Issues/2018/208/Command-Line-unoconv/(offset)/3
 * @see http://manpages.ubuntu.com/manpages/trusty/man1/unoconv.1.html
 *
 * @method static AllowDuplicateFieldNames()
 * @method static CenterWindow()
 * @method static Changes()
 * @method static ConvertOOoTargetToPDFTarget()
 * @method static DisplayPDFDocumentTitle()
 * @method static DocumentOpenPassword()
 * @method static EmbedStandardFonts()
 * @method static EnableCopyingOfContent()
 * @method static EnableTextAccessForAccessibilityTools()
 * @method static EncryptFile()
 * @method static ExportBookmarks()
 * @method static ExportBookmarksToPDFDestination()
 * @method static ExportFormFields()
 * @method static ExportLinksRelativeFsys()
 * @method static ExportNotes()
 * @method static ExportNotesPages()
 * @method static FirstPagOnLeft()
 * @method static FormsType()
 * @method static HideViewerMenubar()
 * @method static HideViewerToolbar()
 * @method static HideViewerWindowControls()
 * @method static InitialPage()
 * @method static InitialView()
 * @method static IsAddStream()
 * @method static IsSkipEmptyPages()
 * @method static Magnification()
 * @method static MaxImageResolution()
 * @method static OpenBookmarkLevels()
 * @method static OpenInFullScreenMode()
 * @method static PageLayout()
 * @method static PageRange()
 * @method static PDFViewSelection()
 * @method static PermissionPassword()
 * @method static Printing()
 * @method static Quality()
 * @method static ReduceImageResolution()
 * @method static ResizeWindowToInitialPage()
 * @method static RestrictPermissionPassword()
 * @method static Selection()
 * @method static SelectPdfVersion()
 * @method static UseLosslessCompression()
 * @method static UseTaggedPDF()
 * @method static UseTransitionEffects()
 * @method static Watermark()
 * @method static Zoom()
 */
final class ExportType extends Enum
{
    public const AllowDuplicateFieldNames              = 'AllowDuplicateFieldNames';
    public const CenterWindow                          = 'CenterWindow';
    public const Changes                               = 'Changes';
    public const ConvertOOoTargetToPDFTarget           = 'ConvertOOoTargetToPDFTarget';
    public const DisplayPDFDocumentTitle               = 'DisplayPDFDocumentTitle';
    public const DocumentOpenPassword                  = 'DocumentOpenPassword';
    public const EmbedStandardFonts                    = 'EmbedStandardFonts';
    public const EnableCopyingOfContent                = 'EnableCopyingOfContent';
    public const EnableTextAccessForAccessibilityTools = 'EnableTextAccessForAccessibilityTools';
    public const EncryptFile                           = 'EncryptFile';
    public const ExportBookmarks                       = 'ExportBookmarks';
    public const ExportBookmarksToPDFDestination       = 'ExportBookmarksToPDFDestination';
    public const ExportFormFields                      = 'ExportFormFields';
    public const ExportLinksRelativeFsys               = 'ExportLinksRelativeFsys';
    public const ExportNotes                           = 'ExportNotes';
    public const ExportNotesPages                      = 'ExportNotesPages';
    public const FirstPagOnLeft                        = 'FirstPagOnLeft';
    public const FormsType                             = 'FormsType';
    public const HideViewerMenubar                     = 'HideViewerMenubar';
    public const HideViewerToolbar                     = 'HideViewerToolbar';
    public const HideViewerWindowControls              = 'HideViewerWindowControls';
    public const InitialPage                           = 'InitialPage';
    public const InitialView                           = 'InitialView';
    public const IsAddStream                           = 'IsAddStream';
    public const IsSkipEmptyPages                      = 'IsSkipEmptyPages';
    public const Magnification                         = 'Magnification';
    public const MaxImageResolution                    = 'MaxImageResolution';
    public const OpenBookmarkLevels                    = 'OpenBookmarkLevels';
    public const OpenInFullScreenMode                  = 'OpenInFullScreenMode';
    public const PageLayout                            = 'PageLayout';
    public const PageRange                             = 'PageRange';
    public const PDFViewSelection                      = 'PDFViewSelection';
    public const PermissionPassword                    = 'PermissionPassword';
    public const Printing                              = 'Printing';
    public const Quality                               = 'Quality';
    public const ReduceImageResolution                 = 'ReduceImageResolution';
    public const ResizeWindowToInitialPage             = 'ResizeWindowToInitialPage';
    public const RestrictPermissionPassword            = 'RestrictPermissionPassword';
    public const Selection                             = 'Selection';
    public const SelectPdfVersion                      = 'SelectPdfVersion';
    public const UseLosslessCompression                = 'UseLosslessCompression';
    public const UseTaggedPDF                          = 'UseTaggedPDF';
    public const UseTransitionEffects                  = 'UseTransitionEffects';
    public const Watermark                             = 'Watermark';
    public const Zoom                                  = 'Zoom';
}
