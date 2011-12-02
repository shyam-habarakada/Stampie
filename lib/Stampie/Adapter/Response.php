<?php

namespace Stampie\Adapter;

/**
 * Immutable implementation of ResponseInterface
 *
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Response implements ResponseInterface
{
    /**
     * @var array Array of reason phrases and their corresponding status codes
     */
    static private $statusTexts = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Enity',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
    );

    /**
     * @var integer
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $content;

    /**
     * @param integer $statusCode
     * @param string $content
     */
    public function __construct($statusCode, $content)
    {
        if (!isset(static::$statusTexts[$statusCode])) {
            throw new \InvalidArgumentException('Unknow StatusCode');
        }

        $this->statusCode = $statusCode;
        $this->content = $content;
    }

    /**
     * @return integer
     */
    public function getStatusCode()
    {
        return (integer) $this->statusCode;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return (string) $this->content;
    }

    /**
     * @return Boolean
     */
    public function isSuccessful()
    {
        return (Boolean) $this->statusCode >= 200 && $this->statusCode < 300;
    }

    /**
     * @return string
     */
    public function getStatusText()
    {
        return static::$statusTexts[$this->getStatusCode()];
    }
}
