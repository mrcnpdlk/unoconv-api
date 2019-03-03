<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 14:22
 */

namespace Mrcnpdlk\Api\Unoconv;

class Config
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
     * @var string
     */
    protected $docType = 'document';
    /**
     * Specify the output format for the document. You can get a list of possible output formats per document type by using the --show
     * option.
     *
     * @var string
     */
    protected $format = 'pdf';
    /**
     * When unoconv starts its own listener, try to connect to it for an amount of seconds before giving up. Increasing this may help when
     * you receive random errors caused by the listener not being ready to accept conversion jobs.
     *
     * @var int
     */
    protected $timeout = 30;
    /**
     * @var string
     */
    protected $options = 'urp;StarOffice.ComponentContext';

    /**
     * Config constructor.
     * Default values;
     *
     * @param array $config
     *
     * @throws \Mrcnpdlk\Api\Unoconv\Exception
     */
    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            $funName = sprintf('set%s', ucfirst($key));
            if (method_exists($this, $funName)) {
                $this->$funName($value);
            } elseif (property_exists($this, $key)) {
                $this->{$key} = $value;
            } else {
                throw new Exception(sprintf('Property "%s" not defined in Config class "%s"', $key, __CLASS__));
            }
        }
    }

    /**
     * @return string
     */
    public function getConnectionString(): string
    {
        return sprintf('%s --connection="socket,host=%s,port=%s;%s"', $this->binary, $this->host, $this->port, $this->options);
    }

    /**
     * @return string
     */
    public function getDocType(): string
    {
        return $this->docType;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
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
     * @param string $docType
     *
     * @return $this
     */
    public function setDocType(string $docType): self
    {
        $this->docType = $docType;

        return $this;
    }

    /**
     * @param string $format
     *
     * @return $this
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;

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
}
