<?php

namespace mixisLv\eurofxref;

use mixisLv\eurofxref\Exceptions\ApiException;

/**
 * Class Api
 *
 * @package mixisLv\eurofxref
 *
 * @property Rates $retrieve

 *
 * @author Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 */
class Api
{

    /**
     * @var string ECB daily rates url
     */
    private $ecbDailyUrl = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

    /**
     * @var resource cURL handle
     */
    private $ch;

    /**
     * @var boolean
     */
    public $debug;

    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    /**
     * __get
     *
     * @param $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            switch ($property) {
                case 'rates':
                    $this->$property = new Articles($this);
                    break;
            }
            return isset($this->$property) ? $this->$property : null;
        }
    }


    /**
     * error
     *
     * @param $code
     * @param $response
     *
     * @throws ApiException
     */
    public function error($code, $response)
    {
        $errorMsg = false;
        if (isset($response, $response['errors'])) {
            $errorMsg = implode(', ', array_map(function ($v, $k) { return $k . ': ' . implode(',', $v); }, $response['errors'], array_keys($response['errors'])));
        }
        if (isset($response, $response['error'])) {
            $errorMsg = $response['error'];
        }

        switch ($code) {
            case 404:
                throw new ApiException($errorMsg ? $errorMsg : 'Not found', $code);
                break;
            case 403:
                throw new ApiException($errorMsg ? $errorMsg : 'Forbidden', $code);
                break;
            case 422:
                throw new ApiException($errorMsg ? 'Unprocessable Entity: ' . $errorMsg : 'Unprocessable Entity', $code);
                break;
            case 429:
                throw new ApiException($errorMsg ? $errorMsg : 'Too Many Requests', $code);
                break;
            default:
                throw new ApiException($errorMsg ? $errorMsg : 'Unknown error', $code);
        }
    }

    /**
     * log
     *
     * @param string $message
     */
    protected function log($message)
    {
        if ($this->debug) {
            echo '<pre>', $message, '</pre>';
        }
    }

}