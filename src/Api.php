<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 14:22
 */

namespace Mrcnpdlk\Api\Unoconv;

use mikehaertl\shellcommand\Command;
use Mrcnpdlk\Api\Unoconv\Enum\FormatType;
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
     * @param string          $from
     * @param string          $to
     * @param FormatType|null $format
     *
     * @return SplFileObject
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     */
    public function create(string $from, string $to, FormatType $format = null): SplFileObject
    {
        $command = new Command($this->params['connection']);
        $command
            ->addArg('--doctype', $this->params['docType'], false)
            ->addArg('--format', $format ?? $this->params['format'], false)
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
