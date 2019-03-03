<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 15:44
 */

namespace Mrcnpdlk\Api\Unoconv\Enum;

use MyCLabs\Enum\Enum;

/**
 * Class DocType
 * @method static DOCUMENT()
 * @method static GRAPHICS()
 * @method static PRESENTATION()
 * @method static SPREADSHEET()
 */
class DocType extends Enum
{
    public const DOCUMENT     = 'document';
    public const GRAPHICS     = 'graphics';
    public const PRESENTATION = 'presentation';
    public const SPREADSHEET  = 'spreadsheet';
}
