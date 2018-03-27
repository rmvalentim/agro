<?php 

require_once("vendor/autoload.php");
use \Slim\Slim;

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');


$app->get('/cadastro/estados', 'getAllEstados');
$app->get('/cadastro/estado/:id', 'getEstado');
$app->post('/cadastro/estado', 'setEstado');
$app->put('/cadastro/estado/:id', 'updateEstado');
$app->delete('/cadastro/estado/:id', 'deleteEstado');

$app->run();


function getConn()
{
 return new PDO('mysql:host=localhost;dbname=custeio',
  'root',
  '',
  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
  
  );
}

function getAllEstados()
{  
	$stmt = getConn()->query("SELECT * FROM estado");
  	$estados = $stmt->fetchAll(PDO::FETCH_OBJ);
  	echo "{\"estados\":".json_encode($estados)."}";
}

function getEstado($id)
{  
	$conn = getConn();
  	$sql = "SELECT * FROM estado WHERE id=:id";
  	$stmt = $conn->prepare($sql);
  	$stmt->bindParam("id",$id);
  	$stmt->execute();
  	$estado = $stmt->fetchObject();
  	echo json_encode($estado);
}
function setEstado()
{  
	$request = \Slim\Slim::getInstance()->request();
  	$estado = json_decode($request->getBody());
  	$sql = "INSERT INTO estado (codigo,desc_estado,usuario_id) values (:codigo,:desc_estado,:usuario_id) ";
  	$conn = getConn();
  	$stmt = $conn->prepare($sql);  	
  	$stmt->bindParam("codigo",$estado->codigo);
  	$stmt->bindParam("desc_estado",$estado->desc_estado);
  	$stmt->bindParam("usuario_id",$estado->usuario_id);
  	$stmt->execute();
  	$estado->id = $conn->lastInsertId();
  	echo json_encode($estado);
}



function updateEstado($id)
{  
	$request = \Slim\Slim::getInstance()->request();
  	$estado = json_decode($request->getBody());
  	$sql = "UPDATE estado set codigo = :codigo, desc_estado = :desc_estado, usuario_id = :usuario_id WHERE id = :id ";
  	$conn = getConn();
  	$stmt = $conn->prepare($sql);  	
  	$stmt->bindParam("id",$id);
  	$stmt->bindParam("codigo",$estado->codigo);
  	$stmt->bindParam("desc_estado",$estado->desc_estado);
  	$stmt->bindParam("usuario_id",$estado->usuario_id);
  	$stmt->execute();
  	$estado->id = $id;
  	echo json_encode($estado);
}

function deleteEstado($id)
{  
	$sql = "DELETE FROM estado WHERE id=:id";
  	$conn = getConn();
  	$stmt = $conn->prepare($sql);
  	$stmt->bindParam("id",$id);
  	$stmt->execute();
  	echo "{'message':'Produto apagado'}";
}

?>