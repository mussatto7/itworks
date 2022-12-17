<?php

$n1 = readline("Informe o primeiro número:\n");
$n2 = readline("Informe o segundo número:\n");
$operador = readline("Informe o operador:\n");
	/*if($operador == '+'){
		echo	$n1 + $n2;
	}else if($operador == '-'){
		echo $n1 - $n2;
	}else if($operador == '*'){
		echo $n1 * $n2;
	}else if($operador == '/'){
		echo $n1 / $n2;
	}else{
		echo 'Digite um operador válido';
	}*/
	
	switch($operador){
		case '+': {
		echo	$n1 + $n2;
		break;
	} 
		case '-': {
		echo	$n1 - $n2;
		break;
	}
		case '*': {
		echo	$n1 * $n2;
		break;
	}
		case '/': {
		echo	$n1 / $n2;
		break;
	}
		default: {
		echo 'Digite um operador válido';
	}
}