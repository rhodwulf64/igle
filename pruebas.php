<?php

$hora='22:25:50';//hora entrada por el usuario
echo $hora."\n";
list($hora1, $minut, $segun) = split('[:]', $hora);
$hora=date("H:i:s", mktime($hora1+1, $minut+2, $segun));
echo $hora."<br>";

?>