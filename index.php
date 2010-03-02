<?php
	// variáveis para conexão ao DB
	$dns = "mysql:host=localhost;dbname=awu2";
	$user = "alexandre";
	$passwd = "";

	// tenta se conectar
	try{
		$dbh = new PDO($dns, $user, $passwd,  array(PDO::ATTR_PERSISTENT => true));

		$sql = "SELECT id, id_curso FROM disciplinas_cursos WHERE id_curso = :idCurso"; // Cria a Query
		$stmt = $dbh->prepare($sql); // faz o prepare da query
		$stmt->bindParam(':idCurso', $id_curso); // passa o parâmetro
		$stmt->execute(); // executa a query

		// retorna o resultado query em um array
		$resultStmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// mostra o array para fins de estudo
		echo "<pre>";
		print_r($resultStmt);
		echo "</pre>";

		/*
		 *  pega a quantidade total de linhas retornadas
		 *  contando a quantidade de elementos dentro do array
		 */
		$qtdRecords = count($resultStmt);

		// Percorre todo o array
		for($i=0; $i<$qtdRecords; $i++){
			/**
			 *  Verifica se o elemento 'id' correspondente
			 *  a posição 0 do segundo array é igual a $id atual
			 *  da página.
			 */
			if($resultStmt[$i]['id'] == $id){

				// se ele achar esse elemento dentro do array
				// ele informa abaixo
				echo "encontrei! -> " . $id . "<br />";
				
				$next = $id + 1; // pega o próximo $id
				$back = $id - 1; // pega o $id anterior

				/*
				 *  se o próximo $id, que é o atual $id mais 1
				 *  existir dentro do array retornado pelo DB,
				 *  o link para o próximo é criado, se ñ existir
				 *  o link ñ é criado e o botão de avançar fica
				 *  desativado
				 */
				if(!array_key_exists($next, $resultStmt)){
					echo "próximo é inválido, Ñ CRIA O LINK! <br />";
				}else{
					echo "o próximo é, CRIA LINK OK: " . $next . "<br />";
				}
				
				// o mesmo raciocínio que o de cima
				if(!array_key_exists($back, $resultStmt)){
					echo "anterior é inválido! <br />";
				}else{
					echo "o anterior é: " . $back . "<br />";
				}
			} // FIM > if($resultStmt[$i]['id'] == $id)
		} // FIM > for($i=0; $i<$qtdRecords; $i++)

	}catch (PDOException $e){
		// se algum erro for pego é apresentado na tela
		echo "Erro! <span style='color: red'>" . $e->getMessage() . "</span>";
	}
?>					