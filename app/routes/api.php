<?php
// Routes
if(!defined("SPECIALCONSTANT")) die ("Acesso Negado");

$app->get("/usuarios", function() use ($app) {

		try {
	     /* Chamamos getConnetion */
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM usuarios");
		$dbh->execute();
		$usuarios[] = $dbh->fetchAll(); //FetchAll carregamos Todos
		$connection = null;

		$app->response->header('Content-Type: application/json');
		$app->response->status(200);
		$app->response->body(json_encode($usuarios));

	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});


$app->get("/usuarios/:id", function($id) use ($app) {

		try {
	     /* Chamamos getConnetion */
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM usuarios WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$usuarios = $dbh->fetchObject();
		$connection = null;

		$app->response->header('Content-Type: application/json');
		$app->response->status(200);
		$app->response->body(json_encode($usuarios));

	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	
});


$app->post("/usuarios/", function() use ($app) {

	$usuario = $app->request->post("usuario");
	$senha = $app->request->post("senha");
	$nome = $app->request->post("nome");

try {

	$connection = getConnection();
	$dbh = $connection->prepare("INSERT INTO usuarios VALUES (null, ?, ?, ?)");
	$dbh->bindParam(1, $usuario);
	$dbh->bindParam(2, $senha);
	$dbh->bindParam(3, $nome);
	$dbh->execute();
	$usuariosId = $connection->lastInsertId();
	$connection = null;
	$app->response->header('Content-Type: application/json');
	$app->response->status(200);
	$app->response->body(json_encode($usuariosId));



} catch (PDOException $e) {

	echo "Error: " . $e->getMessage();
}

});


$app->put("/usuarios/", function() use ($app) {

	$usuario = $app->request->post("usuario");
	$senha = $app->request->post("senha");
	$nome = $app->request->post("nome");
	$id = $app->request->put("id");

	try {

	$connection = getConnection();
	$dbh = $connection->prepare("UPDATE usuarios SET usuario = ?, senha = ?, nome = ? WHERE id = ? ");
	$dbh->bindParam(1, $usuario);
	$dbh->bindParam(2, $senha);
	$dbh->bindParam(3, $nome);
	$dbh->bindParam(4, $id);
	$dbh->execute();
	$connection = null;
	$app->response->header('Content-Type: application/json');
	$app->response->status(200);
	$app->response->body(json_encode(array("res" => 1)));



} catch (PDOException $e) {

	echo "Error: " . $e->getMessage();
}



});


	$app->delete("/usuarios/:id", function($id) use ($app) {


	try {

	$connection = getConnection();
	$dbh = $connection->prepare("DELETE FROM usuarios WHERE id = ? ");
	$dbh->bindParam(1, $id);
	$dbh->execute();
	$connection = null;
	$app->response->header('Content-Type: application/json');
	$app->response->status(200);
	$app->response->body(json_encode(array("res" => 1)));



} catch (PDOException $e) {

	echo "Error: " . $e->getMessage();
}




});

