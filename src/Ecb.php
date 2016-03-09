<?php

namespace mixisLv\eurofxref;

use mixisLv\eurofxref\Exceptions\EcbException;
use mixisLv\eurofxref\Ecb\Rates;

/**
 * Class Ecb
 *
 * @package mixisLv\eurofxref
 *
 * @property Rates $retrieve
 *
 *
 * @author Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 */
class Ecb
{
    /**
     * @var boolean
     */
    public $debug;

    /**
     * @var string ECB daily exchange rates url
     */
    private $ecbDailyUrl = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml'; //the file is updated daily at 16:00 CET

    /**
     * @var array daily exchange rates
     */
    private $exchangeRates;

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
                    $this->$property = new Rates($this);
                break;
            }
            return isset($this->$property) ? $this->$property : null;
        }
    }

    private function retraveXmlData($params = [])
    {
        $useErrors = libxml_use_internal_errors(true);
        $xml       = simplexml_load_file($this->ecbDailyUrl);
        if (!$xml) {
            $errors = "\n";
            foreach (libxml_get_errors() as $error) {
                $errors .= "\t" . print_r($error, true);
            }
            libxml_clear_errors();
            libxml_use_internal_errors($useErrors);
            //throw new EcbException("Unprocessable Entity: \n" . $errors);
        } else {
            libxml_use_internal_errors($useErrors);
        }
        return $xml;
    }

    private function retraveExchangeRates()
    {
        $xml = $this->retraveXmlData();
        try {
            if (isset($xml->Cube, $xml->Cube->Cube, $xml->Cube->Cube->Cube)) {
                $this->exchangeRates = [];
                foreach ($xml->Cube->Cube->Cube as $rate) {
                    // the value of 1EUR for a currency code
                    $this->exchangeRates[(string)$rate->attributes()->currency] = (float)$rate->attributes()->rate;
                }
            } else {
                throw new EcbException('no data');
            }
        } catch (\Exception $e) {
            throw new EcbException($e->getMessage());
        }
    }

    public function getExchangeRates()
    {
        if (!isset($this->exchangeRates)) {
            $this->retraveExchangeRates();
        }
        return $this->exchangeRates;
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