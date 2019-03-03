<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 14:22
 */

namespace Mrcnpdlk\Api\Unoconv;

use mikehaertl\shellcommand\Command;
use Mrcnpdlk\Api\Unoconv\Enum\FormatType;
use Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException;
use Mrcnpdlk\Api\Unoconv\Exception\UnoconvException;
use SplFileObject;

/**
 * Class Api
 */
class Api
{
    /**
     * @var array
     */
    private $params = [];

    /**
     * Api constructor.
     *
     * @param \Mrcnpdlk\Api\Unoconv\Config $oConfig
     *
     * @throws \Mrcnpdlk\Api\Unoconv\Exception
     */
    public function __construct(Config $oConfig = null)
    {
        $oConfig                    = $oConfig ?? new Config();
        $this->params['connection'] = $oConfig->getConnectionString();
        $this->params['timeout']    = $oConfig->getTimeout();
        $this->params['docType']    = $oConfig->getDocType();
        $this->params['format']     = $oConfig->getFormat();
    }

    /**
     * @param string          $from   Path to input file
     * @param FormatType|null $format Default PDF
     * @param string|null     $to     Path to output file or directory
     *
     * @throws \Mrcnpdlk\Api\Unoconv\Exception
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     *
     * @return SplFileObject
     */
    public function transcode(string $from, FormatType $format = null, string $to = null): SplFileObject
    {
        $from = realpath($from);

        if (!is_file($from)) {
            throw new InvalidFileArgumentException(sprintf('Input file "%s" not exists', $from));
        }
        if (!is_readable($from)) {
            throw new InvalidFileArgumentException(sprintf('Input file "%s" is not readable', $from));
        }

        $format       = $format ?? $this->params['format'];
        $fromPathInfo = pathinfo($from);

        if (null === $to) {
            $to = sprintf('%s%s%s.%s',
                $fromPathInfo['dirname'],
                DIRECTORY_SEPARATOR,
                $fromPathInfo['filename'],
                $format->getExtension()
            );
        } elseif (is_dir($to)) {
            $to = sprintf('%s%s%s.%s',
                $to,
                DIRECTORY_SEPARATOR,
                $fromPathInfo['filename'],
                $format->getExtension()
            );
        }

        $command = new Command($this->params['connection']);
        $command
            ->addArg('--doctype', $this->params['docType'], false)
            ->addArg('--format', $format, false)
            ->addArg('--timeout', $this->params['timeout'], false)
            ->addArg('--output', $to)
            ->addArg($from)
        ;

        if ($command->execute()) {
            return new SplFileObject($to);
        }
        throw new UnoconvException(sprintf('Unoconv error: %s', $command->getError()), $command->getExitCode());
    }
}
