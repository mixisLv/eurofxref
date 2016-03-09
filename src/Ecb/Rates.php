<?php
/**
 * eurofxref
 *
 * @author Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 */

namespace mixisLv\eurofxref\Ecb;

use mixisLv\eurofxref\BaseEcb;

class Rates extends BaseEcb
{
    /**
     * all
     *
     * @return array
     */
    public function all()
    {
        return $this->ecb->getExchangeRates();
    }


    /**
     * single
     *
     * @param $currency
     *
     * @return float
     */
    public function single($currency)
    {
        $rates = $this->ecb->getExchangeRates();

        return isset($rates[$currency]) ? $rates[$currency] : null;
    }
}