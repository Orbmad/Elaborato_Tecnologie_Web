CREATE DATABASE IF NOT EXISTS Plantatio;
USE Plantatio;

-- Tabella utenti
CREATE TABLE Utenti (
    email VARCHAR(150) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    admin_flag BOOLEAN NOT NULL
);

-- Tabella indirizzi
CREATE TABLE Indirizzi (
    id_indirizzo INT AUTO_INCREMENT NOT NULL,
    id_utente VARCHAR(150) NOT NULL,
    via VARCHAR(255) NOT NULL,
    citta VARCHAR(100) NOT NULL,
    provincia VARCHAR(100) NOT NULL,
    cap VARCHAR(10) NOT NULL,
    nazione VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_indirizzo, id_utente),
    FOREIGN KEY (id_utente) REFERENCES Utenti(email) ON DELETE CASCADE
);

-- Tabella metodi di pagamento
CREATE TABLE MetodiPagamento (
    id_metodo INT AUTO_INCREMENT PRIMARY KEY,
    tipo_metodo VARCHAR(50) NOT NULL -- es. "Carta di credito", "PayPal"
);

-- Tabella categorie
CREATE TABLE Categorie (
    nome_categoria VARCHAR(100) PRIMARY KEY,
    descrizione TEXT
);

-- Tabella sottocategorie
CREATE TABLE SottoCategorie (
    id_categoria VARCHAR(100) NOT NULL,
    nome_sottocategoria VARCHAR(100) NOT NULL,
    descrizione TEXT,
    PRIMARY KEY(id_categoria, nome_sottocategoria),
    FOREIGN KEY (id_categoria) REFERENCES Categorie(nome_categoria) ON DELETE CASCADE
);

-- Tabella prodotti
CREATE TABLE Prodotti (
    nome_prodotto VARCHAR(150) PRIMARY KEY,
    prezzo DECIMAL(10, 2) NOT NULL,
    id_sottocategoria VARCHAR(100) NOT NULL,
    stock INT NOT NULL,
    nome_volgare VARCHAR(50), -- Tassonomia Pianta-----------------------------
    nome_scientifico VARCHAR(50),
    famiglia VARCHAR(50),
    genere VARCHAR(50),
    specie VARCHAR(50),
    dimensioni VARCHAR(30), -- Caratteristiche di vendita--------------------
    profumo VARCHAR(30), -- Caratteri botanici----------------------------
    tipologia_foglia VARCHAR(30),
    colore_foglia VARCHAR(30), 
    descrizione TEXT,
    voto INT NOT NULL
);

-- Tabella carrello (Ogni utente possiede una tupla per ogni prodotto diverso nel carrello)
CREATE TABLE Carrello (
    id_carrello INT AUTO_INCREMENT,
    id_utente VARCHAR(150) NOT NULL,
    id_prodotto VARCHAR(150) NOT NULL,
    quantita INT CHECK (quantita > 0),
    PRIMARY KEY(id_carrello, id_utente),
    FOREIGN KEY (id_utente) REFERENCES Utenti(email) ON DELETE CASCADE,
    FOREIGN KEY (id_prodotto) REFERENCES Prodotti(nome_prodotto) ON DELETE CASCADE
);

-- Tabella gruppi di prodotti
CREATE TABLE Gruppi (
    nomeGruppo VARCHAR(50) PRIMARY KEY,
    descrizioneGruppo TEXT
);

-- Tabella appartenenza gruppo
CREATE TABLE Appartenenze (
    id_gruppo VARCHAR(50) NOT NULL,
    id_prodotto VARCHAR(150) NOT NULL,
    PRIMARY KEY (id_gruppo, id_prodotto),
    FOREIGN KEY (id_gruppo) REFERENCES Gruppi(nomeGruppo) ON DELETE CASCADE,
    FOREIGN KEY (id_prodotto) REFERENCES Prodotti(nome_prodotto) ON DELETE CASCADE
);


-- Tabella ordini
CREATE TABLE Ordini (
    id_ordine INT AUTO_INCREMENT PRIMARY KEY,
    id_utente VARCHAR(50) NOT NULL,
    id_metodo INT NOT NULL,
    id_indirizzo INT NOT NULL,
    stato_ordine VARCHAR(100) DEFAULT 'in attesa',
    data_ordine TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    totale DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES Utenti(email) ON DELETE CASCADE,
    FOREIGN KEY (id_metodo) REFERENCES MetodiPagamento(id_metodo) ON DELETE CASCADE,
    FOREIGN KEY (id_indirizzo) REFERENCES Indirizzi(id_indirizzo) ON DELETE CASCADE
);

-- Tabella dettagli ordini
CREATE TABLE DettagliOrdini (
    id_dettaglio INT AUTO_INCREMENT PRIMARY KEY,
    id_ordine INT NOT NULL,
    id_prodotto VARCHAR(150) NOT NULL,
    quantita INT NOT NULL,
    prezzo_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_ordine) REFERENCES Ordini(id_ordine) ON DELETE CASCADE,
    FOREIGN KEY (id_prodotto) REFERENCES Prodotti(nome_prodotto)
);

-- Tabella notifiche
CREATE TABLE Notifiche (
    id_notifica INT AUTO_INCREMENT,
    id_utente VARCHAR(150) NOT NULL,
    messaggio TEXT NOT NULL,
    letto BOOLEAN DEFAULT FALSE,
    data_notifica TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id_notifica, id_utente),
    FOREIGN KEY (id_utente) REFERENCES Utenti(email) ON DELETE CASCADE
);

-- Tabella recensioni
CREATE TABLE Recensioni (
    id_utente VARCHAR(150) NOT NULL,
    id_prodotto VARCHAR(150) NOT NULL,
    voto INT CHECK (voto BETWEEN 1 AND 5), -- voto da 1 a 5
    commento TEXT,
    data_recensione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_prodotto, id_utente),
    FOREIGN KEY (id_utente) REFERENCES Utenti(email) ON DELETE CASCADE,
    FOREIGN KEY (id_prodotto) REFERENCES Prodotti(nome_prodotto) ON DELETE CASCADE
);
