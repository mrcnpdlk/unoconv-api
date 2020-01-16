<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 14:22
 */

namespace Mrcnpdlk\Api\Unoconv;

set_time_limit(0);

use CURLFile;
use const CURLOPT_POST;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_URL;
use const JSON_ERROR_NONE;
use mikehaertl\shellcommand\Command;
use Mrcnpdlk\Api\Unoconv\Enum\FormatType;
use Mrcnpdlk\Api\Unoconv\Exception\DomainException;
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
    /** @noinspection PhpUndefinedClassInspection */
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;
    /**
     * @var string
     */
    private $ws;
    /**
     * @var \Mrcnpdlk\Api\Unoconv\Config
     */
    private $oConfig;

    /**
     * Api constructor.
     *
     * @param \Mrcnpdlk\Api\Unoconv\Config $oConfig
     *
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function __construct(Config $oConfig = null)
    {
        $this->oConfig              = $oConfig ?? new Config();
        $this->logger               = $this->oConfig->getLogger();
        $this->ws                   = $this->oConfig->getWebservice();
        $this->params['connection'] = $this->oConfig->getConnectionString();
        $this->params['timeout']    = $this->oConfig->getTimeout();
        $this->params['docType']    = $this->oConfig->getDocType();
        $this->params['format']     = $this->oConfig->getFormat();
    }

    /**
     * @param string          $sourceFile  Path to input file
     * @param FormatType|null $format      Default PDF
     * @param string|null     $destination Path to output file or directory
     * @param array           $exportOpts  Export options
     *
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\DomainException
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
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            } elseif (is_string($value)) {
                $value = sprintf('"%s"', $value);
            } elseif (!is_int($value)) {
                throw new DomainException(sprintf('Invalid type of export argument "%s", only %s are allowed.', gettype($value), implode(',', ['int', 'string', 'bool'])));
            }

            $command->addArg('--export', sprintf('%s=%s', $key, $value), false);
        }

        $command->addArg($sourceFile);

        $this->logger->debug(sprintf('Executing command: %s', $command->getExecCommand()));

        if ($command->execute()) {
            return new SplFileObject($destination);
        }
        throw new UnoconvException(sprintf('Unoconv error: %s', $command->getError()), $command->getExitCode());
    }

    /**
     * Generate PDF using external WebService
     *
     * @see https://github.com/zrrrzzt/docker-unoconv-webservice
     *
     * @param string      $sourceFile
     * @param string|null $destination
     *
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception
     *
     * @return \SplFileObject
     */
    public function wsGetPdf(string $sourceFile, ?string $destination): SplFileObject
    {
        $sourceFile = realpath($sourceFile);

        if (!is_file($sourceFile)) {
            throw new InvalidFileArgumentException(sprintf('Input file "%s" not exists', $sourceFile));
        }
        if (!is_readable($sourceFile)) {
            throw new InvalidFileArgumentException(sprintf('Input file "%s" is not readable', $sourceFile));
        }

        $fromPathInfo = pathinfo($sourceFile);

        if (null === $destination) {
            $destination = sprintf('%s%s%s.pdf',
                $fromPathInfo['dirname'],
                DIRECTORY_SEPARATOR,
                $fromPathInfo['filename']
            );
        } elseif (is_dir($destination)) {
            $destination = sprintf('%s%s%s.pdf',
                $destination,
                DIRECTORY_SEPARATOR,
                $fromPathInfo['filename']
            );
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf('%s/unoconv/pdf', $this->ws));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => new CURLFile($sourceFile)]);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->params['timeout']);

        $output   = null;
        $maxLoops = $this->oConfig->getMaxLoop();
        for ($iLoop = 0; true; ++$iLoop) {
            $this->logger->debug(sprintf('Creating "%s" from "%s" [loop #%d]', $destination, $sourceFile, $iLoop + 1));

            $output = curl_exec($ch);
            if (false === $output) {
                throw new UnoconvException('Curl error: ' . curl_error($ch));
            }

            $ret = json_decode($output, false);
            if (JSON_ERROR_NONE !== json_last_error()) {
                break;
            }
            /*
             * Fix: sometime the first request is with error
             */
            if ($iLoop >= $maxLoops) {
                throw new UnoconvException('WebService Error: ' . $ret->message);
            }
            $this->logger->debug(sprintf('Creating "%s" from "%s" [loop #%d] - restarting request', $destination, $sourceFile, $iLoop + 1));
        }

        curl_close($ch);
        if (null === $output) {
            throw new Exception('WTF. Output is NULL');
        }
        file_put_contents($destination, $output);

        return new SplFileObject($destination);
    }
}
