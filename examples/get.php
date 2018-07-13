<?php
/**
 * eurofxref
 *
 * @author Mikus Rozenbergs <mikus.rozenbergs@gmail.com>
 */

use mixisLv\eurofxref\Ecb;

include_once dirname(__FILE__) . './../autoload.php';

$ecb  = new Ecb();

echo "<h3>Get single</h3>";
echo "<pre>";
var_dump($ecb->rates->single("USD"));
echo "</pre>";

echo "<h3>Get all</h3>";
echo "<pre>";
var_dump($ecb->rates->all());
echo "</pre>";
