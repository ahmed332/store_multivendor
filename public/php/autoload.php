<?php
// function class_load($classname){
//     include __DIR__ . "/{$classname}.php";
// }
spl_autoload_register(function ($classname){
    include __DIR__ . "/{$classname}.php";
});

?>