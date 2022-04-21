<?php

class Product{

    private $orm;
    private $table= "produits";

    // les attributs de la table
    public $id;
    public $nom;
    public $description;
    public $prix;
    public $categories_id;
    public $categories_nom;
    public $created_at;

    /**
     * constructeur de classe
     * @param $orm 
     */
    public function __construct($orm){
        $this->orm= $orm;
    }

    /**
     * Lecture des produits
     * 
     * 
     */
    public function lire(){
        $request= "SELECT as c.nom as categories_nom, p.id, p.nom, p.description,
        p.prix, p.categories_id, p.created_at FROM ".$this->table." p LEFT JOIN
        categories c ON p.categories_id= c.id ORDER_BY p.created_at DESC";

        $query= $this->orm->prepare($sql);
        $query->execute();
        return $query;
    }

    public function creer(array $produit){
        $request= "INSERT INTO ".$this->table. "SET nom=nom, description=:description,
        prix=:prix, categories_id=:categories_id";

        $query= $this->orm->prepare($sql);

        /* par strip_tags on supprime les balides html et php dans une chaine et puis 
        htmlspecialchars renforce par la serialisation des balises restes non supprimés en texte brute */
        $this->nom= htmlspecialchars(strip_tags($this->nom));
        $this->description= htmlspecialchars(strip_tags($this->description));
        $this->prix= htmlspecialchars(strip_tags($this->prix));
        $this->categories_id= htmlspecialchars(strip_tags($this->categories_id));

        if($query->execute()){
            return TRUE;
        }else{
            return FALSE;
        }
    } 
}