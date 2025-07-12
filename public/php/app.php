<?php
namespace A;
// include __DIR__ .'/A/person.php';
include __DIR__ .'/autoload.php';
$person = new \A\person();
$person->name='ahmed';
//$person2 = new \B\person();
//$person2->name = 'monsef';
var_dump($person);
\A\person::$country='egypt';
person::$country='masr';
echo $person::$country;