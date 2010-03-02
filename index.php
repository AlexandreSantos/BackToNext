<?php
	// vari�veis para conex�o ao DB
	$dns = "mysql:host=localhost;dbname=awu2";
	$user = "alexandre";
	$passwd = "";

	// tenta se conectar
	try{
		$dbh = new PDO($dns, $user, $passwd,  array(PDO::ATTR_PERSISTENT => true));

		$sql = "SELECT id, id_curso FROM disciplinas_cursos WHERE id_curso = :idCurso"; // Cria a Query
		$stmt = $dbh->prepare($sql); // faz o prepare da query
		$stmt->bindParam(':idCurso', $id_curso); // passa o par�metro
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
			 *  a posi��o 0 do segundo array � igual a $id atual
			 *  da p�gina.
			 */
			if($resultStmt[$i]['id'] == $id){

				// se ele achar esse elemento dentro do array
				// ele informa abaixo
				echo "encontrei! -> " . $id . "<br />";
				
				$next = $id + 1; // pega o pr�ximo $id
				$back = $id - 1; // pega o $id anterior

				/*
				 *  se o pr�ximo $id, que � o atual $id mais 1
				 *  existir dentro do array retornado pelo DB,
				 *  o link para o pr�ximo � criado, se � existir
				 *  o link � � criado e o bot�o de avan�ar fica
				 *  desativado
				 */
				if(!array_key_exists($next, $resultStmt)){
					echo "pr�ximo � inv�lido, � CRIA O LINK! <br />";
				}else{
					echo "o pr�ximo �, CRIA LINK OK: " . $next . "<br />";
				}
				
				// o mesmo racioc�nio que o de cima
				if(!array_key_exists($back, $resultStmt)){
					echo "anterior � inv�lido! <br />";
				}else{
					echo "o anterior �: " . $back . "<br />";
				}
			} // FIM > if($resultStmt[$i]['id'] == $id)
		} // FIM > for($i=0; $i<$qtdRecords; $i++)

	}catch (PDOException $e){
		// se algum erro for pego � apresentado na tela
		echo "Erro! <span style='color: red'>" . $e->getMessage() . "</span>";
	}
?>					