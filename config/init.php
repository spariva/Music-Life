<?php

define('DOC_ROOT', dirname(dirname(__FILE__)));

spl_autoload_register(
    function($param){
        require(DOC_ROOT."/src/$param.php");
    }
);


?>