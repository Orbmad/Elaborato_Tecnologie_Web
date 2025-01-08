<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    //Ottiene le sottocategorie di una categoria
    private function getSubCategoriesFromCategory($Category) {
        $stmt = $this->db->prepare("SELECT * FROM SottoCategorie WHERE id_categoria = ?");
        $stmt->bind_param('i', $Category);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns all categories.
     */
    public function getCategories(){
        $stmt = $this->db->prepare("SELECT * FROM Categorie");
        $stmt->execute();
        $result = $stmt->get_result();

        $categories = $result->fetch_all(MYSQLI_ASSOC);
        foreach($categories as $category):
            $category["sottocategorie"] = $this->getSubCategoriesFromCategory($category["nome_categoria"]);
        endforeach;

        return $categories;
    }

    public function getRandomCategories($n){
        $stmt = $this->db->prepare("SELECT * FROM Categorie ORDER BY RAND() LIMIT ? ");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns a product using its id (nome_prodotto).
     */
    public function getProductById($product_id){
        $stmt = $this->db->prepare("SELECT * FROM Prodotti WHERE nome_prodotto = ?");
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Function returning n random groups from the groups table, articles for the
     * main page slideshow will be made out of them.
     */
    public function getArticles($n){
        $stmt = $this->db->prepare("SELECT * FROM Gruppi ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns a specified n number of articles names from the tb cotaing in their name a string 
     * specified as the text paramete
     */
    public function getSuggestions($n,$text){
        $text = "%" . $text . "%";
        $stmt = $this->db->prepare("SELECT nome_prodotto FROM Prodotti WHERE nome_prodotto LIKE ? ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('si',$text,$n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns the exact price range between all products
     */
    public function getProductsPrinceRange(){
        $stmt = $this->db->prepare("SELECT MAX(prezzo) as max ,MIN(prezzo) as min FROM Prodotti");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns all different attributes of type '$attribute_name' of all products
     */
    public function getProductsAttributeValues($attribute_name){
        $stmt = $this->db->prepare("SELECT DISTINCT `$attribute_name` as attributo FROM Prodotti");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns a product by its name.
     */
    public function searchProductByName($name){
        $text = "%" . $name . "%";
        $stmt = $this->db->prepare("SELECT * FROM prodotti WHERE nome_prodotto LIKE ? ORDER BY RAND()");
        $stmt->bind_param('s',$text);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBestProducts($n){
        $stmt = $this->db->prepare("SELECT * FROM prodotti ORDER BY voto LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>