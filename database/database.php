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

    public function getRandomCategories($n)
    {
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

    public function getGroup($nomeGruppo)
    {
        $stmt = $this->db->prepare("SELECT * FROM Gruppi WHERE nomeGruppo = ?");
        $stmt->bind_param('s', $nomeGruppo);
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
    public function getProductsAttributesValues()
    {
        $attributes = array("famiglia", "genere", "specie", "dimensioni", "profumo", "tipologia_foglia", "colore_foglia", "voto");
        $results = [];

        foreach ($attributes as $attribute) {
            $stmt = $this->db->prepare("SELECT DISTINCT `$attribute` as attributo FROM Prodotti");
            $stmt->execute();
            $result = $stmt->get_result();
            $values = $result->fetch_all(MYSQLI_ASSOC);

            $valuesList = [];
            foreach ($values as $row) {
                $valuesList[] = $row['attributo'];
            }
            $results[$attribute] = $valuesList;
        }

        $stmt = $this->db->prepare("SELECT DISTINCT nomeGruppo FROM Gruppi");
        $stmt->execute();
        $result = $stmt->get_result();
        $values = $result->fetch_all(MYSQLI_ASSOC);
        $valuesList = [];
        foreach ($values as $row) {
            $valuesList[] = $row['nomeGruppo'];
        }
        $results['nomeGruppo'] = $valuesList;
        return $results;
    }

    /**
     * Returns a product by its name.
     */
    public function searchProductByName($name)
    {
        $text = "%" . $name . "%";
        $stmt = $this->db->prepare("SELECT * FROM prodotti WHERE nome_prodotto LIKE ? ORDER BY RAND()");
        $stmt->bind_param('s', $text);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBestProducts($n)
    {
        $stmt = $this->db->prepare("SELECT * FROM prodotti ORDER BY voto LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    /**
     * Insert a new user in the database
     */
    public function newUser($email, $nome, $cognome, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO Utenti (email, nome, cognome, password_hash) VALUES (?, ?, ?, SHA2(?, 256))");
        $stmt->bind_param('ssss', $email, $nome, $cognome, $password);
        $stmt->execute();
    }

    public function getCartProducts($email)
    {
        $stmt = $this->db->prepare("SELECT prodotti.nome_prodotto, prodotti.prezzo, prodotti.id_sottocategoria, prodotti.stock, prodotti.nome_volgare, prodotti.descrizione, carrello.quantita FROM carrello INNER JOIN prodotti ON carrello.id_prodotto = prodotti.nome_prodotto WHERE carrello.id_utente=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCartTotalPrice($email)
    {
        $stmt = $this->db->prepare("SELECT SUM(carrello.quantita*prodotti.prezzo) as valore FROM `carrello` INNER JOIN prodotti ON prodotti.nome_prodotto = carrello.id_prodotto WHERE id_utente=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        if (isset($result["valore"])) {
            return $result["valore"];
        } else {
            return 0;
        }
    }

    public function getCartTotalProducts($email)
    {
        $stmt = $this->db->prepare("SELECT SUM(carrello.quantita) as valore FROM `carrello` WHERE id_utente=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        if (isset($result["valore"])) {
            return $result["valore"];
        } else {
            return 0;
        }
    }


    /**
     * Returns user informations after login.
     */
    public function checkLogin($email, $password)
    {
        $query = "SELECT email, nome, cognome, admin_flag FROM Utenti WHERE email = ? AND password_hash = SHA2(?, 256)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReviewsOfProduct($idprodotto)
    {
        $query = "SELECT nome, voto, commento, DATE(data_recensione) as dataRec FROM Recensioni, Utenti WHERE id_utente = email AND id_prodotto = ? ORDER BY data_recensione DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $idprodotto);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Checks if an email is already associated with an account.
     */
    public function checkExistingEmail($email)
    {
        $stmt = $this->db->prepare("SELECT email FROM Utenti WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return count($result->fetch_all(MYSQLI_ASSOC)) > 0;

    }

    public function changeCartProductQt($email, $productId, $product_qt)
    {
        if ($product_qt == 0) {
            $stmt = $this->db->prepare("DELETE FROM carrello WHERE id_utente = ? AND id_prodotto = ?");
            $stmt->bind_param('ss', $email, $productId);
        } else {
            $stmt = $this->db->prepare("UPDATE carrello SET quantita = ? WHERE id_utente = ? AND id_prodotto = ?");
            $stmt->bind_param('iss', $product_qt, $email, $productId);
        }

        $stmt->execute();
        $stmt->close();

    }

    /**
     * Insert a new product, returns true if the insertion is executed correctly.
     */
    public function insertNewProduct(
        $nome_prodotto,
        $prezzo,
        $id_sottocategoria,
        $stock,
        $nome_volgare,
        $nome_scientifico,
        $famiglia,
        $genere,
        $specie,
        $dimensioni,
        $profumo,
        $tipologia_foglia,
        $colore_foglia,
        $descrizione
    ) {

        $query = "INSERT INTO Prodotti (nome_prodotto, prezzo, id_sottocategoria, stock, nome_volgare,
            nome_scientifico, famiglia, genere, specie, dimensioni, profumo, tipologia_foglia, colore_foglia, descrizione)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param(
                'sdsissssssssss',
                $nome_prodotto,
                $prezzo,
                $id_sottocategoria,
                $stock,
                $nome_volgare,
                $nome_scientifico,
                $famiglia,
                $genere,
                $specie,
                $dimensioni,
                $profumo,
                $tipologia_foglia,
                $colore_foglia,
                $descrizione
            );
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Modifies an existing product, returns true if executed correctly.
     */
    public function updateProduct(
        $nome_prodotto,
        $prezzo,
        $id_sottocategoria,
        $stock,
        $nome_volgare,
        $nome_scientifico,
        $famiglia,
        $genere,
        $specie,
        $dimensioni,
        $profumo,
        $tipologia_foglia,
        $colore_foglia,
        $descrizione
    ) {

        $query = "UPDATE Prodotti 
                SET prezzo = ?, id_sottocategoria = ?, stock = ?, nome_volgare = ?, 
                    nome_scientifico = ?, famiglia = ?, genere = ?, specie = ?, 
                    dimensioni = ?, profumo = ?, tipologia_foglia = ?, colore_foglia = ?, descrizione = ? 
                WHERE nome_prodotto = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param(
                'dsisssssssssss',
                $prezzo,
                $id_sottocategoria,
                $stock,
                $nome_volgare,
                $nome_scientifico,
                $famiglia,
                $genere,
                $specie,
                $dimensioni,
                $profumo,
                $tipologia_foglia,
                $colore_foglia,
                $descrizione,
                $nome_prodotto
            );
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Deletes an existing product, returns true if executed correctly
     */
    public function deleteProduct($nome)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM Prodotti WHERE nome_prodotto=?");
            $stmt->bind_param('s', $nome);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Creates a new group.
     */
    public function createNewGroup($nome_gruppo, $descrizione)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO Gruppi (nomeGruppo, descrizioneGruppo) VALUES (?, ?)");
            $stmt->bind_param('ss', $nome_gruppo, $descrizione);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Insert a product into a group.
     */
    public function addProductInGroup($nome_gruppo, $nome_prodotto)
    {

        try {
            $stmt = $this->db->prepare("INSERT INTO Appartenenze (id_gruppo, id_prodotto) VALUES (?, ?)");
            $stmt->bind_param('ss', $nome_gruppo, $nome_prodotto);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function removeProductFromGroup($nome_gruppo, $nome_prodotto)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM Appartenenze WHERE id_gruppo=? AND id_prodotto=?");
            $stmt->bind_param('ss', $nome_gruppo, $nome_prodotto);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Adds a review.
     */
    public function addReview($id_utente, $id_prodotto, $voto, $commento)
    {
        try {
            //Inserimento Recensione
            $stmt = $this->db->prepare("INSERT INTO Recensioni (id_utente, id_prodotto, voto, commento) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssis', $id_utente, $id_prodotto, $voto, $commento);
            $stmt->execute();

            //Aggiornamento voto
            $update = $this->db->prepare("UPDATE Prodotti
                SET voto = (
                    SELECT AVG(voto)
                    FROM Recensioni
                    WHERE id_prodotto = ?
                )
                WHERE nome_prodotto = ?;");
            $update->bind_param('ss', $reviewFlag, $reviewFlag);
            $update->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function checkElementInCart($idprodotto, $id_utente)
    {
        $stmt = $this->db->prepare("SELECT * FROM Carrello WHERE id_prodotto = ? AND id_utente = ?");
        $stmt->bind_param('ss', $idprodotto, $id_utente);
        $stmt->execute();
        $result = $stmt->get_result();
        $cont = count($result->fetch_all(MYSQLI_ASSOC));

        if ($cont > 0) {
            return $cont[0]['quantita'];
        } else {
            return 0;
        }
    }

    /*Insert the new item in the cart of the user or add qunti*/
    public function addToCart($idprodotto, $quantità, $id_utente)
    {
        $quant = $this->checkElementInCart($idprodotto, $id_utente);
        if ($quant > 0) {
            $stmt = $this->db->prepare("UPDATE Carrello SET quantita = ? WHERE id_utente = ?");
            $stmt->bind_param('is', $quant + $quantità, $id_utente);
            $stmt->execute();
        } else {
            $stmt = $this->db->prepare("INSERT INTO Carrello (id_utente, id_prodotto, quantita) VALUES (?, ?, ?)");
            $stmt->bind_param('ssi', $id_utente, $idprodotto, $quantità);
            $stmt->execute();
        }

    }

    /*Get the notifications of a user*/
    public function getNotificationOfAUser($id_utente)
    {
        $stmt = $this->db->prepare("SELECT DATE(data_notifica) as dataRec, messaggio FROM Notifiche WHERE id_utente = ?");
        $stmt->bind_param('s', $id_utente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkIfAMessageWasRead($messaggio, $data_notifica, $id_utente)
    {
        $stmt = $this->db->prepare("SELECT * FROM Notifiche WHERE id_utente = ? AND letto = 0 AND messaggio = ?");
        $stmt->bind_param('ss', $id_utente, $messaggio);
        $stmt->execute();
        $result = $stmt->get_result();
        $cont = count($result->fetch_all(MYSQLI_ASSOC));
        return ($cont > 0);
    }

    public function ciao()
    {
        return "ciao()";
    }

    public function changeStateOfAMessage($messaggio, $id_utente)
    {
        //if($this->db->checkIfAMessageWasRead($messaggio, "ciao" ,$id_utente)){
        $stmt = $this->db->prepare("UPDATE Notifiche SET letto = 1 WHERE id_utente = ? AND messaggio = ?");
        $stmt->bind_param('ss', $id_utente, $messaggio);
        $stmt->execute();
        return "ciao()";
        //}
    }

    public function getNumberOfMessagesNotRead($id_utente)
    {
        $stmt = $this->db->prepare("SELECT * FROM Notifiche WHERE id_utente = ? AND letto = 0");
        $stmt->bind_param('s', $id_utente);
        $stmt->execute();
        $result = $stmt->get_result();
        $cont = count($result->fetch_all(MYSQLI_ASSOC));
        return $cont;
    }
}
