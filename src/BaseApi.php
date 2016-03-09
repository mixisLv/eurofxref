<?php
/**
 * eurofxref
 *
 * @author Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 */

namespace mixisLv\eurofxref;

abstract class BaseApi
{
    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }
}

