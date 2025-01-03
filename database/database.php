<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    public function getCategories(){
        $stmt = $this->db->prepare("SELECT * FROM Categorie");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubCategoriesFromCategory($CategoryID) {
        $stmt = $this->db->prepare("SELECT * FROM SottoCategorie WHERE id_categoria = ?");
        $stmt->bind_param('i', $CategoryID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($product_id){
        $stmt = $this->db->prepare("SELECT id_prodotto, nome_prodotto, prezzo, stock, descrizione FROM Prodotti WHERE id_prodotto = ?");
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
        $stmt = $this->db->prepare("SELECT nomegruppo, descrizionegruppo FROM gruppi ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSuggestions($n,$text){
        $text = "%" . $text . "%";
        $stmt = $this->db->prepare("SELECT nome_prodotto FROM prodotti WHERE Nome LIKE ? ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('si',$text,$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>