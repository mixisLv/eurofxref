<?php
/**
 * eurofxref
 *
 * @author    Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 */

namespace mixisLv\eurofxref\Params;

use mixisLv\eurofxref\Exceptions\EcbException;

abstract class BaseParams
{
    public function __construct(array $params = [])
    {
        foreach ($params as $property => $value) {
            $this->__set($property, $value);
        }
    }

    public function __set($property, $value)
    {
        if (!property_exists($this, $property)) {
            throw new EcbException(get_class($this) . ' does not accepts property: ' . $property);
        } else {
            if (method_exists($this, $functionName = 'sanitize' . ucfirst($property))) {
                $this->$property = $this->$functionName($value);
            } else {
                $this->$property = $value;
            }
        }
    }

    public function __get($property)
    {
        return $this->$property;
    }

    public function toArray() {
        return get_object_vars($this);
    }

}
