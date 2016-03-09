<?php
/**
 * eurofxref
 *
 * @author Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 */

namespace mixisLv\eurofxref;

abstract class BaseEcb
{
    protected $ecb;

    public function __construct(Ecb $ecb)
    {
        $this->ecb = $ecb;
    }
}
