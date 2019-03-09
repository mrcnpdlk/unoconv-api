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
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

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
        $this->logger               = $oConfig->getLogger();
        $this->params['connection'] = $oConfig->getConnectionString();
        $this->params['timeout']    = $oConfig->getTimeout();
        $this->params['docType']    = $oConfig->getDocType();
        $this->params['format']     = $oConfig->getFormat();
    }

    /**
     * @param string              $sourceFile  Path to input file
     * @param FormatType|null     $format      Default PDF
     * @param string|null         $destination Path to output file or directory
     * @param array[string]string $exportOpts  Export options
     *
     * @throws \Mrcnpdlk\Api\Unoconv\Exception
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     *
     * @return SplFileObject
     */
    public function transcode(string $sourceFile, ?FormatType $format, ?string $destination, array $exportOpts = []): SplFileObject
    {
        $sourceFile = realpath($sourceFile);

        if (!is_file($sourceFile)) {
            throw new InvalidFileArgumentException(sprintf('Input file "%s" not exists', $sourceFile));
        }
        if (!is_readable($sourceFile)) {
            throw new InvalidFileArgumentException(sprintf('Input file "%s" is not readable', $sourceFile));
        }

        $format       = $format ?? $this->params['format'];
        $fromPathInfo = pathinfo($sourceFile);

        if (null === $destination) {
            $destination = sprintf('%s%s%s.%s',
                $fromPathInfo['dirname'],
                DIRECTORY_SEPARATOR,
                $fromPathInfo['filename'],
                $format->getExtension()
            );
        } elseif (is_dir($destination)) {
            $destination = sprintf('%s%s%s.%s',
                $destination,
                DIRECTORY_SEPARATOR,
                $fromPathInfo['filename'],
                $format->getExtension()
            );
        }

        $this->logger->debug(sprintf('Creating "%s" from "%s"', $destination, $sourceFile));

        $command = new Command($this->params['connection']);
        $command
            ->addArg('--doctype', $this->params['docType'], false)
            ->addArg('--format', $format, false)
            ->addArg('--timeout', $this->params['timeout'], false)
            ->addArg('--output', $destination, false)
        ;

        foreach ($exportOpts as $key => $value) {
            $command->addArg('--export', sprintf('%s=%s', $key, $value), false);
        }

        $command->addArg($sourceFile);

        $this->logger->debug(sprintf('Executing command: %s', $command->getExecCommand()));

        if ($command->execute()) {
            return new SplFileObject($destination);
        }
        throw new UnoconvException(sprintf('Unoconv error: %s', $command->getError()), $command->getExitCode());
    }
}
