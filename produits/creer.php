<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json, charset=utf-8");
header("Access-Control-Allow-Methods: POST");
header("Acces-Control-Max-Age: 3600");
header("Acces-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,
AUthorization, W-Requested-With");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
}else{
    http_response_code(405);
    echo json_encode(["erreur"=> "utiliser la methode post"]);
}

