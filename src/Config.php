<?php

/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 14:22
 */

namespace Mrcnpdlk\Api\Unoconv;

use Mrcnpdlk\Api\Unoconv\Enum\DocType;
use Mrcnpdlk\Api\Unoconv\Enum\FormatType;
use Mrcnpdlk\Lib\ConfigurationOptionsAbstract;

/**
 * Class Config
 */
class Config extends ConfigurationOptionsAbstract
{
    /**
     * @var string
     */
    protected $binary = '/usr/bin/unoconv';
    /**
     * @var string
     */
    protected $host = 'localhost';
    /**
     * Port to listen on (as listener) or to connect to (as client).
     *
     * @var int
     */
    protected $port = 2002;
    /**
     * Specify the LibreOffice document type of the backend format. Possible document types are: document, graphics, presentation,
     * spreadsheet.
     *
     * @var DocType
     */
    protected $docType;
    /**
     * Specify the output format for the document. You can get a list of possible output formats per document type by using the --show
     * option.
     *
     * @var FormatType
     */
    protected $format;
    /**
     * When unoconv starts its own listener, try to connect to it for an amount of seconds before giving up. Increasing this may help when
     * you receive random errors caused by the listener not being ready to accept conversion jobs.
     *
     * For unoconv webservice this value is the timeout [sec] for curl request
     *
     * @var int
     */
    protected $timeout = 30;
    /**
     * @var string
     */
    protected $options = 'urp;StarOffice.ComponentContext';
    /** @noinspection PhpUndefinedClassInspection */
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    /**
     * Webservice url
     *
     * @see https://hub.docker.com/r/zrrrzzt/docker-unoconv-webservice
     *
     * @var string
     */
    protected $webservice = 'http://localhost:3000';
    /**
     * Max loop couter for
     *
     * @var int
     */
    protected $maxLoop = 3;

    /**
     * Config constructor.
     * Default values;
     *
     * @param array $config
     *
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function __construct(array $config = [])
    {
        $this->docType = DocType::DOCUMENT();
        $this->format  = FormatType::PDF();
        parent::__construct($config);
    }

    /**
     * @return string
     */
    public function getConnectionString(): string
    {
        return sprintf('%s --connection="socket,host=%s,port=%s;%s"', $this->binary, $this->host, $this->port, $this->options);
    }

    /**
     * @return DocType
     */
    public function getDocType(): DocType
    {
        return $this->docType;
    }

    /**
     * @param DocType $docType
     *
     * @return $this
     */
    public function setDocType(DocType $docType): self
    {
        $this->docType = $docType;

        return $this;
    }

    /**
     * @return FormatType
     */
    public function getFormat(): FormatType
    {
        return $this->format;
    }

    /**
     * @param FormatType $format
     *
     * @return $this
     */
    public function setFormat(FormatType $format): self
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLoop(): int
    {
        return $this->maxLoop;
    }

    /**
     * @param int $maxLoop
     *
     * @return $this
     */
    public function setMaxLoop(int $maxLoop): self
    {
        $this->maxLoop = $maxLoop;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     *
     * @return $this
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebservice(): string
    {
        return $this->webservice;
    }

    /**
     * @param string $webservice
     *
     * @return Config
     */
    public function setWebservice(string $webservice): Config
    {
        $this->webservice = $webservice;

        return $this;
    }

    /**
     * @param string $binary
     *
     * @return $this
     */
    public function setBinary(string $binary): self
    {
        $this->binary = $binary;

        return $this;
    }

    /**
     * @param string $host
     *
     * @return $this
     */
    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @param int $port
     *
     * @return $this
     */
    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }
}
