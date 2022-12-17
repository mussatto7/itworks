<form method="post" enctype="multipart/form-data">
    <input type="file" name="arquivo" />
    <input type="submit" />

</form>

<?php

	if(isset($_FILES['arquivo'])){
		$arquivo = $_FILES['arquivo'];

	$arquivo = $_FILES['arquivo'];


	$hostname = '127.0.0.1';
	$port = '3306';
	$database = 'jobapplication';
	$username = 'root';
	$password = '123456';

	$link = mysqli_connect($hostname,$username,$password,$database,$port);


	// Covert to Base64
	$file_base64 = base64_encode(file_get_contents($arquivo['tmp_name']) );


	$sql = "insert arquivos
		(
			`name`,
			`type`,
			`binary`,
			`size`
		) 
		values
		(
			'" . $arquivo['name'] ."',
			'" . $arquivo['type']."',
			'" . $file_base64 ."',
			'" . $arquivo['size'] ."')";

	mysqli_query($link,$sql);

	$arquivo_id = mysqli_insert_id($link);

	echo $arquivo_id;
	
	
	$id_formulario = '17';

	$sql_update_form = "update formulario set arquivo_id = '$arquivo_id' where indice = '$id_formulario' ";

	mysqli_query($link, $sql_update_form);

	mysqli_close($link);

	}else{
		echo 'Aguardando arquivo';
	}