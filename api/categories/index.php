<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';
include_once '../../helperFunctions/isValid.php';
include_once '../../helperFunctions/notFound.php';
include_once '../../helperFunctions/success.php';
include_once '../../helperFunctions/fail.php';
include_once '../../helperFunctions/missingParams.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

$database = new Database();
$db = $database->connect();

$cat = new Category($db);

$data = json_decode(file_get_contents('php://input'));

switch ($method) {
    case 'GET': isset($_GET['id']) ? require 'read_single.php' : require 'read.php'; break;
    case 'PUT': require 'update.php'; break;
    case 'POST': require 'create.php'; break;
    case 'DELETE': require 'delete.php'; break;
}

?>