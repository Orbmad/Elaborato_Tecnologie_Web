<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    //Ottiene le sottocategorie di una categoria
    public function getSubCategoriesFromCategory($nomeCategoria)
    {
        $stmt = $this->db->prepare("SELECT nome_sottocategoria FROM SottoCategorie WHERE id_categoria = ?");
        $stmt->bind_param('s', $nomeCategoria);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryFromSubcategory($nomeSottoCategoria)
    {
        $stmt = $this->db->prepare("SELECT id_categoria FROM SottoCategorie WHERE nome_sottocategoria = ?");
        $stmt->bind_param('s', $nomeSottoCategoria);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns all categories.
     */
    public function getCategories()
    {
        $stmt = $this->db->prepare("SELECT nome_categoria FROM Categorie");
        $stmt->execute();
        $result = $stmt->get_result();

        $categories = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($categories as &$category) {
            $category["sottocategorie"] = array();
            $category["sottocategorie"] = $this->getSubCategoriesFromCategory($category["nome_categoria"]);
        }

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
    public function getProductById($product_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Prodotti WHERE nome_prodotto = ?");
        $stmt->bind_param('s', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Function returning n random groups from the groups table, articles for the
     * main page slideshow will be made out of them.
     */
    public function getArticles($n)
    {
        $stmt = $this->db->prepare("SELECT * FROM Gruppi ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns a specified n number of articles names from the tb cotaing in their name a string 
     * specified as the text paramete
     */
    public function getSuggestions($n, $text)
    {
        $text = "%" . $text . "%";
        $stmt = $this->db->prepare("SELECT nome_prodotto FROM Prodotti WHERE nome_prodotto LIKE ? ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('si', $text, $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns the exact price range between all products
     */
    public function getProductsPrinceRange()
    {
        $stmt = $this->db->prepare("SELECT MAX(prezzo) as max ,MIN(prezzo) as min FROM Prodotti");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns all different attributes of type '$attribute_name' of all products
     */
    public function getProductsAttributeValues($attribute_name)
    {
        $stmt = $this->db->prepare("SELECT DISTINCT `$attribute_name` as attributo FROM Prodotti");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns a product by its name.
     */
    public function searchProductByName($name)
    {
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
    /**
     * Insert a new user in the database
     */
    public function newUser($email, $nome, $cognome, $password){
        $stmt = $this->db->prepare("INSERT INTO Utenti (email, nome, cognome, password_hash) VALUES (?, ?, ?, SHA2(?, 256))");
        $stmt->bind_param('ssss', $email, $nome, $cognome, $password);
        $stmt->execute();
    }

    public function getCartProducts($email){
        $stmt = $this->db->prepare("SELECT prodotti.nome_prodotto, prodotti.prezzo, prodotti.id_sottocategoria, prodotti.stock, prodotti.nome_volgare, prodotti.descrizione, carrello.quantita FROM carrello INNER JOIN prodotti ON carrello.id_prodotto = prodotti.nome_prodotto WHERE carrello.id_utente=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCartTotalPrice($email){
        $stmt = $this->db->prepare("SELECT SUM(carrello.quantita*prodotti.prezzo) as valore FROM `carrello` INNER JOIN prodotti ON prodotti.nome_prodotto = carrello.id_prodotto WHERE id_utente=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    /**
     * Returns user informations after login.
     */
    public function checkLogin($email, $password){
        $query = "SELECT email, nome, cognome, admin_flag FROM Utenti WHERE email = ? AND password_hash = SHA2(?, 256)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReviewsOfProduct($idprodotto){
        $query = "SELECT nome, voto, commento, DATE(data_recensione) as dataRec FROM Recensioni, Utenti WHERE id_utente = email AND id_prodotto = ? ORDER BY data_recensione DESC LIMIT 3";
        $stmt = $this->db->prepare($query);
        $stmt-> bind_param('s', $idprodotto);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
