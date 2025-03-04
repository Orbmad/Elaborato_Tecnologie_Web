<?php

use LDAP\Result;

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

    public function getPaymentMethods()
    {
        $stmt = $this->db->prepare("SELECT * FROM metodipagamento");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFilteredProducts(
        $categoriesChecked,
        $groupsChecked,
        $famigliaChecked,
        $profumoChecked,
        $colore_fogliaChecked,
        $tipologia_fogliaChecked,
        $minprice,
        $maxprice,
        $minrating,
        $text
    ) {
        $text = "%" . $text . "%";
        $categoriesChecked = !empty($categoriesChecked) ? $categoriesChecked : ["plantatio"];
        $groupsChecked = !empty($groupsChecked) ? $groupsChecked : ["plantatio"];
        $famigliaChecked = !empty($famigliaChecked) ? $famigliaChecked : ["plantatio"];
        $profumoChecked = !empty($profumoChecked) ? $profumoChecked : ["plantatio"];
        $colore_fogliaChecked = !empty($colore_fogliaChecked) ? $colore_fogliaChecked : ["plantatio"];
        $tipologia_fogliaChecked = !empty($tipologia_fogliaChecked) ? $tipologia_fogliaChecked : ["plantatio"];

        $includeNullGroup = in_array("Nessuno", $groupsChecked);
        if ($includeNullGroup) {
            $groupsChecked = array_diff($groupsChecked, ["Nessuno"]);
            $sql = "SELECT DISTINCT prodotti.* FROM prodotti 
            LEFT JOIN appartenenze ON prodotti.nome_prodotto = appartenenze.id_prodotto
            WHERE id_sottocategoria IN (" . implode(',', array_fill(0, count($categoriesChecked), '?')) . ")
            AND famiglia IN (" . implode(',', array_fill(0, count($famigliaChecked), '?')) . ")
            AND profumo IN (" . implode(',', array_fill(0, count($profumoChecked), '?')) . ")
            AND colore_foglia IN (" . implode(',', array_fill(0, count($colore_fogliaChecked), '?')) . ") 
            AND (id_gruppo IN (" . implode(',', array_fill(0, count($groupsChecked), '?')) . ") 
            OR ISNULL(id_gruppo))
            AND tipologia_foglia IN (" . implode(',', array_fill(0, count($tipologia_fogliaChecked), '?')) . ")
            AND prezzo BETWEEN ? AND ?
            AND voto >= ?
            AND presente = 1
            AND nome_prodotto LIKE ?
            ";
        } else {
            $sql = "SELECT DISTINCT prodotti.* FROM prodotti 
            LEFT JOIN appartenenze ON prodotti.nome_prodotto = appartenenze.id_prodotto
            WHERE id_sottocategoria IN (" . implode(',', array_fill(0, count($categoriesChecked), '?')) . ")
            AND famiglia IN (" . implode(',', array_fill(0, count($famigliaChecked), '?')) . ")
            AND profumo IN (" . implode(',', array_fill(0, count($profumoChecked), '?')) . ")
            AND colore_foglia IN (" . implode(',', array_fill(0, count($colore_fogliaChecked), '?')) . ") 
            AND id_gruppo IN (" . implode(',', array_fill(0, count($groupsChecked), '?')) . ") 
            AND tipologia_foglia IN (" . implode(',', array_fill(0, count($tipologia_fogliaChecked), '?')) . ")
            AND prezzo BETWEEN ? AND ?
            AND voto >= ?
            AND presente = 1
            AND nome_prodotto LIKE ?
            ";

        }

        $stmt = $this->db->prepare($sql);

        $types = str_repeat('s', count($categoriesChecked) + count($famigliaChecked) + count($profumoChecked) + count($colore_fogliaChecked) + count($groupsChecked) + count($tipologia_fogliaChecked)) . "iiis";
        $params = array_merge($categoriesChecked, $famigliaChecked, $profumoChecked, $colore_fogliaChecked, $groupsChecked, $tipologia_fogliaChecked, [$minprice], [$maxprice], [$minrating], [$text]);
        $stmt->bind_param($types, ...$params);
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
        $stmt = $this->db->prepare("SELECT * FROM Prodotti WHERE nome_prodotto = ? AND presente = 1");
        $stmt->bind_param('s', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns a group from its name
     */
    public function getGroup($nomeGruppo)
    {
        $stmt = $this->db->prepare("SELECT * FROM Gruppi WHERE nomeGruppo = ?");
        $stmt->bind_param('s', $nomeGruppo);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns all user addresses
     */
    public function getUserAddresses($user)
    {
        $query = "SELECT *
                FROM Indirizzi
                WHERE id_utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteUserAddress($user, $id_indirizzo)
    {
        $query = "DELETE FROM Indirizzi
                WHERE id_utente = ?
                AND id_indirizzo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $user, $id_indirizzo);
        $stmt->execute();
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
        $attributes = array("famiglia", "profumo", "tipologia_foglia", "colore_foglia");
        $results = [];

        foreach ($attributes as $attribute) {
            $stmt = $this->db->prepare("SELECT DISTINCT `$attribute` as attributo FROM Prodotti WHERE `$attribute` != 'non specificato'");
            $stmt->execute();
            $result = $stmt->get_result();
            $values = $result->fetch_all(MYSQLI_ASSOC);

            $valuesList = [];
            foreach ($values as $row) {
                $valuesList[] = $row['attributo'];
            }
            $results[$attribute] = $valuesList;
        }

        $stmt = $this->db->prepare("SELECT DISTINCT nomeGruppo as nome_gruppo FROM Gruppi");
        $stmt->execute();
        $result = $stmt->get_result();
        $values = $result->fetch_all(MYSQLI_ASSOC);
        $valuesList = [];
        foreach ($values as $row) {
            $valuesList[] = $row['nome_gruppo'];
        }
        $valuesList[] = "Nessuno";
        $results['nome_gruppo'] = $valuesList;
        return $results;
    }

    /**
     * Returns a product by its name.
     */
    public function searchProductByName($name)
    {
        $text = "%" . $name . "%";
        $stmt = $this->db->prepare("SELECT * FROM prodotti WHERE nome_prodotto LIKE ? AND stock > 0 ORDER BY RAND()");
        $stmt->bind_param('s', $text);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductGroups($nomeProdotto)
    {
        $stmt = $this->db->prepare("SELECT gruppi.nomeGruppo 
                            FROM `prodotti` 
                            INNER JOIN appartenenze ON prodotti.nome_prodotto = appartenenze.id_prodotto 
                            INNER JOIN gruppi ON gruppi.nomeGruppo = appartenenze.id_gruppo 
                            WHERE nome_prodotto = ?");
        $stmt->bind_param('s', $nomeProdotto);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se ci sono righe nel risultato
        if ($result->num_rows === 0) {
            $result = "Nessuno";
        } else {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $gruppi = array_map(function ($row) {
                return str_replace(' ', '', $row['nomeGruppo']);
            }, $rows);
            $result = implode(' ', $gruppi);
        }
        return $result;
    }

    public function getBestProducts($n)
    {
        $stmt = $this->db->prepare("SELECT * FROM prodotti WHERE presente = 1 ORDER BY voto DESC LIMIT ?");
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


    // INIZIO QUERY ADMIN

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
        $query = "UPDATE Prodotti
                SET presente = 0
                WHERE nome_prodotto = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $nome);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function removeDeletedProductFromCarts($nome)
    {
        $query = "DELETE FROM Carrello
                WHERE id_prodotto = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $nome);
            $stmt->execute();
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
     * Deletes a group
     */
    public function deleteGroup($nome_gruppo)
    {
        $query1 = "DELETE FROM Appartenenze
                WHERE id_gruppo = ?";
        $query2 = "DELETE FROM Gruppi
                WHERE nomeGruppo = ?";
        try {
            $stmt1 = $this->db->prepare($query1);
            $stmt1->bind_param('s', $nome_gruppo);
            $stmt1->execute();

            $stmt2 = $this->db->prepare($query2);
            $stmt2->bind_param('s', $nome_gruppo);
            $stmt2->execute();

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
     * Updates the state of an order and send a notification to the user
     */
    public function updateOrderState($id_ordine, $stato, $id_utente)
    {
        $query = "UPDATE Ordini
                SET stato_ordine = ?
                WHERE id_ordine = ?";

        $notif = "INSERT INTO Notifiche (id_utente, messaggio)
                VALUES (?, ?)";

        try {
            $stmt_query = $this->db->prepare($query);
            $stmt_notif = $this->db->prepare($notif);

            $stmt_query->bind_param('si', $stato, $id_ordine);
            $string = "Lo stato dell`ordine " . $id_ordine . " è stato aggiornato: " . $stato;
            $stmt_notif->bind_param('ss', $id_utente, $string);

            $stmt_query->execute();
            $stmt_notif->execute();

            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Returns the user from an order
     */
    public function getUserFromOrder($id_ordine)
    {
        $query = "SELECT id_utente
                FROM Ordini
                WHERE id_ordine = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id_ordine);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["id_utente"];
    }

    //FINE QUERY ADMIN

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
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $cont = count($result);
        if ($cont > 0) {
            return $result[0]['quantita'];
        } else {
            return 0;
        }
    }

    /**
     * Insert the new item in the cart of the user or add quantity
     */
    public function addToCart($idprodotto, $quantità, $id_utente)
    {
        $quant = $this->checkElementInCart($idprodotto, $id_utente);
        if ($quant > 0) {
            $stmt = $this->db->prepare("UPDATE Carrello SET quantita = ? WHERE id_utente = ? AND id_prodotto = ?");
            $quantità += $quant;
            $stmt->bind_param('iss', $quantità, $id_utente, $idprodotto);
            $stmt->execute();
        } else {
            $stmt = $this->db->prepare("INSERT INTO Carrello (id_utente, id_prodotto, quantita) VALUES (?, ?, ?)");
            $stmt->bind_param('ssi', $id_utente, $idprodotto, $quantità);
            $stmt->execute();
        }
    }

    /**
     * Get the notifications of a user
     */
    public function getNotificationOfAUser($id_utente)
    {
        $stmt = $this->db->prepare("SELECT DATE(data_notifica) as dataRec, messaggio, id_notifica FROM Notifiche WHERE id_utente = ? ORDER BY data_notifica DESC");
        $stmt->bind_param('s', $id_utente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns true if the user has a certain product in its cart
     */
    public function hasUserProductInCart($user, $id_prodotto)
    {
        $query = "SELECT *
                FROM Carrello
                WHERE id_utente = ?
                AND id_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $user, $id_prodotto);
        $stmt->execute();

        $result = $stmt->get_result();

        return count($result->fetch_all(MYSQLI_ASSOC)) > 0;
    }

    //Inizio Queries Ausilio notifiche

    /**
     * Returns all users except teh admins
     */
    public function getAllUsers()
    {
        $query = "SELECT email FROM Utenti WHERE admin_flag = 0";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Returns all the admins
     */
    public function getAllAdmins()
    {
        $query = "SELECT email FROM Utenti WHERE admin_flag = 0";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Creates a notification
     */
    public function newNotification($id_utente, $testo)
    {
        $query = "INSERT INTO Notifiche (id_utente, messaggio)
                VALUES (?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $id_utente, $testo);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }


    /**
     * Creates a notification for all the users
     */
    public function broadcastNotification($testo)
    {
        $users = $this->getAllUsers();
        $query = "INSERT INTO Notifiche (id_utente, messaggio)
                VALUES (?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            foreach ($users as $user) {
                $stmt->bind_param('ss', $user["email"], $testo);
                $stmt->execute();
            }
            return false;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Creates a notification for all the admins
     */
    public function adminNotification($testo)
    {
        $users = $this->getAllAdmins();
        $query = "INSERT INTO Notifiche (id_utente, messaggio)
                VALUES (?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            foreach ($users as $user) {
                $stmt->bind_param('ss', $user["email"], $testo);
                $stmt->execute();
            }
            return false;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Returns the users that have a certain product in their cart
     */
    public function getUsersWithProductInCart($nome_prodotto)
    {
        $query = "SELECT U.email
                FROM  Carrello C
                JOIN Utenti U ON C.id_utente = U.email
                WHERE C.id_prodotto = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $nome_prodotto);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Add notifications to Admin
     */
    public function newAdminNotification($testo)
    {
        $query = "INSERT INTO Notifiche (id_utente, messaggio)
                VALUES ('admin', ?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $testo);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function checkIfAMessageWasRead($messaggio, $data_notifica, $id_notifica, $id_utente)
    {
        $stmt = $this->db->prepare("SELECT * FROM Notifiche WHERE id_utente = ? AND letto = 0 AND messaggio = ? AND id_notifica = ?");
        $stmt->bind_param('ssi', $id_utente, $messaggio, $id_notifica);
        $stmt->execute();
        $result = $stmt->get_result();
        $cont = count($result->fetch_all(MYSQLI_ASSOC));
        return ($cont > 0);
    }

    public function changeStateOfAMessage($messaggio, $id_notifica, $id_utente)
    {
        echo $messaggio;
        if ($this->checkIfAMessageWasRead($messaggio, "", $id_notifica, $id_utente)) {
            $stmt = $this->db->prepare("UPDATE Notifiche SET letto = 1 WHERE id_utente = ? AND messaggio = ? AND id_notifica = ?");
            $stmt->bind_param('ssi', $id_utente, $messaggio, $id_notifica);
            $stmt->execute();
            return "ciao()";
        }
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

    //Fine queries ausilio notifiche

    public function getOrdersOfAUser($id_utente)
    {
        $query = "SELECT *, DATE(data_ordine) as dataOrdine 
                FROM Ordini/*, Indirizzi*/
                WHERE Ordini.id_utente = ? 
                /*AND Ordini.id_indirizzo = Indirizzi.id_indirizzo*/
                ORDER BY data_ordine DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id_utente);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getItemsInAnOrder($id_ordine)
    {
        $stmt = $this->db->prepare("SELECT id_dettaglio, nome_prodotto, quantita, prezzo_unitario FROM dettagliordini, prodotti WHERE nome_prodotto = id_prodotto AND id_ordine = ?");
        $stmt->bind_param('i', $id_ordine);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function hasUserLeftAReviewForProduct($id_utente, $id_prodotto)
    {
        $stmt = $this->db->prepare("SELECT * FROM recensioni WHERE id_utente = ? AND id_prodotto =  ?");
        $stmt->bind_param('ss', $id_utente, $id_prodotto);
        $stmt->execute();
        $result = $stmt->get_result();
        $cont = count($result->fetch_all(MYSQLI_ASSOC));
        return ($cont > 0);
    }

    //Queries ordini

    /**
     * Empties the cart of a user
     */
    public function emptyCart($user)
    {
        $query = "DELETE FROM Carrello
                WHERE id_utente = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $user);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Returns the cart of a user
     */
    public function fetchUserCart($user)
    {
        $query = "SELECT C.*, P.prezzo
                FROM Carrello C
                JOIN Prodotti P ON C.id_prodotto = P.nome_prodotto
                WHERE id_utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $user);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function removeFromStock($id_prodotto, $quantity)
    {
        $query = "UPDATE Prodotti
                SET stock = stock - ?
                WHERE nome_prodotto = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('is', $quantity, $id_prodotto);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Returns address data
     */
    public function getAddressData($id_indirizzo)
    {
        $query = "SELECT *
                FROM Indirizzi
                WHERE id_indirizzo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_indirizzo);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    /**
     * Creates a new order with the products in the cart.
     */
    public function createOrderFromCart($user, $id_metodo, $id_indirizzo, $totale)
    {
        try {
            //Dati indirizzo
            $address = $this->getAddressData($id_indirizzo);

            // creazione ordine
            $newOrder = "INSERT INTO Ordini (id_utente, id_metodo, id_indirizzo, via, citta, provincia, cap, nazione, totale)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_newOrder = $this->db->prepare($newOrder);
            $stmt_newOrder->bind_param('siisssssd', $user, $id_metodo, $id_indirizzo, $address["via"], $address["citta"], $address["provincia"], $address["cap"], $address["nazione"], $totale);
            $stmt_newOrder->execute();
            $order_id = $stmt_newOrder->insert_id;

            //creazione query dettaglio ordine
            $newOrderDetail = "INSERT INTO DettagliOrdini (id_ordine, id_prodotto, quantita, prezzo_unitario)
                    VALUES (?, ?, ?, ?)";
            $stmt_newOrderDetail = $this->db->prepare($newOrderDetail);

            //recupero informazioni dal carrello
            $cart = $this->fetchUserCart($user);

            //inserimento informazioni in dettagli ordine
            foreach ($cart as $detail) {
                $stmt_newOrderDetail->bind_param('isid', $order_id, $detail["id_prodotto"], $detail["quantita"], $detail["prezzo"]);
                $this->removeFromStock($detail["id_prodotto"], $detail["quantita"]);
                $stmt_newOrderDetail->execute();
            }

            //svuotamento carrello
            $this->emptyCart($user);

            //Notifica Admin
            $string = "L`utente " . $user . " ha effettuato un nuovo ordine. Codice ordine: " . $order_id;
            $this->newAdminNotification($string);

            return true;
        } catch (PDOException) {
            return false;
        }
    }

    /**
     * Saves the address
     */
    public function saveAddress($id_utente, $via, $citta, $provincia, $cap, $nazione)
    {
        $query = "INSERT INTO Indirizzi (id_utente, via, citta, provincia, cap, nazione)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $id_utente, $via, $citta, $provincia, $cap, $nazione);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates a new order with the products in the cart and an address not saved
     */
    public function createOrderFromCart_addressNotSaved($user, $id_metodo, $via, $citta, $provincia, $cap, $nazione, $totale, $save)
    {
        try {
            // creazione ordine
            $newOrder = "INSERT INTO Ordini (id_utente, id_metodo, via, citta, provincia, cap, nazione, totale)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_newOrder = $this->db->prepare($newOrder);
            $stmt_newOrder->bind_param('sisssssd', $user, $id_metodo, $via, $citta, $provincia, $cap, $nazione, $totale);
            $stmt_newOrder->execute();
            $order_id = $stmt_newOrder->insert_id;

            //Salvataggio indirizzo
            if ($save) {
                $this->saveAddress($user, $via, $citta, $provincia, $cap, $nazione);
            }

            //creazione query dettaglio ordine
            $newOrderDetail = "INSERT INTO DettagliOrdini (id_ordine, id_prodotto, quantita, prezzo_unitario)
                    VALUES (?, ?, ?, ?)";
            $stmt_newOrderDetail = $this->db->prepare($newOrderDetail);

            //recupero informazioni dal carrello
            $cart = $this->fetchUserCart($user);

            //inserimento informazioni in dettagli ordine
            foreach ($cart as $detail) {
                $stmt_newOrderDetail->bind_param('isid', $order_id, $detail["id_prodotto"], $detail["quantita"], $detail["prezzo"]);
                $this->removeFromStock($detail["id_prodotto"], $detail["quantita"]);
                $stmt_newOrderDetail->execute();
            }

            //svuotamento carrello
            $this->emptyCart($user);

            //Notifica Admin
            $string = "L`utente " . $user . " ha effettuato un nuovo ordine. Codice ordine: " . $order_id;
            $this->newAdminNotification($string);

            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function isOrderPossible($user)
    {
        $query = "SELECT nome_prodotto
                FROM Prodotti P
                JOIN Carrello C ON C.id_prodotto = P.nome_prodotto
                WHERE P.stock < P.stock - C.quantita
                AND C.id_utente = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $user);
        $stmt->execute();

        $result = $stmt->get_result();

        return !($result->fetch_all(MYSQLI_ASSOC) > 0);
    }
}
