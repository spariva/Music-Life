<?php
//A lo mejor no hace falta y al instalar composer basta con su autoload.a
define('DOC_ROOT', dirname(dirname(__FILE__)));

spl_autoload_register(
    function($param){
        require(DOC_ROOT."/src/php/$param.php");
    }
);


?>