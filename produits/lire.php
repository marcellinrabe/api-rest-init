<?php

// La definition des ces headers sont requis

header("Access-Control-Allow-Origin: *"); /* permet de spécifier le client qui peut avoir accès à l'api.
Le client et l'origine énoncé ici. C'est à dire par exemple si la valeur etait marcellinrabe.mg alors seul
le client sur le site marcellinrabe.mg et que la requete vient de marcellinrabe.mg que l'api repondra */

header("Content-Type: application/json, charset=utf-8"); /* definie le type de données de reponses 
par l'api, on peut aussi spécifier l'encodage comme ici par exemple */

header("Access-Control-Allow-Methods: GET"); /* definie les verbes http sensé reconnue par l'api. Et comme
on a fixé GET la seul verbe http dans ce fichier, alors les requestes de type POST par exemple n'est pas
consideré pour les executables de ce fichier. */

header("Access-Control-Max-Age: 3600"); /* definie la durée de vie d'une requete en millisecondes. A
rappeler qu'une API REST ne conserve pas de trace des ses transactions intérieurs. C'est peut-être à
propos de cela que l'on a définie ceci */

header("Acces-Control-Allow-Headers: content-type, Acces-Control-Allow-Headers,
Authorization, X-Requested-With"); /* accepter les headers du clients, les headers spécifiés comme valeurs
bien sûr */ 



if($_SERVER["REQUEST_METHOD"] == "GET"):
    /* Le tutoriel a mentionné qu'il faut d'abord verifier que la methode de lecture des données soit faite
    par le verbe http GET. Si ce n'est pas le cas, notre api ne sera pas consideré comme un api rest */

    require_once "../config/Database.php";
    require_once "../models/Produits.php";

    $database= new Database();
    $orm= $database->setConnection();

    $produit= new Product($orm);

    $stmt= $produit->lire();
    
    // verifier s'il y a au moins un resultat
    if($stmt->rowCount() > 0){

        $return= [];
        $return["produits"]= [];

        while($row= $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row); /* la fonction extract est d'une aide très précieuse. Car elle transforme 
            chaque élément d'un tableau(tableau associatif jusqu'ici à ma connaissance) en variable.
            c'est-à-dire, si on a un tableau ["a"=> 12], la fonction extract créera une variable $a ayant comme valeur 12. */

            $one= [
                "id"=> $id,
                "nom"=> $nom,
                "description"=> $description,
                "prix"=> $prix,
                "categories_id"=> $categories_id,
                "categories_nom"=> $categories_nom,

            ];
            array_push($return["produits"], $one);
        }

        http_response_code(200);
        echo json_encode($return);


    }else{
        echo json_encode(["message"=> "aucun resultat"]);
    }
else:
    http_response_code(405);
    echo json_encode(["message"=> "utiliser une requete de type GET pour la lecture"]);

endif;

